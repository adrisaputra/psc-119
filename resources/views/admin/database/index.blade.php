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

											<a href="{{ url('/backup_database') }}" class="btn btn-flat btn-primary">Back Up Database</a>
			<a href="#" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modalDetail">Import Database</a>
			<form action="{{ url('/import_database') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
               {{ csrf_field() }}
				<div class="modal fade" id="modalDetail">
					<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Import SQL</h4>
						</div>
						<div class="modal-body">
							<b>File SQL</b>
							<input type="file" class="form-control" placeholder="File SQL" name="file_sql" required>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
					<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				<!-- /.modal -->
			</form>
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