<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<style>
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
        color: slategrey !important;
        transform: scale(1.20);
        transition: scale 0.3s ease;
    }

    .cnt-white {
        width: 100%;
        border-style: solid;
        border-width: 0;
        border-bottom-width: 1px;
        border-color: darkslategray;
    }

    .tab {
        Padding-left: 35px;
    }
</style>

<body style="background: black" onload="OnLoad()">
<p id="selectedInLayout" hidden="">false</p>
<div style="text-align: center;" class="cnt-white">
    <!-- naming of id's must be correct cause they are used to generate the link -->
    <text style="color: darkslategray; font-size: large">
        <a onclick="GoTooPage(id, getCollectionInOrder())" class="btn btn-darkslate" id="aboutMe"> About me</a>
        <span class="tab"> </span>
        <a onclick="GoTooPage(id, getCollectionInOrder())" class="btn btn-darkslate" id="projects">Projects</a>
        <span class="tab"> </span>
        <a onclick="GoTooPage(id, getCollectionInOrder())" class="btn btn-darkslate" id="contact">Contact</a>
    </text>
</div>
</body>
<div style="color: white">
    @yield('content')
</div>
</html>

<script>
    function getCollectionInOrder()
    {
        const aboutMe = document.getElementById('aboutMe');
        const projects = document.getElementById('projects');
        const contact = document.getElementById('contact');
        return [aboutMe, projects, contact];
    }

    document.addEventListener('keydown', function(event) {
        const key = event.code;
        if (key === 'KeyA' || key === 'KeyD' || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ' || key === 'KeyS' || key === 'KeyW')
        {
            OnKeyDown(key);
        }
    });

    function OnLoad()
    {
        const collectionInOrder = getCollectionInOrder();
        const index = collectionInOrder.findIndex(pageOption =>
        {
            return document.URL.toString().includes(UrlVersionOfId(pageOption));
        });
        collectionInOrder.at(index).setAttribute('class', 'btn slct-darkslate')
    }

    function OnKeyDown(key)
    {
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
        if (!($url[$url.length - 1] === 'projects' && document.getElementById("selectedInLayout").textContent === 'false') && (key === 'KeyEnter' || key === 'KeySpace' || key === 'KeyE' || key === 'KeyF' || key === 'KeyZ'))
        {
            GoTooPage(null, getCollectionInOrder());
        }

        if (key === 'KeyDelete' || key === 'KeyBackSpace' || key === 'KeyEscape' || key === 'KeyQ' || key === 'KeyX')
        {
            history.back();
        }
    }

    function LeftAndRight(key)
    {
        const collectionInOrder = getCollectionInOrder();
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

    function GoTooPage(id = null, collectionInOrder)
    {
        const $link = document.URL;
        let spitUrlLocation = collectionInOrder.find(function (option)
        {
            const layers = option.id.split('/');
            const lastpage = UrlVersionOfId(null, layers[layers.length - 1]);
            return $link.includes(lastpage)
        })
        if (spitUrlLocation != null)
        {
            spitUrlLocation = UrlVersionOfId(spitUrlLocation)
        }

        let orderNumber;
        if (id != null)
        {
            orderNumber = collectionInOrder.findIndex(option =>
            {
                console.log(option.id);
                return id === option.id;
            });
            console.log(id)
        } else
        {
            orderNumber = GetSelectedButtonOrderNumber(collectionInOrder)
        }
        console.log(orderNumber);

        const pageOption = UrlVersionOfId(collectionInOrder.at(orderNumber))
        if (spitUrlLocation != null)
        {
            window.location.assign($link.split(spitUrlLocation)[0] + pageOption);
        }
        else
        {
            window.location.assign($link + '/' + pageOption);
        }
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
        }
        else
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

