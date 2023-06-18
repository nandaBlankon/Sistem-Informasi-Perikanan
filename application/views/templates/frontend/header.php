<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= site_url('assets/frontend/'); ?>img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= site_url('assets/frontend/'); ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= site_url('assets/frontend/'); ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= site_url('assets/frontend/'); ?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= site_url('assets/frontend/'); ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= site_url('assets/frontend/'); ?>css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-ship me-2"></i>Pusat<span class="fs-5">Maritim</span></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="<?= site_url(''); ?>" class="nav-item nav-link <?php if (isset($act_home)) {
                                                                                    echo $act_home;
                                                                                } ?>">Home</a>
                        <a href="<?= site_url('kapal.html'); ?>" class="nav-item nav-link <?php if (isset($act_kapal)) {
                                                                                                echo $act_kapal;
                                                                                            } ?>">Data Kapal</a>
                        <a href="<?= site_url('nelayan.html'); ?>" class="nav-item nav-link <?php if (isset($act_nelayan)) {
                                                                                                echo $act_nelayan;
                                                                                            } ?>">Data Nelayan</a>
                        <a href="<?= site_url('tpi.html'); ?>" class="nav-item nav-link <?php if (isset($act_tpi)) {
                                                                                            echo $act_tpi;
                                                                                        } ?>">Data TPI</a>
                        <a href="<?= site_url('ikan.html'); ?>" class="nav-item nav-link <?php if (isset($act_ikan)) {
                                                                                                echo $act_ikan;
                                                                                            } ?>">Data Ikan</a>
                        <a href="<?= site_url('peta.html'); ?>" class="nav-item nav-link <?php if (isset($act_peta)) {
                                                                                                echo $act_peta;
                                                                                            } ?>">Peta</a>
                        <?php if ($this->session->userdata('user_id')) { ?>
                            <a href="<?= site_url('dashboard.html'); ?>" class="nav-item nav-link">Dashboard</a>
                        <?php } else { ?>
                            <a href="<?= site_url('masuk.html'); ?>" class="nav-item nav-link">Masuk</a>
                        <?php } ?>
                        <!-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Page</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </nav>

            <?php if ($page == 'home') { ?>
                <div class="container-xxl py-5 bg-primary hero-header mb-5">
                    <div class="container my-5 py-5 px-lg-5">
                        <div class="row g-5 py-5">
                            <div class="col-lg-6 text-center text-lg-start">
                                <h1 class="text-white mb-4 animated zoomIn">Situs Informasi</h1>
                                <p class="text-white pb-3 animated zoomIn">Data Ikan, Tempat Pelelangan Ikan (TPI), Peta, Kapal, dan Nelayan</p>
                                <a href="<?= site_url('kapal.html'); ?>" class="btn btn-light py-sm-3 px-sm-5 rounded-pill me-3 animated slideInLeft">Kapal</a>
                                <a href="<?= site_url('tpi.html'); ?>" class="btn btn-outline-light py-sm-3 px-sm-5 rounded-pill animated slideInRight">TPI</a>
                            </div>
                            <div class="col-lg-6 text-center text-lg-start">
                                <img class="img-fluid img-thumbnail" width="100%" style="box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);" src="<?= site_url('uploads/peta/' . $peta->image); ?>" alt="Peta <?= $peta->peta_nama; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container-xxl py-5 bg-primary hero-header mb-5">
                    <div class="container my-5 py-5 px-lg-5">
                        <div class="row g-5 py-5">
                            <div class="col-12 text-center">
                                <h1 class="text-white animated zoomIn"><?= $title; ?></h1>
                                <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb justify-content-center">
                                        <li class="breadcrumb-item"><a class="text-white" href="<?= site_url(''); ?>">Home</a></li>
                                        <li class="breadcrumb-item text-white active" aria-current="page"><?= $title; ?></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Navbar & Hero End -->