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
        <h1>deeper description and why I made it</h1>
        <p>This project was made to bring in more customers by sending them a testable improved vertion of there site withouth putting hours in to working on a site
        when it isn't even confirmed the customer wants a new site. <br>
        what this project does exactly is: 1. find websites online with ai, 2. scrape the websites and compere the features in the site with a customisabe feature list,
        3. create an improved vertion of the site with all the old features plus the ones in the feature list that where not yet present. 4. make a seo file of the original and the new website.
        </p>

        <h2>Token ai optimilisation</h2>
        <p>To not make generating/finding a whole website too expensive I made sure to be as optimal with the prompting as i could be. I also made a feature that would make the tokens 50% cheaper by using a Batches api but that does make it take way longer to generate.
        The avrage cost for generating a website with this project was 5 euro's and it would take around 15-30 min to generate.</p>

        <h3>Here is a generated site that of a company that allowed me to put it on my protfolio:</h3>
        <a class="cv-download" download href="{{ asset('site/xeropexGeneratedSite.zip') }}">Download CV</a>
        <p>When downloaded just click the index file to open the home page.</p>
    </div>
@endsection
