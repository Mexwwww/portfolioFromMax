@php use Illuminate\Support\Facades\File; @endphp
@extends('Layout.layout')

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

</style>

<body style="color: black">

<?php
$projectViews = glob("projects/unity/*", GLOB_BRACE);
$unityProjectViewList = array_map('basename', $projectViews);

$projectViews = glob("projects/laravel/*", GLOB_BRACE);
$laravelProjectViewList = array_map('basename', $projectViews);

$projectViews = glob("projects/unreal-engine/*", GLOB_BRACE);
$unrealEngineProjectViewList = array_map('basename', $projectViews);
$projectsInCat = null;

$catagory = 'unity';
$projects = [];
$directoryNames = [];
$fileNames = [];
$basePath = resource_path('views/projects');
foreach (File::directories($basePath) as $directory)
{
    foreach (File::files($directory) as $file)
    {
        $projects[basename($directory)][] = str_replace('.blade', '', $file->getFilenameWithoutExtension());
        $directoryNames[] = basename($directory);
    }
}
$directoryNames = collect($directoryNames)->unique()->values()->toArray();
?>

@section('content')
    <div id="catagoryButtons" style="padding-top: 10vh; text-align: center;">
        @foreach($directoryNames as $directoryName)
            <a class="btn selcection"
               style="font-size: 250%; border-radius: 0; background: black;
          transform: scale(0.9);" id="{{$directoryName}}" onclick="ChangeFilter(id)">
                <span style="line-height: 1;">{{$directoryName}}</span>
            </a>
        @endforeach
    </div>
    <p style="padding-top: 5vh"></p>
    <div class="container text-center" style="padding-top: 1%">
        <div class="row g-1 row-cols-3" id="projectHandeler">
            @foreach($projects as $key => $category)
                @foreach($category as $project)
                <div class="col">
                    <div>
                        <a href="/projects/{{$key}}/{{$project}}">
                            <div class="card" style="width: 18rem;">
                                <img src="" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
    function GetProjectsFromCatagory(id)
    {
        let p1;
        let p2;
        if (id === 'unity')
        {
            p1 = 'projects/unity/';
            p2 = <?php echo json_encode($unityProjectViewList); ?>;
        }

        if (id === 'laravel')
        {
            p1 = 'projects/laravel/';
            p2 = <?php echo json_encode($laravelProjectViewList); ?>;
        }

        if (id === 'unreal-engine')
        {
            p1 = 'projects/unreal-engine/';
            p2 = <?php echo json_encode($unrealEngineProjectViewList); ?>;
        }
        return [p1, p2]
    }

    function ChangeFilter(id)
    {
        const projectHandeler = document.getElementById('projectHandeler');
        projectHandeler.innerHTML = '';

        const projects = GetProjectsFromCatagory(id);
        const linkstart = projects[0];
        const linkEndOptions = projects[1];
        linkEndOptions.forEach(function (linkEnd)
        {
            const outerDiv = document.createElement('div');
            outerDiv.setAttribute('class', 'col')
            outerDiv.setAttribute('id', linkstart + linkEnd)
            projectHandeler.appendChild(outerDiv);

            const innerDiv = document.createElement('div');
            innerDiv.setAttribute('class', 'project');
            outerDiv.appendChild(innerDiv)

            innerDiv.innerHTML = outerDiv.id;

            id = outerDiv.id;
        });
    }

</script>
