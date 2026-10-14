{{-- Here you can set the description that will show under the title on the select project page --}}
{{-- TAGS §1 Dev§ --}}
{{-- IMAGE §images/laravel/portfolio.jpg§ --}}
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

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #586069;
        text-decoration: none;
        font-family: 'Fira Code', monospace;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        transition: color 0.2s ease;
    }

    .back-link:hover {
        color: #0366d6;
        text-decoration: none;
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
        margin-bottom: 1.0rem;
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
        <a href="javascript:history.back()" class="back-link">
            <span>&larr;</span> Back to categories
        </a>

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
