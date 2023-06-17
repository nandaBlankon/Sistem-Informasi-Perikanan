<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('dashboard'); ?>" class="brand-link elevation-4">
        <img src="<?= base_url('assets/backend/') ?>dist/img/AdminLTELogo.png" alt="<?= ($this->fungsi->user_login()->level == 1) ? "Super Admin" : (($this->fungsi->user_login()->level == 2) ? "User" : "Kapal"); ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= ($this->fungsi->user_login()->level == 1) ? "Admin" : (($this->fungsi->user_login()->level == 2) ? "User" : "Kapal"); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= site_url('dashboard.html'); ?>" class="nav-link <?php if (isset($act_dashboard)) {
                                                                                        echo $act_dashboard;
                                                                                    } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if ($this->fungsi->user_login()->level == 1) : ?>
                    <li class="nav-header">DATA MASTER</li>
                    <li class="nav-item">
                        <a href="<?= base_url('data-kapal.html'); ?>" class="nav-link <?php if (isset($act_kapal)) {
                                                                                            echo $act_kapal;
                                                                                        } ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Kapal
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('data-nelayan.html'); ?>" class="nav-link <?php if (isset($act_nelayan)) {
                                                                                            echo $act_nelayan;
                                                                                        } ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Nelayan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('data-tpi.html'); ?>" class="nav-link <?php if (isset($act_tpi)) {
                                                                                        echo $act_tpi;
                                                                                    } ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data TPI
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('data-ikan.html'); ?>" class="nav-link <?php if (isset($act_ikan)) {
                                                                                            echo $act_ikan;
                                                                                        } ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Ikan
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('data-peta.html'); ?>" class="nav-link <?php if (isset($act_peta)) {
                                                                                            echo $act_peta;
                                                                                        } ?>">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                Data Peta
                            </p>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-header">PENGATURAN</li>
                <li class="nav-item">
                    <a href="<?= base_url('profil.html'); ?>" class="nav-link <?php if (isset($act_profil)) {
                                                                                    echo $act_profil;
                                                                                } ?>">
                        <i class="nav-icon far fa-user"></i>
                        <p>
                            Akun
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('logout'); ?>" class="nav-link">
                        <i class="nav-icon far fa-folder"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>