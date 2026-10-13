@php use Illuminate\Support\Facades\File; @endphp
<style>
    .projects-container {
        max-width: 1200px;
        margin: 6vh auto;
        padding: 0 1.5rem;
    }

    .project-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .project-card {
        background: #161b22;
        border: 1px solid #30363d;
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        color: #c9d1d9;
        display: flex;
        flex-direction: column;
        transition: all 0.2s ease;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    .project-card:hover {
        border-color: #58a6ff;
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(88, 166, 255, 0.15);
        color: #c9d1d9;
    }

    .project-img-wrapper {
        width: 100%;
        height: 180px;
        background: #0d1117;
        border-bottom: 1px solid #30363d;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .project-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .project-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        flex: 1;
    }

    .project-title {
        font-family: 'Fira Code', monospace;
        font-size: 1.2rem;
        color: #58a6ff;
        margin: 0;
        line-height: 1.4;
    }

    .project-desc {
        font-size: 0.95rem;
        color: #8b949e;
        line-height: 1.5;
        flex: 1;
        margin: 0;
    }

    .project-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }

    .tag-badge {
        font-family: 'Fira Code', monospace;
        font-size: 0.75rem;
        background: rgba(56, 139, 253, 0.1);
        color: #58a6ff;
        border: 1px solid rgba(56, 139, 253, 0.2);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
</style>

@extends('layout.layout')
@section('content')
    <div class="projects-container">
        <div class="project-grid">
            <?php
            $category = request()->route('category');
            $files = File::files(resource_path("views/projects/{$category}"));
            
            foreach ($files as $file) {
                $fileName = $file->getFilenameWithoutExtension();
                $content = File::get($file->getPathname());
                
                // Extract custom image tag or fallback
                $image = 'images/laravel/laravel-Logo.png';
                if (preg_match('/{{--\s*IMAGE\s*§(.*?)§\s*--}}/', $content, $imgMatch)) {
                    $image = trim($imgMatch[1]);
                }

                // Extract custom description tag if available
                $description = '';
                if (preg_match('/{{--\s*DESCRIPTION\s*§(.*?)§\s*--}}/', $content, $descMatch)) {
                    $description = trim($descMatch[1]);
                } else {
                    // Fallback to extracting text from the 1-sentence summary div if DESCRIPTION tag isn't present
                    if (preg_match('/<div class="project-summary">\s*(.*?)\s*<\/div>/s', $content, $summaryMatch)) {
                        $description = trim(strip_tags($summaryMatch[1]));
                    }
                }

                // Extract the improved <h1> title from the file
                $title = $fileName;
                if (preg_match('/<h1>(.*?)<\/h1>/s', $content, $titleMatch)) {
                    $title = trim(strip_tags($titleMatch[1]));
                }

                // Extract tags if present
                $tags = [];
                if (preg_match('/{{--\s*TAGS\s*§(.*?)§\s*--}}/', $content, $tagMatch)) {
                    $tags = array_map('trim', explode(',', $tagMatch[1]));
                }
            ?>
                <a href="/projects/{{$category}}/{{$fileName}}" class="project-card" id="{{$fileName}}">
                    <div class="project-img-wrapper">
                        <img src="{{ asset($image) }}" alt="{{$title}}">
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">{{$title}}</h3>
                        <p class="project-desc">{{$description}}</p>
                        @if(!empty($tags))
                            <div class="project-tags">
                                @foreach($tags as $tag)
                                    <span class="tag-badge">{{$tag}}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </a>
            <?php } ?>
        </div>
    </div>
@endsection
