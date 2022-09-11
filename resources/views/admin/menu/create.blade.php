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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ $title }}</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">{{ $title }}
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
									<p style="text-align:center;font-size:20px;font-weight:bold">Tambah {{ $title }}</p>
									<div class="col s12">
										<div class="input-field col s12">
											<label for="menu_name">{{ __('Nama Menu') }}</label>
											<input type="text" id="menu_name" name="menu_name" value="{{ old('menu_name') }}" style="@if ($errors->has('menu_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('menu_name'))<small><div class="error">{{ $errors->first('menu_name') }}</div></small>@endif
										</div>
										<div class="input-field col s12">
											<label for="link">{{ __('Link') }}</label>
											<input type="text" id="link" name="link" value="{{ old('link') }}" style="@if ($errors->has('link'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('link'))<small><div class="error">{{ $errors->first('link') }}</div></small>@endif
										</div>
										<div class="input-field col s12">
											<label for="attribute">{{ __('Atribute') }}</label>
											<input type="text" id="attribute" name="attribute" value="{{ old('attribute') }}" style="@if ($errors->has('attribute'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										</div>
										<div class="input-field col s12">
											<label for="position">{{ __('Posisi') }}</label>
											<input type="text" id="position" name="position" value="{{ old('position') }}" style="@if ($errors->has('position'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('position'))<small><div class="error">{{ $errors->first('position') }}</div></small>@endif
										</div>
										<div class="input-field col s12">
											<label for="desc">{{ __('Deskripsi') }}</label>
											<input type="text" id="desc" name="desc" value="{{ old('desc') }}" style="@if ($errors->has('desc'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('desc'))<small><div class="error">{{ $errors->first('desc') }}</div></small>@endif
										</div>
										<div class="input-field col s12">
											<select class="select2 browser-default" name="status">
												<option value="">- Pilih Status -</option>
												<option value="1" @if(old('status')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('status')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('status'))<small><div class="error">{{ $errors->first('status') }}</div></small>@endif
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

@endsection