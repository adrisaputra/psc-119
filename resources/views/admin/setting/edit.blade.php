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

            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <!-- Borderless Table -->
                        <div class="row">
                            <div class="col s12">
                                <div id="input-fields" class="card card-tabs">
                                    <div class="card-content">
										<div id="view-input-fields">
											<div class="row">
																
												@if ($message = Session::get('status'))
													<div class="col s12">
														<div class="card-alert card cyan">
															<div class="card-content white-text">
															<p style="font-size:24px"><i class="icon fa fa-check"></i> Berhasil !</p>
															<p>{{ $message }}</p>
															</div>
														</div>
													</div>
												@endif
												
												<form action="{{ url('/'.Request::segment(1).'/edit/'.$setting->id) }}" method="POST" enctype="multipart/form-data" class="row">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="PUT">
													<div class="col s6">
														<div class="input-field col s12">
															<input value="{{ $setting->application_name }}" name="application_name" type="text" class="validate" style="color: black;">
															<label >{{ __('Nama Aplikasi') }}</label>
														</div>
													</div>

													<div class="col s6">
														<div class="input-field col s12">
															<input value="{{ $setting->short_application_name }}" name="short_application_name" type="text" class="validate" style="color: black;">
															<label >{{ __('Singkatan Nama Aplikasi') }}</label>
														</div>
													</div>
													
													<div class="col s6">
														<div class="input-field col s12">
															<div class="file-field input-field">
																<div class="btn waves-light cyan darken-0" style="line-height: 2rem;float: left;height: 2rem;">
																	<span>Upload APK Petugas</span>
																	<input type="file" name="apk_officer" >
																</div>
																<div class="file-path-wrapper">
																	<input class="file-path validate" type="text" style="height: 2rem;">
																</div>
															</div>
															@if($setting->apk_officer)
																<a href="{{ asset('upload/setting/'.$setting->apk_officer) }}" class="btn waves-effect waves-light blue darken-1 btn-sm" title="Tambah Data"> Download</a>
															@endif
														</div>
													</div>

													<div class="col s6">
														<div class="input-field col s12">
															<input id="time_refresh_tracking" value="{{ $setting->time_refresh_tracking }}" name="time_refresh_tracking" type="text" class="validate" style="color: black;">
															<label for="time_refresh_tracking">{{ __('Waktu Refresh Traking') }}</label>
														</div>
														<div class="form-group @if ($errors->has('group')) has-error @endif">
															<label class="col-sm-2 control-label"></label>
															<div class="col-sm-10">
																<div>
																	<button type="submit" class="btn waves-effect waves-light cyan darken-1 float-right" title="Tambah Data"> Simpan</button>
																</div>
															</div>
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
                    <div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
                        <a href="{{ url('setting') }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
                    </div>
                </div>
                <div class="content-overlay"></div>
            </div>

			<div class="col s12">
                <div class="container">
                    <div class="section">
                        <!-- Borderless Table -->
                        <div class="row">
                            <div class="col s12">
								<h5>Pengaturan Gambar</h5>
                                <div id="input-fields" class="card card-tabs">
                                    <div class="card-content">
										<div id="view-input-fields">
											<div class="row">
												<form action="{{ url('/'.Request::segment(1).'/edit/'.$setting->id) }}" method="POST" enctype="multipart/form-data" class="row">
													{{ csrf_field() }}
													<input type="hidden" name="_method" value="PUT">
													<div class="col s6">
															<div class="form-group @if ($errors->has('small_icon')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Logo Kecil') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('small_icon'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('small_icon') }}</label>@endif
																	<input type="file" class="form-control" name="small_icon" value="{{ $setting->small_icon }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->small_icon)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->small_icon) }}" width="50px" height="50px">
																	@endif
																</div>
															</div>
															<hr>
															<div class="form-group @if ($errors->has('large_icon')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Logo Besar') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('large_icon'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('large_icon') }}</label>@endif
																	<input type="file" class="form-control" name="large_icon" value="{{ $setting->large_icon }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->large_icon)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->large_icon) }}" width="200px" height="50px">
																	@endif
																</div>
															</div>
													</div>
													<div class="col s6">
															<div class="form-group @if ($errors->has('background_login')) has-error @endif">
																<label class="col-sm-2 control-label">{{ __('Background Login') }}</label>
																<div class="col-sm-10">
																	@if ($errors->has('background_login'))<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('background_login') }}</label>@endif
																	<input type="file" class="form-control" name="background_login" value="{{ $setting->background_login }}" >
																	<span style="font-size:11px"><i>Ukuran File Tidak Boleh Lebih Dari 500 Kb (jpg,jpeg,png)</i></span>
																	@if($setting->background_login)
																		<br>
																		<img src="{{ asset('upload/setting/'.$setting->background_login) }}" height="50px">
																	@endif
																</div>
															</div>
															<hr>
															
															<div class="form-group @if ($errors->has('group')) has-error @endif">
																<label class="col-sm-2 control-label"></label>
																<div class="col-sm-10">
																	<div>
																		<button type="submit" class="btn waves-effect waves-light cyan darken-1 float-right" title="Tambah Data"> Simpan</button>
																	</div>
																</div>
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
            </div>

        </div>
    </div>
    <!-- END: Page Main-->


@endsection