<div id="footer-bar" class="footer-bar footer-bar-detached">
		<a href="index-pages.html"><i class="bi bi-heart-fill font-15"></i><span>Pages</span></a>
        <a href="index-components.html"><i class="bi bi-star-fill font-17"></i><span>Features</span></a>
        <a class="<?php echo $this->session->userdata('menu-footer') == "homee" ? "active-nav" : "" ?>" href="<?= base_url('home/filter/homee') ?>"><i class="bi bi-house-fill font-16"></i><span>Home</span></a>
        <a href="index-media.html"><i class="bi bi-image font-16"></i><span>Media</span></a>
        <a class="<?php echo $this->session->userdata('menu-footer') == "profile" ? "active-nav" : "" ?>" href="<?= base_url('home/filter/profile') ?>"><i class="bi bi-people font-16"></i><span>Profile</span></a>
        <!-- <a href="#" data-bs-toggle="offcanvas" data-bs-target="#menu-main"><i class="bi bi-list"></i><span>Menu</span></a> -->
    </div>