<?php
session_start();
$mysql = new mysqli('localhost', 'root', '', 'code_it');
$goods = mysqli_query($mysql, "SELECT * FROM `goods`");
?>
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
                            <li><button class="dropdown-item text-white" id="cart-open-btn" data-bs-toggle="modal" data-bs-target="#cart-modal">
                                    Cart<ion-icon name="cart-outline"></button></li>
                        </ul>
                    </div>
                    <button class="btn btn-warning" type="submit" form="sign-out-form">Log out</button>
                    <form name="sign-out-form" id="sign-out-form" action="/log-out" method="post"></form>
                <?php else:?>
                    <button class="btn btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#SignUpModal">Sign-up</button>
                <?php endif;?>
            </div>

            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-header p-5 pb-4 border-bottom-0">
                            <h2 class="fw-bold mb-0" id="loginModalLabel">Login</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-5">
                            <form  method="post" class="col-4">
                                <div class="mb-3 col">
                                    <label for="login-log" class="form-label">Login or Email</label>
                                    <input type="text" class="form-control" name="login" id="login-log"
                                           placeholder="Enter your login or email" required
                                           value="<?= $_POST['login'] ?? '' ?>">
                                    <div class="error" id="login-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="password-log" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password-log"
                                           placeholder="Enter your password" required>
                                    <div class="error" id="password-error"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="w-10 btn btn-success" type="submit" id="login-submit">Sign in</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="SignUpModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header p-5 pb-4 border-bottom-0">
                            <h2 class="fw-bold mb-0" id="SignUpModalLabel">Registration form</h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form" method="post" class="col-4">
                                <div class="mb-3 col">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Enter email" required value="<?=$_POST['email'] ?? ''?>">
                                    <div class="error" id="email-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="login" class="form-label">Login</label>
                                    <input type="text" class="form-control" name="login" id="login"
                                           placeholder="Enter login" required value="<?=$_POST['login'] ?? ''?>">
                                    <div class="error" id="register-login-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="name" class="form-label">Real Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter real name" required value="<?=$_POST['name'] ?? ''?>">
                                    <div class="error" id="name-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Enter password" required>
                                    <div class="error" id="register-password-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="birthdate" class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" name="birthdate" id="birthdate"
                                           required value="<?=$_POST['birthdate'] ?? ''?>">
                                    <div class="error" id="birthdate-error"></div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" aria-label="country" name="country" id="country" required>
                                        <option <?=isset($_POST['country']) ? '' : 'selected'?> disabled value="">
                                            Select your country</option>
                                        <option
                                            <?php
                                            require_once 'src/Database.php';
                                            $_POST["segment"] = "country_name";
                                            switch ($_POST["segment"]) {
                                                case "country_name":
                                                    $stmt = $pdo->prepare("SELECT * FROM `countries`");
                                                    $stmt ->execute();
                                                    while ($row=$stmt->fetch()){
                                                        printf ("<option value='%s' %s>%s</option>",
                                                            $row["country_name"], isset($_POST['country']) && $_POST['country'] === $row['country_name'] ? 'selected' : '',$row["country_name"]);
                                                    }
                                            }
                                            ?>>
                                        </option>
                                    </select>
                                    <div class="error" id="country-error"></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="w-10 btn btn-success" type="submit" id="signup-submit">Sign up</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="CartModalLabel" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class=" cart modal-body">
                            <table class="table show-cart">
                            </table>
                        </div>
                        <div class="modal-footer">
                            <p>
                                <span class="h5">Total Price:</span>
                                <span class="total-price">0</span>
                                <span class="dolar">$</span>
                            </p>
                            <button type="submit" class="send-order btn btn-primary">Оформить заказ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                <?php while ($products = mysqli_fetch_assoc($goods)){
                    echo '<div class="col">
                    <div class="card h-100">
                        <img src="'.$products["img"].'" class="card-img-top" alt="">
                        <div class="card-body">
                            <h4 class="card-title">'.$products["title"].'</h4>
                            <p class="card-text">Цвет: '.$products["color"].'<br>
                            Ширина: '.$products["width"].'<br>
                           Длина '.$products["height"].'
                            </p>
                        </div>
                       
                        <div class="card-footer">
                            <ul class="rating">
                                <li><ion-icon name="star"></ion-icon></li>
                                <li><ion-icon name="star"></ion-icon></li>
                                <li><ion-icon name="star"></ion-icon></li>
                                <li><ion-icon name="star"></ion-icon></li>
                                <li><ion-icon name="star-half"></ion-icon></li>
                            </ul>
                            <div class="info-price">
                                <span class="price">'.$products["price"].'$</span>
                                <div class="items">
                                    <div class="items__control" data-action="minus">-</div>
                                    <div class="items__current" data-counter>1</div>
                                    <div class="items__control" data-action="plus">+</div>
                                </div>
                                <button class="add-to-cart" data-img="'.$products["img"].'" data-title="'.$products["title"].'" data-price="'.$products["price"].'" data-id="'.$products["id"].'"><ion-icon name="cart-outline"></ion-icon></button>
                            </div>
                        </div>
                    </div>
                </div>';
                }?>
            </div>
        </div>
    </main>
    <footer class="py-3 my-4 border-top bg-dark">
        <ul class="nav justify-content-center  pb-3 mb-3">
            <li class="nav-item px-2 text-white">Телефон: 0636801870</li>
            <li class="nav-item px-2 text-white">Email: lypa.yaroslav@gmail.com</li>
        </ul>
        <p class="text-center text-white">© 2022 Home's Heaven, Inc</p>
    </footer>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
        integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"
        integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK"
        crossorigin="anonymous"></script>
<script src = "http://code.jquery.com/jquery-latest.js"></script>
<script src="/assets/JS/root.js"></script>
<script src="/assets/JS/script.js"></script>
<script src="/assets/JS/counter.js"></script>
<script src="/assets/JS/calc.js"></script>
</body>
</html>
