<?php
	include("globals/config.php");
	include("globals/functions.php");
	$id_kabupaten = @$_REQUEST['id_kabupaten'];
	if($id_kabupaten != ''){
		$query_kabupaten = $db->prepare("SELECT _kabupaten.*, astext(_kabupaten.wilayah) AS text_wilayah, astext(_kabupaten.pusat_kota) AS text_pusat_kota FROM _kabupaten WHERE id_kabupaten = :id_kabupaten");
		$query_kabupaten->bindParam(':id_kabupaten', $id_kabupaten);
		$query_kabupaten->execute();
		$result = $query_kabupaten->fetch(PDO::FETCH_ASSOC);

		$text_wilayah = str_replace('POLYGON', '', $result['text_wilayah']);
		$text_wilayah = str_replace('(', '', $text_wilayah);
		$text_wilayah = str_replace(')', '', $text_wilayah);

		$text_wilayah_temp1 = explode(',', $text_wilayah);
		$text_wilayah_temp1_jum = count($text_wilayah_temp1);
		$i = 1;

		if($text_wilayah_temp1_jum > 0){
			$wilayah = '';
			foreach($text_wilayah_temp1 as $wilayah_arr){
				$wilayah_arr_temp = explode(' ', $wilayah_arr);
				$wilayah .= "(".$wilayah_arr_temp[0].",".$wilayah_arr_temp[1].")";
				if($text_wilayah_temp1_jum != $i) $wilayah .= ",";
				$i++;
			}
		}

		$text_pusat_kota = str_replace('POINT', '', $result['text_pusat_kota']);
		$pusat_kota = str_replace(' ', ',', $text_pusat_kota);
	}
?>
<html>
	<title>Tugas UTS</title>
	<head>
	    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI"></script>

		<script type="text/javascript" src="includes/ajax.js"></script>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="includes/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="includes/bootstrap/css/font-awesome.css">
		<link rel="stylesheet" href="includes/bootstrap/css/bootstrap-glyphicons.css">
		<link rel="stylesheet" href="includes/dist/css/ionicons.min.css">
		<link rel="stylesheet" href="includes/dist/css/AdminLTE.css">
		<link rel="stylesheet" href="includes/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="includes/style.css">

		<script src="includes/jQuery-2.1.4.min.js"></script>
		<script src="includes/bootstrap/js/bootstrap.min.js"></script>
		<script src="includes/dist/js/app.min.js"></script>

		<script type="text/javascript" src="includes/datepicker/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="includes/datepicker/bootstrap-datepicker3.css"/>

		<script type="text/javascript">
			$(function () {
				var options={
					format: 'dd/mm/yyyy',
					todayHighlight: true,
					autoclose: true,
				};
				$('#tanggal_berdiri').datepicker(options);
			});
		</script>
	</head>
	<body>

		<form method="post" action="process.php">
			<?php if($id_kabupaten == ''){ ?>
			<input type="hidden" name="proc" value="add" />
			<?php }else{ ?>
			<input type="hidden" name="proc" value="update" />
			<input type="hidden" name="id_kabupatenx" value="<?php echo $id_kabupaten; ?>" />
			<?php } ?>
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-5">
							<div class="form-group">
								<label>Kode Kabupaten</label>
								<input type="text" name="id_kabupaten" id="id_kabupaten" class="form-control input-sm" placeholder="Kode kabupaten ..." autocomplete="off" value="<?php echo @$result['id_kabupaten']; ?>" required>
							</div>
						</div>

						<div class="col-xs-7">
							<div class="form-group">
								<label>Nama Kabupaten</label>
								<input type="text" name="nama" id="nama" class="form-control input-sm" placeholder="Nama Kabupaten ..." autocomplete="off" value="<?php echo @$result['nama']; ?>" required>
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label>Nama Bupati</label>
								<input type="text" name="nama_bupati" id="nama_bupati" class="form-control input-sm" placeholder="Nama Bupati ..." autocomplete="off" value="<?php echo @$result['nama_bupati']; ?>" required>
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label>Tanggal Berdiri</label>
								<input type="text" name="tanggal_berdiri" id="tanggal_berdiri" class="form-control input-sm" placeholder="dd/mm/YYYY" style="width: 100px;" autocomplete="off" value="<?php echo implode_date(@$result['tanggal_berdiri']); ?>" required readonly>
							</div>
						</div>	

						<div class="col-xs-5">
							<div class="form-group">
								<label>Jumlah Penduduk</label>
								<input type="text" name="jumlah_penduduk" id="jumlah_penduduk" class="form-control input-sm" placeholder="0" style="text-align: center; width: 80px;" onkeypress="return onlyNumbers(event); " autocomplete="off" value="<?php echo @$result['jumlah_penduduk']; ?>" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label>Pusat Kota</label>
								<input type="text" name="pusat_kota" id="pusat_kota" class="form-control input-sm" placeholder="Lat, Lang" readonly autocomplete="off" value="<?php echo @$pusat_kota; ?>" required>
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label>Wilayah</label>
								<input type="text" name="wilayah" id="wilayah" class="form-control input-sm" placeholder="{Lat, Lang}" readonly autocomplete="off" value="<?php echo @$wilayah; ?>" required>
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label>Luas Wilayah m<sup>2</sup></label>
								<input type="text" name="luas_wilayah" id="luas_wilayah" value="<?php echo @$result['luas_wilayah']; ?>" class="form-control input-sm" readonly placeholder="m2" required />
							</div>
						</div>	

						<div class="col-xs-6">
							<div class="form-group">
								<label>Keliling Wilayah</label>
								<input type="text" name="jarak_wilayah" id="jarak_wilayah" value="<?php echo @$result['jarak_wilayah']; ?>" class="form-control input-sm" readonly placeholder="m2" required />
							</div>
						</div>	
					</div>

					<div class="row">
						<div class="col-xs-12 col-xs-offset-2">
							<button class="btn btn-primary btn-flat" type="submit"><i class="fa fa-map-marker"></i> Save</button>
							<?php if(@$id_kabupaten == ''){ ?>
							<button class="btn btn-default btn-flat" type="reset" onclick="javascript: window.top.document.getElementById('delete-all-button').click();"><i class="fa fa-undo"></i> Reset</button>
							<?php }else{ ?>
							<button class="btn btn-warning btn-flat" type="reset" onclick="javascript: window.top.location.reload();"><i class="fa fa-undo"></i> Cancel</button>
							<button class="btn btn-danger btn-flat" type="reset" onclick="javascript: window.top.document.getElementById('btn-hapus').value='<?php echo $id_kabupaten; ?>'; window.top.document.getElementById('btn-hapus').click(); "><i class="fa fa-trash"></i> Delete</button>
							<?php } ?>
						</div>	
					</div>
				</div>
			</div>
		</form>
	</body>
</html>
