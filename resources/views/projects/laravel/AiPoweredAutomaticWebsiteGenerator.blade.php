{{-- Here you can set the description that will show under the title on the select project page --}}
{{-- TAGS §2 weeks, 1 Dev§ --}}
{{-- IMAGE §images/laravel/laravel-Logo.png§ --}}
<style>
    .project-detail {
        max-width: 850px;
        margin: 6vh auto;
        padding: 2.5rem;
        background: #ffffff;
        border: 1px solid #e1e4e8;
        border-radius: 12px;
        color: #24292e;
        box-shadow: 0 4px 12px rgba(27, 31, 35, 0.05);
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #586069;
        text-decoration: none;
        font-family: 'Fira Code', monospace;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        transition: color 0.2s ease;
    }

    .back-link:hover {
        color: #0366d6;
        text-decoration: none;
    }

    .project-detail h1 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 0.75rem;
    }

    .project-detail h2, .project-detail h3 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-detail h2 { font-size: 1.4rem; }
    .project-detail h3 { font-size: 1.15rem; }

    .project-detail p, .project-detail li {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #586069;
        margin-bottom: 0.8rem;
    }

    .project-detail ol {
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .project-detail .project-summary {
        font-size: 1.1rem;
        font-weight: 500;
        color: #0366d6;
        background: rgba(3, 102, 214, 0.08);
        border-left: 3px solid #0366d6;
        padding: 0.75rem 1rem;
        margin-bottom: 2rem;
        border-radius: 0 6px 6px 0;
    }

    .project-detail a.cv-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem 1.75rem;
        background: #2ea44f;
        color: #ffffff;
        font-weight: 600;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid rgba(27, 31, 35, 0.1);
        transition: all 0.2s ease;
        font-family: 'Fira Code', monospace;
    }

    .project-detail a.cv-download:hover {
        background: #2c974b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 164, 79, 0.3);
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <a href="javascript:history.back()" class="back-link">
            <span>&larr;</span> Back to categories
        </a>

        <h1>AI-Driven Automated Website Lead Generator & Upgrader</h1>

        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            An automated lead-generation pipeline that uses AI to discover prospective business websites, evaluate their feature gaps, and dynamically build upgraded drop-in replacement prototypes.
        </div>

        <p>This project was made to bring in more customers by sending them a testable improved version of their site without putting hours into working on a site when it isn't even confirmed that the customer wants a new site.</p>

        <p>What this project does exactly is:</p>

        <ol>
            <li>Find websites online with AI.</li>
            <li>Scrape the websites and compare the features on the site with a customisable feature list.</li>
            <li>Create an improved version of the site with all the old features, plus the ones in the feature list that were not yet present.</li>
            <li>Make an SEO file of the original and the new website.</li>
        </ol>

        <h2>Token AI optimisation</h2>

        <p>To not make generating a whole website too expensive, I made sure to be as optimal with the prompting as I could be. I also made a feature that would make the tokens 50% cheaper by using a Batches API, but that does make it take way longer to generate. The average cost for generating a website with this project was 5 euros, and it would take around 15–30 minutes to generate.</p>

        <h3>Here is a generated site of a company that allowed me to put it on my portfolio:</h3>
        <a class="cv-download" download href="{{ asset('site/xeropexGeneratedSite.zip') }}">Download generated website</a>
        <p>When downloaded, just click the index file to open the home page.</p>
    </div>
@endsection
