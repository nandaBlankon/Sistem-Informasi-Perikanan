<!-- Footer Start -->
<div class="container-fluid bg-primary text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">

    <div class="container px-lg-5">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Pusat Maritim</a>, All Right Reserved.

                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="<?= site_url(''); ?>">Home</a>
                        <a href="<?= site_url('kapal.html'); ?>">Data Kapal</a>
                        <a href="<?= site_url('nelayan.html'); ?>">Data Nelayan</a>
                        <a href="<?= site_url('tpi.html'); ?>">Data TPI</a>
                        <a href="<?= site_url('ikan.html'); ?>">Data Ikan</a>
                        <a href="<?= site_url('peta.html'); ?>">Peta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/wow/wow.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/easing/easing.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/waypoints/waypoints.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/owlcarousel/owl.carousel.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/isotope/isotope.pkgd.min.js"></script>
<script src="<?= site_url('assets/frontend/'); ?>lib/lightbox/js/lightbox.min.js"></script>
<!-- zoom foto -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<!-- Template Javascript -->
<script src="<?= site_url('assets/frontend/'); ?>js/main.js"></script>
<script>
    const preview = document.querySelector('#preview');
    // tambahkan event click untuk memperbesar gambar saat di-klik
    preview.addEventListener('click', function() {
        $.fancybox.open({
            src: preview.getAttribute('src'),
            type: 'image',
            transitionEffect: 'zoom-in-out'
        });
    });
</script>
</body>

</html>