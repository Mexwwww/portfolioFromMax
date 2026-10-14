@php use Illuminate\Support\Facades\File; @endphp
@extends('layout.layout')

@section('style')
    <style>
        .backgroundColor {
            background: #0d1117 !important;
        }
    </style>
@endsection

<style>
    body {
        background-color: #0d1117;
        color: #c9d1d9;
    }

    #catagoryButtons {
        padding: 6vh 1rem 2vh;
    }

    .blackBackgroundColor {
        background: #161b22;
        border-radius: 8px;
        border: 1px solid #30363d;
        color: #8b949e;
        transition: all 0.2s ease;
        font-family: 'Fira Code', monospace;
    }

    .blackBackgroundColor:hover {
        background: #21262d;
        color: #c9d1d9;
        border-color: #8b949e;
    }

    .blackBackgroundColor_slct {
        border-radius: 8px;
        background: rgba(56, 139, 253, 0.15) !important;
        color: #58a6ff !important;
        text-decoration: none;
        border: 1px solid #58a6ff !important;
        box-shadow: 0 0 10px rgba(88, 166, 255, 0.2);
        font-family: 'Fira Code', monospace;
    }

    #catagoryButtons.at-category-level .blackBackgroundColor_slct {
        border-color: #58a6ff;
    }

    .project {
        background: none;
        display: none;
    }

    .temp {
        color: #c9d1d9;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .temp:hover {
        color: #58a6ff;
        text-decoration: none;
    }

    .temp_slct {
        color: #58a6ff;
        text-decoration: none;
    }

    #projectHandeler {
        padding: 2vh 0 6vh;
    }

    .project-card {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        max-width: 320px;
        margin: 0 auto;
    }

    .project-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.6);
        border-color: #8b949e;
    }

    .temp_slct .project-card {
        border: 1px solid #58a6ff;
        box-shadow: 0 0 15px rgba(88, 166, 255, 0.25);
    }

    .project-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-bottom: 1px solid #30363d;
    }

    .project-card .card-title {
        color: #58a6ff;
        font-weight: 600;
        font-family: 'Fira Code', monospace;
    }

    .project-card .card-text {
        color: #8b949e;
        font-size: 0.9rem;
    }

    .project-tags {
        margin-top: 0.75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .project-tag {
        display: inline-block;
        background: #21262d;
        color: #8b949e;
        font-size: 0.75rem;
        padding: 0.25em 0.7em;
        border-radius: 999px;
        border: 1px solid #30363d;
        font-family: 'Fira Code', monospace;
    }
</style>

<body style="color: #c9d1d9; background-color: #0d1117;">

<?php
$projects = [];
$projectNames = [];
$directoryNames = [];
$basePath = resource_path('views/projects');
foreach (File::directories($basePath) as $directory)
{
    foreach (File::files($directory) as $file)
    {
        $projects[] = $file;
        $projectNames[basename($directory)][] = str_replace('.blade', '', $file->getFilenameWithoutExtension());
        $directoryNames[] = basename($directory);
    }
}

$categoryOrder = [
    'unity' => ['WinterWonderRide', 'Hack', 'ThePlay', 'ProceduralAnimation'],
];
foreach ($categoryOrder as $categoryName => $order)
{
    if (isset($projectNames[$categoryName]))
    {
        usort($projectNames[$categoryName], function ($a, $b) use ($order) {
            $posA = array_search($a, $order);
            $posB = array_search($b, $order);
            $posA = $posA === false ? count($order) : $posA;
            $posB = $posB === false ? count($order) : $posB;
            return $posA <=> $posB;
        });
    }
}
$directoryNames = collect($directoryNames)->unique()->values()->toArray();

if(!function_exists('GetProjectDiscriptionOrImage'))
{
    function GetProjectDiscriptionOrImage($project, $projects, $lookForImage = false, $category = '')
    {
        $fileObj = collect($projects)->filter(function ($file) use ($project) {
            return $file->getFilename() === $project . '.blade.php';
        })->first();

        if (!$fileObj) return null;
        $content = File::get($fileObj->getRealPath());

        if ($lookForImage) {
            if (preg_match('/{{--\s*IMAGE\s*§(.*?)§\s*--}}/', $content, $imgMatch) && isset($imgMatch[1])) {
                return asset(trim($imgMatch[1]));
            }
            // Auto-detect image folder based on category or project name if no explicit tag exists
            if (!empty($category)) {
                $possiblePath = "images/{$category}/{$project}.png";
                if (file_exists(public_path($possiblePath))) {
                    return asset($possiblePath);
                }
            }
            return asset('images/laravel/laravel-Logo.png');
        } else {
            // 1. Check DESCRIPTION tag first
            if (preg_match('/{{--\s*DESCRIPTION\s*§(.*?)§\s*--}}/', $content, $descMatch) && isset($descMatch[1])) {
                return trim($descMatch[1]);
            }
            // 2. Check project-summary div
            if (preg_match('/<div class="project-summary">\s*(.*?)\s*<\/div>/s', $content, $summaryMatch) && isset($summaryMatch[1])) {
                return trim(strip_tags($summaryMatch[1]));
            }
            // 3. Fallback to extracting the first paragraph (<p>) for other projects without tags/summaries
            if (preg_match('/<p>(.*?)<\/p>/s', $content, $pMatch) && isset($pMatch[1])) {
                return trim(strip_tags($pMatch[1]));
            }
            return null;
        }
    }
}

if(!function_exists('GetProjectTitle'))
{
    function GetProjectTitle($project, $projects)
    {
        $fileObj = collect($projects)->filter(function ($file) use ($project) {
            return $file->getFilename() === $project . '.blade.php';
        })->first();

        if (!$fileObj) return $project;
        $content = File::get($fileObj->getRealPath());

        if (preg_match('/<h1>(.*?)<\/h1>/s', $content, $titleMatch) && isset($titleMatch[1])) {
            return trim(strip_tags($titleMatch[1]));
        }
        return $project;
    }
}

if(!function_exists('GetProjectTags'))
{
    function GetProjectTags($project, $projects)
    {
        $fileObj = collect($projects)->filter(function ($file) use ($project) {
            return $file->getFilename() === $project . '.blade.php';
        })->first();

        if (!$fileObj) return [];
        $content = File::get($fileObj->getRealPath());

        $line = collect(file($fileObj->getRealPath()))->filter(function ($line) {
            return str_contains($line, 'TAGS');
        })->first();
        $result = explode('§', $line ?? '');
        $tags = $result[1] ?? null;
        return $tags == null ? [] : array_map('trim', explode(',', $tags));
    }
}
?>

@section('content')
    <div id="catagoryButtons" style="text-align: center;">
        @foreach($directoryNames as $directoryName)
            <a class="temp blackBackgroundColor"
               style="font-size: 1.15rem; padding: 0.6em 1.5em; margin: 0 0.4em; display: inline-block;"
               id="{{$directoryName}}" onclick="ClickedOn(id)">
                <span style="line-height: 1;">{{$directoryName}}</span>
            </a>
        @endforeach
    </div>
    <div class="container text-center">
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3" id="projectHandeler">
            @php($count = 0)
            @foreach($projectNames as $key => $category)
                @foreach($category as $project)
                    @php($projectForName = GetProjectTitle($project, $projects))
                    @php($projectDescription = GetProjectDiscriptionOrImage($project, $projects, false, $key))
                    @php($projectImage = GetProjectDiscriptionOrImage($project, $projects, true, $key))
                    @php($projectTags = GetProjectTags($project, $projects))
                    @php($count++)
                    <div class="col project" id="{{$key}}">
                        <div id="project {{$count}}" class="col temp">
                            <a href="/projects/{{$key}}/{{$project}}">
                                <div class="card project-card">
                                    <img src="{{$projectImage}}" alt="selected"
                                         class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$projectForName}}</h5>
                                        <p class="card-text">{{$projectDescription}}</p>
                                        @if(count($projectTags) > 0)
                                            <div class="project-tags">
                                                @foreach($projectTags as $tag)
                                                    <span class="project-tag">{{$tag}}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
