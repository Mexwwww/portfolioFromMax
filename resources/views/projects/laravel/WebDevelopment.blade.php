{{-- Here you can set the description that will show under the title on the select project page --}}
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

    .project-detail h1 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 0.75rem;
    }

    .project-detail h2 {
        font-family: 'Fira Code', monospace;
        color: #0366d6;
        font-size: 1.4rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-detail p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.1rem;
        color: #586069;
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
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Commercial Web Application Maintenance & Feature Development</h1>

        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            Professional client-facing web development involving custom feature engineering, scheduled design management systems, and critical browser-freeze bug resolution[cite: 8].
        </div>

        <p>I've worked on multiple existing websites, adding or fixing features at the request of a customer. This work was all done while working at a company, so I unfortunately can't go into specifics, talk about the customers themselves, or share the code behind these projects[cite: 8].</p>
        <p>What I can share is the kind of feature I built. For one customer, for example, I added the ability to schedule when the design of banners and other visual aspects of their website would change, for a set amount of time, all managed through a separate dashboard[cite: 8].</p>

        <h2>Bug fixing</h2>
        <p>Alongside building features, I also found and fixed a good number of bugs. One example was a bug that would freeze the entire website, and depending on which browser you used, the whole browser along with it. It had never been found before because it was really specific to trigger[cite: 8].</p>
    </div>
@endsection
