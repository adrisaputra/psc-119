@extends('admin.layout')
@section('konten')
@php
$setting = SiteHelpers::setting();
@endphp

<!-- Styles -->
<style>
#chartdiv {
  width: 60%;
  height: 350px;
}
#chartdiv2 {
  width: 60%;
  height: 500px;
}
#chartdiv3 {
  width: 100%;
  height: 500px;
}


</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- ## Grafik Pie -->
    <script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_material);
    am4core.useTheme(am4themes_animated);
    am4core.addLicense("ch-custom-attribution");

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartdiv3", am4charts.PieChart);

    // Add data
    chart.data = [ {
      "country": "Telepon Langsung",
      "litres": {{ $phone }},
      "color": am4core.color("#ffcc00")
    }, {
      "country": "Button Emergency",
      "litres": {{ $emergency }},
      "color": am4core.color("#e5011c"),
    },{
      "country": "Form Aduan",
      "litres": {{ $complaint }},
      "color": am4core.color("#009900"),
    }
    ];

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.propertyFields.fill = "color";
    pieSeries.slices.template.strokeOpacity = 1;

    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

    chart.hiddenState.properties.radius = am4core.percent(0);

    
    chart.legend = new am4charts.Legend();

    }); // end am4core.ready()
    </script>

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
										<div class="col s12">
											<div class="input-field col s12 m5 l3">
											@php
												$d = substr(request()->get('date_start'),3,2);
												$m = substr(request()->get('date_start'),0,2);
												$y = substr(request()->get('date_start'),6,4);
												if(request()->get('date_start')){
													$date_start = $d.'-'.$m.'-'.$y;
												} else {
													$date_start = "";
												}
											@endphp
												<label for="date_start">{{ __('Dari Tanggal') }}</label>
												<input type="text" class="datepicker" id="date_start" name="date_start" value="@if(request()->get('date_start')) {{ $date_start }} @endif">
											</div>
											<div class="input-field col s12 m5 l3">
											@php
												$d = substr(request()->get('date_end'),3,2);
												$m = substr(request()->get('date_end'),0,2);
												$y = substr(request()->get('date_end'),6,4);
												if(request()->get('date_end')){
													$date_end = $d.'-'.$m.'-'.$y;
												} else {
													$date_end = "";
												}
											@endphp
												<label for="date_end">{{ __('Sampai Tanggal') }}</label>
												<input type="text" class="datepicker2" id="date_end" name="date_end" value="@if(request()->get('date_end')) {{ $date_end }} @endif">
											</div>
											<div class="input-field col s12 m5 l4">
												<select class="browser-default" name="category_id">
													<option value="">- Pilih Kategori -</option>
													<option value="">Semua Kategori</option>
													@foreach($category as $v)
														<option value="{{ $v->id }}" @if(request()->get('category_id')=="$v->id") selected @endif>{{ $v->name }}</option>
													@endforeach
												</select>
											</div>
											
											<div class="input-field col s12 m2 l2" style="padding-top:10px">
												<button type="submit" class="mb-12 btn waves-effect waves-light blue darken-1 btn-medium" >Lihat&nbsp;Data</button>
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