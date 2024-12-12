@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/admin/product">Products</a></li>
                <li class="breadcrumb-item active">Create Product</li>
            </ol>
            <div class="container mt-5">
                <h2 class="text-center">Tạo Sản Phẩm Mới</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.product.managerproduct.store') }}" id="form-create" method="POST"
                    class="row g-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập tên hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Price</label>
                        <input type="number" class="form-control" step="0.01" name="price" id="validationCustom02"
                            required>
                        <div class="invalid-feedback">
                            Vui lòng nhập giá hợp lệ
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="validationCustom03" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập số lượng
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">ShortDescription</label>
                        <input type="text" class="form-control" name="shortDescription" id="validationCustom04" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập mô tả ngắn
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">DetailDescription</label>
                        <textarea class="form-control" name="detailDescription" id="validationCustom05" cols="30" rows="10" required></textarea>
                        <div class="invalid-feedback">
                            Vui lòng nhập mô tả dài
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Brand</label>
                        <input type="text" class="form-control" name="brand" id="validationCustom05" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập thương hiệu
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="category_id" class="form-label">Danh Mục</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Chọn danh mục</option>
                            @foreach ($categorys as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn danh mục.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="imageInput" class="form-label">Chọn ảnh</label>
                        <input type="file" class="form-control" name="image[]" id="imageInput" multiple required>
                        <div class="invalid-feedback">
                            Vui lòng chọn ảnh
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div id="imagePreview" style="display: flex; gap: 10px; flex-wrap: wrap;"></div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Tạo sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function(event) {
            const files = event.target.files;
            imagePreview.innerHTML = '';

            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    const img = document.createElement('img');

                    reader.onload = function(e) {
                        img.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                    imagePreview.appendChild(img);
                }
            });
        });
    </script>


    <script>
        const form = document.getElementById('form-create');
        form.addEventListener('submit', function(event) {
            form.classList.add('was-validated');
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>
    <style>
        #imagePreview img {
            max-width: 150px;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background: #f9f9f9;
        }
    </style>

@endsection