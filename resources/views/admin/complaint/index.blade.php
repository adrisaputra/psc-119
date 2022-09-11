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
								<div class="col s12">
									<form action="{{ url('/'.Request::segment(1).'/search') }}" method="GET">
										<div class="app-file-header-search">
											<div class="input-field m-0">
											<i class="material-icons prefix">search</i>
												<input type="search" id="email-search" placeholder="Pencarian" name="search" style="border-bottom: 1px solid #e2dfdf;">
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="card-title content-right">
								
							</div>
							@can('read-data')
							<div id="view-borderless-table ">
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
								
								<div class="col s12 " style="overflow-x:auto;">
									<table class="highlight">
									<thead>
										<tr style="background-color: gray;color:white;border: 1px solid #f4f4f4;">
											<th style="width: 5%">No</th>
											<th style="width: 10%">No. Tiket</th>
											<th style="width: 10%">Nama</th>
											<th style="width: 10%">Telepon</th>
											<th style="width: 20%">Keterangan</th>
											<th style="width: 10%">Kategori</th>
											<th style="width: 10%">PSC</th>
											<th style="width: 10%">Jenis Laporan</th>
											@if(Request::segment(1)=="incoming_complaint")
												<th style="width: 10%">Status</th>
											@endif
											<th style="width: 20%">#aksi</th>
										</tr>
									</thead>
									<tbody>
										@foreach($complaint as $v)
										<tr>
											<td>{{ ($complaint ->currentpage()-1) * $complaint ->perpage() + $loop->index + 1 }}</td>
											<td>{{ $v->ticket_number }}</td>
											<td>{{ $v->name }}</td>
											<td>{{ $v->phone_number }}</td>
											<td>{{ $v->summary }}</td>
											<td>{{ $v->category ? $v->category->name : '' }}</td>
											<td>Kota Baubau</td>
											<td>
												@if ($v->report_type=="emergency")
												<span class="new badge red" data-badge-caption="Darurat"></span>
												@elseif ($v->report_type=="complaint")
												<span class="new badge green" data-badge-caption="Aduan"></span>
												@elseif ($v->report_type=="phone")
												<span class="new badge cyan" data-badge-caption="Telepon"></span>
												@endif
											</td>
											@if(Request::segment(1)=="incoming_complaint")
												@if ($v->handling->status=="reject")
													<td><span class="new badge red" data-badge-caption="Ditolak&nbsp;Petugas"></span></th>
												@else
													<td><span class="new badge cyan" data-badge-caption="Aduan Baru"></span></th>
												@endif
											@endif
											<td>
												<div class="col s12 m12 l12" style="display: block;padding-top:7px">
														
													<a class="mb-12 btn waves-effect waves-light cyan darken-1 btn-small btn-block" href="{{ url('/'.Request::segment(1).'/detail/'.Crypt::encrypt($v->id) ) }}" style="padding-bottom:10px">Detail</a>
													@can('ubah-data')
														<a class="mb-12 btn waves-effect waves-light orange darken-1 btn-small btn-block" href="{{ url('/'.Request::segment(1).'/edit/'.Crypt::encrypt($v->id) ) }}"style="margin-top:5px">Edit</a>
													@endcan
													@can('hapus-data')
														<a class="mb-12 btn waves-effect waves-light red darken-1 btn-small btn-block" href="{{ url('/'.Request::segment(1).'/hapus/'.Crypt::encrypt($v->id) ) }}" style="margin-top:5px" onclick="return confirm('Apakah anda yakin akan menghapus data ini ?');">Hapus</a>
													@endcan
												</div>
											</td>
										</tr>
	
	
										@endforeach
									</tbody>
									</table>
									
									@foreach($complaint as $v)
									
									<div id="modal{{ $v->id }}" class="modal">
											<form action="{{ url('/'.Request::segment(1).'/edit_status/') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
											{{ csrf_field() }}
											<input type="hidden" name="_method" value="PUT">
									
												<div class="modal-content">
												<h5>Data Aduan</h5>
												<div id="view-borderless-table ">
													<div class="row">
														<div class="col s12 " style="overflow-x:auto;">
														<table class="highlight">
															<tbody>
																<tr>
																	<td style="width:20%">No. Tiket</td>
																	<td  style="width:80%">: {{ $v->ticket_number }}</td>
																</tr>
																<tr>
																	<td>Nama</td>
																	<td>: {{ $v->name }}</td>
																</tr>
																<tr>
																	<td>No. Telepon</td>
																	<td>: {{ $v->phone_number }}</td>
																</tr>
																<tr>
																	<td>Kategori</td>
																	<td>: {{ $v->category ? $v->category->name : '' }} </td>
																</tr>
																<tr>
																	<td>Area Kejadian</td>
																	<td>: {{ $v->incident_area }}</td>
																</tr>
																<tr>
																	<td>Ringkasan Kejadian</td>
																	<td>: {{ $v->summary }}</td>
																</tr>
																<tr>
																	<td>Gambar</td>
																	<td>: <img src="{{ asset('storage/upload/image_citizen/'.$v->image)}}" width="50px" height="50px"></td>
																</tr>
																{{--<tr>
																	<td>Pilih Unit</td>
																	<td>
																	<select class="browser-default" name="participation">
																		@foreach($unit as $v)
																			<option value="{{ $v->id }}" @if(old('unit_id')=="$v->id") selected @endif>{{ $v->name }}</option>
																		@endforeach
																	</select>
																	</td>
																</tr>--}}
															</tbody>
														</table>
														</div>
													</div>
												</div>
														
												</div>
												<div class="modal-footer">
													<button type="submit" class="mb-12 btn waves-effect waves-light green darken-1 btn-small">Proses</button>
													<button type="submit" class="mb-12 btn waves-effect waves-light red darken-1 btn-small">Tolak</button>
												</div>
											</form>
										</div>
										
									@endforeach
									<div class="float-right">{{ $complaint->appends(Request::only('search'))->links() }}</div>
								</div>
							</div>
							</div>
							@endcan
						</div>
						</div>
					</div>
				</div>
			</div>
			<div style="bottom: 90px; right: 19px;" class="fixed-action-btn direction-top">
				@can('tambah-data')
					<a href="{{ url('/'.Request::segment(1).'/create') }}" class="btn-floating btn-large waves-effect waves-light green darken-2"><i class="material-icons">add</i></a>
				@endcan
				<a href="{{ url('/'.Request::segment(1)) }}" class="btn-floating btn-large waves-effect waves-light orange darken-2"><i class="material-icons">refresh</i></a>
			</div>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

@endsection