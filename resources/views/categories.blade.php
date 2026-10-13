@php use Illuminate\Support\Facades\File; @endphp
<style>
    .categories-wrapper {
        display: flex;
        gap: 2rem;
        max-width: 1200px;
        margin: 6vh auto;
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

    .category-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0.85rem 1.2rem;
        border-radius: 8px;
        color: #8b949e;
        background: #0d1117;
        border: 1px solid #30363d;
        text-decoration: none;
        font-family: 'Fira Code', monospace;
        font-size: 1.1rem;
        transition: all 0.2s ease;
        cursor: pointer;
        text-align: left;
        width: 100%;
    }

    .category-btn:hover,
    .category-btn.active {
        color: #58a6ff;
        background: rgba(56, 139, 253, 0.1);
        border-color: #58a6ff;
        transform: translateX(4px);
        box-shadow: 0 0 12px rgba(88, 166, 255, 0.2);
    }

    .category-btn .icon {
        opacity: 0.4;
        color: #8b949e;
    }

    .category-btn:hover .icon,
    .category-btn.active .icon {
        opacity: 1;
        color: #58a6ff;
    }

    #preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
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
                <a class="category-btn"
                   id="{{$name}}"
                   href="/categorised/Projects/{{$name}}"
                   onmouseover="PreviewCategory('{{$name}}')">
                    <span class="icon">&gt;</span>
                    <span>{{$name}}</span>
                </a>
            @endforeach
        </div>

        <div class="divRight">
            <img src="" alt="Category Preview" id="preview">
        </div>
    </div>
@endsection

<?php
$laravelImages = array_map('basename', glob("images/laravel/*.{png}", GLOB_BRACE));
$unityImages = array_map('basename', glob("images/unity/*.{png}", GLOB_BRACE));
$unrealImages = array_map('basename', glob("images/unreal-engine/*.{png}", GLOB_BRACE));
?>

<script>
    const categoryImages = {
        'laravel': {
            path: 'images/laravel/',
            images: <?php echo json_encode($laravelImages); ?>
        },
        'unity': {
            path: 'images/unity/',
            images: <?php echo json_encode($unityImages); ?>
        },
        'unreal-engine': {
            path: 'images/unreal-engine/',
            images: <?php echo json_encode($unrealImages); ?>
        }
    };

    let currentActiveCategory = 'laravel';
    let imageInterval = null;

    function PreviewCategory(categoryName) {
        currentActiveCategory = categoryName;
        
        // Highlight active button
        document.querySelectorAll('.category-btn').forEach(btn => {
            if (btn.id === categoryName) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        ShowRandomImage(categoryName);
    }

    function ShowRandomImage(categoryName) {
        const catData = categoryImages[categoryName];
        if (!catData || !catData.images || catData.images.length === 0) {
            document.getElementById('preview').src = '';
            return;
        }

        const randomIndex = Math.floor(Math.random() * catData.images.length);
        const imagePath = "{{ asset('') }}" + catData.path + catData.images[randomIndex];
        document.getElementById('preview').src = imagePath;
    }

    // Initialize on page load
    window.addEventListener('DOMContentLoaded', () => {
        let dirNames = <?php echo json_encode($dirNames); ?>;
        if (dirNames.length > 0) {
            PreviewCategory(dirNames[0]);
            imageInterval = setInterval(() => {
                ShowRandomImage(currentActiveCategory);
            }, 3000);
        }
    });
</script>
