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
      <!-- <div  class="page-header">
        <h1>Information <small>Learn everything about me</small></h1>
      </div> -->
      <div class="row">
        <div class="span6 well">
          <button id="s-sederhana" type="button" class="btn btn-defaultx">Sederhana</button>
          <button id="s-spesifik" type="button" class="btn btn-default">Spesifik</button>
          <!-- <button id="s-bantuan" type="button" class="btn btn-default">Bantuan</button> -->
          <hr>
          <form id="SKoleksiForm" action="<?php echo site_url(); ?>/koleksi/home/<?php echo $tp; ?>" method="post">
          </form>
        </div>
        <div class="span5">
          <table class="table">
            <thead>
              <tr>
                <th>Hasil Pencarian <?php echo $title ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $key => $result_kolesi) { ?>
              <tr>
                <td><a href="<?php echo site_url().'/koleksi/detail/'.$result_kolesi->koleksi_code; ?>"><?php echo $result_kolesi->koleksi_judul; ?></a></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
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
<script src="<?php echo base_url(); ?>build-assets/js/pencarian.js"></script>
<!-- end scripts -->
</body>
<script>
  var tipe = <?php echo $tipe; ?>;
  var mode = <?php echo $mode; ?>;
  var per_input = <?php echo json_encode($per_input); ?>;
</script>
</html>