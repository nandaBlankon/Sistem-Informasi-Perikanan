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
                        <li class="breadcrumb-item"><a href="<?= base_url('data-nelayan.html'); ?>"><?= $title; ?></a></li>
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
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('data-nelayan.html'); ?>"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
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
                                <input type="hidden" name="nelayan_id" id="nelayan_id" value="<?= $row->nelayan_id ?>">

                                <div class="form-group row"></div>
                                <div class="form-group <?= form_error('nik') ? 'has-error' : null ?> row">
                                    <label for="nik" class="col-sm-2" style="text-align: right;">NIK*</label>
                                    <div class="col-sm-4">
                                        <input type="number" name="nik" id="nik" class="form-control text-uppercase" min="16" max="16" value="<?= $page == 'tambah' ? set_value('nik') : $row->nik ?>" autofocus>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('nelayan_nama') ? 'has-error' : null ?> row">
                                    <label for="nelayan_nama" class="col-sm-2" style="text-align: right;">Nama Nelayan*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="nelayan_nama" id="nelayan_nama" class="form-control text-uppercase" value="<?= $page == 'tambah' ? set_value('nelayan_nama') : $row->nelayan_nama ?>">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('nelayan_alamat') ? 'has-error' : null ?> row">
                                    <label for="nelayan_alamat" class="col-sm-2" style="text-align: right;">Alamat Nelayan*</label>
                                    <div class="col-sm-6">
                                        <textarea name="nelayan_alamat" id="nelayan_alamat" class="form-control text-uppercase"><?= $page == 'tambah' ? set_value('nelayan_alamat') : $row->nelayan_alamat ?></textarea>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('kapal_id') ? 'has-error' : null ?> row">
                                    <label for="kapal_id" class="col-sm-2" style="text-align: right;">Nelayan dari Kapal*</label>
                                    <div class="col-sm-6">
                                        <select name="kapal_id" id="kapal_id" class="form-control text-uppercase" style="width: 100%;">
                                            <option value="">-Pilih Kapal-</option>
                                            <?php foreach ($kapal->result() as $dataKapal) : ?>
                                                <?php
                                                $selected = "";
                                                if ($page == "edit" && $dataKapal->kapal_nama == $kapalselected->kapal_nama) {
                                                    $selected = "selected";
                                                }
                                                ?>
                                                <option value="<?= $dataKapal->kapal_id; ?>" <?= $selected; ?>><?= $dataKapal->kapal_nama; ?></option>
                                            <?php endforeach ?>
                                        </select>

                                        <span class="invalid-feedback text-xs"></span>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <a href="<?= base_url('data-nelayan.html'); ?>" class="btn btn-outline-primary">Batal</a>
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
            url = "<?= base_url('nelayan-add.html') ?>";
            method = 'saved';
        } else if (haldibuka == 'edit') {
            url = "<?= base_url('nelayan-update.html') ?>";
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
                        'Data nelayan Berhasil di' + haldibuka + '.',
                        'success'
                    ).then(() => {
                        if (haldibuka == 'tambah') {
                            location.reload();
                        } else if (haldibuka == 'edit') {
                            window.location.href = "<?= site_url('data-nelayan.html'); ?>";
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