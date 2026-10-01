{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §Automated website finding and improving.§--}}
{{-- TAGS §2 weeks, 1 Dev§ --}}
{{-- IMAGE §images/laravel/laravel-Logo.png§ --}}
<style>
    .project-detail {
        max-width: 800px;
        margin: 5vh auto;
        padding: 0 1rem;
        color: white;
    }

    .project-detail h2 {
        margin-top: 2rem;
    }

    .project-detail pre {
        background: #111;
        border: 1px solid darkslategray;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        color: #d4d4d4;
        font-size: 0.85rem;
        line-height: 1.4;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
    <h1>Deeper description and why I made it</h1>

    <p>This project was made to bring in more customers by sending them a testable improved version of their site without putting hours into working on a site when it isn't even confirmed that the customer wants a new site.</p>

    <p>What this project does exactly is:</p>

    <ol> <li>Find websites online with AI.</li> <li>Scrape the websites and compare the features on the site with a customisable feature list.</li> <li>Create an improved version of the site with all the old features, plus the ones in the feature list that were not yet present.</li> <li>Make an SEO file of the original and the new website.</li> </ol>

    <h2>Token AI optimisation</h2>

    <p>To not make generating a whole website too expensive, I made sure to be as optimal with the prompting as I could be. I also made a feature that would make the tokens 50% cheaper by using a Batches API, but that does make it take way longer to generate. The average cost for generating a website with this project was 5 euros, and it would take around 15–30 minutes to generate.</p>

    <h3>Here is a generated site of a company that allowed me to put it on my portfolio:</h3>
        <a class="cv-download" download href="{{ asset('site/xeropexGeneratedSite.zip') }}">Download generated website</a>
    <p>When downloaded, just click the index file to open the home page.</p>
    </div>
@endsection
