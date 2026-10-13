{{-- Here you can set the description that will show under the title on the select project page --}}
{{--DESCRIPTION §An internal dashboard for automatically handling payments and tracking finances, connected to Exact.§--}}
{{-- TAGS §1 dev§ --}}
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
        margin-bottom: 1rem;
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
        <h1>Enterprise Financial Management & Automated Payment Dashboard</h1>

        <!-- 1-Sentence summary explaining the whole project -->
        <div class="project-summary">
            A standalone internal accounting and billing platform integrated with Exact Online to automate multi-interval recurring subscription payments and financial tracking.
        </div>

        <p>I made a dashboard to be used internally at the company. It would automatically send payments and keep track of the status of those payments, and automatically send an email if a vacature hadn't been paid for a certain amount of days[cite: 14].</p>

        <h2>Finances and vacatures</h2>
        <p>The dashboard also keeps track of expenses and income and shows it all directly on the dashboard, along with an overview of the active and old vacatures[cite: 14].</p>

        <h2>Working with Exact</h2>
        <p>All of this was connected to Exact through their API, but all I actually got from them was the base info, like the vacatures themselves and the data needed to work with them. Everything else, filtering, sorting, and even showing profits over custom time frames, was all custom made, since Exact only allows a certain amount of API calls. We didn't want to spend those on anything beyond getting the base vacatures and the info we needed[cite: 14].</p>

        <h2>The hard part: automatic payments</h2>
        <p>The most time-intensive part of the dashboard was the automatic payments, because it needed a lot of safety features to make sure nothing could go wrong. This included handling refunds and what happens if a customer doesn't pay in time, but a big part of it was simply knowing which payment belonged to which[cite: 14].</p>
        <p>The information from Exact gave me the vacature along with the customer and the price, but if a customer had multiple automatic vacatures open at once, there was no direct link telling me which payment belonged to which earlier payment from that same customer. Knowing this mattered, because I needed to know whether the customer had paid the previous payment before the new one, so that even when a customer pays late, it's never so late that a new payment period has already opened up[cite: 14].</p>
        <p>To deal with this, I wrote code that connects a payment to older payments by looking at the interval between them and the price. On top of that, I had to account for the price changing, since that can happen, so it couldn't just rely on the interval alone. It also had to take into account that a new payment might not be a price change on an existing one at all, but a completely new, unrelated automatic payment. So instead of just checking which customer a payment belonged to, it also checked the number of current standard monthly, weekly or other interval payments running for that customer, the planned dates for the new payments, the price, and any potential price change, to make sure nothing could ever go wrong[cite: 14].</p>

        <p>I made this whole dashboard on my own, no other devs involved[cite: 14].</p>
    </div>
@endsection
