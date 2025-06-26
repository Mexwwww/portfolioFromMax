<style>
    .divRight {
        margin-top: 7%;
        float: right;
        margin-right: 5%;
        width: 40%;
        height: 30%;
    }

    @keyframes mailAnim {
        50% {
            scale: 5%;
            transform: translateY(100vh);
        }
        60% {
            scale: 5%;
            transform: translateY(50vh);
        }
        75% {
            transform: translateY(50vh);
            scale: 5%;
            opacity: 1;
        }
        75.1%
        {
            transform: translateY(50vh);
            scale: 0;
            opacity: 0;
        }
        89%
        {
            opacity: 0;
            scale: 0;
            transform: translateY(50vh) translateX(200vw);
        }
        90%
        {
            transform: translateX(50vw);
        }
    }

    .animate-mail-anim {
        animation: mailAnim;
        animation-duration: 10s;
    }
</style>

@extends('Layout.layout')
@section('content')
    <div class="divRight" onfocusin="TurnOffKeyboardSupport()" onfocusout="TurnOnfKeyboardSupport()">
        <div id="email-div">
            <div class="form-group">
                <label for="InputEmail">Mail me</label>
                <input name="header" type="text" class="form-control" id="header" placeholder="Subject">
            </div>
            <div class="input-group">
                <textarea name="message" class="form-control" placeholder="Message"></textarea>
            </div>
            <button type="submit" onclick="SendMail()" class="btn btn-primary">Submit</button>
        </div>
    </div>
    @csrf
    <button type="submit" onclick="TriggerAnimation()" class="btn btn-primary">Submit</button>
@endsection

<script>
    function TurnOffKeyboardSupport()
    {
        SetKeyboardSuport(false)
    }

    function TurnOnfKeyboardSupport()
    {
        SetKeyboardSuport(true)
    }

    function SendMail()
    {
        var header = document.querySelector('[name=header]').value;
        var message = document.querySelector('[name=message]').value;

        let xhr = new XMLHttpRequest();

        let url = '/ajax/send-mail?header=' + header + '&message=' + message;
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function ()
        {
            if (this.readyState === 4 && this.status === 200)
            {
                TriggerAnimation();
            }
        }
        xhr.send();
    }

    function TriggerAnimation()
    {
        const animatedObject = document.getElementById('email-div');

        requestAnimationFrame(() =>
        {
            animatedObject.classList.add('animate-mail-anim');
        });
        CheckAnimationEnded();
    }

    async function CheckAnimationEnded()
    {
        let animatedObject = document.getElementById('email-div');
        let animation = animatedObject.getAnimations().at(0);
        while (animation === undefined)
        {
            await wait(1000)
            animation = animatedObject.getAnimations().at(0);
        }

        animation.finished.then(() =>
        {
            animatedObject.classList.remove('animate-mail-anim');
        });
    }

    function wait(ms)
    {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
</script>
