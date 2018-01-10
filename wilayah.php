<?php
	include("globals/config.php");
	include("globals/functions.php");
?>
<html>
	<head>
	    <script src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false&key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI"></script>

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
	</head>
	<body>
		<div class="row">
			<div class="col-xs-12">
				<input type="text" name="keyword" placeholder="Search ..." class="form-control input-sm" />
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12" id="wilayah_detail"><?php include('wilayah_detail.php'); ?></div>
		</div>

		<script type="text/javascript">

			function getCoordinatesPolygons(coor, _Path){
				var iframe = window.top.document.getElementById('form-add');
				var area = google.maps.geometry.spherical.computeArea(_Path);
				iframe.contentDocument.getElementById('wilayah').value = coor;
				iframe.contentDocument.getElementById('luas_wilayah').value = area;
			}

			function drawingShape(_PolygonCoords, _MarkerCoords, _Data) {
				var map = new google.maps.Map(window.top.document.getElementById('map'), {
					zoom: 8,
					center: _MarkerCoords,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDefaultUI: true,
				});

				var PolyCoords = new google.maps.Polygon({
					paths: _PolygonCoords,
					strokeColor: '#1E90FF',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#1E90FF',
					fillOpacity: 0.35,
					editable: true
				});

				PolyCoords.setMap(map);

				var marker = new google.maps.Marker({
					position: _MarkerCoords,
					title: '#test1',
					map: map
				});
				marker.setMap(map);

				var polyOptions = {
					strokeWeight: 0,
					fillOpacity: 0.45,
					editable: true
				};

				PolyCoords.getPaths().forEach(function(path, index){

					var coordinates = (path.getArray());
					getCoordinatesPolygons(coordinates, path);

					google.maps.event.addListener(path, 'insert_at', function(){ getCoordinatesPolygons(coordinates, path); });

					google.maps.event.addListener(path, 'set_at', function(){ getCoordinatesPolygons(coordinates, path);});

				});

				var contentWindow = '';

				contentWindow += '<div class="window-main">';
				contentWindow += '	<h4><u>'+_Data['nama']+'</u><h4>';
				contentWindow += '	<table style="font-size: 13px;">';
				contentWindow += '		<tr>';
				contentWindow += '			<td style="padding: 5px;"><b>Kode</b></td>';
				contentWindow += '			<td style="padding: 5px;">:</td>';
				contentWindow += '			<td style="padding: 5px;">'+_Data['id_kabupaten']+'</td>';
				contentWindow += '		</tr>';
				contentWindow += '		<tr>';
				contentWindow += '			<td style="padding: 5px;"><b>Tanggal Berdiri</b></td>';
				contentWindow += '			<td style="padding: 5px;">:</td>';
				contentWindow += '			<td style="padding: 5px;">'+_Data['tanggal_berdiri']+'</td>';
				contentWindow += '		</tr>';
				contentWindow += '		<tr>';
				contentWindow += '			<td style="padding: 5px;"><b>Nama Bupati</b></td>';
				contentWindow += '			<td style="padding: 5px;">:</td>';
				contentWindow += '			<td style="padding: 5px;">'+_Data['nama_bupati']+'</td>';
				contentWindow += '		</tr>';
				contentWindow += '		<tr>';
				contentWindow += '			<td style="padding: 5px;"><b>Jumlah Penduduk</b></td>';
				contentWindow += '			<td style="padding: 5px;">:</td>';
				contentWindow += '			<td style="padding: 5px;">'+_Data['jumlah_penduduk']+'</td>';
				contentWindow += '		</tr>';
				contentWindow += '		<tr>';
				contentWindow += '			<td style="padding: 5px;"><b>Luas Wilayah</b></td>';
				contentWindow += '			<td style="padding: 5px;">:</td>';
				contentWindow += '			<td style="padding: 5px;">'+_Data['luas_wilayah']+' km<sup>2</sup></td>';
				contentWindow += '		</tr>';
				contentWindow += '	</table>';
				contentWindow += '</div>';

				var infowindow1 = new google.maps.InfoWindow({
					content: contentWindow
				});
				marker.addListener('click', function() {
					infowindow1.open(map, marker);
				});
			}


			function drawingShapeAll(_PolygonCoords, _MarkerCoords, _Data, _DataSpatialPolygon) {
				var map = new google.maps.Map(window.top.document.getElementById('map'), {
					zoom: 7,
					center: {lat: -7.11724547237, lng: 112.483520507813},
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDefaultUI: true,
				});

				var JumlahData 			= _PolygonCoords.length;
				var infoWindowContent 	= [];
				var infoWindow 			= new google.maps.InfoWindow(), marker, x;
				for(x = 0; x < JumlahData; x++){
					var PolyCoords = new google.maps.Polygon({
						paths: _PolygonCoords[x],
						strokeColor: '#1E90FF',
						strokeOpacity: 0.8,
						strokeWeight: 2,
						fillColor: '#1E90FF',
						fillOpacity: 0.35
					});

					PolyCoords.setMap(map);

					
					PolyCoords.getPaths().forEach(function(path, index){

						var coordinates = (path.getArray());

						google.maps.event.addListener(path, 'insert_at', function(){ getCoordinatesPolygons(coordinates); });

						google.maps.event.addListener(path, 'set_at', function(){ getCoordinatesPolygons(coordinates); });

					});


					marker = new google.maps.Marker({
						position: _MarkerCoords[x],
						map: map,
						title: _Data[x]['nama']
					});

					infoWindowContent[x] += '<div class="window-main">';
					infoWindowContent[x] += '	<h4><u>'+_Data[x]['nama']+'</u><h4>';
					infoWindowContent[x] += '	<table style="font-size: 13px;">';
					infoWindowContent[x] += '		<tr>';
					infoWindowContent[x] += '			<td style="padding: 5px;"><b>Kode</b></td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">:</td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">'+_Data[x]['id_kabupaten']+'</td>';
					infoWindowContent[x] += '		</tr>';
					infoWindowContent[x] += '		<tr>';
					infoWindowContent[x] += '			<td style="padding: 5px;"><b>Tanggal Berdiri</b></td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">:</td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">'+_Data[x]['tanggal_berdiri']+'</td>';
					infoWindowContent[x] += '		</tr>';
					infoWindowContent[x] += '		<tr>';
					infoWindowContent[x] += '			<td style="padding: 5px;"><b>Nama Bupati</b></td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">:</td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">'+_Data[x]['nama_bupati']+'</td>';
					infoWindowContent[x] += '		</tr>';
					infoWindowContent[x] += '		<tr>';
					infoWindowContent[x] += '			<td style="padding: 5px;"><b>Jumlah Penduduk</b></td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">:</td>';
					infoWindowContent[x] += '			<td style="padding: 5px;">'+_Data[x]['jumlah_penduduk']+'</td>';
					infoWindowContent[x] += '		</tr>';
					infoWindowContent[x] += '	</table>';
					infoWindowContent[x] += '</div>';

					// Allow each marker to have an info window    
					google.maps.event.addListener(marker, 'click', (function(marker, x, infoWindow, infoWindowContent) {
						return function() {
							infoWindow.setContent(infoWindowContent[x]);
							infoWindow.open(map, marker);
						}
					})(marker, x));
				}

				window.top.document.getElementById('polygon-all').value=_DataSpatialPolygon;
			}
		</script>
	</body>
</html>
