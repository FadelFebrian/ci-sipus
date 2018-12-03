<?php $this->load->view('layout/head'); ?></head>

<body id="top-section" data-spy="scroll" data-target="#topnav"  data-offset="70" >
<div class="container">
  <header><?php $this->load->view('layout/header'); ?></header>
  <!-- MAIN -->
  <div id="main" role="main">
    <?php $this->load->view('layout/title'); ?>
    <!-- Hero -->
    <div class="hero-unit">
      <p><?php echo $title ?></p>
    </div>
    <!-- ENDS hero -->
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
          <?php foreach ($suges as $s_key => $val) { ?>
          <h2># <?php echo $tipe[$s_key]; ?></h2><hr>
          <?php $no=1; foreach ($val as $key => $value) { ?>
            <h2><?php echo $no++.'. <a href="'.site_url().'/Koleksi/detail/'.$value['detail']->koleksi_code.'">'.$value['detail']->koleksi_judul.'</a>'; ?></h2>
            <p>Nilai Rekomendasi : <?php echo number_format($value['nilai'],2); ?></p>
          <?php } echo '<br>'; } ?>
        </div>
      </div>
    </section>
  </div>

  <div class="hero-unit">
      <p>Top 5</p>
    </div>
    <!-- ENDS hero -->
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
          <?php $no=1; foreach ($top as $t_key => $t_val) { ?>
            <h2><?php echo $no++.'. <a href="'.site_url().'/Koleksi/detail/'.$t_val['detail']->koleksi_code.'">'.$t_val['detail']->koleksi_judul.' ('.$tipe[$t_val['detail']->koleksi_tipe].')</a>'; ?></h2>
            <p>Ratting : <?php echo number_format($t_val['nilai'],2); ?></p>
          <?php } ?>
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