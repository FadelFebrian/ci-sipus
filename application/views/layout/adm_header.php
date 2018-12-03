<!-- navbar -->
<div id="topnav" class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <!-- logo -->
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
        
      <!-- Collapse - Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse">

        <!-- Main nav -->
        <!-- <ul  class="nav">
          <li class="active"><a href="#top-section">Katalog</a></li>
          <li><a href="#work-section">Site Map</a></li>
          <li><a href="#info-section">FAQ</a></li>
          <li><a href="#contact-section">Contact</a></li>
        </ul> -->
        <!-- ENDS main nav -->

        <!-- social -->
        <ul class="nav pull-right ">
          <li class="divider-vertical"></li>
          <li><a href="<?php echo site_url(); ?>/dashboard">Home</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> Tentang Kami <b class="caret"></b> </a>
            <ul class="dropdown-menu tentang-kami">
              <li><a href="<?php echo site_url(); ?>/AdmDashboard/profile">Profil</a></li>
              <?php if ($this->session->su) { ?>
              <li><a href="<?php echo site_url(); ?>/AdmDashboard/staff">Staff</a></li>
              <?php } ?>
              <li><a href="<?php echo site_url(); ?>/AdmDashboard/anggota">Anggota</a></li>
              <li><a href="<?php echo site_url(); ?>/AdmDashboard/keanggotaan">Ketentuan Keanggotaan</a></li>
            </ul>
          </li>
          <li><a href="<?php echo site_url(); ?>/AdmDashboard/koleksi">Koleksi</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $this->session->name; ?> <b class="caret"></b> </a>
            <ul class="dropdown-menu bahasa">
              <li><a href="<?php echo site_url(); ?>/AdmDashboard/pengaturan">Pengaturan</a></li>
              <li><a href="<?php echo site_url(); ?>/login/logout">Keluar</a></li>
            </ul>
          </li>
        </ul>
        <!-- ENDS Social -->
      
      </div>
      <!-- ENDS Collapse -->
    </div>
  </div>
</div>