<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Zoom Foto -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />


    <!-- jQuery -->
    <script src="<?= base_url('assets/backend/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/backend/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/backend/') ?>plugins/select2/js/select2.full.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/backend/') ?>dist/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url('assets/backend/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Page specific script -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- zoom foto -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <style>
        .btn-bulat {
            border-radius: 50%;
        }

        .btn-kecil {
            padding: 0.25rem 0.5rem;
            /* font-size: 0.875rem; */
            font-size: 0.675rem;
            line-height: 1.5;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav text-bold">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('logout'); ?>" class="nav-link"><i class="fa fa-angle-double-right"></i> Keluar (Logout)</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url(''); ?>" class="nav-link"><i class="fa fa-home"></i> Home</a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->