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

    .project {
        background: darkslategray;
    }

    .temp {
        background: black;
        color: white;
        text-decoration: none;
    }

    .temp:hover {
        background: gray;
    }

    .temp_slct {
        background: gray;
        color: white;
        text-decoration: none;
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
$directoryNames = collect($directoryNames)->unique()->values()->toArray();
if(!function_exists('GetProjectDiscription'))
{
    function GetProjectDiscription($project, $projects)
    {
        return explode('§', collect(file(collect($projects)->filter(function ($file) use ($project) {
            return $file->getFilename() === $project . '.blade.php';
        })->first()->getRealPath()))->filter(function ($line) {
            return str_contains($line, 'DESCRIPTION');
        })->first())[1];
    }
}
?>

@section('content')
    <div id="catagoryButtons" style="padding-top: 10vh; text-align: center;">
        @foreach($directoryNames as $directoryName)
            <a class="temp"
               style="font-size: 250%; border-radius: 0;
          transform: scale(0.9);" id="{{$directoryName}}" onclick="ClickedOn(id)">
                <span style="line-height: 1;">{{$directoryName}}</span>
            </a>
        @endforeach
    </div>
    <p style="padding-top: 5vh"></p>
    <div class="container text-center" style="padding-top: 1%">
        <div class="row g-1 row-cols-3" id="projectHandeler">
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
                    @php($projectDescription = GetProjectDiscription($project, $projects))
                    @php($count++)
                    <div class="col project" id="{{$key}}">
                        <div id="project {{$count}}" class="col temp">
                            <a href="/projects/{{$key}}/{{$project}}">
                                <div class="card" style="width: 18rem;">
                                    <img src="" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$projectForName}}</h5>
                                        <p class="card-text">{{$projectDescription}}</p>
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
    document.getElementById(id).setAttribute('class', 'temp_slct')
    document.getElementById('categorys').setAttribute('class', 'btn slct-darkslate')
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

    @section('KeyInYX')
        depthLevel = document.getElementById("selectedInLayout").textContent;
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
    document.getElementById("selectedInLayout").textContent = depthLevel;
    @endsection

        @section('KeyInXX')
        depthLevel = document.getElementById("selectedInLayout").textContent;
    if (depthLevel !== 'true')
    {
        if (depthLevel === '-1')
        {
            $cattagoryButtons = GetCattagoryButtons();
            LeftAndRight(key, $cattagoryButtons, 'temp', 'temp_slct')
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
                document.getElementById(button.id).setAttribute('class', 'temp_slct')
            } else
            {
                document.getElementById(button.id).setAttribute('class', 'temp')
            }
        })
    }

    @section('CanMove')
        canMove = document.getElementById("selectedInLayout").textContent === 'true';
    @endsection
</script>
