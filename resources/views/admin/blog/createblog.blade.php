@extends('layouts.admin.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="page-inner">
            <ol class="breadcrumb mb-4 bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/blog">Blogs</a></li>
                <li class="breadcrumb-item active">Create Blog</li>
            </ol>
            <div class="form-container bg-white p-4 shadow rounded-lg">
                <h2 class="text-center mb-4">Tạo Bài Viết Mới</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.blog.managerblog.store') }}" id="form-create" method="POST"
                    class="row g-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Tiêu Đề</label>
                        <input type="text" class="form-control" name="title" id="validationCustom01"
                            placeholder="Nhập tiêu đề bài viết" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập tiêu đề hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomHinhAnh" class="form-label">Chọn Ảnh</label>
                        <input type="file" class="form-control" name="image" id="validationCustomHinhAnh" required
                            onchange="previewFile()">
                        <div class="invalid-feedback">
                            Vui lòng chọn ảnh.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Mô Tả</label>
                        <textarea class="form-control" name="description" id="validationCustom02" cols="50" rows="5"
                            placeholder="Nhập mô tả bài viết" required></textarea>
                        <div class="invalid-feedback">
                            Vui lòng nhập mô tả.
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <img id="previewImage" src="#" alt="Preview Image"
                            style="max-width: 250px; height: auto; display: none; border: 1px solid #ccc; padding: 5px; border-radius: 5px;" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary py-2" type="submit">Tạo bài viết</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const form = document.getElementById('form-create');

        function previewFile() {
            const preview = document.getElementById('previewImage');
            const file = document.getElementById('validationCustomHinhAnh').files[0];
            const reader = new FileReader();

            if (file) {
                reader.readAsDataURL(file);
            }

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            };
        }
        form.addEventListener('submit', function(event) {
            form.classList.add('was-validated');
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>

@endsection
