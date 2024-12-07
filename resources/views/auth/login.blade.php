<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .profile-image-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .cardbody-color {
            background-color: #ebf2fa;
            border-radius: 15px;
        }

        .btn-google {
            background-color: #db4a39;
            border-color: #db4a39;
        }

        .btn-google:hover {
            background-color: #c23321;
        }

        .btn-facebook {
            background-color: #3b5998;
            border-color: #3b5998;
        }

        .btn-facebook:hover {
            background-color: #2d4373;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center text-dark mt-5">Đăng Nhập</h2>
                <div class="text-center mb-5 text-dark">Website bán nội thất</div>
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5" method="POST"
                        action="{{ route('auth.login.submit') }}">
                        @csrf
                        <div class="text-center">
                            <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="150px"
                                alt="profile">
                        </div>
                        @if ($errors->has('username'))
                            <div class="alert alert-danger">{{ $errors->first('username') }}</div>
                        @endif
                        <div class="mb-3">
                            <input type="text" class="form-control" name="username" id="Username"
                                placeholder="Email">
                        </div>
                        @if ($errors->has('password'))
                            <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 w-100 mb-3">Login</button>
                        </div>
                    </form>
                    <div class="row justify-content-center mb-3 mx-5">
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-danger w-100">
                                <a href="{{ route('auth.google') }}" class="text-white text-decoration-none">
                                    <i class="fab fa-google"></i> Google
                                </a>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary w-100" style="background-color: #3b5998;">
                                <a href="{{ route('auth.facebook') }}" class="text-white text-decoration-none">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                            </button>
                        </div>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                        Not Registered?
                        <a href="{{ route('auth.register') }}" class="text-dark fw-bold">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>
