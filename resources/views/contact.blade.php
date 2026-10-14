@extends('layout.layout')
@section('content')
<style>
    .contactWrapper {
        min-height: 75vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 6vh 1rem;
    }

    .divRight {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border: 1px solid #e1e4e8;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: 0 4px 12px rgba(27, 31, 35, 0.05);
        color: #24292e;
        font-family: 'Inter', sans-serif;
    }

    .divRight h3 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        margin-bottom: 1.5rem;
        text-align: center;
        font-size: 1.5rem;
    }

    .divRight label {
        color: #586069;
        margin-bottom: 0.4rem;
        display: inline-block;
        font-size: 0.9rem;
        font-family: 'Fira Code', monospace;
    }

    .divRight .form-control {
        background: #f6f8fa;
        border: 1px solid #e1e4e8;
        color: #24292e;
        border-radius: 6px;
        padding: 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .divRight .form-control::placeholder {
        color: #959da5;
    }

    .divRight .form-control:focus {
        background: #ffffff;
        color: #24292e;
        border-color: #0366d6;
        box-shadow: 0 0 0 3px rgba(3, 102, 214, 0.15);
    }

    .divRight .form-group {
        margin-bottom: 1.25rem;
    }

    .divRight .input-group {
        margin-top: 0;
        margin-bottom: 1.5rem;
    }

    .divRight textarea.form-control {
        min-height: 130px;
        resize: vertical;
    }

    .envolope {
        display: block;
        margin: 1.5rem auto 0;
        max-width: 60px;
        height: auto;
        filter: invert(1) hue-rotate(180deg);
    }

    .divRight .btn-darkslate {
        background: #2ea44f;
        color: #ffffff;
        border: 1px solid rgba(27, 31, 35, 0.1);
        width: 100%;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: 6px;
        font-family: 'Fira Code', monospace;
        transition: all 0.2s ease;
    }

    .divRight .btn-darkslate:hover {
        background: #2c974b;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(46, 164, 79, 0.3);
    }

    /* Direct Contact Info Box */
    .direct-contact-info {
        width: 100%;
        max-width: 480px;
        margin-top: 1.5rem;
        background: #f6f8fa;
        border: 1px solid #e1e4e8;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        font-family: 'Fira Code', monospace;
        font-size: 0.95rem;
        color: #24292e;
        box-shadow: 0 4px 12px rgba(27, 31, 35, 0.03);
    }

    .direct-contact-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 0.5rem;
    }

    .direct-contact-item:last-child {
        margin-bottom: 0;
    }

    .direct-contact-item svg {
        width: 16px;
        height: 16px;
        fill: #0366d6;
        flex-shrink: 0;
    }

    .direct-contact-item a {
        color: #0366d6;
        text-decoration: none;
    }

    .direct-contact-item a:hover {
        text-decoration: underline;
    }

    .placeholder-text {
        color: #8c959f;
        font-style: italic;
        font-size: 0.85rem;
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

    <div class="contactWrapper">
        <div class="divRight" onfocusin="TurnOffKeyboardSupport()" onfocusout="TurnOnfKeyboardSupport()">
            <div id="email-div">
                <h3>Get in Touch</h3>
                <div class="form-group">
                    <label for="senderEmail">Your email</label>
                    <input name="email" type="email" class="form-control" id="senderEmail" placeholder="you@example.com" required>
                </div>
                <div class="form-group">
                    <label for="header">Subject</label>
                    <input name="header" type="text" class="form-control" id="header" placeholder="Project Inquiry / Subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" class="form-control" placeholder="Write your message here..."></textarea>
                </div>
                <div id="formError" class="text-danger mb-2" style="display: none; font-size: 0.85rem;"></div>
                <button type="submit" onclick="SendMail()" class="btn btn-darkslate">Send Message</button>
            </div>
            <img src="{{ asset('images/mail_closed.png') }}"
                 alt="Envelope"
                 class="envolope" id="envolope">
        </div>

        <!-- Direct Contact Details (Protected against scrapers) -->
        <div class="direct-contact-info">
            <div class="direct-contact-item">
                <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                <span id="email-container"><span class="placeholder-text">Loading email...</span></span>
            </div>
            <div class="direct-contact-item">
                <svg viewBox="0 0 24 24"><path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/></svg>
                <span id="phone-container"><span class="placeholder-text">Loading phone...</span></span>
            </div>
        </div>
    </div>
    @csrf
@endsection

<script>
    function TurnOffKeyboardSupport() {
        SetKeyboardSuport(false);
    }

    function TurnOnfKeyboardSupport() {
        SetKeyboardSuport(true);
    }

    function SendMail() {
        var email = document.querySelector('[name=email]').value.trim();
        var header = document.querySelector('[name=header]').value.trim();
        var message = document.querySelector('[name=message]').value.trim();

        var missing = [];
        if (!email) {
            missing.push('your email');
        }
        if (!header) {
            missing.push('a subject');
        }
        if (!message) {
            missing.push('a message');
        }

        var errorDiv = document.getElementById('formError');
        if (missing.length > 0) {
            errorDiv.textContent = 'Please fill in ' + missing.join(', ') + ' before sending.';
            errorDiv.style.display = 'block';
            return;
        }

        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorDiv.textContent = 'Please enter a valid email address.';
            errorDiv.style.display = 'block';
            return;
        }
        errorDiv.style.display = 'none';

        let xhr = new XMLHttpRequest();
        let url = '/ajax/send-mail?email=' + encodeURIComponent(email) + '&header=' + encodeURIComponent(header) + '&message=' + encodeURIComponent(message);
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                TriggerAnimation();
            }
        };
        xhr.send();
    }

    function TriggerAnimation() {
        const animatedObject = document.getElementById('email-div');
        const envolope = document.getElementById('envolope');

        requestAnimationFrame(() => {
            animatedObject.classList.add('animate-mail-anim');
            envolope.classList.add('animate-envolope-anim');
        });
        setTimeout(ClearFormFields, 10000 * 0.88);
        CheckAnimationEnded();
    }

    function ClearFormFields() {
        document.querySelector('[name=email]').value = '';
        document.querySelector('[name=header]').value = '';
        document.querySelector('[name=message]').value = '';
    }

    async function CheckAnimationEnded() {
        let animatedObject = document.getElementById('email-div');
        let envolope = document.getElementById('envolope');
        let animation = animatedObject.getAnimations().at(0);
        while (animation === undefined) {
            await wait(1000);
            animation = animatedObject.getAnimations().at(0);
        }

        animation.finished.then(() => {
            animatedObject.classList.remove('animate-mail-anim');
            envolope.classList.remove('animate-envolope-anim');
        });
    }

    function wait(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    // Anti-scraper dynamic rendering for direct contact details
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            const encodedEmail = "bS50LmpuZ2V1cnRzQGdtYWlsLmNvbQ=="; // m.t.j.geurts@gmail.com
            const encodedPhone = "KzMxIDYgNDIzNDg0NDI=";            // +31 6 42348442

            const email = atob(encodedEmail);
            const phone = atob(encodedPhone);
            const cleanPhone = phone.replace(/\s+/g, '');

            const emailContainer = document.getElementById('email-container');
            if (emailContainer) {
                emailContainer.innerHTML = '<a href="mailto:' + email + '">' + email + '</a>';
            }

            const phoneContainer = document.getElementById('phone-container');
            if (phoneContainer) {
                phoneContainer.innerHTML = '<a href="tel:' + cleanPhone + '">' + phone + '</a>';
            }
        }, 500);
    });
</script>
