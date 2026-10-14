<style>
    :root {
        --bg-primary: #0d1117;
        --bg-secondary: #161b22;
        --border-color: #30363d;
        --text-main: #c9d1d9;
        --text-muted: #b1bac4;
        --accent-blue: #58a6ff;
        --accent-green: #2ea043;
    }

    .about-me {
        max-width: 850px;
        margin: 6vh auto;
        padding: 2.5rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        color: var(--text-main);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    .about-me h1 {
        font-family: 'Fira Code', monospace;
        color: var(--accent-blue);
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.75rem;
    }

    .about-me h2 {
        font-family: 'Fira Code', monospace;
        color: var(--accent-blue);
        font-size: 1.5rem;
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
    }

    .about-me img.profile {
        float: left;
        width: 220px;
        height: 310px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        margin: 0 2rem 1.5rem 0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .about-me p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.1rem;
        color: var(--text-muted);
    }

    .about-me p.below-image {
        clear: both;
        padding-top: 2rem;
    }

    .cv-container {
        margin-top: 2rem;
    }

    .cv-preview {
        width: 100%;
        height: 600px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        background: var(--bg-primary);
        margin-bottom: 1.2rem;
    }

    .about-me a.cv-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 0.75rem 1.75rem;
        background: var(--accent-green);
        color: #ffffff;
        font-weight: 600;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid rgba(240, 246, 252, 0.1);
        transition: all 0.2s ease;
        font-family: 'Fira Code', monospace;
    }

    .about-me a.cv-download:hover {
        background: #3fb950;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 160, 67, 0.3);
    }

    .about-me .clear {
        clear: both;
    }

    @media screen and (max-width: 650px) {
        .about-me {
            margin: 2vh 1rem;
            padding: 1.5rem;
        }

        .about-me img.profile {
            float: none;
            display: block;
            width: 100%;
            max-width: 220px;
            height: auto;
            margin: 0 auto 1.5rem;
        }

        .about-me p.below-image {
            clear: none;
            padding-top: 0;
        }

        .cv-preview {
            height: 400px;
        }

        .about-me a.cv-download {
            display: block;
            text-align: center;
            justify-content: center;
        }
    }
</style>

@extends('layout.layout')
@section('content')
    <div class="about-me">
        <h1>About Me</h1>
        <img class="profile" src="{{ asset('images/max.png') }}" alt="Max Geurts">
        <p>Hello,</p>
        <p>My name is Max Geurts. I am a software developer who completed the 4-year Game Development study at Grafisch Lyceum Utrecht, which included two internship periods that combined took about a year.</p>
        <p>After my studies, I started working at Xeropex, where I completed my internship periods and worked during summer vacation.</p>
        <p class="below-image">What I like most about software development is solving complex technical problems and seeing the end result of a high-quality project I have built.</p>
        <p>In my free time, I like to code, play D&D, hang out with friends, and meet new people. My favourite game is Horizon Zero Dawn, with Undertale in second place and Omori in third.</p>

        <h2>Curriculum Vitae</h2>
        <div class="cv-container">
            <iframe src="{{ asset('cv/CvOfMaxGeurts.pdf') }}" class="cv-preview" type="application/pdf">
                <p>Your browser does not support PDFs. Please download the PDF to view it: <a href="{{ asset('cv/CvOfMaxGeurts.pdf') }}">Download CV</a>.</p>
            </iframe>

            <a class="cv-download" download href="{{ asset('cv/CvOfMaxGeurts.pdf') }}">
                <span>↓</span> Download CV
            </a>
        </div>

        <div class="clear"></div>
    </div>
@endsection
