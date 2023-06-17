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
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('tambah-ikan.html'); ?>"><i class="fas fa-plus"></i> Tambah Data Ikan</a>
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

                            <table id="ikan-tabel" class="table table-bordered table-hover text-uppercase" cellspacing="0" width="100%">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ikan</th>
                                        <th>Produksi</th>
                                        <th>Tahun Produksi</th>
                                        <th>Kabupaten/Kota</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

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
    $(document).ready(function() {
        $('#ikan-tabel').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [], //Initial no order
            "fnDrawCallback": function(oSettings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            "ajax": {
                "url": "<?php echo site_url('get-ikan.html'); ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, ],
            //Add search box and search options
            "dom": '<"top"lBf>rt<"bottom"ip><"clear">',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "searching": true,
            "search": {
                "regex": true //Enable regex search
            }
        });

    });

    function delete_ikan(ikan_id) {
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
                    url: "<?php echo site_url('hapus-ikan') ?>/" + ikan_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Data Ikan Berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Gagal!',
                                'Gagal menghapus data Ikan.',
                                'error'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'Error deleting data Ikan.',
                            'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    'Data Ikan tidak jadi dihapus :)',
                    'error'
                );
            }
        });
    }
</script>