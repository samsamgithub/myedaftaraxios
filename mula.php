<?php
  session_start();
  include("libs.php");
  include("connection.php");

  if(isset($_SESSION["isadmin"]) && $_SESSION["isadmin"] == "yes"){
    $boleh = 1;
    $onlineUser = $_SESSION["siapa"];
  }else{
    $boleh = 0;
    $onlineUser = "Guest";
  }

  if(isset($_SESSION["pergike"]) && $_SESSION["pergike"] != NULL){
    $pergike = $_SESSION["pergike"];
  }else{
    $pergike = "listprogram.php";
  }

?>

<style>
  .kepala{
    background-image:url("img/header2.jpg");
    height: 100px;
  }
  .tulisan{
    background-image:url("img/wording1.png");
    background-repeat: no-repeat;
    height: 100px;
    margin: auto;
    width: 90%;
    margin-top: 1%;
    /*padding: 10px;*/
  }
  .kaki{
    background-color:white;
    height: 200px;
  }
  #tinggi{
    height: 30px;
  }
</style>

<!DOCTYPE html>
<html>
<head>
 <title>My Edaftar</title>
</head>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 kepala">
      <input type="text" id="pergike" value="<?php echo $pergike; ?>">
      <div class="tulisan"> </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
    </div>
    <div class="col-md-6 text-right">
      <label>Selamat Datang <strong> <?php echo $onlineUser; ?> </strong></label>
      <a id="loginfocus" href="#" data-toggle="modal" data-target="<?php if($boleh!=1){ echo '#loginModal'; } else{ echo '#logoutModal'; } ?>"><?php if($boleh!=1){ echo "[Login]"; }else{ echo "[Logout]"; }?></a>
    </div>
</div>

  <div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->
  <div class="row">
    <div class="col-md-12">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-2">
            <div class="list-group">
              <a href="#" data-halaman="listprogram.php" id="memula" class="cuba list-group-item list-group-item-action">Senarai Program</a>
              <?php if($boleh == 1){ ?><a href="#" id="dua" data-halaman="setupprogram.php" class="cuba list-group-item list-group-item-action">Setup Program</a> <?php }?>
            </div>
          </div>
          <div class="col-md-10">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="utama"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->
  <div class="row">
    <div class="col-md-12 kaki">

    </div>
  </div>
</div>



<!-- Modal login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Log Masuk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loginForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Id Pengguna</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="idpengguna" id="idpengguna" placeholder="Sila Masukkan Id Pengguna" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Kata Laluan</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="katalaluan" id="katalaluan" placeholder="Sila Masukkan Katalaluan" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Log Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal login -->







<!-- Modal logout -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Log Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="loginForm" method="post" class="form-horizontal">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-12 col-form-label">Anda Ingin Log Keluar?</label>
          </div>
          <div class="form-group row">
            <div class="col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
              <button type="button" id="keluar" class="btn btn-primary">Ya</button>
              <!-- <input type="text" name="idProg" value="<?php echo $idprog; ?>">
              <input type="text" name="jenisAction" value="createPeserta"> -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal logout -->

</html>


<script>
  $(document).ready(function() {

    var pergike = $('#pergike').val();
    if(pergike == 'listprogram.php'){
      $('.cuba#memula').addClass('active');
    }else{
      $('.cuba#memula').removeClass('active');
      $('.cuba#dua').addClass('active');
    }
    
    $('.utama').load(pergike);
    

    $('.cuba').click(function(){
      var aaa = $(this).data('halaman');
  //    alert(aaa);
      $(this).addClass('active').siblings().removeClass('active');
      $('.utama').load(aaa);
    });

    $('#keluar').click(function(){
      // alert('masuk');
      $(location).attr('href','hapussession.php');
    });

    $('#loginForm').submit(function(e){
      e.preventDefault(); //form will not submitted
           // alert('masuk');
      var data = $(this).serializeArray();
      //      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        // beforeSend: function() { $('#tunggu').show(); },
        // complete: function() { $('#tunggu').hide(); },
        type: "POST",
        url: "loginprocess.php",
        data: data,
        // dataType: "text",
        // async: false,
        success: function(data) {
          // var obj = jQuery.parseJSON(data);
          // alert(data[0]);
          // $('#tunggu').hide();
          // alert(data);
          if(data=='yes'){
            $(location).attr('href','mula.php');
          }else{
            alert('Kesilapan Pada Id Pengguna atau Kata Laluan');
          }
          // alert(data);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });

  });
</script>
