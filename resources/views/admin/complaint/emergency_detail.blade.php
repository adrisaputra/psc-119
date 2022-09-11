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
												<th style="background-color: #9e9e9e;color:white;width: 20%";>Fayankes</th>
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
												<th style="background-color: #2196f3;color:white;width: 20%";>Jenis Aduan</th>
												<th style="width: 80%">
													@if ($complaint->report_type=="emergency")
														<span class="new badge red" data-badge-caption="Darurat"></span>
													@else
														<span class="new badge green" data-badge-caption="Aduan"></span>
													@endif</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Nama</th>
												<th style="width: 80%">{{ $complaint->name }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Telepon</th>
												<th style="width: 80%">{{ $complaint->phone_number }}</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Area Kejadian</th>
												<th style="width: 80%">
													<input type="text" id="incident_area" name="incident_area" value="@if($complaint->incident_area == NULL) {{ old('incident_area') }} @else {{ $complaint->incident_area }} @endif" style="@if ($errors->has('incident_area'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('incident_area'))<small><div class="error" style="color: red;">{{ $errors->first('incident_area') }}</div></small>@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Ringkasan Kejadian</th>
												<th style="width: 80%">
													<input type="text" id="summary" name="summary" value="@if($complaint->summary == NULL) {{ old('summary') }} @else {{ $complaint->summary }} @endif" style="@if ($errors->has('summary'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
													@if ($errors->has('summary'))<small><div class="error" style="color: red;">{{ $errors->first('summary') }}</div></small>@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Kategori</th>
												<th style="width: 80%">
													<select class="browser-default" name="category_id" style="@if ($errors->has('incident_area'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
														<option value="">- Pilih Kategori -</option>
														@foreach($category as $v)
															<option value="{{ $v->id }}" @if($complaint->category_id=="$v->id") selected @endif>{{ $v->name }}</option>
														@endforeach
													</select>
													@if ($errors->has('category_id'))<small><div class="error" style="color: red;">{{ $errors->first('category_id') }}</div></small>@endif
												</th>
											</tr>
											<tr>
												<th style="background-color: #2196f3;color:white;width: 20%";>Petass </th>
												<th style="width: 80%">
													<input id="pac-input" class="form-control"  style="width: 70%" type="text" placeholder="Search Box"/>
													<div id="xmap3"></div> 
													@php 
														$lat_long = explode(", ", $complaint->coordinate_citizen); 
													@endphp
													<input type="hidden" name="lat" id="latclicked" class="form-control" value="{{ $lat_long[0] }}" readonly>
													<input type="hidden" name="long" id="longclicked" class="form-control" value="{{ $lat_long[1] }}" readonly>
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
				<form action="{{ url('handling/'.Crypt::encrypt($complaint->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="PUT">

				<div class="modal-content">

					<div class="input-field col s12">
						<span>Unit</span>
						<select class="browser-default" name="unit_id" required>
							<option value="">- Pilih Unit -</option>
							@foreach($unit as $v)
								<option value="{{ $v->id }}" @if(old('unit_id')=="$v->id") selected @endif>{{ $v->name }}</option>
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
               </div>

			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				<a href="#modal1" class="btn-floating btn-large waves-effect waves-light green darken-2 btn modal-trigger">Proses</a>
				<button type="submit" class="btn-floating btn-large waves-effect waves-light red darken-2">Tolak</button>
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light yellow darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		</form>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDk5azS8gZ2aDInOTqyPv7FmB5uBlu55RQ&callback=initAutocomplete&libraries=places&v=weekly" defer></script>
<script>
      "use strict";

      function initAutocomplete() {
        const map = new google.maps.Map(document.getElementById("xmap3"), {
          center: {
            lat: <?php echo $lat_long[0];?>,
            lng: <?php echo $lat_long[1];?>
          },
          zoom: 15,
          mapTypeId: "roadmap"
        }); 

		var myLatlng = new google.maps.LatLng({{ $complaint->coordinate_citizen }});
		var marker = new google.maps.Marker({
			  draggable: true,
			  position: myLatlng,
			  map: map,
			  title: "Your location"
		  });
		
		google.maps.event.addListener(map, 'click', function (event) {
		  document.getElementById("latclicked").value = event.latLng.lat();
		  document.getElementById("longclicked").value = event.latLng.lng();
		  
		  placeMarker(map, event.latLng);
		});

		function placeMarker(map, location) {
		  	if (marker == undefined){
				marker = new google.maps.Marker({
					position: location,
					map: map, 
					animation: google.maps.Animation.DROP,
				});
			} else{
				marker.setPosition(location);
					  var infowindow = new google.maps.InfoWindow({
							content: 'Latitude: ' + location.lat() + '<br>Longitude: ' + location.lng()
					  });
					  infowindow.open(map,marker);	
					map.setCenter(location);		
			}
		}
			
        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input); // Bias the SearchBox results towards current map's viewport.

        map.addListener("bounds_changed", () => {
          searchBox.setBounds(map.getBounds());
        });
        let markers = []; 
		
        searchBox.addListener("places_changed", () => {
          const places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          } // Clear out the old markers.

          const bounds = new google.maps.LatLngBounds();
          places.forEach(place => {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            const icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            }; // Create a marker for each place.

			
            if (place.geometry.viewport) {
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
		  
		  
        });
		
      }
</script>
@endsection