{{-- Here you can set the description that will show under the title on the select project page --}}
{{-- TAGS §1 dev§ --}}
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
</style>
@extends('layout.layout')
@section('content')
    <div class="project-detail">
        <a href="javascript:history.back()" class="back-link">
            <span>&larr;</span> Back to categories
        </a>

        <h1>Enterprise Financial Management & Automated Payment Dashboard</h1>

        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            A standalone internal accounting and billing platform integrated with Exact Online to automate multi-interval recurring subscription payments and financial tracking.
        </div>

        <p>I made a dashboard to be used internally at the company. It would automatically send payments and keep track of the status of those payments, and automatically send an email if a vacature hadn't been paid for a certain amount of days.</p>

        <h2>Finances and vacatures</h2>
        <p>The dashboard also keeps track of expenses and income and shows it all directly on the dashboard, along with an overview of the active and old vacatures.</p>

        <h2>Working with Exact</h2>
        <p>All of this was connected to Exact through their API, but all I actually got from them was the base info, like the vacatures themselves and the data needed to work with them. Everything else, filtering, sorting, and even showing profits over custom time frames, was all custom made, since Exact only allows a certain amount of API calls. We didn't want to spend those on anything beyond getting the base vacatures and the info we needed.</p>

        <h2>The hard part: automatic payments</h2>
        <p>The most time-intensive part of the dashboard was the automatic payments, because it needed a lot of safety features to make sure nothing could go wrong. This included handling refunds and what happens if a customer doesn't pay in time, but a big part of it was simply knowing which payment belonged to which.</p>
        <p>The information from Exact gave me the vacature along with the customer and the price, but if a customer had multiple automatic vacatures open at once, there was no direct link telling me which payment belonged to which earlier payment from that same customer. Knowing this mattered, because I needed to know whether the customer had paid the previous payment before the new one, so that even when a customer pays late, it's never so late that a new payment period has already opened up.</p>
        <p>To deal with this, I wrote code that connects a payment to older payments by looking at the interval between them and the price. On top of that, I had to account for the price changing, since that can happen, so it couldn't just rely on the interval alone. It also had to take into account that a new payment might not be a price change on an existing one at all, but a completely new, unrelated automatic payment. So instead of just checking which customer a payment belonged to, it also checked the number of current standard monthly, weekly or other interval payments running for that customer, the planned dates for the new payments, the price, and any potential price change, to make sure nothing could ever go wrong.</p>

        <p>I made this whole dashboard on my own, no other devs involved.</p>
    </div>
@endsection
