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
        box-sizing: border-box;
        min-width: 0;
    }

    .divRight {
        margin-top: 7%;
        float: right;
        margin-right: 5%;
        width: 40%;
        height: 60vh;
        outline: solid gray;
        box-sizing: border-box;
        min-width: 0;
        overflow: hidden;
    }

    /* Keep each category button inside the left panel and let long names wrap. */
    .divLeft .selcection,
    .divLeft .slct-selcection {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
        white-space: normal !important;
        overflow-wrap: anywhere;
        justify-content: flex-start;
        text-align: left;
        padding: 0.4rem 0.5rem;
        gap: clamp(6px, 1vw, 12px) !important;
    }

    .divLeft .selcection img,
    .divLeft .slct-selcection img {
        width: clamp(24px, 3vw, 50px) !important;
        height: auto !important;
        aspect-ratio: 1 / 1;
        flex: 0 0 auto;
        object-fit: contain;
    }

    .divLeft .selcection span,
    .divLeft .slct-selcection span {
        min-width: 0;
        flex: 1 1 auto;
        white-space: normal;
        overflow-wrap: anywhere;
        line-height: 1.15 !important;
    }

    /* Prevent the preview image itself from exceeding its container. */
    #preview {
        display: block;
        width: 100%;
        max-width: 100%;
        height: 100%;
        object-fit: cover;
        box-sizing: border-box;
    }

    .selcection {
        color: #e0e0e0 !important;
        text-decoration: none;
        transition: scale 0.3s ease !important;
    }

    
    .slct-selcection {
        color: #ffeb3b !important;
        background: linear-gradient(135deg, #343434, #202020) !important;
        border: 2px solid #ffeb3b !important;
        border-radius: 10px !important;
        box-shadow: 0 0 12px rgba(255, 235, 59, 0.2),
                    inset 0 0 8px rgba(255, 235, 59, 0.05);
        transition: all 0.25s ease !important;
        scale: 1.05 !important;
    }

    .slct-selcection:hover {
        color: #fff176 !important;
        background: linear-gradient(135deg, #414141, #292929) !important;
        border-color: #fff176 !important;
        box-shadow: 0 0 18px rgba(255, 235, 59, 0.35);
        scale: 1.05 !important;
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

    /* Stack the category list and preview on phones and narrow screens. */
    @media (max-width: 768px) {
        .divLeft,
        .divRight {
            float: none;
            width: 92%;
            max-width: 40rem;
            margin: 1.25rem auto;
        }

        .divLeft {
            height: auto;
            min-height: 0;
            text-align: left;
            gap: 0.5rem;
        }

        .divLeft .selcection,
        .divLeft .slct-selcection {
            font-size: clamp(1rem, 4vw, 1.4rem) !important;
            transform: none !important;
            scale: 1 !important;
        }

        .divLeft .selcection img,
        .divLeft .slct-selcection img {
            width: clamp(24px, 7vw, 36px) !important;
        }

        .divRight {
            height: auto;
            aspect-ratio: 16 / 9;
        }
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

    <div class="divRight">
        <img src="{{ asset('') }}"
             alt="selected"
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
