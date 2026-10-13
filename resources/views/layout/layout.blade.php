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
            pointer-events: none; /* Disable mouse clicks */
        }

        .slct-darkslate {
            color: #58a6ff !important;
            background: rgba(56, 139, 253, 0.15);
            border: 1px solid #30363d;
            border-radius: 6px;
            padding: 0.4rem 0.8rem;
            box-shadow: 0 0 10px rgba(88, 166, 255, 0.2);
            pointer-events: none; /* Disable mouse clicks */
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

        @media (max-width: 767.98px) {
            .layout-nav-links {
                gap: 6px;
                padding: 4px;
                font-size: 0.85rem;
            }
        }
    </style>
    @yield('style')
</head>
<body class="backgroundColor" onload="OnLoad()" onkeydown="onkeydown(KeyboardEvent.code)">
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
<script src="{{ asset('js/KeyCodeTooKey.js') }}"></script>

<script>
    let KeyboardSuport = true;

    function SetKeyboardSuport(bool) {
        KeyboardSuport = bool;
    }

    function GetCollectionInOrder() {
        let buttons = [];
        let names = <?php echo json_encode($fileNames); ?>;
        names.forEach(function (name) {
            if (name != null) {
                buttons.push(document.getElementById(name));
            }
        })
        return buttons;
    }

    document.onkeydown = function (e) {
        const key = Convert(e.keyCode);
        if (key != null) {
            OnKeyDown(key)
            if (CurrentPageButton() && CurrentPageButton().id === 'categories') {
                OnProjectKeyDown(key);
            }
        }
    };

    document.addEventListener('keydown', function (event) {
        let key = 'Key' + event.key;
        key = 'Key' + key.split('y')[1].toUpperCase();
        if (['KeyA', 'KeyD', 'KeyE', 'KeyF', 'KeyZ', 'KeyS', 'KeyW', 'KeyQ', 'KeyX'].includes(key) || event.code === 'Escape' || event.code === 'KeyEscape') {
            OnKeyDown(key);
        }
    });

    let scrollDirection = 0;
    let scrollAnimationFrame = null;

    function IsTypingInField() {
        const activeTag = document.activeElement ? document.activeElement.tagName : null;
        return activeTag === 'INPUT' || activeTag === 'TEXTAREA';
    }

    function ScrollStep() {
        if (scrollDirection !== 0) {
            window.scrollBy(0, scrollDirection * 15);
            scrollAnimationFrame = requestAnimationFrame(ScrollStep);
        } else {
            scrollAnimationFrame = null;
        }
    }

    document.addEventListener('keydown', function (event) {
        if (KeyboardSuport === false || IsTypingInField()) return;
        if (event.code === 'KeyS') {
            scrollDirection = 1;
        } else if (event.code === 'KeyW') {
            scrollDirection = -1;
        } else {
            return;
        }
        if (scrollAnimationFrame === null) {
            scrollAnimationFrame = requestAnimationFrame(ScrollStep);
        }
    });

    document.addEventListener('keyup', function (event) {
        if (event.code === 'KeyS' && scrollDirection === 1) scrollDirection = 0;
        if (event.code === 'KeyW' && scrollDirection === -1) scrollDirection = 0;
    });

    function CurrentPageButton() {
        const collectionInOrder = GetCollectionInOrder();
        return collectionInOrder.find(pageOption => {
            return pageOption && document.URL.toString().includes(pageOption.id);
        });
    }

    function OnLoad() {
        @yield('onLoad')
        let currentPageButton = CurrentPageButton();
        if (currentPageButton === undefined) {
            currentPageButton = document.getElementById('categories')
        }
        if (currentPageButton) {
            currentPageButton.setAttribute('class', 'btn slct-darkslate')
        }
    }

    function OnKeyDown(key) {
        if (KeyboardSuport === false) return;
        if (["KeyD", "KeyRightArrow", "KeyA", "KeyLeftArrow"].includes(key)) {
            let canMove = true;
            @yield('KeyInXX')
            @yield('CanMove')
            if (canMove === true) {
                LeftAndRight(key);
            }
        }

        if (['KeyS', 'KeyW', 'KeyUpArrow', 'KeyDownArrow'].includes(key)) {
            @yield('KeyInYX')
        }

        if (['KeyEnter', 'KeySpace', 'KeyE', 'KeyF', 'KeyZ'].includes(key)) {
            @yield('Select')
            if (document.getElementById("selectedInLayout").textContent === 'true') {
                GoTooPage(GetCollectionInOrder());
            }
        }

        // Only keep Escape key functionality for going back
        if (key === 'KeyEscape' || event.code === 'Escape') {
            history.back();
        }
    }

    function LeftAndRight(key, collectionInOrder = null, oClassName = 'btn btn-darkslate', nClassName = 'btn slct-darkslate') {
        if (collectionInOrder === null) {
            collectionInOrder = GetCollectionInOrder();
        }
        let count = collectionInOrder.length;
        let leftOrRight = (key === "KeyA" || key === 'KeyLeftArrow') ? -1 : 1;
        const collectionOrderNumber = GetSelectedButtonOrderNumber(collectionInOrder);
        
        if (collectionOrderNumber + leftOrRight !== -1 && collectionInOrder.at(collectionOrderNumber + leftOrRight) != null) {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', oClassName);
            collectionInOrder.at(collectionOrderNumber + leftOrRight).setAttribute('class', nClassName);
        } else {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', oClassName);
            let orderNumber = (leftOrRight === -1) ? count - 1 : 0;
            collectionInOrder.at(orderNumber).setAttribute('class', nClassName);
        }
    }

    function GoTooPage(collectionInOrder, id = null) {
        let orderNumber = (id != null) ? collectionInOrder.findIndex(option => id === option.id) : GetSelectedButtonOrderNumber(collectionInOrder);
        GoToURL(collectionInOrder.at(orderNumber).id);
    }

    function GoToURL(url) {
        if (url.includes('http')) {
            window.location.assign(url);
        } else {
            const cleanUrl = url.startsWith('/') ? url.slice(1) : url;
            const baseUrl = window.location.origin + '/';
            window.location.assign(baseUrl + cleanUrl);
        }
    }

    function GetSelectedButtonOrderNumber(collectionInOrder) {
        if (collectionInOrder.length < 3) {
            if (collectionInOrder.length === 1) return 0;
            if (collectionInOrder.length === 2) {
                let $standardClass = document.getElementById('standardClass');
                if (!$standardClass) {
                    let p = document.createElement("p");
                    p.setAttribute('style', 'display: none');
                    p.setAttribute('id', 'standardClass');
                    p.setAttribute('class', collectionInOrder[1].getAttribute('class'));
                    document.body.appendChild(p);
                    $standardClass = p;
                }
                return (collectionInOrder[0].getAttribute('class') !== $standardClass.getAttribute('class')) ? 0 : 1;
            }
        } else {
            let $class = collectionInOrder[0].getAttribute('class');
            if ($class !== collectionInOrder[1].getAttribute('class')) {
                if (collectionInOrder[2].getAttribute('class') === $class) return 1;
            }
            return collectionInOrder.findIndex(option => $class !== option.getAttribute('class'));
        }
    }
</script>
</body>
</html>
