<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/select2-materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/animate-css/animate.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/vertical-modern-menu-template/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/form-select2.css') }}">
    <!-- END: Custom CSS-->

</head>
<div id="officer">
     <p>{{ __('Petugas') }}</p>
     <select class="select2 browser-default" name="officer_id" id="officer_id">
	<option value="">- Pilih Petugas -</option>
		@foreach($officer as $v)
			<option value="{{ $v->id }}" @if(old('officer_id')=="$v->id") selected @endif>{{ $v->name }}</option>
		@endforeach
     </select>
</div>
										
										
										
 
<script src="{{ asset('assets/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/vendors/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts/form-select2.js') }}"></script>