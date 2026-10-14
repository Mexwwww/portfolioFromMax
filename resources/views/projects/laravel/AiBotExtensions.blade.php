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

    .project-detail pre {
        background: #f6f8fa;
        border: 1px solid #e1e4e8;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        color: #0366d6;
        font-family: 'Fira Code', monospace;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 1.2rem 0;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <a href="javascript:history.back()" class="back-link">
            <span>&larr;</span> Back to categories
        </a>

        <h1>Local AI Chat Interface & Automated Database Reporting Extension</h1>
        
        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            A custom web platform that parses structured commands from a local AI's chat replies to query isolated databases and generate automated reports.
        </div>

        <p>I worked with an existing, locally-run AI by building a custom website around it, with its own chat area.</p>
        <p>By giving the AI a specific set of rules, I got it to write certain things in its replies in a specific format. My own code on the website could then read that format out of the AI's response and use it to do things the AI itself wasn't able to do directly, such as getting information from a database the AI had no direct access to, and using that information to generate a report with visual graphs and text.</p>

        <h2>How it worked</h2>
        <p>I gave the AI a rule that basically came down to: if the user asks for a report on, for example, the profit made in the last 2 years of the company, write the years and the information you want inside {} in this specific format:</p>
        <pre><code>{time:"2"; scale:"years"; format:"report"}</code></pre>
        <p>My code on the website would take the AI's response shown in the chat area and pull that tagged information out of it. It would then use that to get the needed information from the database, and send it to a separate AI agent that generated the report. That agent sent back the formatted information, which my code then used to generate graphs, with the rest of the report shown as text.</p>
    </div>
@endsection
