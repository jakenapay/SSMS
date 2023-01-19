<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSMS</title>

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/login.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="assets/css/login.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row px-3">
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                <div class="img-left d-none d-md-flex"></div>

                <div class="card-body">
                    <h4 class="title text-center mt-4">
                        S.S.M.S Login
                    </h4>
                    <form class="form-box px-3">
                        <div class="form-input">
                            <span><i class="fa fa-envelope-o"></i></span>
                            <input type="email" name="" placeholder="Email Address" tabindex="10" required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="cb1" name="" onclick="">
                                <label class="custom-control-label" for="cb1">Show password</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-block text-uppercase">
                                Login
                            </button>
                        </div>

                        <div class="text-right">
                            <a href="#" class="forget-link">
                                Forget Password?
                            </a>
                        </div>

                        <div class="text-center mb-3">
                            or login with
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <a href="#" class="btn btn-block btn-social btn-facebook">
                                    facebook
                                </a>
                            </div>

                            <div class="col-4">
                                <a href="#" class="btn btn-block btn-social btn-google">
                                    google
                                </a>
                            </div>

                            <div class="col-4">
                                <a href="#" class="btn btn-block btn-social btn-twitter">
                                    twitter
                                </a>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="text-center mb-2">
                            Don't have an account?
                            <a href="#" class="register-link">
                                Register here
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showHidePassword() {
            var x = document.getElementById("password");
            var y = document.getElementById("label-toggle");
            if (x.type === "password") {
                x.type = "text";
                y.innerHTML = "Hide Password";
            } else {
                x.type = "password";
                y.innerHTML = "Show Password";
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>