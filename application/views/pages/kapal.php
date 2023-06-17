<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="position-relative d-inline text-primary ps-4"><?= $title; ?></h6>
            <h2 class="mt-2"><?= $title; ?> yang tercatat pada kami</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($kapal->result() as $data) : ?>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="service-item d-flex flex-column justify-content-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="fa fa-ship fa-2x"></i>
                        </div>
                        <h5 class="mb-3 text-capitalize text-center">Kapal <?= $data->kapal_nama; ?></h5>
                        <p>
                        <table class="table table-bordered" onmouseover="this.style.color='white';" onmouseout="this.style.color='gray';">
                            <tr>
                                <td>Jenis Kapal</td>
                                <td class="text-capitalize"><?= $data->kapal_jenis; ?></td>
                            </tr>
                            <tr>
                                <td>Kapasitas</td>
                                <td><?= $data->kapasitas; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah ABK</td>
                                <td><?= $data->jumlah_abk; ?></td>
                            </tr>
                        </table>
                        </p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- Service End -->