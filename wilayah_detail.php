<?php
	if(@$_REQUEST['ajax'] == 'true'){
		include("globals/config.php");
		include("globals/functions.php");
	}
?>
<div class="box-body table-responsive">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode Kabupaten</th>
				<th>Nama Kabupaten</th>
				<th>Nama Bupati</th>
			</tr>
		</thead>

		<tbody>
			<?php
				$no = 1;
				$query_wilayah = $db->prepare("SELECT _kabupaten.*, astext(_kabupaten.wilayah) AS text_wilayah, astext(_kabupaten.pusat_kota) AS text_pusat_kota FROM _kabupaten");
				$query_wilayah->execute();
				while($result_wilayah = $query_wilayah->fetch(PDO::FETCH_ASSOC)){
					$text_wilayah = str_replace('POLYGON', '', $result_wilayah['text_wilayah']);
					$text_wilayah = str_replace('(', '', $text_wilayah);
					$text_wilayah = str_replace(')', '', $text_wilayah);

					$wilayah = '[';
					$text_wilayah_temp1 = explode(',', $text_wilayah);
					$text_wilayah_temp1_jum = count($text_wilayah_temp1);
					$i = 1;
					foreach($text_wilayah_temp1 as $wilayah_arr){
						$wilayah_arr_temp = explode(' ', $wilayah_arr);
						$wilayah .= "{lat: ".$wilayah_arr_temp[0].", lng: ".$wilayah_arr_temp[1]."}";
						if($text_wilayah_temp1_jum != $i) $wilayah .= ",";
						$i++;
					}
					$wilayah .= ']';

					$text_pusat_kota = str_replace('POINT', '', $result_wilayah['text_pusat_kota']);
					$text_pusat_kota = str_replace('(', '', $text_pusat_kota);
					$text_pusat_kota = str_replace(')', '', $text_pusat_kota);
					$pusat_kota_temp = explode(' ', $text_pusat_kota);
					$pusat_kota = "{lat: ".$pusat_kota_temp[0].", lng: ".$pusat_kota_temp[1]."}";

					$luas_wilayah = $result_wilayah['luas_wilayah']/1000;


					echo "<tr style='cursor:pointer;' onclick=\"javascript:
						var polygon = $wilayah;
						var markers = $pusat_kota;
						var data = [];
						data['id_kabupaten'] 	= '$result_wilayah[id_kabupaten]';
						data['nama'] 			= '$result_wilayah[nama]';
						data['nama_bupati'] 	= '$result_wilayah[nama_bupati]';
						data['jumlah_penduduk'] = '$result_wilayah[jumlah_penduduk]';
						data['tanggal_berdiri'] = '$result_wilayah[tanggal_berdiri]';
						data['luas_wilayah'] 	= '".number_format($luas_wilayah,2,',','.')."';

						drawingShape(polygon, markers, data);
						window.top.document.getElementById('form-add').src='add.php?id_kabupaten=$result_wilayah[id_kabupaten]';
						window.top.document.getElementById('dismissChoode').click();
					\">";
					echo "	<td align='center'>$no.</td>";
					echo "	<td>$result_wilayah[id_kabupaten]</td>";
					echo "	<td>$result_wilayah[nama]</td>";
					echo "	<td>$result_wilayah[nama_bupati]</td>";
					echo "</tr>";

					$no++;
				}
			?>
			<tr>
				
			</tr>
		</tbody>
	</table>
</div>

<script type="text/javascript">

	function ActionDrawingAll(){
		var polygon = [];
		var markers = [];
		var data 	= [];
		var data2 	= [];
		var all_polygon_spatial = '';
		<?php
			$query_wilayah->execute();
			$j = 0;
			$all_polygon_spatial = "";
			while($result_wilayah = $query_wilayah->fetch(PDO::FETCH_ASSOC)){
				$all_polygon_spatial .= $result_wilayah['text_wilayah']."|";

				$text_wilayah = str_replace('POLYGON', '', $result_wilayah['text_wilayah']);
				$text_wilayah = str_replace('(', '', $text_wilayah);
				$text_wilayah = str_replace(')', '', $text_wilayah);

				$wilayah = '[';
				$text_wilayah_temp1 = explode(',', $text_wilayah);
				$text_wilayah_temp1_jum = count($text_wilayah_temp1);
				$i = 1;
				foreach($text_wilayah_temp1 as $wilayah_arr){
					$wilayah_arr_temp = explode(' ', $wilayah_arr);
					$wilayah .= "{lat: ".$wilayah_arr_temp[0].", lng: ".$wilayah_arr_temp[1]."}";
					if($text_wilayah_temp1_jum != $i) $wilayah .= ",";
					$i++;
				}
				$wilayah .= ']';

				$text_pusat_kota = str_replace('POINT', '', $result_wilayah['text_pusat_kota']);
				$text_pusat_kota = str_replace('(', '', $text_pusat_kota);
				$text_pusat_kota = str_replace(')', '', $text_pusat_kota);
				$pusat_kota_temp = explode(' ', $text_pusat_kota);
				$pusat_kota = "{lat: ".$pusat_kota_temp[0].", lng: ".$pusat_kota_temp[1]."}";

				echo "polygon[$j] = $wilayah;";
				echo "markers[$j] = $pusat_kota;";
				echo "data2['id_kabupaten'] 	= '$result_wilayah[id_kabupaten]';";
				echo "data2['nama'] 			= '$result_wilayah[nama]';";
				echo "data2['nama_bupati'] 		= '$result_wilayah[nama_bupati]';";
				echo "data2['jumlah_penduduk'] 	= '$result_wilayah[jumlah_penduduk]';";
				echo "data2['tanggal_berdiri'] 	= '$result_wilayah[tanggal_berdiri]';";
				echo "data[$j] = data2;";

				$j++;
			}

			echo "all_polygon_spatial = '$all_polygon_spatial';";
		?>

		drawingShapeAll(polygon, markers, data, all_polygon_spatial);
		// window.top.document.getElementById('form-add').src='add.php?id_kabupaten=$result_wilayah[id_kabupaten]';
		window.top.document.getElementById('dismissChoode').click();
		window.top.document.getElementById('load-data').style.display='none';
		window.top.document.getElementById('cancel-all').style.display='inline-block';
		window.top.document.getElementById('union-all').style.display='inline-block';
		window.top.document.getElementById('intersection-all').style.display='inline-block';
	}
</script>
<input type="hidden" onclick="ActionDrawingAll();" id="draw-all">