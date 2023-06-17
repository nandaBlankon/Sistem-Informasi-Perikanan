<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('dashboard'); ?>">Suara</a></li>
                        <li class="breadcrumb-item active">Kirim Suara (404 error page)</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-warning"> 404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Halaman tidak ditemukan.</h3>

                <p>
                    Kami tidak dapat menemukan halaman yang Anda cari.
                    Sementara itu, Anda mungkin <a href="<?= site_url('dashboard'); ?>">kembali ke dashboard.</a>
                </p>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->