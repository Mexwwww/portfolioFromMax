<style>
    .about-me {
        max-width: 800px;
        margin: 5vh auto;
        padding: 0 1rem;
        color: white;
    }

    .about-me img.profile {
        float: left;
        width: 225px;
        height: 325px;
        object-fit: cover;
        border-radius: 8px;
        margin: 0 1.5rem 1rem 0;
    }

    .about-me a.cv-download {
        display: inline-block;
        margin-top: 1.5rem;
        padding: 0.6em 1.5em;
        background: #444;
        color: white;
        text-decoration: none;
        border-radius: 999px;
        border: 1px solid darkslategray;
        transition: background 0.2s ease;
    }

    .about-me a.cv-download:hover {
        background: slategrey;
        color: white;
    }

    .about-me .clear {
        clear: both;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="about-me">
        <h1>About me</h1>
        <img class="profile" src="{{ asset('images/max.png') }}" alt="Max Geurts">
        <p>Hello,</p>
        <p>My name is Max Geurts. I'm 20 years old and I live in the Netherlands. I've finished my game development study, and had a 1 year internship at Xeropex, where I worked during the summer vacation, and stayed on working after school finished.</p>
        <p>What I like most about software development is figuring out how to fix problems.</p>
        <p>In my free time I like to play DND and hanging out with my friends and meet new people. My favourite game is Horizon Zero Dawn with Undertale in second and Omori on third place.</p>
        <a class="cv-download" download href="{{ asset('cv/CvOfMaxGeurts.pdf') }}">Download CV</a>
        <div class="clear"></div>
    </div>
@endsection
