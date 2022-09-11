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
											<label for="title">{{ __('Judul') }}</label>
											<input type="text" id="title" name="title" value="{{ old('title') }}" style="@if ($errors->has('title'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('title'))<small><div class="error">{{ $errors->first('title') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="text">{{ __('Teks') }}</label>
											<textarea class="materialize-textarea" id="editor" placeholder="Keterangan" name="text">{{ old('text') }}</textarea>
											@if ($errors->has('text'))<small><div class="error">{{ $errors->first('text') }}</div></small>@endif
										</div>

										<div class="input-field col s6">
											<label for="date_start">{{ __('Tanggal Mulai') }}</label>
											<input type="text" id="date_start" onChange="getNumberOfDays()" class="datepicker" name="date_start" value="{{ old('date_start') }}" style="@if ($errors->has('date_start'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										</div>

										<div class="input-field col s6">
											<label for="date_end">{{ __('Tanggal Selesai') }}</label>
											<input type="text" id="date_end" onChange="getNumberOfDays()" class="datepicker2" name="date_end" value="{{ old('date_end') }}" style="@if ($errors->has('date_end'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
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
	document.addEventListener('DOMContentLoaded', function() {
		var options = {
			format: "dd-mm-yyyy",
			autoClose: true,
			setDefaultDate: true
		};
		var elems = document.querySelector('.datepicker');
		var elems2 = document.querySelector('.datepicker2');
		var instance = M.Datepicker.init(elems, options);
		var instance = M.Datepicker.init(elems2, options);
	});
	
</script>
@endsection