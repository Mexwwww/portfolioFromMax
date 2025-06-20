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
@extends('Layout.layout')
<body onload="StartTimer()">
@section('content')
    <div class="divLeft">
        <div class="spacer"></div>
        <a class="btn slct-selcection"
           style="font-size: 250%; outline: solid yellow; border-radius: 0;
          display: inline-flex; gap: 12px; transform: scale(0.9);
          text-decoration: none; align-items: center;" id="laravel"
           onclick="GoTooPage(id, GetProjectsCollectionInOrder())"
           onmouseover="Hover(id)">
            <img src="{{ asset('images/save-star.png') }}"
                 alt="selected"
                 width="50"
                 height="50"
                 style="align-self: flex-start;"
                 class="slct-hover-icon">
            <span style="line-height: 1;">Laravel</span>
        </a>
        <a class="btn selcection"
           style="font-size: 250%; outline: solid yellow; border-radius: 0;
          display: inline-flex; gap: 12px; transform: scale(0.9);
          text-decoration: none; align-items: center;" id="unity"
           onclick="GoTooPage(id, GetProjectsCollectionInOrder())"
           onmouseover="Hover(id)">
            <img src="{{ asset('images/save-star.png') }}"
                 alt="selected"
                 width="50"
                 height="50"
                 style="align-self: flex-start;"
                 class="hover-icon">
            <span style="line-height: 1;">Unity</span>
        </a>
        <a class="btn selcection"
           style="font-size: 250%; outline: solid yellow; border-radius: 0;
          display: inline-flex; gap: 12px; transform: scale(0.9);
          text-decoration: none; align-items: center;" id="unrealEngine"
           onclick="GoTooPage(id, GetProjectsCollectionInOrder())"
           onmouseover="Hover(id)">
            <img src="{{ asset('images/save-star.png') }}"
                 alt="selected"
                 width="50"
                 height="50"
                 style="align-self: flex-start;"
                 class="hover-icon">
            <span style="line-height: 1;">Unreal Engine</span>
        </a>
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

    function StartTimer()
    {
        setInterval(ImageChange, 3000);
    }

    function GetProjectsCollectionInOrder()
    {
        const Laravel = document.getElementById('laravel');
        const Unity = document.getElementById('unity');
        const UnrealEngine = document.getElementById('unrealEngine');
        return [Laravel, Unity, UnrealEngine];
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
        const selected = collectionInOrder.at(GetSelectedButtonOrderNumber(collectionInOrder)).id;

        if (selected === 'laravel')
        {
            $p1 = 'images/laravel/';
            $p2 = <?php echo json_encode($laravelImageList); ?>;
        }

        if (selected === 'unity')
        {
            $p1 = 'images/unity/';
            $p2 = <?php echo json_encode($unityImageList); ?>;
            return [$p1, $p2];
        }

        if (selected === 'unrealEngine')
        {
            $p1 = 'images/unreal-engine/';
            $p2 = <?php echo json_encode($unrealEngineImageList); ?>;
            return [$p1, $p2];
        }
    }

    document.addEventListener('keydown', function (event)
    {
        let key = 'Key' + event.key;  // This is layout-dependent
        key = 'Key' + key.split('y')[1].toUpperCase();
        if (key === 'KeyS' || key === 'KeyW' || key === "KeyA" || key === "KeyD" || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ')
        {
            OnProjectKeyDown(key);
        }
    });

    function OnProjectKeyDown(key)
    {
        if (key === "KeyLeftArrow" || key === "KeyA" || key === "KeyRightArrow" || key === "KeyD")
        {
            document.getElementById("selected").textContent = 'false'
        }

        console.log(key)
        if (key === "KeyUpArrow" || key === 'KeyW' || key === "KeyDownArrow" || key === 'KeyS')
        {
            document.getElementById("selected").textContent = 'true'
            UpAndDown(key);
            ImageChange();
        }

        if (document.getElementById("selected").textContent === 'true' && (key === 'KeyE' || key === 'KeyF' || key === 'KeyZ' || key === 'KeySpace' || key === 'KeyEnter'))
        {
            GoTooPage(null, GetProjectsCollectionInOrder())
        }
    }

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
        let $randomNumber = Math.floor(Math.random());
        console.log(preview.src);
        let count = 0;
        console.log(max)
        // while (preview.src.includes($randomNumber) || count > 0  || max < 1)
        // {
        //     $randomNumber = Math.floor(Math.random());
        //     count++
        // }

        const picture = pictureList[0] + pictureList[1][Math.floor(Math.random() * max)];
        $default = "{{ asset('') }}".toString()
        preview.src = "{{ asset('') }}" + picture.toString();
    }
</script>
