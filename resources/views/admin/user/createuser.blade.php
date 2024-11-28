@extends('layouts.admin.dashboard')
@section('content')
    <div class="container">
        <div class="page-inner">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="/admin/user">Users</a></li>
                <li class="breadcrumb-item active">Create User</li>
            </ol>
            <div class="container mt-5">
                <h2 class="text-center">Tạo Tài Khoản Mới</h2>
                <form id="form-create" class="row g-4 needs-validation" novalidate>
                    <div class="col-md-6">
                        <label for="validationCustom01" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationCustom01" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập email hợp lệ.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom02" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="validationCustom02" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập mật khẩu.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustomUsername" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="validationCustomUsername" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập họ và tên.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationCustom04" class="form-label">Tỉnh/Thành Phố</label>
                        <select class="form-select" id="validationCustom04" required>
                            <option selected disabled value="">Chọn...</option>
                            <option>Hà Nội</option>
                            <option>TP. Hồ Chí Minh</option>
                            <option>Đà Nẵng</option>
                        </select>
                        <div class="invalid-feedback">
                            Vui lòng chọn một tỉnh/thành phố hợp lệ.
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Tạo tài khoản</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            event.preventDefault();
            form.classList.add('was-validated');
            validateEmail(emailInput);

        });
    </script>
@endsection
