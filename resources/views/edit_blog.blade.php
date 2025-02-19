<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .form-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }

        .btn-submit {
            background: #0d6efd;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .btn-submit:hover {
            background: #0b5ed7;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog') }}"><i class="bi bi-journal-text"></i> Data Blog</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h2 class="text-center mb-4 fw-bold text-primary">Edit Post</h2>

                        <!-- Tampilkan pesan error atau sukses -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form method="POST" action="{{ route('update_blog', $blog->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <!-- Judul -->
                            <div class="mb-4">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Enter post title" value="{{ $blog->title }}">
                            </div>

                            <!-- Author -->
                            <div class="mb-4">
                                <label for="author" class="form-label">Author</label>
                                <input name="author" type="text" class="form-control" id="author"
                                    placeholder="Enter author name" value="{{ $blog->author }}">
                            </div>

                            <!-- Konten -->
                            <div class="mb-4">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" name="content" id="content" rows="5"
                                    placeholder="Write your post content here...">{{ $blog->content ?? old('content') }}</textarea>
                            </div>

                            <!-- Gambar -->
                            <div class="mb-4">
                                <label for="image" class="form-label">Upload Image</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    accept="image/*" value="{{ $blog->image }}">
                                </input>
                            </div>

                            <!-- Tombol Submit -->
                            <form action="{{ route('update_blog', ['id' => $blog->id]) }}" method="POST"
                                class="d-inline delete-form">
                                @csrf
                                <button type="button" class="btn btn-primary btn-lg btn-submit delete-btn">
                                    <i class="bi bi-edit"></i> Save Changes
                                </button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <p class="text-center text-muted mb-0">© {{ date('Y') }} Data Blog by <span
                class="text-primary fw-semibold">ROZI</span>. All rights
            reserved.</p>
    </footer>
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
                    title: 'Save Changes?',
                    text: "Are you sure you want to save the changes?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#0052cc',
                    cancelButtonColor: ' #404040',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
</body>

</html>
