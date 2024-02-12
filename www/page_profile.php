<?php
session_start();
require_once 'backend/helpers.php';

if (isNotLoginUser())
{
    redirect('/page_login.php');
}

$user_id = $_GET['id'];
$user = getUserByID($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
</head>
    <body class="mod-bg-1 mod-nav-link">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
            <a class="navbar-brand d-flex align-items-center fw-500" href="#"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="users.php">Главная</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="page_login.php">Войти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="backend/logout.php">Выйти</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main id="js-page-content" role="main" class="page-content mt-3">
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-user'></i> <?= $user['name'] ?>
                </h1>
            </div>

            <?php if (existFlashMessage('success_update_user')): ?>
                <div class="alert alert-success">
                    <?= getFlashMessage('success_update_user') ?>
                </div>
            <?php endif; deleteFlashMessage('success_update_user'); ?>
            <?php if (existFlashMessage('success_edit_credentials')): ?>
                <div class="alert alert-success">
                    <?= getFlashMessage('success_edit_credentials') ?>
                </div>
            <?php endif; deleteFlashMessage('success_edit_credentials'); ?>
            <?php if (existFlashMessage('success_edit_status')): ?>
                <div class="alert alert-success">
                    <?= getFlashMessage('success_edit_status') ?>
                </div>
            <?php endif; deleteFlashMessage('success_edit_status'); ?>
            <?php if (existFlashMessage('success_upload_image')): ?>
                <div class="alert alert-danger">
                    <?= getFlashMessage('success_upload_image') ?>
                </div>
            <?php endif; deleteFlashMessage('success_upload_image'); ?>

            <div class="row">
                <div class="col-lg-6 col-xl-6 m-auto">
                    <!-- profile summary -->
                    <div class="card mb-g rounded-top">
                        <div class="row no-gutters row-grid">
                            <div class="col-12">
                                <div class="d-flex flex-column align-items-center justify-content-center p-4">
                                    <img src="<?php if (!empty($user['avatar'])) echo $user['avatar']; else echo 'img/demo/avatars/default_avatar.png' ?>" class="rounded-circle shadow-2 img-thumbnail" alt="" width="200">
                                    <h5 class="mb-0 fw-700 text-center mt-3">
                                        <?= $user['name'] ?>
                                        <small class="text-muted mb-0"><?= $user['position'] ?>, <?= $user['job_company'] ?></small>
                                    </h5>
                                    <div class="mt-4 text-center demo">
                                        <a href="<?= $user['instagram'] ?>" class="fs-xl" style="color:#C13584">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                        <a href="<?= $user['vk'] ?>" class="fs-xl" style="color:#4680C2">
                                            <i class="fab fa-vk"></i>
                                        </a>
                                        <a href="<?= $user['telegram'] ?>" class="fs-xl" style="color:#0088cc">
                                            <i class="fab fa-telegram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-3 text-center">
                                    <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mobile-alt text-muted mr-2"></i> <?= $user['phone'] ?></a>
                                    <a href="mailto:oliver.kopyov@marlin.ru" class="mt-1 d-block fs-sm fw-400 text-dark">
                                        <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?= $user['email'] ?></a>
                                    <address class="fs-sm fw-400 mt-4 text-muted">
                                        <i class="fas fa-map-pin mr-2"></i> <?= $user['job_address'] ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </main>
    </body>

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>

        $(document).ready(function()
        {

        });

    </script>
</html>