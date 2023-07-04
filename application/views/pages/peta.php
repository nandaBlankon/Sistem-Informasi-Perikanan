<!-- Portfolio Start -->
<div class="container-xxl py-5">
    <div class="container px-lg-5">
        <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="position-relative d-inline text-primary ps-4"><?= $title; ?></h6>
            <h2 class="mt-2"><?= $title; ?> yang tercatat pada kami</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($row->result() as $data) : ?>
                <div class="col-lg-4 col-md-6 portfolio-item first wow zoomIn" data-wow-delay="0.1s">
                    <div class="position-relative rounded overflow-hidden">
                        <img class="img-fluid w-100" src="<?= site_url('uploads/peta/' . $data->image); ?>">
                        <div class="portfolio-overlay">
                            <a class="btn btn-light" href="<?= site_url('uploads/peta/' . $data->image); ?>" data-lightbox="portfolio" title="Perbesar Peta"><i class="fa fa-plus fa-2x text-primary"></i></a>
                            <div class="mt-auto">
                                <small class="text-white"><i class="fa fa-folder me-2"></i>Peta</small>
                                <a class="h5 d-block text-white mt-1 mb-0" href=""><?= $data->peta_nama; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
<!-- Portfolio End -->