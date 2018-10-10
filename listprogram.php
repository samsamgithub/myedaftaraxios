<?php
include("libs.php");
include("connection.php");

$warnafont="style='color:blue; font-weight:bold'";

$sql = "SELECT idrec, keterangan, DATE_FORMAT(tarikh,'%d/%m/%Y') as tarikh, tempat FROM tbl_program where papar=1 ORDER BY idrec DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="row"><div class="col-md-12"><div id="tinggi"></div></div></div> <!--satu row kosong-->

<table id="example" class="display compact">
  <thead>
    <tr>
      <th>Bil</th>
      <th>Keterangan</th>
      <th>Tarikh</th>
      <th>Tempat</th>
      <th>Tindakan</th>
    </tr>
  </thead>
  <tbody>

    <?php $bil=0; while($row = mysqli_fetch_array($result)){ $bil++;?>
    <tr <?php if($row["tarikh"]==date("d/m/Y")){ echo $warnafont; } ?>>
      <td><?php echo $bil; ?></td>
      <td><?php echo $row["keterangan"]; ?></td>
      <td><?php echo $row["tarikh"]; ?></td>
      <td><?php echo $row["tempat"]; ?></td>
      <td>
        <button type="button" class="btn btn-info btn-sm pilihan" data-pergi="liveevent.php?idprog=<?php echo $row['idrec'];?>">Live</button>
        <a href="#" target="_blank"><button type="button" class="btn btn-primary btn-sm pilihan" data-pergi="monitoring.php?idprog=<?php echo $row['idrec'];?>">Laporan</button></a>
      </td>
    </tr>
    <?php }?>

  </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "paging" : false,
      "dom": '<"top"if>',
      "language": {
            "info" : "Sebanyak _TOTAL_ data dipaparkan",
            "search" : "Cari:",
            "infoEmpty": "Tiada Rekod",
            "infoFiltered": "daripada _MAX_ rekod",
            "emptyTable": "Tiada Rekod Dijumpai",
            "searchPlaceholder" : "Kata kunci...",
            "zeroRecords": "Tiada rekod untuk carian"
        }
    });

    $('.pilihan').click(function(){
      var bbb = $(this).data('pergi');
           // alert(bbb);
      $(location).attr('href',bbb);

      //      $(this).addClass('active').siblings().removeClass('active');
      // $('.utama').load(bbb);
    });
  } );
</script>
