<?php $this->load->view('layout/head'); ?></head>

<body id="top-section" data-spy="scroll" data-target="#topnav"  data-offset="70" >
<div class="container">
  <header><?php $this->load->view('layout/header'); ?></header>
  <!-- MAIN -->
  <div id="main" role="main">
    <?php $this->load->view('layout/title'); ?>
    
    <!-- info -->
    <section>
      <div class="row">
        <div class="span5">
        <img src="<?php echo base_url(); ?>up_file/koleksi/<?php echo $data->koleksi_sampul; ?>.png" width="460px">
        </div>
        <div class="span7">
          <div id="input-rat">
            <div id="gr">
              <button type="button" id="GiveRatting" class="btn pull-right">Berikan Nilai</button>
            </div>
          </div>
              <div class="clearfix"></div>
          
          <div class="well">
            <table class="table">
              <thead>
                <tr>
                  <th colspan="2"><h2><?php echo $data->koleksi_judul; ?></h2></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2" style="text-align: justify"><p><?php echo (isset($data->koleksi_sinopsis) && $data->koleksi_sinopsis != '')?$data->koleksi_sinopsis:'---'; ?></p></td>
                </tr>
                <tr>
                  <th width="30%">Penulis</th>
                  <td><?php echo $data->koleksi_penulis; ?></td>
                </tr>
                <tr>
                  <th>Judul</th>
                  <td><?php echo $data->koleksi_judul; ?></td>
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
                  <td style="font-size:2em;">
                    <?php 
                    for ($i=0; $i<5; $i++) { 
                      echo ($i<$data->koleksi_ratting)?'&starf;':'&star;';
                    } 
                    ?>
                  </td>
                </tr>
                <?php if ($data->koleksi_tipe == 3) { ?>
                <tr>
                  <td colspan="2">
                    <br>
                    <form action="<?php echo site_url(); ?>/dashboard/downloadkoleksi" target="_blank" method="post" >
                      <button type="submit" name="code" value="<?php echo $data->koleksi_code; ?>" class="btn pull-right">Download</button>
                    </form>
                  </td>
                </tr>
                <?php } ?>
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
  $(document).ready(function (argument) {
    $("#GiveRatting").on('click', function (argument) {
      $("#gr").hide();

        var div = document.getElementById('input-rat');
          
          var form = document.createElement('form');
          form.setAttribute('action','<?php echo site_url(); ?>/koleksi/saveratting');
          form.setAttribute('method','post');
          // form.setAttribute('style','display:none;');
            
            var input = document.createElement('input');
            input.setAttribute('type','hidden');
            input.setAttribute('name','koleksi_key');
            input.setAttribute('value','<?php echo $data->koleksi_code; ?>');
          form.appendChild(input);

            var input = document.createElement('input');
            input.setAttribute('type','hidden');
            input.setAttribute('id','ratting_val');
            input.setAttribute('name','ratting_val');
          form.appendChild(input);
        

            var star = document.createElement('div');
            star.setAttribute("id","fiveStar");
            star.style.cursor = "pointer";
            for (var i=1; i<=5; i++) {
              var st = document.createElement('span');
              st.setAttribute("style","font-size:2em;");
              st.setAttribute("onclick","F_Ratting("+i+")");
              st.innerHTML="&star;";
            star.appendChild(st);
            };
              var input = document.createElement('input');
              input.setAttribute('type','submit');
              input.setAttribute('value','Selesai');
              input.setAttribute('class','pull-right');
            star.appendChild(input);
              var input = document.createElement('input');
              input.setAttribute('type','button');
              input.setAttribute('id','reset');
              input.setAttribute('value','Batal');
              input.setAttribute("onclick","F_Reset(<?php echo $ratting; ?>)");
              input.setAttribute('class','pull-right');
            star.appendChild(input);
          form.appendChild(star);
            
          // form.appendChild(input);  
        div.appendChild(form);
        
        F_Ratting(<?php echo $ratting; ?>);
    });
  });

  function F_Reset (x) {
    F_Ratting(x);
    $("#input-rat form").empty();
    $("#gr").show();
    // var ratt = document.getElementById('input-rat');
    //   var div = document.createElement('div');
    //     var button = document.createElement('button');
    //     button.setAttribute('id','GiveRatting');
    //     button.setAttribute('type','button');
    //     button.setAttribute('class','btn pull-right');
    //     button.innerHTML="Berikan Nilai";
    //   div.appendChild(button);
        
    //     var clrfx = document.createElement('div');
    //     clrfx.setAttribute('class','clearfix');
    //   div.appendChild(clrfx);
      
    //     var br = document.createElement('br');
    //   div.appendChild(br);
    // ratt.appendChild(div);
  }

  function F_Ratting (x) {
    $("#fiveStar span:lt(5)").css("color","black").html('&star;');
    $("#fiveStar span:lt("+(x)+")").css("color","red").html('&starf;');
    $("#ratting_val").val((x));
  }

</script>
</body>
</html>