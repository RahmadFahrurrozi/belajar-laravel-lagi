<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Add in head section -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .alert {
            width: 300px;
            padding: 15px;
            border-radius: 5px;
            color: white;
            position: fixed;
            top: 0px;
            right: 0px;
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            z-index: 1000;
        }

        /* Warna untuk notifikasi sukses */
        .alert-success {
            background-color: #28a745;
            /* Hijau */
        }

        /* Animasi muncul (fade-in dan slide-in) */
        .alert.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* Animasi menghilang (fade-out dan slide-out) */
        .alert.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        /* Efek hover (opsional) */
        .alert:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
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
                <a href="{{ route('add_blog') }}" class="col-md-4 text-end align-self-center">
                    <button class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-circle"></i> New Post
                    </button>
                </a>

                @if (session('success'))
                    <div id="alert-success" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

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
                    No posts found. <a href="{{ route('add_blog') }}" class="alert-link">Create a new post</a> now!
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
                                        <th scope="col">Image</th>
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
                                                <img src="{{ $blog->image }}" class="img-fluid" width="150"
                                                    alt="Post image">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('show_blog', ['id' => $blog->id]) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="bi bi-eye"></i> View </a>
                                                    <a href="{{ route('edit_blog', ['id' => $blog->id]) }}"
                                                        class="btn btn-outline-primary btn-sm">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form action="{{ route('delete_blog', ['id' => $blog->id]) }}"
                                                        method="POST" class="d-inline delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm delete-btn">
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

    <footer class="bg-white shadow py-4 mt-5">
        <p class="text-center text-muted mb-0">© {{ date('Y') }} Data Blog by <span
                class="text-primary fw-semibold">ROZI</span>. All rights
            reserved.</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertElement = document.getElementById("alert-success");

            if (alertElement) {
                // Tampilkan notifikasi dengan animasi
                setTimeout(function() {
                    alertElement.classList.add("show");
                }, 100); // Delay kecil untuk memastikan animasi berjalan

                // Sembunyikan notifikasi setelah 5 detik
                setTimeout(function() {
                    alertElement.classList.remove("show");
                    alertElement.classList.add("hide");

                    // Hapus elemen dari DOM setelah animasi selesai
                    setTimeout(function() {
                        alertElement.remove();
                    }, 500); // Sesuaikan dengan durasi animasi fade-out
                }, 5000); // 5 detik
            }
        });
    </script>
    <!-- Alert Animation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertElement = document.getElementById("alert-success");

            if (alertElement) {
                setTimeout(function() {
                    alertElement.classList.add("show");
                }, 100);

                setTimeout(function() {
                    alertElement.classList.remove("show");
                    alertElement.classList.add("hide");

                    setTimeout(function() {
                        alertElement.remove();
                    }, 500);
                }, 5000);
            }
        });
    </script>

    <!-- Delete Confirmation Script -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "you want to delete this post?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#404040',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
    {{-- <script src="{{ asset('js/blog-animation-alert.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

</body>

</html>
