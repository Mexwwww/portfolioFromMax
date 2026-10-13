{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §Worked on multiple existing websites, adding and fixing features on request of customers.§--}}
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

    .project-detail h2 {
        font-family: 'Fira Code', monospace;
        color: #58a6ff;
        font-size: 1.4rem;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .project-detail p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.1rem;
        color: #b1bac4;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Web Development</h1>
        <p>I've worked on multiple existing websites, adding or fixing features at the request of a customer. This work was all done while working at a company, so I unfortunately can't go into specifics, talk about the customers themselves, or share the code behind these projects[cite: 16].</p>
        <p>What I can share is the kind of feature I built. For one customer, for example, I added the ability to schedule when the design of banners and other visual aspects of their website would change, for a set amount of time, all managed through a separate dashboard[cite: 16].</p>

        <h2>Bug fixing</h2>
        <p>Alongside building features, I also found and fixed a good number of bugs. One example was a bug that would freeze the entire website, and depending on which browser you used, the whole browser along with it. It had never been found before because it was really specific to trigger[cite: 16].</p>
    </div>
@endsection
