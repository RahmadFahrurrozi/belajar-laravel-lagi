<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href={{ route('blog') }}><i class="bi bi-journal-text"></i> Data Blog</a>
        </div>
    </nav>

    <main class="container">
        <section class="my-5">
            <div class="row mb-4">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold text-primary">Data Blog Posts</h1>
                    <p class="text-muted lead">Manage and explore your blog entries</p>
                </div>
                <div class="col-md-4 text-end align-self-center">
                    <button class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle"></i> New Post
                    </button>
                </div>
                <p class="mt-4 text-sm/relaxed fs-4">Search by title, content, or author</p>
                <form method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            aria-label="search by title or content" placeholder="Search by title or content">
                        <input type="text" class="form-control" name="author" value="{{ request('author') }}"
                            aria-label="search by author" placeholder="Search by author">
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
            </div>

            @if ($blogs->isEmpty())
                <div class="alert alert-warning" role="alert">
                    No matching posts found for <strong
                        class="fw-semibold text-danger">"{{ request('search') ?? request('author') }}"</strong>.
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Content</th>
                                        <th scope="col">Author</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td scope="row" class="text-center">
                                                {{ ($blogs->currentpage() - 1) * $blogs->perpage() + $loop->index + 1 }}
                                            </td>
                                            <td class="fw-semibold">{{ $blog->title }}</td>
                                            <td>{{ Str::limit($blog->content, 50) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://img.freepik.com/free-vector/smiling-young-man-illustration_1308-174669.jpg"
                                                        class="rounded-circle me-2 " width="32" alt="Author avatar">
                                                    <span>{{ $blog->author }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="#" class="btn btn-outline-primary btn-sm">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <i class="bi bi-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $blogs->appends(['search' => request('search'), 'author' => request('author')])->links() }}
                </div>
            @endif
        </section>
    </main>

    <footer class="bg-white py-4 mt-5 border-top">
        <div class="container">
            <p class="text-center text-muted mb-0">© {{ date('Y') }} Data Blog. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
