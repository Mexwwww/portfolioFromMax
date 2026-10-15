async function loadHeader() {
    let isInSubfolder = window.location.pathname.includes('/projects/');
    let headerPath = isInSubfolder ? '../../header.html' : 'header.html';
    
    try {
        let response = await fetch(headerPath);
        let html = await response.text();
        
        if (isInSubfolder) {
            html = html.replace(/href="index.html"/g, 'href="../../index.html"')
                       .replace(/href="categories.html"/g, 'href="../../categories.html"')
                       .replace(/href="contact.html"/g, 'href="../../contact.html"');
        }
        
        document.getElementById('site-header').innerHTML = html;
    } catch (e) {
        console.error('Failed to load header component', e);
    }
}