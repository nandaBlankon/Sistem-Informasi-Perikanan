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
                        <!-- 		<li class="breadcrumb-item active">Fixed Navbar Layout</li> -->
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
                            <h3 class="card-title">Informasi Akun</h3>

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
                            <form action="#" id="form" class="form-horizontal">
                                <input type="hidden" name="user_id" value="<?= $profil->user_id ?>">
                                <div class="form-group <?= form_error('email') ? 'has-error' : null ?> row">
                                    <label for="email" class="col-sm-2">Email*</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" id="email" class="form-control" value="<?= $page == 'tambah' ? set_value('email') : $profil->username ?>">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                                <div class="form-group <?= form_error('level') ? 'has-error' : null ?> row">
                                    <label for="level" class="col-sm-2">Level Hak Akses</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="level" value="Admin" class="form-control text-uppercase" readonly>
                                        <input type="hidden" name="level" value="1">
                                        <span class="invalid-feedback"></span>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                <button type="reset" class="btn btn-outline-primary">Reset</button>
                                <button type="submit" name="<?= $page ?>" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

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
    var halaman = document.querySelector('button[name="<?= $page; ?>"]');
    var haldibuka = halaman.name;

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url, method;

        if (haldibuka == 'edit') {
            url = "<?= base_url('profil-update') ?>";
            method = 'updated';
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "json",
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
                        'Profil Berhasil di' + haldibuka + '.',
                        'success'
                    ).then(() => {
                        if (haldibuka == 'edit') {
                            location.reload();
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
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 
            }
        });

        $('#form input, #form textarea').on('keyup', function() {
            $(this).removeClass('is-valid is-invalid');
        });
        $('#form select').on('change', function() {
            $(this).removeClass('is-valid is-invalid');
        });
    }
</script>