@extends('admin.layout')
@section('konten')
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
	   
		<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
		{{ csrf_field() }}

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
									<p style="text-align:center;font-size:20px;font-weight:bold">Tambah {{ __($title) }}</p>
									<div class="col s12">
										
										<div class="input-field col s12">
											<label for="police_number">{{ __('No. Plat') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="police_number" name="police_number" value="{{ old('police_number') }}" style="@if ($errors->has('police_number'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('police_number'))<small><div class="error">{{ $errors->first('police_number') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="browser-default" name="unit_id" id="unit_id" onChange="Tampil()">
												<option value="">- Pilih Puskesmas -</option>
												@foreach($unit as $v)
													<option value="{{ $v->id }}" @if(old('unit_id')=="$v->id") selected @endif>{{ $v->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('unit_id'))<small><div class="error">{{ $errors->first('unit_id') }}</div></small>@endif
										</div>
										
										<div class="input-field col s12" id="officer" >
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
<script>
	function Tampil() {
		unit_id = document.getElementById("unit_id").value;
		url = "{{ url('/officer/get') }}"
		$.ajax({
			url:""+url+"/"+unit_id+"",
			success: function(response){
				$("#officer").html(response);
			}
		});
		return false;
}

</script>
@endsection