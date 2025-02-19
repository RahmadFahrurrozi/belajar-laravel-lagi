<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $blog->title }} - Data Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Source+Sans+Pro:wght@400;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
        }

        h1,
        h2,
        h3,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }

        .blog-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .meta-info {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .back-link {
            text-decoration: none;
            color: #0d6efd;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #0a58ca;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
        }

        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .05);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href={{ route('blog') }}>
                <i class="bi bi-journal-text"></i> Data Blog
            </a>
        </div>
    </nav>

    <main class="container py-5" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <article class="card shadow">
                    <div class="card-body p-md-5">
                        <div class="mb-4">
                            <a href="{{ route('blog') }}" class="back-link">
                                <i class="bi bi-arrow-left-circle"></i> Back to Data Blog
                            </a>
                        </div>

                        <h1 class="display-4 mb-4">{{ $blog->title }}</h1>

                        <div class="meta-info mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-circle me-2"></i>
                                <span class="me-4">{{ $blog->author }}</span>
                                <i class="bi bi-calendar3 me-2"></i>
                                <span>{{ $blog->created_at }}</span>
                            </div>
                        </div>

                        <div class="blog-content">
                            {{ $blog->content }}
                        </div>

                        <hr class="my-5">

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="share-buttons">
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="bi bi-facebook"></i> Share
                                </button>
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="bi bi-twitter"></i> Tweet
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-linkedin"></i> Share
                                </button>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-bookmark"></i> Save
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <footer>
        <p class="text-center text-muted mb-0">© {{ date('Y') }} Data Blog by <span
                class="text-primary fw-semibold">ROZI</span>. All rights
            reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
