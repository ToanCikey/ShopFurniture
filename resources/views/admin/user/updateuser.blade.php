@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/admin/user">Users</a></li>
                <li class="breadcrumb-item active">Update User</li>
            </ol>
            <div class="container mt-5">
                <h2 class="text-center">Cập Nhật Tài Khoản</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.user.manageruser.update', ['id' => $user->id]) }}" id="form-create"
                    method="POST" class="row g-4 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Email</label>
                        <input readonly type="email" class="form-control" name="email" id="validationCustom01" required
                            value="{{ $user->email }}">
                        <div class="invalid-feedback">
                            Vui lòng nhập email hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Mật khẩu</label>
                        <input value="{{ $user->password }}" type="password" minlength="6" class="form-control"
                            name="password" id="validationCustom02" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập mật khẩu 6 kí tự
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomUsername" class="form-label">Họ và Tên</label>
                        <input type="text" value="{{ $user->name }}" class="form-control" name="hoten"
                            id="validationCustomUsername" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập họ và tên.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Role</label>
                        <select class="form-select" id="validationCustom04" name="role" required>
                            <option selected disabled value="">Vui lòng chọn</option>
                            <option {{ $user->role === 'USR' ? 'selected' : '' }} value="USR">User</option>
                            <option {{ $user->role === 'ADM' ? 'selected' : '' }} value="ADM">Admin</option>
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn role hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomHinhAnh" class="form-label">Chọn ảnh</label>
                        <input type="file" class="form-control" name="image" id="validationCustomHinhAnh">
                        <div class="invalid-feedback">
                            Vui lòng chọn ảnh.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <img id="previewImage" src="{{ $user->image ? asset('assets/image/user/' . $user->image) : '#' }}"
                            alt="Preview Image"
                            style="max-width: 250px; height: auto; {{ $user->image ? '' : 'display: none;' }};" />
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Cập nhật tài khoản</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const fileInput = document.getElementById('validationCustomHinhAnh');
        const previewImage = document.getElementById('previewImage');

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                previewImage.src = '#';
                previewImage.style.display = 'none';
            }
        });
    </script>
    <script>
        const form = document.getElementById('form-create');
        const emailInput = document.getElementById('validationCustom01');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        emailInput.addEventListener('input', function() {
            validateEmail(this);
        });


        function validateEmail(input) {
            if (emailPattern.test(input.value)) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
        }

        form.addEventListener('submit', function(event) {
            form.classList.add('was-validated');
            validateEmail(emailInput);
            if (!form.checkValidity() || emailInput.classList.contains('is-invalid')) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>
@endsection
