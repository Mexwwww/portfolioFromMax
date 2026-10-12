
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

    /* Mobile layout */
    @media (max-width: 600px) {
        .about-me {
            width: auto;
            max-width: 100%;
            margin: 1.5rem auto;
            padding: 0 1rem;
            box-sizing: border-box;
        }

        .about-me h1 {
            font-size: 1.8rem;
            margin-bottom: 1.25rem;
        }

        .about-me img.profile {
            float: none;
            display: block;
            width:  min(65%, 225px);
            height: auto;
            aspect-ratio: 9 / 13;
            margin: 0 auto 1.5rem;
        }

        .about-me p {
            font-size: 1rem;
            line-height: 1.65;
            margin: 0 0 1rem;
        }

        .about-me a.cv-download {
            display: block;
            width: fit-content;
            max-width: 100%;
            box-sizing: border-box;
            margin: 1.5rem auto 0;
            padding: 0.85rem 1.75rem;
            text-align: center;
        }
    }

    /* Extra-small phones */
    @media (max-width: 360px) {
        .about-me {
            padding: 0 0.75rem;
        }

        .about-me h1 {
            font-size: 1.6rem;
        }

        .about-me img.profile {
            width: 70%;
        }
    }
</style>
