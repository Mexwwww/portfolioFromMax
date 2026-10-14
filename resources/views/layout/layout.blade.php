<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Max Geurts | Software Developer Portfolio</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Fira Code & Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-primary: #0d1117;
            --bg-secondary: #161b22;
            --border-color: #30363d;
            --text-main: #c9d1d9;
            --text-muted: #8b949e;
            --accent-blue: #58a6ff;
            --accent-green: #2ea043;
        }

        body {
            background-color: var(--bg-primary) !important;
            color: var(--text-main) !important;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding-bottom: 4rem;
        }

        /* IDE / Terminal style Navbar */
        .navbar {
            background-color: var(--bg-secondary) !important;
            border-bottom: 1px solid var(--border-color);
            padding: 0.8rem 1.5rem;
            font-family: 'Fira Code', monospace;
        }

        .navbar-brand {
            color: var(--accent-blue) !important;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .navbar-nav .nav-link {
            color: var(--text-muted) !important;
            transition: color 0.2s ease;
            padding: 0.5rem 1rem;
            border-radius: 6px;
        }

        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: var(--accent-blue) !important;
            background: rgba(56, 139, 253, 0.1);
        }

        /* Global button styling */
        .btn-darkslate {
            background-color: var(--bg-secondary);
            color: var(--accent-blue);
            border: 1px solid var(--border-color);
            font-family: 'Fira Code', monospace;
            transition: all 0.2s ease;
        }

        .btn-darkslate:hover {
            background-color: #21262d;
            border-color: var(--text-muted);
            color: var(--accent-blue);
        }

        /* Hidden layout state tracker for script compatibility */
        #selectedInLayout {
            display: none;
        }
    </style>

    @yield('style')
</head>
<body>

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">~/max-geurts/portfolio</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link" id="categories" href="/projects/unity">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="about" href="/about">About Me</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hidden element required by category/project scripts -->
    <span id="selectedInLayout">-2</span>

    <!-- Main Content Injection -->
    <main>
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Run onLoad hooks if defined in views
        window.addEventListener('DOMContentLoaded', (event) => {
            if (typeof window.onLoad === 'function') {
                window.onLoad();
            }
            @yield('onLoad')
        });

        // Strict Escape key handling for backward navigation, stripping all other key shortcuts
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                // If deep inside a project view, go back to project selection
                if (window.location.pathname.includes('/projects/')) {
                    window.location.href = '/projects/unity';
                } else if (window.location.pathname !== '/') {
                    window.history.back();
                }
            }
        });
    </script>
</body>
</html>
