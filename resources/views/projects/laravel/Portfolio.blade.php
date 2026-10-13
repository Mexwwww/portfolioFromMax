{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §This portfolio website itself, built with Laravel with full keyboard navigation and dynamically generated project pages.§--}}
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
        margin-bottom: 1.0rem;
    }

    .project-detail p {
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 1.1rem;
        color: #b1bac4;
    }

    .project-detail .project-summary {
        font-size: 1.1rem;
        font-weight: 500;
        color: #58a6ff;
        background: rgba(56, 139, 253, 0.1);
        border-left: 3px solid #58a6ff;
        padding: 0.75rem 1rem;
        margin-bottom: 2rem;
        border-radius: 0 6px 6px 0;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>Modular Laravel Developer Portfolio & File-Driven View Engine</h1>

        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            A high-performance personal portfolio built in Laravel featuring dynamic file-based project rendering and responsive developer-themed UI layouts.
        </div>

        <p>This is this exact website. I made this in PhpStorm and made it as nice to use as I could make it.</p>

        <h2>Keyboard navigation</h2>
        <p>To make this website comfortable to use I made it so it's almost fully navigable with the keyboard without using a mouse. The controls are WASD or the arrow keys move you around, E, F, Z, Enter or Space select whatever you're on, and Q, X, Backspace or Escape take you back one page. This works for moving between pages in the top navigation bar, browsing categories, and moving through project grids row by row and column by column.</p>

        <h2>Dynamic projects</h2>
        <p>Every project you can browse on this site, including this one, is just a Blade file placed in the right folder. A small comment at the top of the file holds the description, some tags and a thumbnail image, which get read straight from the file to build the category grid. So adding a new project is as easy as adding a new file.</p>
    </div>
@endsection
