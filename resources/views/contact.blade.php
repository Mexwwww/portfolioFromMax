<style>
    .contactWrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 6vh 1rem;
    }

    .divRight {
        width: 100%;
        max-width: 460px;
        background: #111;
        border: 1px solid darkslategray;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.6);
        color: white;
    }

    .divRight h3 {
        color: white;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .divRight label {
        color: slategrey;
        margin-bottom: 0.4rem;
        display: inline-block;
    }

    .divRight .form-control {
        background: #1c1c1c;
        border-color: darkslategray;
        color: white;
    }

    .divRight .form-control::placeholder {
        color: #6c7a7a;
    }

    .divRight .form-control:focus {
        background: #1c1c1c;
        color: white;
        border-color: slategrey;
        box-shadow: 0 0 0 0.2rem rgba(112, 128, 144, 0.35);
    }

    .divRight .input-group {
        margin-top: 1rem;
        margin-bottom: 1.5rem;
    }

    .divRight textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .envolope {
        display: block;
        margin: 0 auto 1.5rem;
    }

    .divRight .btn-darkslate {
        border: 1px solid darkslategray;
        width: 100%;
    }

    @keyframes mailAnim {
        50% {
            scale: 5%;
            transform: translateY(-50vh);
        }
        60% {
            scale: 5%;
            transform: translateY(50vh);
        }
        75% {
            transform: translateY(100vh);
            scale: 5%;
            opacity: 1;
        }
        75.1% {
            transform: translateY(50vh);
            scale: 0;
            opacity: 0;
        }
        89% {
            opacity: 0;
            scale: 0;
            transform: translateY(50vh) translateX(500vw);
        }
        90% {
            transform: translateX(500vw);
        }
    }

    @keyframes envolopeAnim {
        0% {
            transform: translateX(0vw) translateY(0);
            opacity: 1;
            scale: 100%;
        }
        40% {
            transform: translateY(-30vh);
            opacity: 1;
            scale: 100%;
        }
        50% {
            transform: translateX(0vw) translateY(-30vh);
            opacity: 1;
            scale: 95%;
        }
        75% {
            scale: 95%;
            opacity: 1;
        }
        75.1% {
            transform: translateX(0vw) translateY(-30vh);
            scale: 100%;
            opacity: 1;
        }
        78% {
            transform: translateX(0vw) translateY(-100vh);
            opacity: 1;
        }
        83% {
            transform: translateX(0vw) translateY(-90vh);
            opacity: 0;
        }
        88% {
            transform: translateX(0vw) translateY(100vh);
            opacity: 0;
        }
        89% {
            transform: translateX(0vw) translateY(100vh);
            opacity: 1;
        }
        100% {
            opacity: 1;
        }
    }

    .animate-mail-anim {
        animation: mailAnim;
        animation-duration: 10s;
    }

    .animate-envolope-anim {
        animation: envolopeAnim;
        animation-duration: 10s;
    }

</style>

@extends('layout.layout')
@section('content')
    <div class="contactWrapper">
        <div class="divRight" onfocusin="TurnOffKeyboardSupport()" onfocusout="TurnOnfKeyboardSupport()">
            <div id="email-div">
                <h3>Mail me</h3>
                <div class="form-group">
                    <label for="senderEmail">Your email</label>
                    <input name="email" type="email" class="form-control" id="senderEmail" placeholder="you@example.com" required>
                </div>
                <div class="form-group mt-3">
                    <label for="header">Subject</label>
                    <input name="header" type="text" class="form-control" id="header" placeholder="Subject">
                </div>
                <div class="input-group">
                    <textarea name="message" class="form-control" placeholder="Message"></textarea>
                </div>
                <div id="formError" class="text-danger mb-2" style="display: none;"></div>
                <button type="submit" onclick="SendMail()" class="btn btn-darkslate">Submit</button>
            </div>
            <img src="{{ asset('images/mail_closed.png') }}"
                 alt="selected"
                 class="envolope" id="envolope">
        </div>
    </div>
    @csrf
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
        var email = document.querySelector('[name=email]').value.trim();
        var header = document.querySelector('[name=header]').value.trim();
        var message = document.querySelector('[name=message]').value.trim();

        var missing = [];
        if (!email)
        {
            missing.push('your email');
        }
        if (!header)
        {
            missing.push('a subject');
        }
        if (!message)
        {
            missing.push('a message');
        }

        var errorDiv = document.getElementById('formError');
        if (missing.length > 0)
        {
            errorDiv.textContent = 'Please fill in ' + missing.join(', ') + ' before sending.';
            errorDiv.style.display = 'block';
            return;
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email))
        {
            errorDiv.textContent = 'Please enter a valid email address.';
            errorDiv.style.display = 'block';
            return;
        }
        errorDiv.style.display = 'none';

        let xhr = new XMLHttpRequest();

        let url = '/ajax/send-mail?email=' + encodeURIComponent(email) + '&header=' + encodeURIComponent(header) + '&message=' + encodeURIComponent(message);
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
        const envolope = document.getElementById('envolope');

        requestAnimationFrame(() =>
        {
            animatedObject.classList.add('animate-mail-anim');
            envolope.classList.add('animate-envolope-anim');
        });
        setTimeout(ClearFormFields, 10000 * 0.88);
        CheckAnimationEnded();
    }

    function ClearFormFields()
    {
        document.querySelector('[name=email]').value = '';
        document.querySelector('[name=header]').value = '';
        document.querySelector('[name=message]').value = '';
    }

    async function CheckAnimationEnded()
    {
        let animatedObject = document.getElementById('email-div');
        let envolope = document.getElementById('envolope');
        let animation = animatedObject.getAnimations().at(0);
        while (animation === undefined)
        {
            await wait(1000)
            animation = animatedObject.getAnimations().at(0);
        }

        animation.finished.then(() =>
        {
            animatedObject.classList.remove('animate-mail-anim');
            envolope.classList.remove('animate-envolope-anim');
        });
    }

    function wait(ms)
    {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
</script>
