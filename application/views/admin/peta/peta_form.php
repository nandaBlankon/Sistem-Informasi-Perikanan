<!-- Content Wrapper. Contains page content -->
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
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('sub-kabupaten'); ?>"><?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $page; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('data-peta.html'); ?>"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                                <a href="<?= base_url('dashboard.html'); ?>" class="btn btn-danger btn-flat btn-sm"><i class="fas fa-times"></i> Keluar</a>
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php $this->view('messages') ?>

                            <form action="<?= site_url('proses-tambah-peta.html') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="peta_id" value="<?= $row->peta_id ?>">
                                <div class="form-group <?= form_error('peta_nama') ? 'has-error' : null ?>">
                                    <label for="id_produk">Peta Wilayah*</label>
                                    <input type="text" name="peta_nama" class="form-control col-md-6" value="<?= $page == 'tambah' ? set_value('peta_nama') : $row->peta_nama ?>">
                                    <?= form_error('peta_nama') ?>
                                </div>
                                <div class="form-group <?= form_error('kawasan') ? 'has-error' : null ?>">
                                    <label for="id_produk">Kawasan*</label>
                                    <input type="text" name="kawasan" class="form-control col-md-6" value="<?= $page == 'tambah' ? set_value('kawasan') : $row->kawasan ?>">
                                    <?= form_error('kawasan') ?>
                                </div>
                                <div class="form-group <?= form_error('image') ? 'has-error' : null ?>">
                                    <label for="image">Unggah Peta*</label>
                                    <small style="color: gray; margin-bottom: 0;">(Format yang didukung: <b style="color: #2196f3; text-decoration: none;">jpg | jpeg | png</b>)</small>
                                    <input type="file" class="form-control col-md-6" name="image" id="image" <?= $page == 'edit' ? '' : 'required' ?>>
                                    <p class="help-block text-sm" style="color: red; margin-bottom: 0;"><?= $page == 'edit' ? 'kosongkan jika tidak ingin diganti' : '' ?></p>

                                    <span class="help-block"><?= form_error('image') ?></span>
                                    <?php if ($row->image == NULL) {
                                        echo "";
                                    } else {
                                    ?>
                                        <img class="profile-user-img img-responsive img-thumbnail" style="width: 50%" src="<?= base_url('uploads/peta/' . $row->image) ?>">
                                    <?php } ?>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group <?= form_error('tahun') ? 'has-error' : null ?>">
                                            <label for="tahun" style="text-align: right;">Tahun*</label>
                                            <select name="tahun" id="tahun" class="form-control text-uppercase">
                                                <option value="">- Pilih Tahun -</option>
                                                <?php
                                                $currentYear = date('Y');
                                                $startYear = 2010;
                                                for ($year = $currentYear; $year >= $startYear; $year--) { ?>
                                                    <option value="<?= $year; ?>" <?= $row->tahun == $year ? "selected" : null; ?>><?= $year; ?></option>
                                                <?php } ?>
                                                ?>
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group <?= form_error('bulan') ? 'has-error' : null ?>">
                                            <label for="bulan" style="text-align: right;">Bulan*</label>
                                            <select name="bulan" id="bulan" class="form-control text-uppercase">
                                                <option value="">- Pilih Bulan -</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <button type="reset" class="btn btn-outline-primary">Reset</button>
                                    <button type="submit" name="<?= $page ?>" class="btn btn-primary">Unggah</button>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>