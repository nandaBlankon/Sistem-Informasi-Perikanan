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
                        <li class="breadcrumb-item active"><?= $title; ?></li>
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
                                Hasil Survei Koresponden
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

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                Pertanyaan Kuesioner
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

                            <div class="row">
                                <div class="col-md-4">
                                    <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                                        <input type="hidden" name="pertanyaan_id" id="pertanyaan_id" value="<?= $row->pertanyaan_id ?>">

                                        <!-- <div class="form-group row"></div> -->
                                        <div class="form-group <?= form_error('pertanyaan_text') ? 'has-error' : null ?>">
                                            <textarea name="pertanyaan_text" id="pertanyaan_text" class="form-control" cols="0" rows="5" placeholder="Tuliskan Pertanyaan Kuesioner Disini"><?= set_value('pertanyaan_text') ?></textarea>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary btn-block">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>PERTANYAAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($data->result() as $key) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $key->pertanyaan_text; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="edit('<?php echo $key->pertanyaan_id; ?>')"><i class="fa fa-edit"></i></a>
                                                        <a href="javascript:void(0)" onclick="delete_data('<?php echo $key->pertanyaan_id; ?>')"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
<!-- /.content-wrapper -->

<script type="text/javascript">
    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url, method;
        url = "<?= base_url('pertanyaan-add.html') ?>";
        method = 'saved';

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
                        'Pertanyaan Baru Berhasil Disimpan',
                        'success'
                    ).then(() => {
                        location.reload();
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

    function edit(pertanyaan_id) {
        var save_method;
        save_method = 'update';
        $('#formedit')[0].reset(); // reset form on modals
        $('.form-control').removeClass('is-invalid'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('ubah-pertanyaan') ?>/" + pertanyaan_id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="pertanyaan_id"]').val(data.pertanyaan_id);
                $('[name="pertanyaan_text"]').val(data.pertanyaan_text);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Form edit pertanyaan kuesioner'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function update() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        url = "<?php echo site_url('pertanyaan-update.html') ?>";

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#formedit').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) {
                    $('#modal_form').modal('hide');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger mr-2'
                        },
                        buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire(
                        'Berhasil!',
                        'Pertanyaan Berhasil Diperbaharui',
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').removeClass('form-control').addClass('form-control is-invalid').parent().removeClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().addClass('text-danger').text(data.error_string[i]);
                    }
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // alert('Error adding / update data');
                console.log(errorThrown);
                alert('Error: ' + errorThrown);
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_data(pertanyaan_id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Tidak, batalkan!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('hapus-pertanyaan') ?>/" + pertanyaan_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Data Pertanyaan Berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Gagal!',
                                'Gagal menghapus data pertanyaan.',
                                'error'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'Error deleting data pertanyaan.',
                            'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    'Data pertanyaan tidak jadi dihapus :)',
                    'error'
                );
            }
        });
    }
</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form edit pertanyaan kuesioner</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="formedit">
                    <input type="hidden" value="" name="pertanyaan_id" />
                    <div class="form-group">
                        <textarea name="pertanyaan_text" id="pertanyaan_text" rows="5" class="form-control"></textarea>
                        <span class="help-block"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update()" class="btn btn-primary btn-flat">Simpan Perubahan</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Keluar</button>
            </div>
        </div>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<!-- End Bootstrap modal -->