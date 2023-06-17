<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="position-relative d-inline text-primary ps-4"><?= $title; ?></h6>
            <h2 class="mt-2"><?= $title; ?> yang tercatat pada kami</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($row->result() as $data) : ?>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="service-item d-flex flex-column justify-content-center text-center rounded">
                        <div class="service-icon flex-shrink-0">
                            <i class="fa fa-fish fa-2x"></i>
                        </div>
                        <h5 class="mb-3 text-capitalize"><?= $data->ikan_nama; ?></h5>
                        <p class="text-capitalize">
                            Produksi <?= $data->produksi; ?> Ton, Tahun Produksi <?= $data->produksi_tahun; ?>
                        </p>
                        <p class="text-capitalize">
                            <?= $data->name; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- Service End -->