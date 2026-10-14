@php use Illuminate\Support\Facades\File; @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Fonts for a clean tech look -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d1117;
            color: #c9d1d9;
        }

        .backgroundColor {
            background: #0d1117;
        }

        /* Modern Developer Nav Bar */
        .cnt-white {
            width: 100%;
            border-bottom: 1px solid #30363d;
            background: #161b22;
            padding: 0.5rem 1rem;
        }

        .layout-nav-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem 3rem;
            padding: 8px 16px;
            font-size: 0.95rem;
            font-family: 'Fira Code', monospace;
        }

        .btn-darkslate {
            color: #8b949e !important;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            pointer-events: auto;
            transition: all 0.2s ease;
        }

        .btn-darkslate:hover,
        a:hover {
            color: #58a6ff !important;
            background: rgba(56, 139, 253, 0.1);
            border-color: #30363d;
            transform: translateY(-1px);
        }

        .slct-darkslate {
            color: #58a6ff !important;
            background: rgba(56, 139, 253, 0.15);
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            box-shadow: 0 0 10px rgba(88, 166, 255, 0.2);
            pointer-events: auto;
        }

        img, video {
            max-width: 100%;
            height: auto;
        }

        pre {
            max-width: 100%;
            overflow-x: auto;
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 1rem;
            color: #e6edf3;
            font-family: 'Fira Code', monospace;
        }
    </style>
    @yield('style')
</head>
<body class="backgroundColor" onload="OnLoad()">
<p id="selectedInLayout" hidden="">true</p>

<nav class="cnt-white" aria-label="Main navigation">
    <div class="layout-nav-links">
        <?php
        $fileNames = [];
        $basePath = resource_path('views/');
        foreach (File::files($basePath) as $file) {
            $fileNames[] = basename(str_replace('.blade', '', $file->getFilenameWithoutExtension()));
        }
        $fileNames = collect($fileNames)->unique()->values()->toArray();
        ?>
        @foreach($fileNames as $name)
            <a href="/{{$name}}" class="btn btn-darkslate" id="{{$name}}">{{$name}}</a>
        @endforeach
    </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<script>
    // Only listen for Escape key to go back
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' || event.code === 'Escape') {
            history.back();
        }
    });

    function CurrentPageButton() {
        let fileNames = <?php echo json_encode($fileNames); ?>;
        let currentPath = window.location.pathname.replace(/^\/|\/$/g, '');
        if (!currentPath) currentPath = 'categories';
        
        return fileNames.find(name => currentPath.includes(name));
    }

    function OnLoad() {
        @yield('onLoad')
        let currentName = CurrentPageButton();
        if (!currentName) {
            currentName = 'categories';
        }
        let activeBtn = document.getElementById(currentName);
        if (activeBtn) {
            activeBtn.setAttribute('class', 'btn slct-darkslate');
        }
    }
</script>
</body>
</html>
