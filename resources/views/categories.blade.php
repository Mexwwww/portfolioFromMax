@php use Illuminate\Support\Facades\File; @endphp
<style>
    .categories-wrapper {
        display: flex;
        gap: 2rem;
        max-width: 1200px;
        margin: 5vh auto;
        padding: 0 1.5rem;
        align-items: stretch;
    }

    .divLeft {
        flex: 0 0 350px;
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    .divRight {
        flex: 1;
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        min-height: 400px;
    }

    .selcection, .slct-selcection {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.85rem 1.2rem;
        border-radius: 8px;
        color: #8b949e !important;
        background: #0d1117;
        border: 1px solid #30363d;
        text-decoration: none;
        font-family: 'Fira Code', monospace;
        font-size: 1.1rem !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        cursor: pointer;
        text-align: left;
    }

    .selcection:hover {
        color: #c9d1d9 !important;
        background: #21262d;
        border-color: #8b949e;
        transform: translateX(4px);
    }

    .slct-selcection {
        color: #58a6ff !important;
        background: rgba(56, 139, 253, 0.1) !important;
        border-color: #58a6ff !important;
        box-shadow: 0 0 12px rgba(88, 166, 255, 0.25);
        transform: translateX(6px) !important;
    }

    .slct-hover-icon {
        opacity: 1;
        color: #58a6ff;
        font-weight: bold;
    }

    .hover-icon {
        opacity: 0.3;
        color: #8b949e;
    }

    #preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        border-radius: 10px;
    }

    @media (max-width: 900px) {
        .categories-wrapper {
            flex-direction: column;
            margin: 2vh auto;
            padding: 0 1rem;
        }

        .divLeft {
            flex: none;
            width: 100%;
        }

        .divRight {
            width: 100%;
            height: 250px;
            min-height: 250px;
        }
    }
</style>

@extends('layout.layout')
@section('content')
    <div class="categories-wrapper">
        <div class="divLeft">
            <?php
            $dirNames = [];
            $basePath = resource_path('views/projects');
            foreach (File::directories($basePath) as $dir) {
                $dirNames[] = basename($dir);
            }
            $dirNames = collect($dirNames)->unique()->values()->toArray();
            ?>
            @foreach($dirNames as $name)
                <a class="btn selcection"
                   id="{{$name}}"
                   onclick="SelectCategory(id)"
                   onmouseover="Hover(id)">
                    <span class="hover-icon">&gt;</span>
                    <span>{{$name}}</span>
                </a>
            @endforeach
        </div>

        <div class="divRight">
            <img src="{{ asset('') }}" alt="Category Preview" id="preview">
        </div>
    </div>
    <p hidden="" id="selected">true</p>
@endsection

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

    function GetProjectsCollectionInOrder() {
        let buttons = [];
        let names = <?php echo json_encode($dirNames); ?>;
        names.forEach(function (name) {
            buttons.push(document.getElementById(name));
        });
        return buttons;
    }

    function SelectCategory(id) {
        localStorage.setItem('lastCategory', id);
        GoToURL('categorised/Projects/' + id);
    }

    function RestoreCategorySelection() {
        const collectionInOrder = GetProjectsCollectionInOrder();
        const lastCategory = localStorage.getItem('lastCategory');
        let index = collectionInOrder.findIndex(function (option) {
            return option.id === lastCategory;
        });
        if (index === -1) index = 0;

        collectionInOrder.forEach(function (option, i) {
            const icon = option.querySelector('span:first-child');
            if (i === index) {
                option.setAttribute('class', 'btn slct-selcection');
                if (icon) icon.setAttribute('class', 'slct-hover-icon');
            } else {
                option.setAttribute('class', 'btn selcection');
                if (icon) icon.setAttribute('class', 'hover-icon');
            }
        });

        ImageChange();
    }

    function Hover(id) {
        const projectsCollectionInOrder = GetProjectsCollectionInOrder();
        if (projectsCollectionInOrder.at(GetSelectedButtonOrderNumber(projectsCollectionInOrder)).id === id) return;

        projectsCollectionInOrder.forEach(function (option) {
            const icon = option.querySelector('span:first-child');
            if (option.id !== id) {
                option.setAttribute('class', 'btn selcection');
                if (icon) icon.setAttribute('class', 'hover-icon');
            } else {
                option.setAttribute('class', 'btn slct-selcection');
                if (icon) icon.setAttribute('class', 'slct-hover-icon');
            }
        });
        ImageChange();
    }

    function PictureList() {
        const collectionInOrder = GetProjectsCollectionInOrder();
        let selected = collectionInOrder.at(GetSelectedButtonOrderNumber(collectionInOrder)).id;

        if (selected === 'laravel') {
            return ['images/laravel/', <?php echo json_encode($laravelImageList); ?>];
        }
        if (selected === 'unity') {
            return ['images/unity/', <?php echo json_encode($unityImageList); ?>];
        }
        if (selected === 'unreal-engine') {
            return ['images/unreal-engine/', <?php echo json_encode($unrealEngineImageList); ?>];
        }
        return ['', []];
    }

    @section('KeyInYX')
    document.getElementById("selectedInLayout").textContent = 'false';
    document.getElementById("selected").textContent = 'true';
    UpAndDown(key);
    ImageChange();
    @endsection

    @section('KeyInXX')
    document.getElementById("selectedInLayout").textContent = 'true';
    document.getElementById("selected").textContent = 'false';
    @endsection

    @section('Select')
    if (document.getElementById("selected").textContent === 'true') {
        const selectedButtonId = GetProjectsCollectionInOrder().at(GetSelectedButtonOrderNumber(GetProjectsCollectionInOrder())).id;
        SelectCategory(selectedButtonId);
    }
    @endsection

    function UpAndDown(key) {
        const collectionInOrder = GetProjectsCollectionInOrder();
        let count = collectionInOrder.length;
        let upOrDown = (key === "KeyW" || key === 'KeyUpArrow') ? -1 : 1;
        const collectionOrderNumber = GetSelectedButtonOrderNumber(collectionInOrder);

        let targetIndex = collectionOrderNumber + upOrDown;
        if (targetIndex < 0) targetIndex = count - 1;
        if (targetIndex >= count) targetIndex = 0;

        collectionInOrder.forEach((btn, idx) => {
            const icon = btn.querySelector('span:first-child');
            if (idx === targetIndex) {
                btn.setAttribute('class', 'btn slct-selcection');
                if (icon) icon.setAttribute('class', 'slct-hover-icon');
            } else {
                btn.setAttribute('class', 'btn selcection');
                if (icon) icon.setAttribute('class', 'hover-icon');
            }
        });
    }

    function ImageChange() {
        let preview = document.getElementById('preview');
        const pictureList = PictureList();
        if (!pictureList[1] || pictureList[1].length === 0) return;

        const max = pictureList[1].length;
        const randomIndex = Math.floor(Math.random() * max);
        const picture = pictureList[0] + pictureList[1][randomIndex];
        preview.src = "{{ asset('') }}" + picture;
    }
</script>
