<?php $this->load->view('layout/head'); ?></head>

<body id="top-section" data-spy="scroll" data-target="#topnav"  data-offset="70" >
<div class="container">
  <header><?php $this->load->view('layout/adm_header'); ?></header>
  <!-- MAIN -->
  <div id="main" role="main">
    <?php $this->load->view('layout/title'); ?>

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
    
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
          <form class="well" enctype="multipart/form-data" action="<?php echo site_url(); ?>/AdmDashboard/addkoleksi" method="post">
            <div class="span5">
              <label>Tipe</label>
              <select class="input-xlarge" id="koleksi_tipe" name="koleksi_tipe">
              <?php 
              foreach ($tipe as $key => $value) {
                $_s = ($data['koleksi_tipe'] == $key) ? 'selected' : '';
                echo "<option value='".$key."' ".$_s.">".$value."</option>";
              } 
              ?>
              </select>
              <hr>

              <label>Gambar Sampul</label>
              <input class="input-xlarge" type="file" id="koleksi_gambar" name="koleksi_gambar" value="<?php echo $data['koleksi_judul']; ?>">
              <hr>

              <label>Berkas</label>
              <input disabled class="input-xlarge" type="file" id="koleksi_file" name="koleksi_file" value="<?php echo $data['koleksi_judul']; ?>">
            </div>
            <!-- <div class="span2"></div> -->
            <div class="span6">
              <label>Judul</label>
              <input class="input-xxlarge" type="text" name="koleksi_judul" value="<?php echo $data['koleksi_judul']; ?>">

              <label>Penulis</label>
              <input class="input-xxlarge" type="text" name="koleksi_penulis" value="<?php echo $data['koleksi_penulis']; ?>">
              
              <label>Penerbit</label>
              <input class="input-xxlarge" type="text" name="koleksi_penerbit" value="<?php echo $data['koleksi_penerbit']; ?>">
              
              <label>Tahun</label>
              <input class="input-xxlarge" type="text" name="koleksi_tahun" value="<?php echo $data['koleksi_tahun']; ?>">
              
              <label>Sinopsis</label>
              <textarea class="input-xxlarge" name="koleksi_sinopsis"><?php echo $data['koleksi_sinopsis']; ?></textarea>
              
              <label>Lokasi</label>
              <input class="input-xxlarge" type="text" name="koleksi_lokasi" value="<?php echo $data['koleksi_lokasi']; ?>">
            </div>
            <div class="clearfix"></div>
            <hr>
            <div>
              <input class="pull-right" type="submit" value="Simpan">
            </div>
            <div class="clearfix"></div>
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
<script>
  $(document).ready(function () {
    $("#koleksi_tipe").on('change', function () {
      if ($(this).val() == 3) {
        $("#koleksi_file").attr("disabled",false);
      } else {
        $("#koleksi_file").attr("disabled",true);
      }
    })
  })
</script>
</body>
</html>