{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §Automated website finding and improving.§--}}
{{-- TAGS §2 weeks, 1 Dev§ --}}
{{-- IMAGE §images/laravel/laravel-Logo.png§ --}}
<style>
    .project-detail {
        max-width: 850px;
        margin: 6vh auto;
        padding: 2.5rem;
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        color: #c9d1d9;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    .project-detail h1 {
        font-family: 'Fira Code', monospace;
        color: #58a6ff;
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #30363d;
        padding-bottom: 0.75rem;
    }

    .project-detail h2, .project-detail h3 {
        font-family: 'Fira Code', monospace;
        color: #58a6ff;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-detail h2 { font-size: 1.4rem; }
    .project-detail h3 { font-size: 1.15rem; }

    .project-detail p, .project-detail li {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #b1bac4;
        margin-bottom: 0.8rem;
    }

    .project-detail ol {
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .project-detail a.cv-download {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 1rem;
        margin-bottom: 1rem;
        padding: 0.75rem 1.75rem;
        background: #238636;
        color: #ffffff;
        font-weight: 600;
        text-decoration: none;
        border-radius: 6px;
        border: 1px solid rgba(240, 246, 252, 0.1);
        transition: all 0.2s ease;
        font-family: 'Fira Code', monospace;
    }

    .project-detail a.cv-download:hover {
        background: #2ea043;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(46, 160, 67, 0.3);
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Deeper description and why I made it</h1>

        <p>This project was made to bring in more customers by sending them a testable improved version of their site without putting hours into working on a site when it isn't even confirmed that the customer wants a new site[cite: 13].</p>

        <p>What this project does exactly is[cite: 13]:</p>

        <ol>
            <li>Find websites online with AI[cite: 13].</li>
            <li>Scrape the websites and compare the features on the site with a customisable feature list[cite: 13].</li>
            <li>Create an improved version of the site with all the old features, plus the ones in the feature list that were not yet present[cite: 13].</li>
            <li>Make an SEO file of the original and the new website[cite: 13].</li>
        </ol>

        <h2>Token AI optimisation</h2>

        <p>To not make generating a whole website too expensive, I made sure to be as optimal with the prompting as I could be. I also made a feature that would make the tokens 50% cheaper by using a Batches API, but that does make it take way longer to generate. The average cost for generating a website with this project was 5 euros, and it would take around 15–30 minutes to generate[cite: 13].</p>

        <h3>Here is a generated site of a company that allowed me to put it on my portfolio[cite: 13]:</h3>
        <a class="cv-download" download href="{{ asset('site/xeropexGeneratedSite.zip') }}">Download generated website</a>
        <p>When downloaded, just click the index file to open the home page[cite: 13].</p>
    </div>
@endsection
