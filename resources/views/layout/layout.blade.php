@php use Illuminate\Support\Facades\File; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

<style>
    .backgroundColor {
        background: black;
    }

    a:hover,
    .btn-darkslate:hover {
        color: slategrey !important;
        transform: scale(1.20);
        transition: scale 0.3s ease;
    }

    .btn-darkslate {
        color: darkslategray !important;
    }

    .slct-darkslate {
        color: slategrey;
        transform: scale(1.20);
        transition: scale 0.3s ease;
    }

    .cnt-white {
        width: 100%;
        border-style: solid;
        border-width: 0;
        border-bottom-width: 1px;
        border-color: darkslategray;
        background: black;
    }

    .tab {
        Padding-left: 35px;
    }
</style>
@yield('style')


<body class="backgroundColor" onload="OnLoad()" onkeydown="onkeydown(KeyboardEvent.code)">
<p id="selectedInLayout" hidden="">true</p>
<div style="text-align: center;" class="cnt-white">
    <text style="color: darkslategray; font-size: large">
        <?php
        $fileNames = [];
        $basePath = resource_path('views/');
        foreach (File::files($basePath) as $file)
        {
            $fileNames[] = basename(str_replace('.blade', '', $file->getFilenameWithoutExtension()));
        }
        $fileNames = collect($fileNames)->unique()->values()->toArray();
        ?>
        @foreach($fileNames as $name)
            <span class="tab"> </span>
            <a href="/{{$name}}" class="btn btn-darkslate" id="{{$name}}"> {{$name}}</a>
            <span class="tab"> </span>
        @endforeach
    </text>
</div>
</body>
@yield('content')
</html>

<script src="{{ asset('js/KeyCodeTooKey.js') }}"></script>

<script>
    let KeyboardSuport = true;

    function SetKeyboardSuport(bool)
    {
        KeyboardSuport = bool;
    }

    function GetCollectionInOrder()
    {
        let buttons = [];
        let names = <?php echo json_encode($fileNames); ?>;
        names.forEach(function (name)
        {
            if(name != null)
            {
                buttons.push(document.getElementById(name));
            }
        })
        return buttons;
    }

    document.onkeydown = function (e)
    {
        const key = Convert(e.keyCode);
        if (key != null)
        {
            OnKeyDown(key)
            if (CurrentPageButton().id === 'categorys')
            {
                OnProjectKeyDown(key);
            }
        }
    };

    document.addEventListener('keydown', function (event)
    {
        let key = 'Key' + event.key;  // This is layout-dependent
        key = 'Key' + key.split('y')[1].toUpperCase();
        if (key === 'KeyA' || key === 'KeyD' || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ' || key === 'KeyS' || key === 'KeyW' || key === 'KeyQ' || key === 'KeyX')
        {
            OnKeyDown(key);
        }
    });

    function CurrentPageButton()
    {
        const collectionInOrder = GetCollectionInOrder();
        return collectionInOrder.find(pageOption =>
        {
            return document.URL.toString().includes(pageOption);
        });
    }

    function OnLoad()
    {
        @yield('onLoad')
        let currentPageButton = CurrentPageButton();
        if (currentPageButton === undefined)
        {
            currentPageButton = document.getElementById('categorys')
        }
        currentPageButton.setAttribute('class', 'btn slct-darkslate')
    }

    function OnKeyDown(key)
    {
        if (KeyboardSuport === false)
        {
            return;
        }
        if (key === "KeyD" || key === "KeyRightArrow" || key === "KeyA" || key === 'KeyLeftArrow')
        {
            let canMove = true;
            @yield('KeyInXX')
            @yield('CanMove')
            if (canMove === true)
            {
                LeftAndRight(key);
            }
        }

        if (key === 'KeyS' || key === 'KeyW' || key === 'KeyUpArrow' || key === 'KeyDownArrow')
        {
            let upDownInt = 1;
            if (key === 'KeyS' || key === 'KeyDownArrow')
            {
                upDownInt = -1
            }

            @yield('KeyInYX')
        }

        $url = document.URL.split('/');
        if (key === 'KeyEnter' || key === 'KeySpace' || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ')
        {
            @yield('Select')
            if(document.getElementById("selectedInLayout").textContent === 'true')
            {
                GoTooPage(GetCollectionInOrder());
            }
        }

        if (key === 'KeyDelete' || key === 'KeyBackSpace' || key === 'KeyEscape' || key === 'KeyQ' || key === 'KeyX')
        {
            history.back();
        }
    }

    function LeftAndRight(key , collectionInOrder = null , oClassName = 'btn btn-darkslate', nClassName = 'btn slct-darkslate')
    {
        if (collectionInOrder === null)
        {
            collectionInOrder = GetCollectionInOrder();
        }

        let count = collectionInOrder.length;
        let leftOrRight = 1;
        if (key === "KeyA" || key === 'KeyLeftArrow')
        {
            leftOrRight = -1;
        }

        const collectionOrderNumber = GetSelectedButtonOrderNumber(collectionInOrder)
        if (collectionOrderNumber + leftOrRight !== -1 && collectionInOrder.at(collectionOrderNumber + leftOrRight) != null)
        {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', oClassName)
            collectionInOrder.at(collectionOrderNumber + leftOrRight).setAttribute('class', nClassName)

        } else
        {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', oClassName)
            let orderNumber = 0;
            if (leftOrRight === -1)
            {
                orderNumber = count - 1;
            }
            collectionInOrder.at(orderNumber).setAttribute('class', nClassName)
        }
    }

    function GoTooPage(collectionInOrder, id = null)
    {
        let orderNumber;
        if (id != null)
        {
            orderNumber = collectionInOrder.findIndex(option =>
            {
                return id === option.id;
            });
        } else
        {
            orderNumber = GetSelectedButtonOrderNumber(collectionInOrder)
        }
        GoToURL(collectionInOrder.at(orderNumber).id);
    }

    function GoToURL(url)
    {
        if (url.includes('http'))
        {
            window.location.assign(url);
        }
        else
        {
            window.location.assign(document.URL.split(document.URL.split('/')[3])[0] + url);
        }
    }

    function GetSelectedButtonOrderNumber(collectionInOrder)
    {
        if (collectionInOrder.length < 3)
        {
            if (collectionInOrder.length === 1)
            {
                return 0;
            }

            if (collectionInOrder.length === 2)
            {
                let $standardClass = document.getElementById('standardClass')
                if (document.getElementById('standardClass') === null)
                {
                    p = document.createElement("p");
                    p.setAttribute('style', 'display: none');
                    p.setAttribute('id', 'standardClass')
                    p.setAttribute('class', collectionInOrder[1].getAttribute('class'))
                    $standardClass = p;
                    document.body.appendChild(p);
                }

                if (collectionInOrder[0].getAttribute('class') === $standardClass.getAttribute('class'))
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
        }
        else
        {
            let $class = (collectionInOrder[0]).getAttribute('class');
            if ($class !== (collectionInOrder[1]).getAttribute('class'))
            {
                $class = (collectionInOrder[2]).getAttribute('class');
            }

            return collectionInOrder.findIndex(option =>
            {
                return $class !== option.getAttribute('class');
            });
        }
    }
</script>

