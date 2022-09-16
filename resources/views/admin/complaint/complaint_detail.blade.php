@extends('admin.layout')
@section('konten')
<style type="text/css">
#xmap3 {width:100%; height:440px; border:5px solid #DEEBF2;}
</style>
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
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">{{ __($title) }}
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

		<form action="{{ url('/'.Request::segment(1).'/process/'.Crypt::encrypt($complaint->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">

        <div class="col s12">
          <div class="container">
			<div class="section">
				<!-- Borderless Table -->
				<div class="row">
					<div class="col s12">
						<div id="borderless-table" class="card card-tabs">
						<div class="card-content">
							<div id="view-borderless-table ">
							<div class="row">
								<div class="col s12 " style="overflow-x:auto;">
								@if($complaint->status=="process" || $complaint->status=="dispatch")
									<table class="highlight" style="margin-top:20px">
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
											@if($complaint->status == "process")
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
									<table class="highlight" style="margin-top:20px">
										<thead>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%" colspan=2><center>DETAIL PENGADUAN</center></th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #2196f3;width: 20%";>Jenis Aduan</th>
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
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Nama</th>
												<th style="width: 80%">{{ $complaint->name }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Telepon</th>
												<th style="width: 80%">{{ $complaint->phone_number }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Area Kejadian</th>
												<th style="width: 80%">{{ $complaint->incident_area }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Ringkasan Kejadian</th>
												<th style="width: 80%">{{ $complaint->summary }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Kategori</th>
												<th style="width: 80%">{{ $complaint->category->name }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Gambar</th>
												<th style="width: 80%"><a href="{{ asset('storage/upload/image_citizen/'.$complaint->image)}}" target="_blank">Lihat Gambar</a></th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;border: 1px solid #f4f4f4;width: 20%";>Peta</th>
												<th style="width: 80%">
												<div id="googleMap" style="width:100%;height:400px;"></div>
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
			
			<div id="modal1" class="modal modal-fixed-footer">
				{{--<form action="{{ url('handling/'.Crypt::encrypt($complaint->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">--}}

				<div class="modal-content">

					<div class="input-field col s12">
						<span>Unit</span>
						<select class="browser-default" name="unit_id" required>
							<option value="">- Pilih Unit -</option>
							@foreach($unit as $v)
								<option value="{{ $v->unit->id }}" @if(old('unit_id')=="$v->unit->id") selected @endif>{{ $v->unit->name }}</option>
							@endforeach
						</select>
					</div>
					
					<div class="input-field col s12">
						<span>Keterangan</span>
						<textarea class="materialize-textarea" name="description" placeholder="Masukkan Langkah Penanganan "></textarea>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" class="mb-12 btn waves-effect waves-light green darken-1 btn-small ">Beri Penugasan</button>
				</div>
				</form>
               </div>
		
			<div id="modal2" class="modal">
				<form action="{{ url('/'.Request::segment(1).'/reject/'.Crypt::encrypt($complaint->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}
					<input type="hidden" name="_method" value="PUT">

					<div class="modal-content">

						<div class="input-field col s12">
							<span>Masukkan Alasan</span>
							<textarea class="materialize-textarea" name="reason" required></textarea>
						</div><br><br><br><br>
					</div>
					<div class="modal-footer">
						<button type="submit" class="mb-12 btn waves-effect waves-light green darken-1 btn-small ">Kirim</button>
						<a href="#!" class="mb-12 btn waves-effect waves-light red darken-1 btn-small modal-close">Batal</a>
					</div>
				</form>
			</div>

			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				<a href="#modal1" class="btn-floating btn-large waves-effect waves-light green darken-2 btn modal-trigger">Proses</a>
				<a href="#modal2" class="btn-floating btn-large waves-effect waves-light red darken-2 btn modal-trigger">Tolak</button>
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light yellow darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		


          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

    

<!-- Menyisipkan library Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk5azS8gZ2aDInOTqyPv7FmB5uBlu55RQ&callback=initMap"></script>

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
	
	var markerOptions = {
		map: map,
		position: myLatlng,
		icon: markerImage
	};
	
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
@endsection