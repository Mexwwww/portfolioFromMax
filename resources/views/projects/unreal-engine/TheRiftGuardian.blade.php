{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §This VR game was made in Unreal engine with blueprints and C++ code.§--}}
{{-- TAGS §20 developers, 3 artists§ --}}
{{-- IMAGE §images/unreal-engine/the-rift-guardian.png§ --}}
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

    .project-detail video, .project-detail img {
        width: 100%;
        max-width: 639px;
        border-radius: 8px;
        display: block;
        margin: 1rem 0;
        aspect-ratio: 16 / 9;
        background: #f6f8fa;
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
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>THE RIFT GUARDIAN</h1>
        <p>This VR game was made in Unreal Engine with blueprints and C++ code.<br> This game is made by 20 developers and 3 artists.</p>

        <video autoplay muted loop>
            <source src="{{ asset('videos/RiftTrailer.mp4') }}" type="video/mp4">
        </video>

        <p>The Rift Guardian is a single-player game where your job is to keep the rift to the world safe. There are aliens that try to break through the rift to the world; It's your job to stop them. For every kill, you get a small pay check to buy more useful items or guns.</p>

        <h1>My Contributions</h1>
        <h2>Moon of resurrection:</h2>

        <p>In this project, I made everything from this moon except for the model and texture.<br><br></p>

        <video autoplay muted loop>
            <source src="{{ asset('videos/MoonOfRes.mp4') }}" type="video/mp4">
        </video>

        <p>
            When the player hits 0 HP, the moon will activate. After a short animation, the moon will explode, letting out a loud sound and a shockwave that kills every enemy it hits. When it's done, the player gets 1 HP back.<br>
            If not at 0 hp and you own the moon. It will follow the player and slowly spin around them, making sure that the player knows and can't forget that they own the moon.
        </p>

        <p>This is a code snippet of how I made the explosion kill all enemies in range and heal the player for 1 hp.</p>
        <img src="{{ asset('images/unreal-engine/rift-moon-explosion.png') }}" alt="">

        <p>The code snippet below is of how I made the shockwave grow, below that is a snippet of how I made the shockwave look like it does and disappear over time. Together, they are how I made the visual of the shockwave.</p>
        <img src="{{ asset('images/unreal-engine/rift-shockwave-grow.png') }}" alt="">
        <img src="{{ asset('images/unreal-engine/rift-shockwave-rest.png') }}" alt="">
    </div>
@endsection
