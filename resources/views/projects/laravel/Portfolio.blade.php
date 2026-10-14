{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §This portfolio website itself, built with Laravel, featuring a sleek modern developer aesthetic and dynamic file-driven project rendering.§--}}
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
            A high-performance personal portfolio built in Laravel featuring dynamic file-based project rendering, a sleek GitHub-inspired dark UI, and smooth mouse-driven navigation.
        </div>

        <p>This is this exact website. I designed and built this portfolio to reflect a clean, professional software developer aesthetic—moving away from traditional gimmicks into a polished, modern tech look inspired by developer tooling and GitHub dashboards.</p>

        <h2>Architecture & Design</h2>
        <p>The site is built on a robust Laravel backend utilizing Blade templating and Bootstrap 5, styled completely with custom CSS to feature darkslate surfaces, subtle cyan accents, and Fira Code typography. Navigation is built around natural, fluid mouse interaction while preserving an Escape key shortcut for quick backward navigation.</p>

        <h2>Dynamic File-Driven Projects</h2>
        <p>Every project you can browse on this site is dynamically loaded from individual Blade files stored in structured category folders. The application scans these files on the fly, extracting metadata comments for tags, thumbnail images, and summaries to build the interactive project grids automatically. This makes adding or updating portfolio pieces as simple as dropping in a new file.</p>
    </div>
@endsection
