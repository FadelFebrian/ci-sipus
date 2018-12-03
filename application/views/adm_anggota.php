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
    
    
    <!-- Hero -->
    <div class="hero-unit">
      <p><?php echo $title[0] ?></p>
    </div>
    <!-- ENDS hero -->
    <section>
      <div class="row">
        <div class="span12">
          <table class="table">
            <thead>
              <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th></th>
              </tr>
            </thead>
            <form action="<?php echo site_url(); ?>/AdmDashboard/addanggota" method="post">
            <tbody>
              <tr>
                <td>
                  <input type="text" name="anggota_code" required placeholder="NID">
                </td>
                <td>
                  <input type="text" name="anggota_nama" required placeholder="Nama">
                </td>
                <td>
                    <button id="simpan" type="submit" class="btn">Simpan</button>
                </td>
              </tr>
            </tbody>
            </form>
          </table>
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
          <table class="table">
            <thead>
              <tr>
                <th>Info :: </th>
                <th>NIK</th>
                <th>Nama</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
            </thead>

            <tbody id="table_list">
            <?php $n=1; foreach ($data as $field => $record) { ?>
              <tr id="<?php echo 'tr_'.$record->anggota_code; ?>">
            <form action="<?php echo site_url(); ?>/AdmDashboard/updateanggota" method="post">
                  <td>
                  <?php echo $n++; ?>
                </td>
                <td id="<?php echo $record->anggota_code; ?>">
                  <span><?php echo $record->anggota_code; ?></span>
                  <input disabled class="hidden" type='text' name='anggota_code' value='<?php echo $record->anggota_code; ?>'>
                </td>
                <td id="<?php echo $record->anggota_nama; ?>">
                  <span><?php echo $record->anggota_nama; ?></span>
                  <input disabled class="hidden" type='text' name='anggota_nama' value='<?php echo $record->anggota_nama; ?>'>
                </td>
                <td>
                  <button id="hapus" type="button" class="btn" onclick="edit('<?php echo $record->anggota_code; ?>');">Ubah</button>
                  <button id="ubah" type="button" class="btn hidden"  onclick="batal('<?php echo $record->anggota_code; ?>');">Batal</button>
                </td>
                <td>
                  <button id="simpan" type="submit" class="btn hidden">Simpan</button>
                  <a id="hapus" href="<?php echo site_url(); ?>/AdmDashboard/hapusanggota/<?php echo $record->anggota_code; ?>" class="btn btn-default">Hapus</a>
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
<script src="<?php echo base_url(); ?>build-assets/js/editoranggota.js"></script>
<!-- end scripts -->
</body>
</html>