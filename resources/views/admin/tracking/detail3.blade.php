@extends('admin.layout')
@section('konten')
@php
$setting = SiteHelpers::setting();
@endphp
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-light-blue-cyan"></div>
        <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ __($title) }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">{{ __($title) }}
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
			<div class="section">
				<!-- Borderless Table -->
				<div class="row">
					<div class="col s12">
						<div id="borderless-table" class="card card-tabs">
						<div class="card-content">
							<div class="card-title content-right">
								
							</div>
							<div id="view-borderless-table ">
								<div class="row">
									<div class="col s8" style="overflow-x:auto;">
										<p style="font-weight:bold;font-size:16px" id="msg"></p>
										<div id="googleMap" style="width:100%;height:500px;"></div>
									</div>
									<div class="col s4" style="overflow-x:auto;">
									@if($complaint->status=="process" || $complaint->status=="dispatch" || $complaint->status=="accept" || $complaint->status=="done")
									<table class="highlight">
										<thead>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%" colspan=3><center>DETAIL PETUGAS</center></th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;width: 20%";>Petugas/Unit</th>
												<th style="background-color: #9e9e9e;color:white;width: 20%";>Status</th>
												<th style="background-color: #9e9e9e;color:white;width: 60%";>Keterangan</th>
											</tr>
											@foreach($switch_officer as $v)
												<tr>
													<td>{{ $v->unit->name }}</td>
													<td><span class="new badge red" data-badge-caption="Ditolak"></span></td>
													<td>{{ $v->description }}</td>
												</tr>
											@endforeach
											@if($complaint->status == "process" || $complaint->status=="accept"  || $complaint->status=="done" )
											<tr>
												<td>{{ $get_unit->name }}</td>
												<td>	
													@if($handling->status == NULL)
														<span class="new badge orange" data-badge-caption="Dalam Proses"></span>
													@elseif($handling->status == "accept")
														<span class="new badge blue" data-badge-caption="Diterima"></span>
													@elseif($handling->status == "reject")
														<span class="new badge red" data-badge-caption="Ditolak"></span>
													@elseif($handling->status == "done")
														<span class="new badge green" data-badge-caption="selesai"></span>
													@endif
												</td>
												<td></td>
											</tr>
											@endif
											<tr>
											</tr>
										</thead>
									</table>
									@endif

									@if($complaint->status=="done" )
									<table class="highlight">
										<thead>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%" colspan=3><center>DETAIL PENANGANAN</center></th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Diagnosa</th>
												<th style="width: 80%">{{ $handling->diagnosis }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Penanganan</th>
												<th style="width: 80%">{{ $handling->handling }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Status Penanganan</th>
												<th style="width: 80%">
													@if($complaint->handling_status == 'home')
														Pulang Kerumah
													@else
														Dirujuk
													@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Tempat Rujukan</th>
												<th style="width: 80%">
													@if($complaint->handling_status == 'home')
														-
													@else
														{{ $complaint->reference_place }}
													@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Foto TKP/Korban</th>
												<th style="width: 80%"><a href="{{ asset('storage/upload/photo_citizen/'.$complaint->photo_citizen)}}" target="_blank">Lihat Foto</a></th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Waktu Respon</th>
												<th style="width: 80%">{{ $handling->response_time }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Waktu Selesai</th>
												<th style="width: 80%">{{ $handling->done_time }}</th>
											</tr>
										</thead>
									</table>
									@endif

									<table class="highlight">
										<thead>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%" colspan=2><center>DETAIL PENGADUAN</center></th>
											</tr>
											@if($complaint->status=="reject" )
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Alasan Ditolak</th>
												<th style="width: 80%">{{ $complaint->reason }}</th>
											</tr>
											@endif
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Jenis Aduan</th>
												<th style="width: 80%">
													@if ($complaint->report_type=="emergency")
														<span class="new badge red" data-badge-caption="Darurat"></span>
													@elseif ($complaint->report_type=="phone")
														<span class="new badge cyan" data-badge-caption="Telepon"></span>
													@else
														<span class="new badge green" data-badge-caption="Aduan"></span>
													@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Nama</th>
												<th style="width: 80%">{{ $complaint->name }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Telepon</th>
												<th style="width: 80%">{{ $complaint->phone_number }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Area Kejadian</th>
												<th style="width: 80%">{{ $complaint->incident_area }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Ringkasan Kejadian</th>
												<th style="width: 80%">{{ $complaint->summary }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Kategori</th>
												<th style="width: 80%">{{ $complaint->category ? $complaint->category->name : '' }}</th>
											</tr>
											<tr>
												<th style="background-color: #9e9e9e;color:white;border: 1px solid #ffffff;width: 20%";>Gambar</th>
												<th style="width: 80%">
													@if($complaint->image) 
														<a href="{{ asset('storage/upload/image_citizen/'.$complaint->image)}}" target="_blank">Lihat Gambar</a>
													@else
														Tidak Ada
													@endif
												</th>
											</tr>
										</thead>
									</table>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
 <!-- Menyisipkan library Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ $setting->gmaps_key }}&callback=initMap"></script>

@if($complaint->coordinate_officer)
<script type="text/javascript">

	var map; 
	// var cek_officer = '{{ $complaint->coordinate_officer }}'; 
	// const cek_citizen = '{{ $complaint->coordinate_citizen }}'; 
	var iw_map;
	// var a = '{{ $complaint->coordinate_officer }}';
	
	iw_map = new google.maps.InfoWindow();

	function haversine_distance(mk1, mk2) {
		var R = 3958.8; // Radius of the Earth in miles
		var rlat1 = mk1.position.lat() * (Math.PI/180); // Convert degrees to radians
		var rlat2 = mk2.position.lat() * (Math.PI/180); // Convert degrees to radians
		var difflat = rlat2-rlat1; // Radian difference (latitudes)
		var difflon = (mk2.position.lng()-mk1.position.lng()) * (Math.PI/180); // Radian difference (longitudes)

		var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
		return d;
	}

	var myLatlng = new google.maps.LatLng({{ $complaint->coordinate_citizen }});

var myOptions = {
zoom: 14,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP }
		map = new google.maps.Map(document.getElementById("googleMap"), myOptions);

	function initialize_map() {

		$.getJSON('{{ url('/detail_tracking2/'.$complaint->id) }}', function(data) {

			// var coordinate_officer = "("+data.coordinate_officer+")";
			// var input = coordinate_officer.replace('(', '');
			// var latlngStr = input.split(",", 2);
			// var lat = parseFloat(latlngStr[0]);
			// var lng = parseFloat(latlngStr[1]);

			// var myLatlng = new google.maps.LatLng(lat, lng);
			
			const lat_long1 = data.coordinate_officer.split(", ");
			const lat_long2 = data.coordinate_citizen.split(", ");
			
			const dakota = {lat: parseFloat(lat_long1[0]), lng: parseFloat(lat_long1[1]) };
			const frick = {lat: parseFloat(lat_long2[0]), lng: parseFloat(lat_long2[1]) };

			console.log(dakota);

			var image = {
						url: '{{ asset('images/icon_aduan/ambulance.png') }}',
						scaledSize : new google.maps.Size(50, 30),
					};
					
				var mk1 = new google.maps.Marker({
							position: dakota, 
							// map: map,
							// icon: image,
							// scaledSize: new google.maps.Size(50, 30), // scaled size
						});

			
				@if($complaint->report_type=='emergency')

					@if($complaint->status=='process' || $complaint->status=='dispatch' || $complaint->status=='accept')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Button Emergency (Kuning).png') }}',
							scaledSize : new google.maps.Size(30, 50),
						};
					@elseif($complaint->status=='done')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Button Emergency (Hijau).png') }}',
							scaledSize : new google.maps.Size(30, 50),
						};
					@elseif($complaint->status=='request')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Button Emergency (Merah).png') }}',
							scaledSize : new google.maps.Size(30, 50),
						};
					@endif

				@endif

				@if($complaint->report_type=='complaint')
					@if($complaint->status=='process' || $complaint->status=='dispatch' || $complaint->status=='accept')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Kuning).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@elseif($complaint->status=='done')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Hijau).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@elseif($complaint->status=='request')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Merah).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@endif
				@endif

				@if($complaint->report_type=='phone')
					@if($complaint->status=='process' || $complaint->status=='dispatch' || $complaint->status=='accept')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Kuning).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@elseif($complaint->status=='done')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Hijau).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@elseif($complaint->status=='request')
						var image2 = {
							url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Merah Baru).png') }}',
							scaledSize : new google.maps.Size(30, 30),
						};
					@endif
				@endif

				var mk2 = new google.maps.Marker({
							position: frick, 
							// map: map,
							// icon: image2,
							// scaledSize: new google.maps.Size(50, 50), // scaled size
						});
				
				// var line = new google.maps.Polyline({
				// 			path: [dakota, frick], 
				// 			map: map,
				// 			icons: [{
				// 				icon: image,
				// 				offset: '0%'
				// 			},{
				// 				icon: image2,
				// 				offset: '0%'
				// 			}],
				// 		});

				// // Calculate and display the distance between markers
				var distance = haversine_distance(mk1, mk2);
				let directionsService = new google.maps.DirectionsService();
				let directionsRenderer = new google.maps.DirectionsRenderer();
				directionsRenderer.setMap(map); // Existing map object displays directions
				// Create route from existing points used for markers
				const route = {
					origin: dakota,
					destination: frick,
					travelMode: google.maps.DirectionsTravelMode.DRIVING,
					unitSystem: google.maps.UnitSystem.METRIC
				}

				directionsService.route(route,
				function(response, status) { // anonymous function to capture directions
					if (status == google.maps.DirectionsStatus.OK) {
						new google.maps.DirectionsRenderer({
							map: map,
							directions: response,
							suppressMarkers: true
						});
						var leg = response.routes[0].legs[0];
						makeMarker(leg.start_location, icons.start, "title", map);
						makeMarker2(leg.end_location, icons.end, 'title', map);
							// document.getElementById('msg').innerHTML += " Jarak ke lokasi adalah " + leg.distance.text + " (" + leg.duration.text + ").";
							document.getElementById('msg').textContent =" Jarak ke lokasi adalah " + leg.distance.text + " (" + leg.duration.text + ").";

					} else {
						alert("Unable to retrive route");
					}
				});

				// to store markers
				var markers = [];

				function makeMarker(position, icon, title, map) {
					
					var marker = new google.maps.Marker({
						position: position,
						map: map,
						icon: icon,
						title: title
					});
					// store marker in list
					markers.push(marker);
				}

				// Sets the map on all markers in the array.
				function setMapOnAll(map) {
					for (var i = 0; i < markers.length; i++) {
						markers[i].setMap(map);
					}
				}

				// // Removes the markers from the map, but keeps them in the array.
				function clearMarkers() {
					setMapOnAll(null);
				}

				// Shows any markers currently in the array.
				function showMarkers() {
					setMapOnAll(map);
				}

				// Deletes all markers in the array by removing references to them.
				function deleteMarkers() {
					clearMarkers();
					markers = [];
				}
				

				function makeMarker2(position, icon, title, map) {
					new google.maps.Marker({
						position: position,
						map: map,
						icon: icon,
						title: title
					});
				}

				var icons = {
					start: new google.maps.MarkerImage(
					// URL
					'{{ asset('images/icon_aduan/mini_ambulance2.png') }}',
					// (width,height)
					new google.maps.Size(129, 42),
					new google.maps.Point(0,0),
					new google.maps.Point(20, 20)),
					end: new google.maps.MarkerImage(
					// URL
					@if ($complaint->category_id==1 )
						'{{ asset('images/icon_aduan/baby.png') }}',
					@elseif ($complaint->category_id==2 )
						'{{ asset('images/icon_aduan/accident.png') }}',
					@endif
					// (width,height)
					new google.maps.Size(129, 42),
					new google.maps.Point(0,0),
					new google.maps.Point(20, 20)),
				};

			setTimeout(function(){
				deleteMarkers();
				initialize_map();
			}, 5000);
			// setTimeout(function(){ p.abort(); }, 7000);

		});

	}

	google.maps.event.addDomListener(window, "load", initialize_map);


