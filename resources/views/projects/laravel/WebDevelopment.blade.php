{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §Worked on multiple existing websites, adding and fixing features on request of customers.§--}}
{{-- IMAGE §images/laravel/laravel-logo.png§ --}}
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
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Web Development</h1>
        <p>I've worked on multiple existing websites, adding or fixing features at the request of a customer. This work was all done while working at a company, so I unfortunately can't go into specifics, talk about the customers themselves, or share the code behind these projects.</p>
        <p>What I can share is the kind of feature I built. For one customer, for example, I added the ability to schedule when the design of banners and other visual aspects of their website would change, for a set amount of time, all managed through a separate dashboard.</p>

        <h2>Bug fixing</h2>
        <p>Alongside building features, I also found and fixed a good number of bugs. One example was a bug that would freeze the entire website, and depending on which browser you used, the whole browser along with it. It had never been found before because it was really specific to trigger.</p>
    </div>
@endsection
