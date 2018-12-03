<?php $this->load->view('layout/head'); ?></head>

<body id="top-section" data-spy="scroll" data-target="#topnav"  data-offset="70" >
<div class="container">
  <header><?php //$this->load->view('layout/header'); ?></header>
  <!-- MAIN -->
  <div id="main" role="main">
    <!-- info -->
    <section>
      <div class="row">
        <div class="span12">
          <div class="span2"><img src="<?php echo base_url(); ?>build-assets/img/dummies/logo.jpg" width="190px"></div>
          <div class="span4">
            <form method="post" action="<?php echo site_url(); ?>/login/CheckData">
              <label><h3>NIM / NIK</h3></label>
              <input type="text" name="account_id">
              <label><h3>Password</h3></label>
              <input type="password" name="account_pass"><br>
              <button class="btn">Masuk</button>
            </form>
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
</body>
</html>