</script>

@else

<script type="text/javascript">

var map; 
	var lat_longs_map = new Array();
	var markers_map = new Array();
	var iw_map;

	iw_map = new google.maps.InfoWindow();

	function initialize_map() {

	var myLatlng = new google.maps.LatLng({{ $complaint->coordinate_citizen }});
	var myOptions = {
		zoom: 14,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.hybrid }
	map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
		
	// Marker 1	
	var myLatlng = new google.maps.LatLng({{ $complaint->coordinate_citizen }});

	var pinColor = "#4caf50";
    var pinLabel = "A";

    // Pick your pin (hole or no hole)
    var pinSVGHole = "M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z";
    var labelOriginHole = new google.maps.Point(12,15);
    var pinSVGFilled = "M 12,2 C 8.1340068,2 5,5.1340068 5,9 c 0,5.25 7,13 7,13 0,0 7,-7.75 7,-13 0,-3.8659932 -3.134007,-7 -7,-7 z";
    var labelOriginFilled =  new google.maps.Point(12,9);


    var markerImage = {  // https://developers.google.com/maps/documentation/javascript/reference/marker#MarkerLabel
        path: pinSVGHole,
        anchor: new google.maps.Point(12,25),
        fillOpacity: 1,
        fillColor: pinColor,
        strokeWeight: 2,
        strokeColor: "white",
        scale: 2,
        labelOrigin: new google.maps.Point(12,30),
    };
	
			var image2 = {

				
				@if ($complaint->category_id==1 )
					url: '{{ asset('images/icon_aduan/baby.png') }}',
				@elseif ($complaint->category_id==2 )
					url: '{{ asset('images/icon_aduan/accident.png') }}',
				@endif
				scaledSize : new google.maps.Size(40, 40),
			};

	@if ($complaint->category_id)
		var markerOptions = {
			map: map,
			position: myLatlng,
			icon: image2,
			scaledSize: new google.maps.Size(50, 50), // scaled size
		};
	@else
		var markerOptions = {
			map: map,
			position: myLatlng,
			icon: markerImage,
			scaledSize: new google.maps.Size(50, 50), // scaled size
		};
	@endif
	
	
	marker_0 = createMarker_map(markerOptions);

		google.maps.event.addListener(marker_0, "click", function(event) {
         document.getElementById("clickButton").click();
			$.ajax(
            {
               url: "{{ url('/detail_peta/') }}", 
               success: function(result){
				$("#detail-modal").html(result);
			}
            })
		});
	}


	function createMarker_map(markerOptions) {
	var marker = new google.maps.Marker(markerOptions);
	markers_map.push(marker);
	lat_longs_map.push(marker.getPosition());
	return marker;
	}

	google.maps.event.addDomListener(window, "load", initialize_map);


</script>

@endif
@endsection