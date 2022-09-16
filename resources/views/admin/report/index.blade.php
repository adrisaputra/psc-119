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
							<h5><center>CETAK LAPORAN</center></h5>
								<div class="col s12">
									<form action="{{ url('/'.Request::segment(1)) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
										<div class="col s12">
											<div class="input-field col s12 m12 l12">
												<select class="browser-default" name="month" required>
													<option value="">- Pilih Bulan-</option>
													<option value="1" @if(date('m')=="1") selected @endif>Januari</option>
													<option value="2" @if(date('m')=="2") selected @endif>Februari</option>
													<option value="3" @if(date('m')=="3") selected @endif>Maret</option>
													<option value="4" @if(date('m')=="4") selected @endif>April</option>
													<option value="5" @if(date('m')=="5") selected @endif>Mei</option>
													<option value="6" @if(date('m')=="6") selected @endif>Juni</option>
													<option value="7" @if(date('m')=="7") selected @endif>Juli</option>
													<option value="8" @if(date('m')=="8") selected @endif>Agustus</option>
													<option value="9" @if(date('m')=="9") selected @endif>September</option>
													<option value="10" @if(date('m')=="10") selected @endif>Oktober</option>
													<option value="11" @if(date('m')=="11") selected @endif>November</option>
													<option value="12" @if(date('m')=="12") selected @endif>Desember</option>
												</select>
												@if ($errors->has('month'))<small><div class="error">{{ $errors->first('month') }}</div></small>@endif
											</div>

											<div class="input-field col s12 m12 l12">
												<select class="browser-default" name="year" required>
													<option value="">- Pilih Tahun-</option>
													@for($i=2019;$i<=date('Y');$i++)
													<option value="{{ $i }}" @if(date('Y')==$i) selected @endif>{{ $i }}</option>
													@endfor
												</select>
												@if ($errors->has('year'))<small><div class="error">{{ $errors->first('year') }}</div></small>@endif
											</div>

											<div class="input-field col s12 m12 l12">
												<select class="browser-default" name="category_id">
													<option value="">- Pilih Jenis Aduan -</option>
													<option value="">Semua Jenis Aduan</option>
													@foreach($category as $v)
														<option value="{{ $v->id }}" @if(request()->get('category_id')=="$v->id") selected @endif>{{ $v->name }}</option>
													@endforeach
												</select>
											</div>
											
											<div class="input-field col s12 m12 l12">
												<select class="browser-default" name="report_type">
													<option value="">- Pilih Kategori -</option>
													<option value="">Semua Kategori</option>
													<option value="phone">Telepon Langsung</option>
													<option value="emergency">Button Emergency</option>
													<option value="complaint">Form Aduan</option>
												</select>
											</div>
											
											<div class="input-field col s12 m12 l12" style="padding-top:10px">
												<button type="submit" class="mb-12 btn waves-effect waves-light blue darken-1 btn-medium" >Cetak&nbsp;Laporan</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div id="view-borderless-table ">
								<div class="row">
									<div class="col s12" >
										<center><div id="chartdiv3"></div></center>
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
		var instance2 = M.Datepicker.init(elems2, options);
	});
</script>
@endsection