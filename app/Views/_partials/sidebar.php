<aside class="main-sidebar sidebar-dark-primary elevation-4 custom-background">
    <a href="<?php echo base_url('/'); ?>" class="brand-link">
        <img src="<?php echo base_url('adminlte/dist'); ?>/img/150x150.png" alt="SD Khadijah Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8;background: white;">
      <span class="brand-text font-weight-light">METAPOLIJE</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (session('level') === 'admin') {?>
                <li class="nav-item">
                    <a href="<?php echo base_url('home'); ?>" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cog nav-icon"></i>
                        <p>Master Data<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('kategori');?>" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('kecamatan');?>" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>Kecamatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('kelurahan');?>" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>Kelurahan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('obyek');?>" class="nav-link">
                                <i class="fa fa-book nav-icon"></i>
                                <p>Obyek</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('auth/login');?>" class="nav-link">
                        <i class="fa fa-id-card nav-icon"></i>
                        <p>Login</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('home'); ?>" class="nav-link">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('mapsobject');?>" class="nav-link">
                        <i class="fa fa-book nav-icon"></i>
                        <p>Obyek</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('mapskategori');?>" class="nav-link">
                        <i class="fa fa-book nav-icon"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('mapskecamatan');?>" class="nav-link">
                        <i class="fa fa-book nav-icon"></i>
                        <p>Kecamatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('mapskatkec');?>" class="nav-link">
                        <i class="fa fa-book nav-icon"></i>
                        <p>Kategori per Kecamatan</p>
                    </a>
                </li>
                <li class="nav-header"></li>
                <li class="nav-item">
                </li>
            </ul>
        </nav>
    </div>
</aside>