</body>
<script>
    @section('onLoad')
    const id = document.URL.split('/').at(-1);
    document.getElementById(id).setAttribute('class', 'temp_slct blackBackgroundColor_slct')
    document.getElementById('categories').setAttribute('class', 'btn slct-darkslate')
    ChangeFilter(id);
    document.getElementById("selectedInLayout").textContent = -2;
    @endsection

    function ChangeFilter(id)
    {
        const projects = document.getElementsByClassName('project');
        for (var i = 0; i < projects.length; i++)
        {
            var project = projects[i];
            if (project.id === id)
            {
                project.setAttribute('style', 'display: block');
            } else
            {
                project.setAttribute('style', 'display: none');
            }
        }
    }

    function GetColumnCount(projectNames)
    {
        if (projectNames.length === 0)
        {
            return 1;
        }
        const firstTop = projectNames.at(0).offsetTop;
        let count = 0;
        for (let i = 0; i < projectNames.length; i++)
        {
            if (projectNames.at(i).offsetTop === firstTop)
            {
                count++;
            } else
            {
                break;
            }
        }
        return count;
    }

    @section('KeyInYX')
    let previousDepthLevel = document.getElementById("selectedInLayout").textContent;

    if (previousDepthLevel == -2)
    {
        const shownProjects = GetShownProjects();
        const columnCount = GetColumnCount(shownProjects);
        let currentIndex = GetSelectedButtonOrderNumber(shownProjects);
        if (currentIndex === -1 || currentIndex === undefined)
        {
            currentIndex = 0;
        }
        const indexDelta = upDownInt === -1 ? columnCount : -columnCount;
        const targetIndex = currentIndex + indexDelta;

        if (targetIndex >= 0 && targetIndex < shownProjects.length)
        {
            shownProjects.at(currentIndex).setAttribute('class', 'col temp');
            shownProjects.at(targetIndex).setAttribute('class', 'col temp_slct');
            document.getElementById("selectedInLayout").textContent = -2;
            return;
        }

        if (upDownInt === -1)
        {
            document.getElementById("selectedInLayout").textContent = -2;
            return;
        }
    }

    depthLevel = previousDepthLevel;
    if (depthLevel === 'true')
    {
        depthLevel = 0;
    }
    depthLevel = parseInt(depthLevel) + parseInt(upDownInt);
    if (depthLevel >= 0)
    {
        depthLevel = 'true'
    }
    if (depthLevel < -2)
    {
        depthLevel = -2;
    }

    if (depthLevel === -2 && previousDepthLevel != -2)
    {
        const projectNames = GetShownProjects();
        let orderNumber = GetSelectedButtonOrderNumber(projectNames);
        if (orderNumber === -1 || orderNumber === undefined)
        {
            orderNumber = 0;
        }
        const project = projectNames.at(orderNumber);
        if (!project.getAttribute('class').includes('slct'))
        {
            project.setAttribute('class', 'col temp_slct')
        }
    }

    if (previousDepthLevel == -2 && depthLevel !== -2)
    {
        GetShownProjects().forEach(function (project)
        {
            project.setAttribute('class', 'col temp')
        });
    }

    if (depthLevel === -1)
    {
        document.getElementById('catagoryButtons').classList.add('at-category-level');
    } else
    {
        document.getElementById('catagoryButtons').classList.remove('at-category-level');
    }

    document.getElementById("selectedInLayout").textContent = depthLevel;
    @endsection

    @section('KeyInXX')
    depthLevel = document.getElementById("selectedInLayout").textContent;
    if (depthLevel !== 'true')
    {
        if (depthLevel === '-1')
        {
            $cattagoryButtons = GetCattagoryButtons();
            LeftAndRight(key, $cattagoryButtons, 'temp blackBackgroundColor', 'temp_slct blackBackgroundColor_slct')
            ChangeFilter($cattagoryButtons.at(GetSelectedButtonOrderNumber($cattagoryButtons)).id);
        } else
        {
            $projectNames = GetShownProjects();
            LeftAndRight(key, $projectNames, 'col temp', 'col temp_slct');
        }
    }
    @endsection

    @section('Select')
    let projects = GetShownProjects()
    GoToURL(projects.at(GetSelectedButtonOrderNumber(projects)).children[0].href);
    @endsection

    function GetCattagoryButtons()
    {
        let catagoryButtons = [];
        const names = <?php echo json_encode($directoryNames); ?>;
        names.forEach(function (id)
        {
            catagoryButtons.push(document.getElementById(id));
        })
        return catagoryButtons;
    }

    function GetShownProjects()
    {
        const categorys = GetCattagoryButtons();
        const category = categorys.at(GetSelectedButtonOrderNumber(categorys)).id
        const projects = document.getElementsByClassName('col');
        let projectAtributes = [];
        for (var i = 0; i < projects.length; i++)
        {
            var project = projects[i];
            if (project.id === category)
            {
                projectAtributes.push(document.getElementById(project.children[0].id));
            }
        }
        return projectAtributes;
    }

    function ClickedOn(id)
    {
        ChangeFilter(id);
        GetCattagoryButtons().forEach(function (button)
        {
            if (button.id === id)
            {
                document.getElementById(button.id).setAttribute('class', 'temp_slct blackBackgroundColor_slct')
            } else
            {
                document.getElementById(button.id).setAttribute('class', 'temp blackBackgroundColor')
            }
        })
    }

    @section('CanMove')
    canMove = document.getElementById("selectedInLayout").textContent === 'true';
    @endsection
</script>
