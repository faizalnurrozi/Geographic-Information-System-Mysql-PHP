<?php
	session_start();
	include("globals/config.php");
	include("globals/functions.php");

	$proc = $_REQUEST['proc'];

	switch($proc){
		case "add":
			$id_kabupaten		= $_POST['id_kabupaten'];
			$nama				= $_POST['nama'];
			$nama_bupati		= $_POST['nama_bupati'];
			$jumlah_penduduk	= $_POST['jumlah_penduduk'];
			$tanggal_berdiri	= explode_date($_POST['tanggal_berdiri']);
			$pusat_kota_text	= $_POST['pusat_kota'];
			$wilayah_text		= $_POST['wilayah'];
			$luas_wilayah		= $_POST['luas_wilayah'];
			$jarak_wilayah		= $_POST['jarak_wilayah'];
			
			$pusat_kota_array 	= str_replace('(', '', $pusat_kota_text);
			$pusat_kota_array 	= str_replace(')', '', $pusat_kota_array);
			$pusat_kota_array 	= str_replace(' ', '', $pusat_kota_array);
			$pusat_kota_array 	= explode(',', $pusat_kota_array);
			$pusat_kota 		= "POINT(".$pusat_kota_array[0]." ".$pusat_kota_array[1].")";


			$wilayah = "POLYGON((";

			$wilayah_text 	= explode('),(', $wilayah_text);
			foreach ($wilayah_text as $wilayah_text_result) {
				$wilayah_text_result = str_replace('(', '', $wilayah_text_result);
				$wilayah_text_result = str_replace(')', '', $wilayah_text_result);
				$wilayah_text_result = str_replace(',', '', $wilayah_text_result);

				$wilayah .= $wilayah_text_result.", ";
			}

			$wilayah_text[0] = str_replace('(', '', $wilayah_text[0]);
			$wilayah_text[0] = str_replace(')', '', $wilayah_text[0]);
			$wilayah_text[0] = str_replace(',', '', $wilayah_text[0]);
			$wilayah .= $wilayah_text[0];

			$wilayah .= "))";

			$query_insert = $db->prepare("INSERT INTO _kabupaten(id_kabupaten, nama, nama_bupati, jumlah_penduduk, tanggal_berdiri, pusat_kota, wilayah, luas_wilayah, jarak_wilayah) VALUES(:id_kabupaten, :nama, :nama_bupati, :jumlah_penduduk, :tanggal_berdiri, PointFromText(:pusat_kota), GeomFromText(:wilayah), :luas_wilayah, :jarak_wilayah)");
			$query_insert->bindParam(':id_kabupaten', $id_kabupaten);
			$query_insert->bindParam(':nama', $nama);
			$query_insert->bindParam(':nama_bupati', $nama_bupati);
			$query_insert->bindParam(':jumlah_penduduk', $jumlah_penduduk);
			$query_insert->bindParam(':tanggal_berdiri', $tanggal_berdiri);
			$query_insert->bindParam(':pusat_kota', $pusat_kota);
			$query_insert->bindParam(':wilayah', $wilayah);
			$query_insert->bindParam(':luas_wilayah', $luas_wilayah);
			$query_insert->bindParam(':jarak_wilayah', $jarak_wilayah);
			$query_insert->execute();

			echo "
				<script>
					window.top.document.getElementById('delete-all-button').click();
					window.top.document.getElementById('alert-info').style.display='inline-block';
					window.top.document.getElementById('alert-text').innerHTML='Data has been recored';
					window.location.href='add.php';
				</script>
			";


			break;

		case "update":
			$id_kabupaten		= $_POST['id_kabupaten'];
			$id_kabupatenx		= $_POST['id_kabupatenx'];
			$nama				= $_POST['nama'];
			$nama_bupati		= $_POST['nama_bupati'];
			$jumlah_penduduk	= $_POST['jumlah_penduduk'];
			$tanggal_berdiri	= explode_date($_POST['tanggal_berdiri']);
			$pusat_kota_text	= $_POST['pusat_kota'];
			$wilayah_text		= $_POST['wilayah'];
			$luas_wilayah		= $_POST['luas_wilayah'];
			$jarak_wilayah		= $_POST['jarak_wilayah'];
			
			$pusat_kota_array 	= str_replace('(', '', $pusat_kota_text);
			$pusat_kota_array 	= str_replace(')', '', $pusat_kota_array);
			$pusat_kota_array 	= str_replace(' ', '', $pusat_kota_array);
			$pusat_kota_array 	= explode(',', $pusat_kota_array);
			$pusat_kota 		= "POINT(".$pusat_kota_array[0]." ".$pusat_kota_array[1].")";


			$wilayah = "POLYGON((";

			$wilayah_text 	= explode('),(', $wilayah_text);
			foreach ($wilayah_text as $wilayah_text_result) {
				$wilayah_text_result = str_replace('(', '', $wilayah_text_result);
				$wilayah_text_result = str_replace(')', '', $wilayah_text_result);
				$wilayah_text_result = str_replace(',', ' ', $wilayah_text_result);

				$wilayah .= $wilayah_text_result.", ";
			}

			$panjang_karater_wilayah = strlen($wilayah);
			$wilayah = substr($wilayah, 0, ($panjang_karater_wilayah-2));

			$wilayah .= "))";

			$query_insert = $db->prepare("UPDATE _kabupaten SET id_kabupaten = :id_kabupaten, nama = :nama, nama_bupati = :nama_bupati, jumlah_penduduk = :jumlah_penduduk, tanggal_berdiri = :tanggal_berdiri, pusat_kota = PointFromText(:pusat_kota), wilayah = GeomFromText(:wilayah), luas_wilayah = :luas_wilayah, jarak_wilayah = :jarak_wilayah WHERE id_kabupaten = :id_kabupatenx");
			$query_insert->bindParam(':id_kabupaten', $id_kabupaten);
			$query_insert->bindParam(':id_kabupatenx', $id_kabupatenx);
			$query_insert->bindParam(':nama', $nama);
			$query_insert->bindParam(':nama_bupati', $nama_bupati);
			$query_insert->bindParam(':jumlah_penduduk', $jumlah_penduduk);
			$query_insert->bindParam(':tanggal_berdiri', $tanggal_berdiri);
			$query_insert->bindParam(':pusat_kota', $pusat_kota);
			$query_insert->bindParam(':wilayah', $wilayah);
			$query_insert->bindParam(':luas_wilayah', $luas_wilayah);
			$query_insert->bindParam(':jarak_wilayah', $jarak_wilayah);
			$query_insert->execute();

			echo "
				<script>
					window.location.href='add.php?id_kabupaten=$id_kabupatenx';
					window.top.document.getElementById('alert-info').style.display='inline-block';
					window.top.document.getElementById('alert-text').innerHTML='Data has been updated';
				</script>
			";


			break;

		case 'delete':
			$id_kabupaten = $_REQUEST['id_kabupaten'];
			$query = $db->prepare("DELETE FROM _kabupaten WHERE id_kabupaten = :id_kabupaten");
			$query->bindParam(':id_kabupaten', $id_kabupaten);
			$query->execute();
			$_SESSION['s_delete'] = "Data has been deleted";

			echo "
				<script>
					window.top.location.reload();
				</script>
			";
			break;
	}