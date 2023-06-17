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
                        <li class="breadcrumb-item"><a href="<?= base_url('data-ikan.html'); ?>"><?= $title; ?></a></li>
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
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('data-ikan.html'); ?>"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
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
                                <input type="hidden" name="ikan_id" id="ikan_id" value="<?= $row->ikan_id ?>">

                                <div class="form-group row"></div>
                                <div class="form-group <?= form_error('ikan_nama') ? 'has-error' : null ?> row">
                                    <label for="ikan_nama" class="col-sm-2" style="text-align: right;">Nama Ikan*</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ikan_nama" id="ikan_nama" class="form-control text-uppercase" value="<?= $page == 'tambah' ? set_value('ikan_nama') : $row->ikan_nama ?>">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('produksi') ? 'has-error' : null ?> row">
                                    <label for="produksi" class="col-sm-2" style="text-align: right;">Produksi*</label>
                                    <div class="col-sm-10 row">
                                        <div class="col-md-4">
                                            <input type="number" name="produksi" id="produksi" class="form-control" value="<?= $page == 'tambah' ? set_value('produksi') : $row->produksi ?>">
                                            <div class="text-xs text-danger">Satuan Ton</div>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('produksi_tahun') ? 'has-error' : null ?> row">
                                    <label for="produksi_tahun" class="col-sm-2" style="text-align: right;">Tahun Produksi*</label>
                                    <div class="col-sm-6">
                                        <select name="produksi_tahun" id="produksi_tahun" class="form-control text-uppercase">
                                            <option value="">- Pilih Tahun Produksi -</option>
                                            <?php
                                            $currentYear = date('Y');
                                            $startYear = 2010;
                                            for ($year = $currentYear; $year >= $startYear; $year--) { ?>
                                                <option value="<?= $year; ?>" <?= $row->produksi_tahun == $year ? "selected" : null; ?>><?= $year; ?></option>
                                            <?php } ?>
                                            ?>
                                        </select>
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>
                                <div class="form-group <?= form_error('kabupaten') ? 'has-error' : null ?> row">
                                    <label for="kabupaten" class="col-sm-2" style="text-align: right;">Kabupaten/Kota*</label>
                                    <div class="col-sm-6">
                                        <select name="kabupaten" id="kabupaten" class="form-control text-uppercase" style="width: 100%;">
                                            <option value="">-Pilih Kabupaten/Kota-</option>
                                            <?php foreach ($kab->result() as $datakab) : ?>
                                                <?php
                                                $selected = "";
                                                if ($page == "edit" && $datakab->name == $kabselected->name) {
                                                    $selected = "selected";
                                                }
                                                ?>
                                                <option value="<?= $datakab->id; ?>" <?= $selected; ?>><?= $datakab->name; ?></option>
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
                                <a href="<?= base_url('data-ikan.html'); ?>" class="btn btn-outline-primary">Batal</a>
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
            url = "<?= base_url('ikan-add.html') ?>";
            method = 'saved';
        } else if (haldibuka == 'edit') {
            url = "<?= base_url('ikan-update.html') ?>";
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
                        'Data ikan Berhasil di' + haldibuka + '.',
                        'success'
                    ).then(() => {
                        if (haldibuka == 'tambah') {
                            location.reload();
                        } else if (haldibuka == 'edit') {
                            window.location.href = "<?= site_url('data-ikan.html'); ?>";
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