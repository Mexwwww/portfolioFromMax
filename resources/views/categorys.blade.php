@php use Illuminate\Support\Facades\File; @endphp
<style>
    .divLeft {
        margin-top: 7%;
        float: left;
        width: 25%;
        margin-left: 13.5%;
        height: 60%;
        text-align: right;
        outline: solid gray;

        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .divRight {
        margin-top: 7%;
        float: right;
        margin-right: 5%;
        width: 40%;
        height: 60%;
    }

    .selcection {
        color: greenyellow;
        text-decoration: none;
        transition: scale 0.3s ease !important;
    }

    .slct-selcection {
        color: yellow !important;
        transition: scale 0.3s ease !important;
        scale: 1.11 !important;
    }

    .slct-selcection:hover {
        color: yellow !important;
        transition: scale 0.3s ease !important;
        scale: 1.11 !important;
    }

    .slct-hover-icon {
        opacity: 1;
        transition: opacity 0.3s ease !important;
    }

    .hover-icon {
        opacity: 0;
        transition: opacity 0.3s ease !important;
    }

    .selcection:hover .hover-icon {
        opacity: 1;
        transition: opacity 0.3s ease !important;
    }
</style>
@extends('layout.layout')
<body>
@section('content')
    <div class="divLeft">
        <div class="spacer"></div>
        <?php
        $dirNames = [];
        $basePath = resource_path('views/projects');
        foreach (File::directories($basePath) as $dir)
        {
            $dirNames[] = basename($dir);
        }
        $dirNames = collect($dirNames)->unique()->values()->toArray();
        ?>
        @foreach($dirNames as $name)
            <a class="btn selcection"
               style="font-size: 250%; outline: solid yellow; border-radius: 0;
          display: inline-flex; gap: 12px; transform: scale(0.9);
          text-decoration: none; align-items: center;" id="{{$name}}"
               onclick="SelectCategory(id)"
               onmouseover="Hover(id)">
                <img src="{{ asset('images/save-star.png') }}"
                     alt="selected"
                     width="50"
                     height="50"
                     style="align-self: flex-start;"
                     class="hover-icon">
                <span style="line-height: 1;">{{$name}}</span>
            </a>
        @endforeach
        <div class="spacer"></div>
    </div>

    <div class="divRight" style="outline: solid gray;">
        <img src="{{ asset('') }}"
             alt="selected"
             width="100%"
             height="100%"
             style="align-self: flex-start; object-fit: cover;"
             id="preview">
    </div>
    <p hidden="" id="selected">true</p>
@endsection
</body>

<?php
$images = glob("images/*.{png}", GLOB_BRACE);
$imageList = array_map('basename', $images);

$images = glob("images/laravel/*.{png}", GLOB_BRACE);
$laravelImageList = array_map('basename', $images);

$images = glob("images/unity/*.{png}", GLOB_BRACE);
$unityImageList = array_map('basename', $images);

$images = glob("images/unreal-engine/*.{png}", GLOB_BRACE);
$unrealEngineImageList = array_map('basename', $images);
?>

<script src="{{ asset('js/KeyCodeTooKey.js') }}"></script>

<script>
    @section('onLoad')
    document.getElementById("selectedInLayout").textContent = 'false';
    document.getElementById("selected").textContent = 'true';
    RestoreCategorySelection();
    setInterval(ImageChange, 3000);
    @endsection

    function GetProjectsCollectionInOrder()
    {
        let buttons = [];
        let names = <?php echo json_encode($dirNames); ?>;
        names.forEach(function (name)
        {
            buttons.push(document.getElementById(name));
        })
        return buttons;
    }

    function SelectCategory(id)
    {
        localStorage.setItem('lastCategory', id);
        GoToURL('categorised/Projects/' + id);
    }

    function RestoreCategorySelection()
    {
        const collectionInOrder = GetProjectsCollectionInOrder();
        const lastCategory = localStorage.getItem('lastCategory');
        let index = collectionInOrder.findIndex(function (option)
        {
            return option.id === lastCategory;
        });
        if (index === -1)
        {
            index = 0;
        }

        collectionInOrder.forEach(function (option, i)
        {
            const image = document.querySelector('#' + option.id + ' img');
            if (i === index)
            {
                option.setAttribute('class', 'btn slct-selcection');
                image.setAttribute('class', 'slct-hover-icon');
            } else
            {
                option.setAttribute('class', 'btn selcection');
                image.setAttribute('class', 'hover-icon');
            }
        });

        ImageChange();
    }

    function Hover(id)
    {
        const projectsCollectionInOrder = GetProjectsCollectionInOrder();
        if (projectsCollectionInOrder.at(GetSelectedButtonOrderNumber(projectsCollectionInOrder)).id === id)
        {
            return;
        }

        let count = 0;
        projectsCollectionInOrder.forEach(function (option)
        {
            const image = document.querySelector('#' + projectsCollectionInOrder.at(count).id + ' img');
            if (option.id !== id)
            {
                option.setAttribute('class', 'btn selcection');
                image.setAttribute('class', 'hover-icon')
            } else
            {
                option.setAttribute('class', 'btn slct-selcection');
                image.setAttribute('class', 'slct-hover-icon')
            }
            count++;
        })
        ImageChange();
    }

    function PictureList()
    {
        const collectionInOrder = GetProjectsCollectionInOrder();
        let selected = collectionInOrder.at(GetSelectedButtonOrderNumber(collectionInOrder)).id;

        if (selected === 'laravel')
        {
            $p1 = 'images/laravel/';
            $p2 = <?php echo json_encode($laravelImageList); ?>;
            return [$p1, $p2];
        }

        if (selected === 'unity')
        {
            $p1 = 'images/unity/';
            $p2 = <?php echo json_encode($unityImageList); ?>;
            return [$p1, $p2];
        }

        if (selected === 'unreal-engine')
        {
            $p1 = 'images/unreal-engine/';
            $p2 = <?php echo json_encode($unrealEngineImageList); ?>;
            return [$p1, $p2];
        }
    }

    @section('KeyInYX')
    document.getElementById("selectedInLayout").textContent = 'false'
    document.getElementById("selected").textContent = 'true'
    UpAndDown(key);
    ImageChange();
    @endsection

    @section('KeyInXX')
    document.getElementById("selectedInLayout").textContent = 'true'
    document.getElementById("selected").textContent = 'false'
    @endsection

    @section('Select')
    if (document.getElementById("selected").textContent === 'true')
    {
        const selectedButtonId = GetProjectsCollectionInOrder().at(GetSelectedButtonOrderNumber(GetProjectsCollectionInOrder())).id;
        SelectCategory(selectedButtonId)
    }
    @endsection

    function UpAndDown(key)
    {
        const collectionInOrder = GetProjectsCollectionInOrder();
        let count = collectionInOrder.length;
        let upOrDown = 1;
        if (key === "KeyW" || key === 'KeyUpArrow')
        {
            upOrDown = -1;
        }

        const collectionOrderNumber = GetSelectedButtonOrderNumber(collectionInOrder)

        if (collectionOrderNumber + upOrDown !== -1 && collectionInOrder.at(collectionOrderNumber + upOrDown) != null)
        {
            let image = document.querySelector('#' + collectionInOrder.at(collectionOrderNumber).id + ' img');
            image.setAttribute('class', 'hover-icon');
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', 'btn selcection');

            image = document.querySelector('#' + collectionInOrder.at(collectionOrderNumber + upOrDown).id + ' img');
            image.setAttribute('class', 'slct-hover-icon')
            collectionInOrder.at(collectionOrderNumber + upOrDown).setAttribute('class', 'btn slct-selcection');
        } else
        {
            let image = document.querySelector('#' + collectionInOrder.at(collectionOrderNumber).id + ' img');
            image.setAttribute('class', 'hover-icon')
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', 'btn selcection')
            let orderNumber = 0;
            if (upOrDown === -1)
            {
                orderNumber = count - 1;
            }
            image = document.querySelector('#' + collectionInOrder.at(orderNumber).id + ' img');
            image.setAttribute('class', 'slct-hover-icon')
            collectionInOrder.at(orderNumber).setAttribute('class', 'btn slct-selcection')
        }
    }

    function ImageChange()
    {
        let preview = document.getElementById('preview');

        const pictureList = PictureList();
        const max = pictureList[1].length;
        let randomNumber = Math.floor(Math.random());
        let count = 0;
        while (preview.src.includes(randomNumber) && count < 5 && max > 1)
        {
            randomNumber = Math.floor(Math.random());
            count++
        }

        const picture = pictureList[0] + pictureList[1][Math.floor(Math.random() * max)];
        $default = "{{ asset('') }}".toString()
        preview.src = "{{ asset('') }}" + picture.toString();
    }
</script>
