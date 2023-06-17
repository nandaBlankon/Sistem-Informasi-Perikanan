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
                                <a class="btn btn-primary btn-flat btn-sm" href="<?= site_url('tambah-peta.html'); ?>"><i class="fas fa-plus"></i> Tambah Data Peta</a>
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

                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Peta</th>
                                        <th>Kawasan</th>
                                        <th>Bulan/Tahun</th>
                                        <th>Peta</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($row->result() as $data) :
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $data->peta_nama; ?></td>
                                            <td><?= $data->kawasan; ?></td>
                                            <td><?= $data->bulan; ?>/<?= $data->tahun; ?></td>
                                            <td>
                                                <img src="<?= site_url('uploads/peta/' . $data->image); ?>" class="img-fluid" width="300px">
                                            </td>
                                            <td>
                                                <a href="<?= site_url('ubah-peta/' . $data->peta_id) ?>" class="btn btn-primary btn-xs btn-flat" title="Ubah"><i class="fa fa-plus"></i></a>
                                                <a href="javascript:void(0)" onclick="delete_peta('<?= $data->peta_id; ?>')" class="btn btn-danger btn-xs btn-flat" title="Hapus Foto ini"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
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

<script>
    function delete_peta(peta_id) {
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
                    url: "<?php echo site_url('hapus-peta') ?>/" + peta_id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.status) {
                            swalWithBootstrapButtons.fire(
                                'Berhasil!',
                                'Data Peta Berhasil dihapus.',
                                'success'
                            ).then(() => {
                                window.location.href = "<?= site_url('data-peta.html'); ?>";
                            });
                        } else {
                            swalWithBootstrapButtons.fire(
                                'Gagal!',
                                'Gagal menghapus data Peta.',
                                'error'
                            );
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'Error deleting data peta.',
                            'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan',
                    'Data Peta tidak jadi dihapus :)',
                    'error'
                );
            }
        });
    }
</script>