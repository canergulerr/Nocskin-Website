<?php include dirname(__DIR__, 2) . '/config.php'; ?>
<!-- Sidebar -->
<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <img src="<?= BASE_URL ?>/assets/images/noc-beyaz-logo.png" alt="Noc Admin" class="brand-logo-img" onclick="window.location.href = 'index.php'">
    </div>

    <div class="list-group list-group-flush mt-3 flex-grow-1">
        <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

        <div class="sidebar-section-title">Yönetim Paneli</div>

        <a class="list-group-item list-group-item-action <?php echo $current_page == 'index.php' ? 'active-link' : ''; ?>"
            href="index.php">
            <i class="fas fa-th-large"></i> Genel Bakış
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'slider.php' || $current_page == 'slider-edit.php') ? 'active-link' : ''; ?>"
            href="slider.php">
            <i class="fas fa-images"></i> Slider Yönetimi
        </a>
         <a class="list-group-item list-group-item-action <?php echo ($current_page == 'assets.php' || $current_page == 'asset-edit.php') ? 'active-link' : ''; ?>"
            href="assets.php">
            <i class="fas fa-photo-video"></i> Anasayfa İçerik
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'team.php' || $current_page == 'team-edit.php') ? 'active-link' : ''; ?>"
            href="team.php">
            <i class="fas fa-users"></i> Ekip Yönetimi
        </a>
         <a class="list-group-item list-group-item-action <?php echo ($current_page == 'categories.php' || $current_page == 'category-edit.php') ? 'active-link' : ''; ?>"
            href="categories.php">
            <i class="fas fa-tags"></i> Kategori Yönetimi
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'products.php' || $current_page == 'product-edit.php') ? 'active-link' : ''; ?>"
            href="products.php">
            <i class="fas fa-box-open"></i> Ürün Yönetimi
        </a>
      
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'banners.php' || $current_page == 'banner-edit.php') ? 'active-link' : ''; ?>"
            href="banners.php">
            <i class="fas fa-bullhorn"></i> Bannerlar
        </a>

       
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'page-sections.php' || $current_page == 'page-section-edit.php') ? 'active-link' : ''; ?>"
            href="page-sections.php">
            <i class="fas fa-layer-group"></i> Sayfa İçerikleri
        </a>

        <!-- Blog Menu -->
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'blog-posts.php' || $current_page == 'blog-post-edit.php') ? 'active-link' : ''; ?>"
            href="#blogSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <i class="fas fa-blog"></i> Blog
        </a>
        <ul class="collapse list-unstyled ps-4 <?php echo ($current_page == 'blog-posts.php' || $current_page == 'blog-post-edit.php') ? 'show' : ''; ?>"
            id="blogSubmenu">
            <li>
                <a href="blog-posts.php"
                    class="text-decoration-none text-secondary <?php echo ($current_page == 'blog-posts.php') ? 'fw-bold' : ''; ?>">
                    <i class="fas fa-list tiny-icon"></i> Tüm Yazılar
                </a>
            </li>
            <li>
                <a href="blog-post-edit.php?slug=rejim-rehberi"
                    class="text-decoration-none text-secondary <?php echo ($current_page == 'blog-post-edit.php' && isset($_GET['slug']) && $_GET['slug'] == 'rejim-rehberi') ? 'fw-bold' : ''; ?>">
                    <i class="fas fa-edit tiny-icon"></i> Rejim Rehberi
                </a>
            </li>
            <li>
                <a href="blog-post-edit.php?slug=malzeme-sozlugu"
                    class="text-decoration-none text-secondary <?php echo ($current_page == 'blog-post-edit.php' && isset($_GET['slug']) && $_GET['slug'] == 'malzeme-sozlugu') ? 'fw-bold' : ''; ?>">
                    <i class="fas fa-book-open tiny-icon"></i> Malzeme Sözlüğü
                </a>
            </li>
            <li>
                <a href="blog-post-edit.php?slug=katmanlama-kilavuzu"
                    class="text-decoration-none text-secondary <?php echo ($current_page == 'blog-post-edit.php' && isset($_GET['slug']) && $_GET['slug'] == 'katmanlama-kilavuzu') ? 'fw-bold' : ''; ?>">
                    <i class="fas fa-layer-group tiny-icon"></i> Katmanlama Kılavuzu
                </a>
            </li>
        </ul>
       <a class="list-group-item list-group-item-action <?php echo ($current_page == 'contact-categories.php' || $current_page == 'contact-category-edit.php' || $current_page == 'contact-links.php' || $current_page == 'contact-link-edit.php' || $current_page == 'contact-settings.php' || $current_page == 'contact-phones.php' || $current_page == 'contact-phone-edit.php') ? 'active-link' : ''; ?>"
            href="contact-categories.php">
            <i class="fas fa-envelope"></i> İletişim Sayfası
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'footer-settings.php') ? 'active-link' : ''; ?>"
            href="footer-settings.php">
            <i class="fas fa-shoe-prints"></i> Footer Ayarları
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'footer-menus.php') ? 'active-link' : ''; ?>"
            href="footer-menus.php">
            <i class="fas fa-list-alt"></i> Footer Menüleri
        </a>

     
        <div class="sidebar-section-title">Header Yönetimi</div>
  <a class="list-group-item list-group-item-action <?php echo ($current_page == 'menus.php' || $current_page == 'menu-edit.php') ? 'active-link' : ''; ?>"
            href="menus.php">
            <i class="fas fa-bars"></i> Menü Yönetimi
        </a>
           <a class="list-group-item list-group-item-action <?php echo ($current_page == 'header-brands.php' || $current_page == 'header-brand-edit.php') ? 'active-link' : ''; ?>"
            href="header-brands.php">
            <i class="fas fa-bookmark"></i> Header Markalar
        </a>
        <a class="list-group-item list-group-item-action <?php echo ($current_page == 'announcements.php' || $current_page == 'announcement-edit.php') ? 'active-link' : ''; ?>"
            href="announcements.php">
            <i class="fas fa-bullhorn"></i> Duyuru (Kayan Yazı)
        </a>
     

        <div class="sidebar-section-title">Sistem</div>

        <a class="list-group-item list-group-item-action <?php echo $current_page == 'settings.php' ? 'active-link' : ''; ?>"
            href="settings.php">
            <i class="fas fa-cog"></i> Ayarlar
        </a>
    </div>

    <!-- User Profile Footer -->
    <div class="sidebar-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div class="user-profile">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['admin_username'] ?? 'A', 0, 1)); ?>
                </div>
                <div class="user-info">
                    <h6><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></h6>
                    <small>Yönetici</small>
                </div>
            </div>
            <a href="logout.php" class="text-secondary hover-text-white" title="Çıkış Yap">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
</div>