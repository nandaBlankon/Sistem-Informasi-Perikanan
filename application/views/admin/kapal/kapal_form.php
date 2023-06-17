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
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('data-kapal.html'); ?>"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
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

                            <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="kapal_id" id="kapal_id" value="<?= $row->kapal_id ?>">

                                <div class="form-group row"></div>
                                <div class="form-group <?= form_error('kapal_jenis') ? 'has-error' : null ?> row">
                                    <label for="kapal_jenis" class="col-sm-2" style="text-align: right;">Jenis Kapal*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="kapal_jenis" id="kapal_jenis" class="form-control text-uppercase" value="<?= $page == 'tambah' ? set_value('kapal_jenis') : $row->kapal_jenis ?>" autofocus>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('kapal_nama') ? 'has-error' : null ?> row">
                                    <label for="kapal_nama" class="col-sm-2" style="text-align: right;">Nama Kapal*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="kapal_nama" id="kapal_nama" class="form-control text-uppercase" value="<?= $page == 'tambah' ? set_value('kapal_nama') : $row->kapal_nama ?>">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('kapasitas') ? 'has-error' : null ?> row">
                                    <label for="kapasitas" class="col-sm-2" style="text-align: right;">Kapasitas*</label>
                                    <div class="col-sm-10 row">
                                        <div class="col-md-4">
                                            <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="<?= $page == 'tambah' ? set_value('kapasitas') : $row->kapasitas ?>">
                                            <div class="text-xs text-danger">Gross Tonnage (TG)</div>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('jumlah_abk') ? 'has-error' : null ?> row">
                                    <label for="jumlah_abk" class="col-sm-2" style="text-align: right;">Jumlah ABK*</label>
                                    <div class="col-sm-10 row">
                                        <div class="col-md-4">
                                            <input type="number" name="jumlah_abk" id="jumlah_abk" class="form-control" value="<?= $page == 'tambah' ? set_value('jumlah_abk') : $row->jumlah_abk ?>">
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="<?= base_url('data-kapal.html'); ?>" class="btn btn-outline-primary">Batal</a>
                                <button type="submit" name="<?= $page ?>" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>

<script type="text/javascript">
    var halaman = document.querySelector('button[name="<?= $page; ?>"]');
    var haldibuka = halaman.name;

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url, method;

        if (haldibuka == 'tambah') {
            url = "<?= base_url('kapal-add.html') ?>";
            method = 'saved';
        } else if (haldibuka == 'edit') {
            url = "<?= base_url('kapal-update.html') ?>";
            method = 'updated';
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "json",
            beforeSend: function() {
                // hilangkan class select2-hidden-accessible
                $('.select2').removeClass('select2-hidden-accessible');
            },
            success: function(data) {

                if (data.status) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger mr-2'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire(
                        'Berhasil!',
                        'Data kapal Berhasil di' + haldibuka + '.',
                        'success'
                    ).then(() => {
                        if (haldibuka == 'tambah') {
                            location.reload();
                        } else if (haldibuka == 'edit') {
                            window.location.href = "<?= site_url('data-kapal.html'); ?>";
                        }
                    });
                } else {

                    $.each(data.errors, function(key, value) {
                        $('[name="' + key + '"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + key + '"]').next().text(value); //select span help-block class set text error string
                        if (value == "") {
                            $('[name="' + key + '"]').removeClass('is-invalid');
                            $('[name="' + key + '"]').addClass('is-valid');
                        }
                    });
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                alert('Error adding / updating data: ' + textStatus + ' ' + errorThrown);
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
            }
        });

        $('#form input, #form textarea').on('keyup', function() {
            $(this).removeClass('is-valid is-invalid');
        });
        $('#form select').on('change', function() {
            $(this).removeClass('is-valid is-invalid');
            $(this).find('option').removeClass('is-invalid');
            $(this).find('option').removeAttr('selected');
            $('.select2-selection').removeClass('is-invalid');
        });
    }
</script>