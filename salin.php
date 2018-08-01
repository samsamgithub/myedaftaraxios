<?php
include("libs.php");
include("connection.php");

$idprog=$_GET["idprog"];

$sql1 = "select * from tbl_program where idrec='$idprog'";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1);

$sql0 = "select * from tbl_program where idrec != '$idprog' and papar=1";
$result0 = mysqli_query($conn, $sql0);

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

      <form id="formsalin" method="post" class="form-horizontal">

      <div class="form-group">

        <h4 align="center">Salin Data Senarai Peserta</h4>
        <h4 align="center" style="font-weight: bold;"><?php echo $row1["keterangan"]?></h4><br />

        <label class="col-xs-3 control-label">Salin Daripada Program</label>
        <div class="col-xs-5 selectContainer">
          
          <input type="hidden" name="toprogram" id="noprog" value="<?php echo $idprog;?>">
          <select class="form-control" name="fromprogram">
            <option value="">Sila Pilih</option>
            <?php while($row0 = mysqli_fetch_array($result0)){?>
            <option value="<?php echo $row0['idrec']?>"><?php echo $row0["keterangan"]?></option>
            <?php }?>
          </select>
        </div>
      </div>

        <div class="form-group">
          <div class="col-xs-5 col-xs-offset-3">
            <button type="submit" class="btn btn-primary">Salin</button>
            <div id="tunggu">Sedang Salin<img src="img/loading1.gif" alt="Smiley face" height="42" width="42"></div>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
     $('#tunggu').hide();
    $('#formsalin').submit(function(e){
      e.preventDefault(); //form will not submitted
           // alert('masuk');
      var noprog = $('#noprog').val();
      var pergi = 'senarainama.php?idprog='+noprog;
      var sesi = 'urussession.php?pergi='+pergi;
      var data = $(this).serializeArray();
      //      data.push({proses: 'addprogram', value: 'love'}); //for additional data
      $.ajax({
        beforeSend: function() { $('#tunggu').show(); },
        complete: function() { $('#tunggu').hide(); },
        type: "POST",
        url: "salinproses.php",
        data: data,
        // dataType: "text",
        // async: false,
        // beforeSend: function() { $('#wait').show(); },
        // complete: function() { $('#wait').hide(); },
        success: function(data) {
          // var obj = jQuery.parseJSON(data);
          // alert(data[0]);
          $('#tunggu').hide();
          alert(data);
          $(location).attr('href',sesi);
          // do what ever you want with the server response
        },
        error: function() {
          alert('silap tuuu');
        }
      });
    });


  });
</script>
