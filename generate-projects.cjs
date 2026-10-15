const fs = require('fs');
const path = require('path');

const projectsDir = path.join(__dirname, 'projects');

function scanProjects() {
    let categories = {};
    
    if (!fs.existsSync(projectsDir)) {
        console.log("Projects directory not found at:", projectsDir);
        return;
    }

    let catFolders = fs.readdirSync(projectsDir, { withFileTypes: true })
        .filter(dirent => dirent.isDirectory())
        .map(dirent => dirent.name);

    catFolders.forEach(cat => {
        categories[cat] = [];
        let catPath = path.join(projectsDir, cat);
        let files = fs.readdirSync(catPath).filter(file => file.endsWith('.php') || file.endsWith('.html'));

        files.forEach(file => {
            let filePath = path.join(catPath, file);
            let content = fs.readFileSync(filePath, 'utf8');

            // 1. Extract Description from Blade comment: {{-- DESCRIPTION §...§ --}}
            let descMatch = content.match(/\{\{--\s*DESCRIPTION\s*§(.*?)§\s*--\}\}/s);
            let description = descMatch ? descMatch[1].trim() : "";

            // Fallback description if tag isn't found
            if (!description) {
                let pMatch = content.match(/<p>(.*?)<\/p>/s);
                description = pMatch ? pMatch[1].replace(/<[^>]*>?/gm, '').trim() : "No description available.";
            }

            // 2. Extract Tags from Blade comment: {{-- TAGS §...§ --}}
            let tagsMatch = content.match(/\{\{--\s*TAGS\s*§(.*?)§\s*--\}\}/s);
            let tags = tagsMatch ? tagsMatch[1].split(',').map(t => t.trim()) : [];

            // 3. Extract Image from Blade comment: {{-- IMAGE §...§ --}}
            let imgMatch = content.match(/\{\{--\s*IMAGE\s*§(.*?)§\s*--\}\}/s);
            let image = imgMatch ? imgMatch[1].trim() : `images/${cat}/default.png`;

            // 4. Extract Title from <h1>
            let titleMatch = content.match(/<h1>(.*?)<\/h1>/s);
            let title = titleMatch ? titleMatch[1].replace(/<[^>]*>?/gm, '').trim() : file.replace(/\.(blade\.php|php|html)$/, '');

            // Determine correct web extension link (if changing files to html or keeping php)
            let webFilename = file.replace('.blade.php', '.php'); // or .html depending on your setup

            categories[cat].push({
                filename: file,
                title: title,
                description: description,
                tags: tags,
                image: image,
                url: `projects/${cat}/${webFilename}`
            });
        });
    });

    fs.writeFileSync(path.join(__dirname, 'projects.json'), JSON.stringify(categories, null, 4));
    console.log("Successfully parsed project files and updated projects.json!");
}

scanProjects();