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
<p id="selectedInLayout" hidden="">false</p>
<div style="text-align: center;" class="cnt-white">
    <!-- naming of id's must be correct cause they are used to generate the link -->
    <text style="color: darkslategray; font-size: large">
        <a onclick="GoTooPage(GetCollectionInOrder(), id)" class="btn btn-darkslate" id="aboutMe"> About me</a>
        <span class="tab"> </span>
        <a onclick="GoTooPage(GetCollectionInOrder(), id)" class="btn btn-darkslate" id="categorys">Categorys</a>
        <span class="tab"> </span>
        <a onclick="GoTooPage(GetCollectionInOrder(), id)" class="btn btn-darkslate" id="contact">Contact</a>
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
        const aboutMe = document.getElementById('aboutMe');
        const categorys = document.getElementById('categorys');
        const contact = document.getElementById('contact');
        return [aboutMe, categorys, contact];
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
        const key = event.code;
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
            return document.URL.toString().includes(UrlVersionOfId(pageOption));
        });
    }

    function OnLoad()
    {
        const currentPageButton = CurrentPageButton();
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
            document.getElementById("selectedInLayout").textContent = 'true'
            LeftAndRight(key);
        }

        if (key === 'KeyS' || key === 'KeyW' || key === 'KeyUpArrow' || key === 'KeyDownArrow')
        {
            document.getElementById("selectedInLayout").textContent = 'false'
        }

        $url = document.URL.split('/');
        if (!($url[$url.length - 1] === 'categorys' && document.getElementById("selectedInLayout").textContent === 'false') && (key === 'KeyEnter' || key === 'KeySpace' || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ'))
        {
            GoTooPage(GetCollectionInOrder());
        }

        if (key === 'KeyDelete' || key === 'KeyBackSpace' || key === 'KeyEscape' || key === 'KeyQ' || key === 'KeyX')
        {
            history.back();
        }
    }

    function LeftAndRight(key)
    {
        const collectionInOrder = GetCollectionInOrder();
        let count = collectionInOrder.length;
        let leftOrRight = 1;
        if (key === "KeyA" || key === 'KeyLeftArrow')
        {
            leftOrRight = -1;
        }

        const collectionOrderNumber = GetSelectedButtonOrderNumber(collectionInOrder)

        if (collectionOrderNumber + leftOrRight !== -1 && collectionInOrder.at(collectionOrderNumber + leftOrRight) != null)
        {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', 'btn btn-darkslate')
            collectionInOrder.at(collectionOrderNumber + leftOrRight).setAttribute('class', 'btn slct-darkslate')
        } else
        {
            collectionInOrder.at(collectionOrderNumber).setAttribute('class', 'btn btn-darkslate')
            let orderNumber = 0;
            if (leftOrRight === -1)
            {
                orderNumber = count - 1;
            }
            collectionInOrder.at(orderNumber).setAttribute('class', 'btn slct-darkslate')
        }
    }

    function GoTooPage(collectionInOrder, id = null)
    {
        const temp = GetCollectionInOrder();
        let backNotForward = false;
        if (collectionInOrder.at(0).id === GetCollectionInOrder().at(0).id)
        {
            backNotForward = true;
        }

        const $link = document.URL;
        let splitUrlLocation;
        if (backNotForward === false)
        {
            splitUrlLocation = collectionInOrder.find(function (option)
            {
                const layers = option.id.split('/');
                const lastpage = UrlVersionOfId(null, layers[layers.length - 1]);
                return $link.includes(lastpage);
            })
            if (splitUrlLocation != null)
            {
                splitUrlLocation = UrlVersionOfId(splitUrlLocation)
            }
        } else
        {
            splitUrlLocation = $link.split('//').at(0) + '//' + $link.split('//').at(1).split('/').at(0) + '/';
        }

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

        const pageOption = UrlVersionOfId(collectionInOrder.at(orderNumber))
        if (splitUrlLocation != null)
        {
            GoToURL($link.split(splitUrlLocation)[0] + pageOption);
        } else
        {
            GoToURL($link + '/' + pageOption);
        }
    }

    function GoToURL(url)
    {
        if (url === 'categorisedProjects')
        {
            const thisUrl = document.URL;
            const startUrl = thisUrl.split('//').at(0) + '//' + thisUrl.split('//').at(1).split('/').at(0) + '/';

            url = UrlVersionOfId(null, url);
            url = startUrl + url;
        }
        window.location.assign(url);
    }

    function GetSelectedButtonOrderNumber(collectionInOrder)
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

    function UrlVersionOfId(pageOption, id = null)
    {
        if (id == null)
        {
            pageOption = pageOption.id;
        } else
        {
            pageOption = id
        }

        const upercases = pageOption.split('').filter(ch =>
        {
            const code = ch.charCodeAt(0);
            return code >= 65 && code <= 90;
        })
        if (upercases.at(0) != null)
        {
            upercases.forEach(function (upercase)
            {
                const splitString = pageOption.split(upercase);
                const lowerCase = upercase.toLowerCase();
                pageOption = splitString.at(0) + '-' + lowerCase + splitString.at(1);
            })
        }
        return pageOption;
    }
</script>

