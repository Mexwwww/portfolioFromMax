@php use Illuminate\Support\Facades\File; @endphp
@extends('layout.layout')

@section('style')
    <style>

        .backgroundColor {
            background: white;
        }

    </style>
@endsection

<style>

    #catagoryButtons {
        padding: 6vh 1rem 2vh;
    }

    .blackBackgroundColor
    {
        background: black;
        border-radius: 999px;
        border: 2px solid transparent;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .blackBackgroundColor:hover {
        background: #444;
    }

    .blackBackgroundColor_slct
    {
        background: #444;
        color: white;
        text-decoration: none;
        border: 2px solid transparent;
    }

    #catagoryButtons.at-category-level .blackBackgroundColor_slct {
        border-color: slategrey;
    }

    .project {
        background: none;
        display: none;
    }

    .temp {
    color: white;
    text-decoration: none;
    transition: color 0.2s ease;
}

.temp:hover {
    color: white;
    text-decoration: none;
}

.temp_slct {
    color: white;
    text-decoration: none;
}

    #projectHandeler {
        padding: 2vh 0 6vh;
    }

    .project-card {
        border: 2px solid transparent;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        max-width: 320px;
        margin: 0 auto;
    }

    .project-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.16);
    }

    .temp_slct .project-card {
        border: 2px solid slategrey;
    }

    .project-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .project-card .card-title {
        color: #1a1a1a;
        font-weight: 600;
    }

    .project-card .card-text {
        color: #5a5a5a;
    }

    .project-tags {
        margin-top: 0.75rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .project-tag {
        display: inline-block;
        background: #eee;
        color: #444;
        font-size: 0.75rem;
        padding: 0.25em 0.7em;
        border-radius: 999px;
    }

    .temp_slct,
.temp_slct:hover {
    transform: none !important;
    scale: 1 !important;
}

.temp_slct .project-card,
.temp_slct .project-card:hover {
    transform: none !important;
    scale: 1 !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    border: 2px solid slategrey !important;
}
</style>

<body style="color: black">

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
    function GetProjectDiscriptionOrImage($project, $projects, $lookForImage = false)
    {
        $text = $lookForImage === true? 'IMAGE' : "DESCRIPTION";
        $result = explode('§', collect(file(collect($projects)->filter(function ($file) use ($project, $text) {
            return $file->getFilename() === $project . '.blade.php';
        })->first()->getRealPath()))->filter(function ($line) use ($text) {
            return str_contains($line, $text);
        })->first());
        return ($result[1] ?? null) == null ? null : ($lookForImage ? asset($result[1]) : $result[1]);
    }
}
if(!function_exists('GetProjectTags'))
{
    function GetProjectTags($project, $projects)
    {
        $line = collect(file(collect($projects)->filter(function ($file) use ($project) {
            return $file->getFilename() === $project . '.blade.php';
        })->first()->getRealPath()))->filter(function ($line) {
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
                    @php($projectForName = (function ($project)
{
    $words = preg_split('/(?=[A-Z])/',$project);
    $name = null;
    foreach ($words as $word)
    {
        if ($word != '')
        {
            if ($name == null)
            {
                $name = ucfirst($word);
            }
            else
            {
                $name = $name . ' ' . lcfirst($word);
            }
        }
    }
    return $name;
})($project))
                    @php($projectDescription = GetProjectDiscriptionOrImage($project, $projects))
                    @php($projectTags = GetProjectTags($project, $projects))
                    @php($count++)
                    <div class="col project" id="{{$key}}">
                        <div id="project {{$count}}" class="col temp">
                            <a href="/projects/{{$key}}/{{$project}}">
                                <div class="card project-card">
                                    <img src="{{GetProjectDiscriptionOrImage($project, $projects, true)}}" alt="selected"
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
