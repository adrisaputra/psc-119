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
									<div class="col s9" style="overflow-x:auto;">
										<div id="googleMap" style="width:100%;height:500px;"></div>
									</div>
									<div class="col s3" style="overflow-x:auto;">
										<table class="highlight">
										<thead>
											<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
												<th colspan=2><center>KETERANGAN</center></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="background-color: #e5011c;color:white;border: 1px solid #f4f4f4;"></td>
												<td>Masuk</td>
											</tr>
											<tr>
												<td style="width: 50%;background-color: #ffcc00;color:white;border: 1px solid #f4f4f4;"></td>
												<td>Dalam Proses</td>
											</tr>
											<tr>
												<td style="background-color: #009900;color:white;border: 1px solid #f4f4f4;"></td>
												<td>Selesai</td>
											</tr>
										</tbody>
										</table><br><br>

										<table class="highlight">
										<thead>
											<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
												<th colspan=2><center>JENIS KATEGORI PENGADUAN</center></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><center><img src="{{ asset('images/icon_aduan/Icon Button Emergency (Hijau).png')}}" width="35px" height="50px"></center></td>
												<td>Button Emergency</td>
											</tr>
											<tr>
												<td><center><img src="{{ asset('images/icon_aduan/Icon Telpon Langsung (Hijau).png')}}" width="40px" height="40px"></center></td>
												<td>Telepon</td>
											</tr>
											<tr>
												<td><center><img src="{{ asset('images/icon_aduan/Icon Laporan Aduan (Hijau).png')}}" width="40px" height="40px"></center></td>
												<td>Form Aduan</td>
											</tr>
										</tbody>
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

<script type="text/javascript">

	var map; 
	var lat_longs_map = new Array();
	var markers_map = new Array();
	var iw_map;

	iw_map = new google.maps.InfoWindow();

	function initialize_map() {

	var myLatlng = new google.maps.LatLng(-5.4856429306487176, 122.58496969552637);
	var myOptions = {
		zoom: 13,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP }
	map = new google.maps.Map(document.getElementById("googleMap"), myOptions);
		
	@foreach($complaint as $v)
	// Marker 1	
	var myLatlng = new google.maps.LatLng({{ $v->coordinate_citizen }});

	var pinColor = "#63cbf2";
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

	@if($v->report_type=='emergency')

		@if($v->status=='process' || $v->status=='dispatch' || $v->status=='accept')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Button Emergency (Kuning).png') }}',
				scaledSize : new google.maps.Size(30, 50),
			};
		@elseif($v->status=='done')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Button Emergency (Hijau).png') }}',
				scaledSize : new google.maps.Size(30, 50),
			};
		@elseif($v->status=='request')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Button Emergency (Merah).png') }}',
				scaledSize : new google.maps.Size(30, 50),
			};
		@endif

	@endif

	@if($v->report_type=='complaint')
		@if($v->status=='process' || $v->status=='dispatch' || $v->status=='accept')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Kuning).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@elseif($v->status=='done')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Hijau).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@elseif($v->status=='request')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Laporan Aduan (Merah).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@endif
	@endif

	@if($v->report_type=='phone')
		@if($v->status=='process' || $v->status=='dispatch' || $v->status=='accept')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Kuning).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@elseif($v->status=='done')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Hijau).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@elseif($v->status=='request')
			var image = {
				url: '{{ asset('images/icon_aduan/Icon Telpon Langsung (Merah Baru).png') }}',
				scaledSize : new google.maps.Size(30, 30),
			};
		@endif
	@endif

    	
    
	var markerOptions = {
		map: map,
		position: myLatlng,
		//icon: markerImage,
		icon: image,
		scaledSize: new google.maps.Size(50, 50), // scaled size
       	 animation: google.maps.Animation.BOUNCE,
	};
	marker_0 = createMarker_map(markerOptions);

		google.maps.event.addListener(marker_0, "click", function(event) {
			window.location.href = "{{ url('/detail_tracking/') }}/{{ Crypt::encrypt($v->id) }}";
		});

	@endforeach

	}


	function createMarker_map(markerOptions) {
	var marker = new google.maps.Marker(markerOptions);
	marker.addListener("click", toggleBounce);
	markers_map.push(marker);
	lat_longs_map.push(marker.getPosition());
	return marker;

	function toggleBounce() {
	if (marker.getAnimation() !== null) {
	marker.setAnimation(null);
	} else {
	marker.setAnimation(google.maps.Animation.BOUNCE);
	}
	}

	}

	google.maps.event.addDomListener(window, "load", initialize_map);


</script>
@endsection