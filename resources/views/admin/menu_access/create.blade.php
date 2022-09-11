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
	   
		<form action="{{ url('/'.Request::segment(1).'/'.Crypt::encrypt($group->id)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
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
											<label for="group_name">{{ __('Nama Group') }}</label>
											<input type="text" id="group_name" name="group_name" value="{{ $group->group_name }}" disabled style="@if ($errors->has('group_name'))border-bottom: 2px solid #ff5252;@else color: black; @endif">
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="menu_id">
												<option value="">- Pilih Menu -</option>
												@foreach($menu as $v)
													<option value="{{ $v->id }}" @if(old('menu_id')==$v->id) selected @endif>{{ $v->menu_name }}</option>
												@endforeach
											</select>
											@if ($errors->has('menu_id'))<small><div class="error">{{ $errors->first('menu_id') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="create">
												<option value="">- Pilih Create -</option>
												<option value="1" @if(old('create')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('create')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('create'))<small><div class="error">{{ $errors->first('create') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="read">
												<option value="">- Pilih Read -</option>
												<option value="1" @if(old('read')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('read')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('read'))<small><div class="error">{{ $errors->first('read') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="update">
												<option value="">- Pilih Update -</option>
												<option value="1" @if(old('update')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('update')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('update'))<small><div class="error">{{ $errors->first('update') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="delete">
												<option value="">- Pilih Delete -</option>
												<option value="1" @if(old('delete')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('delete')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('delete'))<small><div class="error">{{ $errors->first('delete') }}</div></small>@endif
										</div>

										<div class="input-field col s12">
											<select class="select2 browser-default" name="print">
												<option value="">- Pilih Print -</option>
												<option value="1" @if(old('print')=="1") selected @endif>Aktif</option>
												<option value="0" @if(old('print')=="0") selected @endif>Tidak Aktif</option>
											</select>
											@if ($errors->has('print'))<small><div class="error">{{ $errors->first('print') }}</div></small>@endif
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
				<a href="{{ url('/'.Request::segment(1).'/'.Crypt::encrypt($group->id)) }}" class="btn-floating btn-large waves-effect waves-light red darken-2"><i class="material-icons">arrow_back</i></a>
			</div>
          </div>
		</form>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection