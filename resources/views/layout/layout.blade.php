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
            /* Clean daylight code editor background */
            background-color: #f6f8fa;
            color: #24292e;
        }

        .backgroundColor {
            background: #f6f8fa;
        }

        /* Modern Light Developer Nav Bar */
        .cnt-white {
            width: 100%;
            border-bottom: 1px solid #e1e4e8;
            background: #ffffff;
            padding: 0.6rem 1rem;
            box-shadow: 0 1px 3px rgba(27, 31, 35, 0.04);
        }

        .layout-nav-links {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem 3rem;
            padding: 4px 16px;
            font-size: 0.95rem;
            font-family: 'Fira Code', monospace;
        }

        .btn-darkslate {
            /* Muted dark gray text for unselected nav tabs */
            color: #586069 !important;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            text-decoration: none;
            pointer-events: auto;
            transition: all 0.15s ease;
        }

        .btn-darkslate:hover,
        a:hover {
            color: #0366d6 !important;
            background: rgba(3, 102, 214, 0.08);
            border-color: #e1e4e8;
            transform: translateY(-1px);
        }

        .slct-darkslate {
            /* Active tab indicator styled like VS Code Light active file */
            color: #0366d6 !important;
            background: rgba(3, 102, 214, 0.1);
            border: 1px solid #c8e1ff;
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            box-shadow: 0 1px 4px rgba(3, 102, 214, 0.15);
            pointer-events: auto;
        }

        img, video {
            max-width: 100%;
            height: auto;
        }

        pre {
            max-width: 100%;
            overflow-x: auto;
            background: #ffffff;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            padding: 1rem;
            color: #24292e;
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
