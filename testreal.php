<?php
include("libs.php");
include("connection.php");
?>

<table align="center" border="1" cellpadding="10" cellspacing="10">
	<tr>
		<td class="editku">satu</td>
		<td class="editku">dua</td>
		<td class="editku">tiga</td>
		<td class="editku">tiga</td>
	</tr>
	<tr>
		<td class="editku">empat</td>
		<td class="editku">lima</td>
		<td class="editku">enam</td>
		<td class="editku">enam</td>
		<td class="editku">enam</td>
	</tr>
</table>

<script>
	$(document).ready(function(){
		$('.editku').click(function(){
			// var aa = $(this).data('perkara');
			var aa = $(this).text();
			// alert(aa);
			$(this).text('').append('<input type=text name=lastname class=masuk value='+aa+'>').removeClass('editku');
			// $('.masuk').click(function(e){
			// 	e.stopPropagation();
			// 	$(this).focusout(function(){
			// 		// alert('aa');
			// 	});
			// });
			// initback();
			// $(this).append('<input type=text name=lastname value='+aa+'>');
			// $('.editing').focus().
			// alert(aa);
		});
	});

	// function initback(){
	// 	$(document).ready(function(){
	// 		$('.editing').click(function(){
	// 			alert('editing');
	// 		});
	// 	});
	// }
</script>