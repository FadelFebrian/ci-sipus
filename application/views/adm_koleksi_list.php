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
    <div class="row">
        <div class="span12">
          <table class="table">
            <tr>
              <td width="62%">
                <a href="<?php echo site_url(); ?>/AdmDashboard/tambahkoleksi" class="btn btn-default">&plus; Tambah Koleksi</a>
              </td>
              <td width="12%">
                <a href="<?php echo site_url(); ?>/AdmDashboard/koleksi" class="btn btn-default">Tampilkan Semua</a>
              </td>
              <td width="25%">
                <form action="<?php echo site_url(); ?>/AdmDashboard/koleksi" method="post">
                  <input type="text" name="cari" placeholder="Cari Judul" value="<?php echo $cari; ?>">
                  <input type="submit" value="Cari">
                </form>
              </td>
            </tr>
          </table>
        </div>
      </div>
    <!-- Hero -->
    <div class="hero-unit">
      <p><?php echo $title; ?></p>
    </div>
    <!-- ENDS hero -->
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
          <table class="table">
            <thead>
              <tr>
                <th>Judul</th>
                <th>&nbsp;</th>
              </tr>
            </thead>

            <tbody id="table_list">
            <?php $n=1; foreach ($data as $field => $record) { ?>
              <tr>
                <td>
                  <a id="detail" href="<?php echo site_url(); ?>/AdmDashboard/detailkoleksi/<?php echo $record->koleksi_code; ?>"><?php echo $record->koleksi_judul; ?></a>
                </td>
                <td>
                  <?php for ($i=0; $i<5; $i++) { 
                    echo ($i<$record->koleksi_ratting) ? '&starf;' : '&star;';
                  } ?>
                </td>
                <td>
                </td>
            </form>
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
<script src="<?php echo base_url(); ?>build-assets/js/editorstaff.js"></script>
<!-- end scripts -->
</body>
</html>