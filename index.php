<?php
	session_start();
?>
<html>
	<title>Tugas UAS</title>
	<head>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=drawing&key=AIzaSyB1wZZqn8OiFRUNDR3MSMHS32NvGwknVDI"></script>
		<script src="http://www.openlayers.org/api/OpenLayers.js"></script>

		<script type="text/javascript" src="includes/lib/javascript.util.js"></script>
		<script type="text/javascript" src="includes/lib/jsts.js"></script>

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

		<style type="text/css">
			.body{
				padding: 0;
				margin:0;
			}
		</style>

		<script type="text/javascript">
			/**
			 * Fungsi untuk membuat gabungan pada polygon
			 * @param _PolygonAll berisi tentang semua koordinat polygon
			 */
			function UnionAll(_PolygonAll){
				/**
				 * Dilakukan split berdasarkan karakter '|'
				 */
				
				var SpatialPolygon = _PolygonAll.split('|');

				/**
				 * Instance API dari JSTS Library
				 */
				
				var reader = new jsts.io.WKTReader();

				/**
				 * Instance API dari Google Maps
				 */
				
				var map = new google.maps.Map(window.top.document.getElementById('map'), {
					zoom: 7,
					center: {lat: -7.11724547237, lng: 112.483520507813},
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDefaultUI: true,
				});

				/**
				 * Perhitungan UNION Polygon
				 */

				var a, b, x, union;

				i = 0;
				a = reader.read(SpatialPolygon[i]);
				b = reader.read(SpatialPolygon[i+1]);

				union = a;
				union = union.union(b);

				for(var i = 1; i < SpatialPolygon.length; i++){
					if(i < (SpatialPolygon.length-1)){
						x = reader.read(SpatialPolygon[i]);
						union = union.union(x);
					}
				}

				if(union.__proto__.CLASS_NAME == 'jsts.geom.Polygon'){
					var coords = union.getCoordinates().map(function (coord) {
						return { lat: coord.x, lng: coord.y };
					});

					var unionCoor = new google.maps.Polygon({
						paths: coords,
						strokeColor: '#1E90FF',
						strokeOpacity: 0.8,
						strokeWeight: 2,
						fillColor: '#1E90FF',
						fillOpacity: 0.35
					});

					unionCoor.setMap(map);
				}else{
					// console.log(union.geometries);
					for(i = 0; i < union.geometries.length; i++){
						console.log(union.geometries[i].shell.points);

						var coords = union.geometries[i].shell.points.map(function (coord) {
							return { lat: coord.x, lng: coord.y };
						});

						var unionCoor = new google.maps.Polygon({
							paths: coords,
							strokeColor: '#1E90FF',
							strokeOpacity: 0.8,
							strokeWeight: 2,
							fillColor: '#1E90FF',
							fillOpacity: 0.35
						});

						unionCoor.setMap(map);
					}
				}

				/**
				 * Convert dari text spatial menjadi koordinat yang dibutuhkan Google Maps
				 */

				/*var coords = union.getCoordinates().map(function (coord) {
					return { lat: coord.x, lng: coord.y };
				});*/

				/**
				 * Menggambar Polygon yg sudah di UNION ke dalam Maps
				 */

				/*var unionCoor = new google.maps.Polygon({
					paths: coords,
					strokeColor: '#1E90FF',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#1E90FF',
					fillOpacity: 0.35
				});

				unionCoor.setMap(map);*/
				
			}


			/**
			 * Fungsi untuk membuat irisan pada polygon
			 * @param _PolygonAll berisi tentang semua koordinat polygon
			 */
			function IntersectionAll(_PolygonAll){
				/**
				 * Dilakukan split berdasarkan karakter '|'
				 */
				
				var SpatialPolygon = _PolygonAll.split('|');

				/**
				 * Instance API dari JSTS Library
				 */

				var reader = new jsts.io.WKTReader();

				/**
				 * Instance API dari Google Maps
				 */
				
				var map = new google.maps.Map(window.top.document.getElementById('map'), {
					zoom: 7,
					center: {lat: -7.11724547237, lng: 112.483520507813},
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDefaultUI: true,
				});


				/**
				 * Perhitungan Intersection Polygon
				 */
				
				var a, b, x, intersection;

				i = 0;
				a = reader.read(SpatialPolygon[i]);
				b = reader.read(SpatialPolygon[i+1]);

				intersection = a;
				intersection = intersection.intersection(b);

				for(var i = 1; i < SpatialPolygon.length; i++){
					if(i < (SpatialPolygon.length-1)){
						x = reader.read(SpatialPolygon[i]);
						intersection = intersection.intersection(x);
					}
				}

				/**
				 * Convert dari text spatial menjadi koordinat yang dibutuhkan Google Maps
				 */
				
				var coords = intersection.getCoordinates().map(function (coord) {
					return { lat: coord.x, lng: coord.y };
				});

				/**
				 * Jika tidak ditemukan hasil dari irisan maka akan munculkan peringatan
				 */
				if(coords.length > 0){

					/**
					 * Menggambar Polygon yg sudah di iris ke dalam Maps
					 */
					
					var intersectionCoor = new google.maps.Polygon({
						paths: coords,
						strokeColor: '#1E90FF',
						strokeOpacity: 0.8,
						strokeWeight: 2,
						fillColor: '#1E90FF',
						fillOpacity: 0.35
					});

					intersectionCoor.setMap(map);

				}else{
					console.log('Tidak dapat melakukan intersection.');
				}
				
			}
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<dir class="col-md-12">
					<h1 class="title">Geographic Information System</h1>
				</dir>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="col-md-12">
						<div class="map" id="map"></div>
					</div>
					<div class="col-md-12 button-map">
						<button class="btn btn-default btn-flat" onclick="javascript: document.getElementById('iframe_load_wilayah').src='wilayah.php'; document.getElementById('btn-load-wilayah').click(); " id="load-data"><i class="fa fa-search"></i> Load Data</button>
						<button class="btn btn-warning btn-flat" style="display: none;" onclick="javascript: window.location.reload(); " id="cancel-all"><i class="fa fa-times"></i> Cancel</button>
						<button class="btn btn-default btn-flat" style="display: none;" onclick="javascript: UnionAll(document.getElementById('polygon-all').value); " id="union-all"><i class="fa fa-gears"></i> Union Polygon</button>
						<button class="btn btn-default btn-flat" style="display: none;" onclick="javascript: IntersectionAll(document.getElementById('polygon-all').value); " id="intersection-all"><i class="fa fa-gears"></i> Intersection Polygon</button>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-info" <?php if(@$_SESSION['s_delete'] == ''){ echo 'style="display: none; width:100%;"'; } ?> id="alert-info">
						<button type="button" class="close" data-dismiss="alert">x</button>
						<strong>Status : </strong> <font id="alert-text"><?php if($_SESSION['s_delete'] != ''){ echo @$_SESSION['s_delete']; unset($_SESSION['s_delete']); } ?></font>
					</div>
					<div class="form-map">
						<iframe src="add.php" id="form-add" border="0" scrolling="no" style="border:none; height: 505px; width: 100%; padding: 0; margin: 0;"></iframe>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" id="polygon-all">
		<input type="hidden" id="delete-all">
		<input type="hidden" id="delete-all-button">


		<input type="hidden" data-toggle="modal" data-target="#modal-load-wilayah" id="btn-load-wilayah" />
		<div class="modal fade" id="modal-load-wilayah" data-backdrop="static">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Choose</h4>
					</div>
					<div class="modal-body">
						<iframe name="iframe_load_wilayah" id="iframe_load_wilayah" width="98%" height="400" frameborder="0"></iframe>
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary" onclick="javascript: document.getElementById('iframe_load_wilayah').contentDocument.getElementById('draw-all').click(); "><i class="fa fa-map-marker"></i> Draw All</button>
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" id="dismissChoode"><i class="fa fa-remove"></i> Cancel</button>
					</div>
				</div>
			</div>
		</div>

		<input type="hidden" data-toggle="modal" data-target="#modal-hapus" id="btn-hapus" />
		<div class="modal fade" id="modal-hapus" data-backdrop="static">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Delete data</h4>
					</div>
					<div class="modal-body">
						Apkah anda yakin akan dihapus ?
					</div>
					<div class="modal-footer">
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="fa fa-remove"></i> Cancel</button>
						<button class="btn btn-success" data-dismiss="modal" aria-hidden="true" onclick="javascript: document.getElementById('form-add').src='process.php?proc=delete&id_kabupaten='+document.getElementById('btn-hapus').value; "><i class="fa fa-check"></i> Yes</button>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">

			/**
			 * Dibawah ini merupakan semua script tentang Manajemen Maps
			 * Mulai dari membuat Polygon, Point/Marker, hingga perhitungan Luas wilayah sampai Keliling Wilayah
			 * Fasilitas yang digunakan adalah drawing manager yang disediakan oleh API Goole Maps version 3.0
			 */
			
			/**
			 * Pendeklarasian variabel yang dibutuhkan
			 */
			
			var drawingManager;
			var all_overlays = [];
			var selectedShape;
			var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
			var selectedColor;
			var colorButtons = {};

			/**
			 * Fungsi dibawah ini untuk mengkalkulasi Luas Wilayah & Keliling Wilayah
			 * @param coor berisi koordinat asli
			 * @param _Path berisi koordinat yang dijadikan kedalam Array
			 */
			
			function getCoordinatesPolygons(coor, _Path){
				/**
				 * Instance iframe yang digunakan untuk input data
				 */
				
				var iframe = document.getElementById('form-add');

				/**
				 * Digunakan untuk menghitung Luas Wilayah
				 */
				
				var area = google.maps.geometry.spherical.computeArea(_Path);

				/**
				 * Digunakan untuk menghitung Keliling Wilayah berdasarkan Line pada Polygon
				 */
				
				var jarak = google.maps.geometry.spherical.computeLength(_Path);

				/**
				 * Return dari hasil diatas kedalam input[id=wilayah], input[id=luas_wilayah], input[id=keliling_wilayah]
				 */
				
				iframe.contentDocument.getElementById('wilayah').value = coor;
				iframe.contentDocument.getElementById('luas_wilayah').value = area;
				iframe.contentDocument.getElementById('jarak_wilayah').value = jarak;
			}

			/*function test(_PolygonCoords, _MarkerCoords) {
				var map = new google.maps.Map(document.getElementById('map'), {
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

				drawingManager = new google.maps.drawing.DrawingManager({
					drawingControl: true,
					drawingControlOptions: {
						drawingModes: []
					},
					polylineOptions: {
						editable: true
					},
					polygonOptions: polyOptions,
					map: map
				});

				PolyCoords.getPaths().forEach(function(path, index){

					var coordinates = (path.getArray());

					google.maps.event.addListener(path, 'insert_at', function(){ getCoordinatesPolygons(coordinates); });

					google.maps.event.addListener(path, 'set_at', function(){ getCoordinatesPolygons(coordinates);});

				});
			}*/

			/**
			 * Fasilitas-fasilitas pendukung drawing manager
			 * Mohon tidak dihapus agar fungsi DrawingManager berjalan dengan baik
			 */
			
			function clearSelection() {
				if (selectedShape) {
					selectedShape.setEditable(false);
					selectedShape = null;
				}
			}

			function setSelection(shape) {
				clearSelection();
				selectedShape = shape;
				shape.setEditable(true);
				selectColor(shape.get('fillColor') || shape.get('strokeColor'));
			}

			function deleteSelectedShape() {
				if (selectedShape) {
					selectedShape.setMap(null);
				}
			}

			function deleteAllShape() {
				for (var i=0; i < all_overlays.length; i++){
					all_overlays[i].overlay.setMap(null);
				}
				all_overlays = [];
			}

			function selectColor(color) {
				selectedColor = color;

				var polygonOptions = drawingManager.get('polygonOptions');
				polygonOptions.fillColor = color;
				drawingManager.set('polygonOptions', polygonOptions);
			}

			function setSelectedShapeColor(color) {
				if (selectedShape) {
					if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
						selectedShape.set('strokeColor', color);
					} else {
						selectedShape.set('fillColor', color);
					}
				}
			}

			function makeColorButton(color) {
				var button = document.createElement('span');
				button.className = 'color-button';
				button.style.backgroundColor = color;
				google.maps.event.addDomListener(button, 'click', function() {
					selectColor(color);
					setSelectedShapeColor(color);
				});

				return button;
			}

			function buildColorPalette() {
				var colorPalette = document.getElementById('color-palette');
				for (var i = 0; i < colors.length; ++i) {
					var currColor = colors[i];
					var colorButton = makeColorButton(currColor);
				}
				selectColor(colors[0]);
			}

			/** End of Initial Optional Function */
			

			function initialize() {
				var map = new google.maps.Map(document.getElementById('map'), {
					center: {lat: -7.2742175, lng: 112.719087},
					zoom: 8,
					disableDefaultUI: true,
				});

				var polyOptions = {
					strokeWeight: 0,
					fillOpacity: 0.45,
					editable: true
				};

				drawingManager = new google.maps.drawing.DrawingManager({
					drawingMode: google.maps.drawing.OverlayType.POLYGON,
					drawingControl: true,
					drawingControlOptions: {
						drawingModes: ['marker', 'polygon']
					},
					markerOptions: {
						// icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
					},
					polylineOptions: {
						editable: true
					},
					polygonOptions: polyOptions,
					map: map
				});

				google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
					all_overlays.push(e);
					if (e.type != google.maps.drawing.OverlayType.MARKER) {
						drawingManager.setDrawingMode(null);

						var newShape = e.overlay;
						newShape.type = e.type;
						google.maps.event.addListener(newShape, 'click', function() {
							setSelection(newShape);
						});
						setSelection(newShape);
					}
				});

				google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
				google.maps.event.addListener(map, 'click', clearSelection);

				// google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
				google.maps.event.addDomListener(document.getElementById('delete-all-button'), 'click', deleteAllShape);

				google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
					var coordinates = (polygon.getPath().getArray());
					var path_coord = polygon.getPath();
					getCoordinatesPolygons(coordinates, path_coord);

					google.maps.event.addListener(polygon.getPath(), 'set_at', function() {
						getCoordinatesPolygons(coordinates, path_coord);
					});

					google.maps.event.addListener(polygon.getPath(), 'insert_at', function() {
						getCoordinatesPolygons(coordinates, path_coord);
					});
				});

				google.maps.event.addListener(drawingManager, 'markercomplete', function (marker) {
					var coordinates = (marker.getPosition());
					var iframe = document.getElementById('form-add');
					iframe.contentDocument.getElementById('pusat_kota').value = coordinates;
				});

				buildColorPalette();
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
	</body>
</html>
