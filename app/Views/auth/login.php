<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login</title>
    <link href="<?= base_url('/template/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/template/css/examples.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Login</h1>
                                <p class="text-medium-emphasis">Sign In to your account</p>
                                <?php if (session()->has('error')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session('error') ?>
                                    </div>
                                <?php endif; ?>
                                <form method="post" action="<?= route_to('attemptLogin') ?>">
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                            </svg></span>
                                        <input class="form-control" name="email" type="" placeholder="Username">
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                            </svg></span>
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-center">
                                            <button class="btn btn-primary px-4" type="submit">Login</button>
                                        </div>
                                        <div class="col-12 divider d-flex justify-content-center my-2">
                                            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-2">
                                            <a  style="width: 250px; font-size: 18px;" class="btn btn-primary btn-lg" style="background-color: #55acee" href="<?= route_to('googleLogin') ?>" role="button">
                                                <i class="fab fa-twitter me-2"></i>Continue with google</a>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-2">
                                            <a style="width: 250px; font-size: 18px;" class="btn btn-success btn-lg" style="background-color: #55acee" href="<?= route_to('facebookLogin') ?>" role="button">
                                                <i class="fab fa-twitter me-2"></i>Continue with facebook</a>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center mt-2">
                                            <a style="width: 250px; font-size: 18px;" class="btn btn-info btn-lg" style="background-color: #55acee" href="<?= route_to('facebookLogin') ?>" role="button">
                                                <i class="fab fa-twitter me-2"></i>Continue with instagram</a>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>