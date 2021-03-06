<?php $this->load->view('layout/head'); ?></head>

<body id="top-section" data-spy="scroll" data-target="#topnav"  data-offset="70" >
<div class="container">
  <header><?php $this->load->view('layout/adm_header'); ?></header>
  <!-- MAIN -->

  <div id="main" role="main">
    <?php $this->load->view('layout/title'); ?>
    <!-- Hero -->
    <div class="hero-unit">
      <p><?php echo $title[0] ?></p>
    </div>
    <!-- ENDS hero -->
    <!-- info -->
    <section>
      <?php if ($this->session->error) { ?>
        <div id="error" class="alert alert-error">
          <?php foreach ($this->session->flashdata('msg') as $msg) {
            echo '<p>'.$msg.'</p>';
          } ?>
        </div>
        <?php } ?>

        <?php if ($this->session->success) { ?>
        <div id="sent-form-msg" class="alert alert-success">
          <?php foreach ($this->session->flashdata('msg') as $msg) {
            echo '<p>'.$msg.'</p>';
          } ?>
        </div>
      <?php } ?>
      <div class="row">
        <div class="span12">
        <?php if (!empty($data->staff_foto)) { ?>
        <img width="200px" src="<?php echo base_url(); ?>up_file/staff/<?php echo $data->staff_foto; ?>.jpg">
        <?php } ?>
        </div>
        <div class="span12">
        <form  enctype="multipart/form-data" action="<?php echo site_url(); ?>/AdmDashboard/updateimguser" method="post">
          <input type="file" name="staff_img">
          <button type="submit" class="btn">Simpan</button>
          <button type="submit" name="del_img" class="btn" value="1">Hapus</button>
        </form>
        </div>
      </div>
    </section>

    <!-- Hero -->
    <div class="hero-unit">
      <p><?php echo $title[1] ?></p>
    </div>
    <!-- ENDS hero -->
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
        <form action="<?php echo site_url(); ?>/AdmDashboard/updatepass" method="post">
          <label>Password Baru</label>
          <input type="password" name="pass_new">
          <label>Password Sebelumnya</label>
          <input type="password" name="pass_old">
          <br>
          <button type="submit" class="btn">Simpan</button>
        </form>
        </div>
      </div>
    </section>
  </div>
  <!-- ENDS MAIN -->
  <footer><?php $this->load->view('layout/footer'); ?></footer>
</div>
<!-- JavaScript at the bottom for fast page loading -->
<script src="<?php echo base_url(); ?>build-assets/js/jquery-1.7.1.min.js"></script>
<!-- scripts concatenated and minified via build script -->
<script src="<?php echo base_url(); ?>build-assets/js/plugins.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script src="<?php echo base_url(); ?>build-assets/js/custom.js"></script>
<!-- end scripts -->
</body>
</html>