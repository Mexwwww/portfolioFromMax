{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §Built a custom website around an existing, locally-run AI, extending what it could do through a chat interface.§--}}
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

    .project-detail pre {
        background: #111;
        border: 1px solid darkslategray;
        border-radius: 8px;
        padding: 1rem;
        overflow-x: auto;
        color: #d4d4d4;
        font-size: 0.85rem;
        line-height: 1.4;
    }
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <h1>AI Bot Extensions</h1>
        <p>I worked with an existing, locally-run AI by building a custom website around it, with its own chat area.</p>
        <p>By giving the AI a specific set of rules, I got it to write certain things in its replies in a specific format. My own code on the website could then read that format out of the AI's response and use it to do things the AI itself wasn't able to do directly, such as getting information from a database the AI had no direct access to, and using that information to generate a report with visual graphs and text.</p>

        <h2>How it worked</h2>
        <p>I gave the AI a rule that basically came down to: if the user asks for a report on, for example, the profit made in the last 2 years of the company, write the years and the information you want inside {} in this specific format:</p>
        <pre><code>{time:"2"; scale:"years"; format:"report"}</code></pre>
        <p>My code on the website would take the AI's response shown in the chat area and pull that tagged information out of it. It would then use that to get the needed information from the database, and send it to a separate AI agent that generated the report. That agent sent back the formatted information, which my code then used to generate graphs, with the rest of the report shown as text.</p>
    </div>
@endsection
