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
	   
	   <form action="{{ url('/'.Request::segment(1).'/edit/'.Crypt::encrypt($unit->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PUT">
		
        <div class="col s12">
          <div class="container">
			<div class="section">
				<!-- Input Fields -->
				<div class="row">
				<div class="col s12">
				<div id="input-fields" class="card card-tabs">
					<div class="card-content">
						
						<div id="view-input-fields">
							<div class="row">
								<form class="row">
									<p style="text-align:center;font-size:20px;font-weight:bold">Edit {{ __($title) }}</p>
									<div class="col s12">
										
										<div class="input-field col s12">
											<label for="name">{{ __('Nama Puskesmas') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="name" name="name" value="{{ $unit->name}}" style="@if ($errors->has('name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('name'))<small><div class="error">{{ $errors->first('name') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="address">{{ __('Alamat') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="address" name="address" value="{{ $unit->address }}" style="@if ($errors->has('address'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('address'))<small><div class="error">{{ $errors->first('address') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<select class="select2 browser-default" name="subdistrict_id">
												<option value="">- Pilih Kecamatan -</option>
												@foreach($subdistrict as $v)
													<option value="{{ $v->id }}" @if($unit->subdistrict_id =="$v->id") selected @endif>{{ $v->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('subdistrict_id'))<small><div class="error">{{ $errors->first('subdistrict_id') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<select class="select2 browser-default" name="category">
												<option value="">- Pilih Kategori -</option>
												<option value="hospital" @if($unit->category=="hospital") selected @endif>Rumah Sakit</option>
												<option value="health center" @if($unit->category=="health center") selected @endif>Puskesmas</option>
												<option value="clinic" @if($unit->category=="clinic") selected @endif>Klinik</option>
												<option value="drugstore" @if($unit->category=="drugstore") selected @endif>Apotek</option>
												<option value="practicing doctor" @if($unit->category=="practicing doctor") selected @endif>Dokter Praktek</option>
											</select>
											@if ($errors->has('category'))<small><div class="error">{{ $errors->first('category') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<div class="file-field input-field">
												<div class="btn waves-light cyan darken-0" style="line-height: 2rem;float: left;height: 2rem;">
													<span>Upload Gambar</span>
													<input type="file" name="image" >
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" style="height: 2rem;">
												</div>
												<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
											</div>
											@if($unit->image)
												<img src="{{ asset('storage/upload/unit/thumbnail/'.$unit->image) }}" width="150px" height="150px">
											@endif
										</div>
																
										<div class="input-field col s6">
											<label for="time_operation">{{ __('Waktu Operasional') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="time_operation" name="time_operation" value="{{ $unit->time_operation }}" style="@if ($errors->has('time_operation'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('time_operation'))<small><div class="error">{{ $errors->first('time_operation') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="address">{{ __('Peta Lokasi') }}</label>
											<input id="pac-input" class="form-control"  style="width: 70%;background-color:white" type="text" placeholder="Search Box"/>
											<div id="xmap3"></div>
											@php 
												$lat_long = explode(", ", $unit->coordinate); 
											@endphp
											<input type="hidden" name="lat" id="latclicked" class="form-control" value="{{ $lat_long[0] }}" readonly>
											<input type="hidden" name="long" id="longclicked" class="form-control" value="{{ $lat_long[1] }}" readonly>
										</div>
										
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
				</div>
			</div>
			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				<button type="submit" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">save</i></button>
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
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

		var myLatlng = new google.maps.LatLng(<?php echo $lat_long[0];?>, <?php echo $lat_long[1];?>);
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