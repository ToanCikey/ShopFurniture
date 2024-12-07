@extends('layouts.admin.dashboard')
@section('content')
    <div class="container mt-5">
        <div class="page-inner">
            <ol class="breadcrumb mb-4 bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/category">Categorys</a></li>
                <li class="breadcrumb-item active">Update Category</li>
            </ol>
            <div class="form-container bg-white p-4 shadow rounded-lg">
                <h2 class="text-center mb-4">Cập Nhật Danh Mục Sản Phẩm </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.category.managercategory.update', ['id' => $category->id]) }}"
                    id="form-create" method="POST" class="row g-4 needs-validation" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="validationCustom01"
                            placeholder="Nhập tiêu đề bài viết" required value="{{ $category->name }}">
                        <div class="invalid-feedback">
                            Vui lòng nhập tên hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomHinhAnh" class="form-label">Chọn Ảnh</label>
                        <input type="file" class="form-control" name="image" id="validationCustomHinhAnh"
                            onchange="previewFile()">
                        <div class="invalid-feedback">
                            Vui lòng chọn ảnh.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img id="previewImage"
                            src="{{ $category->image ? asset('assets/image/categoris/' . $category->image) : '#' }}"
                            alt="Preview Image"
                            style="max-width: 250px; height: auto; border: 1px solid #ccc; padding: 5px; border-radius: 5px;" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary py-2" type="submit">Cập nhật danh mục</button>
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
