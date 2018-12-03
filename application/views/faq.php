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
          <p style="text-align: justify">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
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