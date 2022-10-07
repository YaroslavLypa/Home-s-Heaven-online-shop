<?php session_start()?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home's Heaven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/CSS/style.css">
</head>
<body>
<div class="container">
    <header class="p-3 my-2 bg-dark">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-10 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-1">
                <h1><a href="/" class="nav-link px-2 text-white">Home's Heaven</a></h1>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                <input type="search" class="form-control form-control-dark text-bg-dark" placeholder="Search..."
                       aria-label="Search">
            </form>
            <div class="text-end">
                <?php if(isset($_SESSION['login'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-light me-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['login'];?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item text-white" href="/user">Profile</a></li>
                            <li><a class="dropdown-item text-white" href="#">Cart</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-warning" type="submit" form="sign-out-form">Log out</button>
                    <form name="sign-out-form" id="sign-out-form" action="/log-out" method="post"></form>
                <?php else:?>
                    <button class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#SignUpModal">Sign-up</button>
                <?php endif;?>
            </div>
        </div>
    </header>
    <main class="form-signin w-100 m-auto">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <h3 class="border-bottom pb-2 mb-0">User info</h3>
            <div class="d-flex text-muted pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#000"></rect></svg>

                <p class="pb-3 mb-0 small lh-sm border-bottom">
                    <strong class="d-block text-gray-dark">Login: <?php echo $_SESSION['login']?></strong>
                </p>
            </div>
            <div class="d-flex text-muted pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#000"></rect></svg>

                <p class="pb-3 mb-0 small lh-sm border-bottom">
                    <strong class="d-block text-gray-dark">Name: <?php echo $user['name']?></strong>
                </p>
            </div>
            <div class="d-flex text-muted pt-3">
                <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#000"></rect></svg>
                <p class="pb-3 mb-0 small lh-sm border-bottom">
                    <strong class="d-block text-gray-dark">Email: <?php echo $user['email']?></strong>
                </p>
            </div>
            <small class="d-block text-end mt-3">
                <a href="/">Return to the main page</a>
            </small>
        </div>
    </main>