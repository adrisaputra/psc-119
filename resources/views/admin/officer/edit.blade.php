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
	   
	   <form action="{{ url('/'.Request::segment(1).'/edit/'.Crypt::encrypt($officer->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
											<label for="name">{{ __('Nama Petugas') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="name" name="name" value="{{ $officer->name }}" style="@if ($errors->has('name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('name'))<small><div class="error">{{ $errors->first('name') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="email">{{ __('Email') }}</label>
											<input type="text" id="email" name="email" value="{{ $officer->user->email }}" readonly>
										</div>

										<div class="input-field col s12">
											<label for="phone_number">{{ __('No. HP') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="phone_number" name="phone_number" value="{{ $officer->phone_number }}" style="@if ($errors->has('phone_number'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('phone_number'))<small><div class="error">{{ $errors->first('phone_number') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<label for="address">{{ __('Alamat') }} <span class="required" style="color: #dd4b39;">*</span></label>
											<input type="text" id="address" name="address" value="{{ $officer->address }}" style="@if ($errors->has('address'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
											@if ($errors->has('address'))<small><div class="error">{{ $errors->first('address') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="unit_id">
												<option value="">- Pilih Unit -</option>
												@foreach($unit as $v)
													<option value="{{ $v->id }}" @if($officer->unit_id=="$v->id") selected @endif>{{ $v->name }}</option>
												@endforeach
											</select>
											@if ($errors->has('unit_id'))<small><div class="error">{{ $errors->first('unit_id') }}</div></small>@endif
										</div>
										
										<div class="input-field col s12">
											<select class="browser-default" name="status">
												<option value="">- Pilih Status -</option>
													<option value="available" @if($officer->status=="available") selected @endif>Tersedia</option>
													<option value="noavailable" @if($officer->status=="noavailable") selected @endif>Tidak Tersedia</option>
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