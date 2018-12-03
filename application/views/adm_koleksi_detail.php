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
        <div class="span5">
        <img src="<?php echo base_url(); ?>up_file/koleksi/<?php echo $data->koleksi_sampul; ?>.png" width="460px">
        </div>
        <div class="span7">
          <div class="well">
            <table class="table">
              <thead id="h_info">
                <tr>
                  <th>
                    <button id="ubah" type="button" class="btn btn-default">Ubah</button>
                    <button id="ubah-file" type="button" class="btn btn-default">Ubah File</button>
                  </th>
                  <th><form action="<?php echo site_url(); ?>/AdmDashboard/hapuskoleksi" method="post"><button type="submit" class="btn btn-default pull-right" name="code" value="<?php echo $data->koleksi_code; ?>">Hapus</button></form></th>
                </tr>
                <tr>
                  <th colspan="2"><h2><?php echo $data->koleksi_judul; ?></h2></th>
                </tr>
              </thead>
              <thead id="h_form" style="display:none;">
                <tr>
                  <th colspan="2">Masukan perubaha untuk koleksi ini</th>
                </tr>
              </thead>
              <tbody id="b_info">
                <tr>
                  <td colspan="2" style="text-align: justify"><p><?php echo (isset($data->koleksi_sinopsis) && $data->koleksi_sinopsis != '')?$data->koleksi_sinopsis:'---'; ?></p></td>
                </tr>
                <tr>
                  <th width="30%">Penulis</th>
                  <td><?php echo $data->koleksi_penulis; ?></td>
                </tr>
                <tr>
                  <th>Penerbit</th>
                  <td><?php echo $data->koleksi_penerbit; ?></td>
                </tr>
                <tr>
                  <th>Tahun</th>
                  <td><?php echo $data->koleksi_tahun; ?></td>
                </tr>
                <tr>
                  <th>Lokasi</th>
                  <td><?php echo $data->koleksi_lokasi; ?></td>
                </tr>
                <tr>
                  <th>Rating</th>
                  <td><?php for ($i=0; $i<5; $i++) { 
                    echo ($i<$data->koleksi_ratting) ? '&starf;' : '&star;';
                  } ?></td>
                </tr>
              </tbody>
              <tbody id="b_form" style="display:none;">
              <form action="<?php echo site_url(); ?>/AdmDashboard/ubahkoleksi" method="post">
                <tr>
                  <th width="30%">Judul</th>
                  <td><input type="text" name="koleksi_judul" value="<?php echo $data->koleksi_judul; ?>"></td>
                </tr>
                <tr>
                  <th>Penulis</th>
                  <td><input type="text" name="koleksi_penulis" value="<?php echo $data->koleksi_penulis; ?>"></td>
                </tr>
                <tr>
                  <th>Penerbit</th>
                  <td><input type="text" name="koleksi_penerbit" value="<?php echo $data->koleksi_penerbit; ?>"></td>
                </tr>
                <tr>
                  <th>Tahun</th>
                  <td><input type="text" name="koleksi_tahun" value="<?php echo $data->koleksi_tahun; ?>"></td>
                </tr>
                <tr>
                  <th>Sinopsis</th>
                  <td><textarea name="koleksi_sinopsis"><?php echo $data->koleksi_sinopsis; ?></textarea></td>
                </tr>
                <tr>
                  <th>Lokasi</th>
                  <td><input type="text" name="koleksi_lokasi" value="<?php echo $data->koleksi_lokasi; ?>"></td>
                </tr>
                <tr>
                  <td><button type="button" class="btn btn-default batal">Batal</button></td>
                  <td><button type="submit" name="code" class="btn btn-default pull-right" value="<?php echo $data->koleksi_code; ?>">Simpan</button></td>
                </tr>
              </form>
              </tbody>
              <tbody id="f_form" style="display:none;">
              <form enctype="multipart/form-data" action="<?php echo site_url(); ?>/AdmDashboard/ubahkoleksifile" method="post">
                <tr>
                  <th>Sampul</th>
                  <td>
                    <input class="input-xlarge" type="file" name="koleksi_gambar">
                    <button type="submit" name="sub_img" class="btn btn-default pull-right" value="<?php echo $data->koleksi_code; ?>">Simpan</button>
                    <button type="submit" name="del_img" class="btn btn-default pull-right" value="<?php echo $data->koleksi_code; ?>">Hapus</button>
                  </td>
                </tr>
                <?php if ($data->koleksi_tipe == 3) { ?>
                <tr>
                  <th>Berkas</th>
                  <td>
                    <input class="input-xlarge" type="file" name="koleksi_file">
                    <button type="submit" name="sub_file" class="btn btn-default pull-right" value="<?php echo $data->koleksi_code; ?>">Simpan</button>
                    <button type="submit" name="del_file" class="btn btn-default pull-right" value="<?php echo $data->koleksi_code; ?>">Hapus</button>
                  </td>
                </tr>
                <?php } ?>
                <tr>
                  <td colspan="2"><button type="button" class="btn btn-default batal">Batal</button></td>
                </tr>
              </form>
              </tbody>
            </table>
          </div>
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
    $("#ubah").on('click', function () {
      $("#h_info").hide();
      $("#b_info").hide();
      $("#h_form").show();
      $("#b_form").show();
    })
    $("#ubah-file").on('click', function () {
      $("#h_info").hide();
      $("#b_info").hide();
      $("#h_form").show();
      $("#f_form").show();
    })
    $(".batal").on('click', function () {
      $("#h_info").show();
      $("#b_info").show();
      $("#h_form").hide();
      $("#b_form").hide();
      $("#f_form").hide();
    })
  })
</script>
</body>
</html>