@extends('admin/layout')
@section('konten')

<script src="{{ asset('/js/jquery.js') }}"></script>
<script src="{{ asset('/js/bootstrap.js') }}"></script>

<!-- BEGIN: Page Main-->
<div id="main">
   <div class="row">
   <div class="content-wrapper-before gradient-45deg-light-blue-cyan"></div>
      <div class="col s12">
         <div class="container">
            <div class="section">
               <!-- Current balance & total transactions cards-->
               <div class="row vertical-modern-dashboard">
                  <div class="col s12 m12 l12">
                     <!-- Current Balance -->
                     <p class="animate fadeUp " style="font-size:28px;font-weight:bold;color:white;margin-top: -20px;margin-bottom: 10px;">Selamat Datang Di PSC 119 Dinas Kesehatan Kota Baubau </p>
                     <!-- card stats start -->
                     <div id="card-stats" class="pt-0">
                        <div class="row">
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp ">
                                 <div class="card-content blue white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-briefcase"></i> Kejadian Hari Ini</p>
                                    <p style="font-size:40px">{{ $complaint }}</p>
                                 </div>
                                 <div class="card-action blue darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp ">
                                 <div class="card-content orange accent-2 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-sync"></i> Belum ditanggapi</p>
                                    <p style="font-size:40px">{{ $complaint_request }}</p>
                                 </div>
                                 <div class="card-action orange darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp delay-1">
                                 <div class="card-content green lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-check"></i> Selesai</p>
                                    <p style="font-size:40px">{{ $complaint_done }}</p>
                                 </div>
                                 <div class="card-action green">
                                    <div id="sales-compositebar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m3 l3">
                              <div class="card animate fadeUp delay-2">
                                 <div class="card-content red lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-close"></i> Tolak</p>
                                    <p style="font-size:40px">{{ $complaint_reject }}</p>
                                 </div>
                                 <div class="card-action red">
                                    <div id="invoice-line" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--card stats end-->
                     <!-- card stats start -->
                     <div id="card-stats" class="pt-0">
                        <div class="row">
                           <div class="col s12 m4 l4">
                              <div class="card animate fadeUp ">
                                 <div class="card-content orange accent-2 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-sync"></i> Emergency Button</p>
                                    <p style="font-size:40px">{{ $emergency_button }}</p>
                                 </div>
                                 <div class="card-action orange darken-1">
                                    <div id="clients-bar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m4 l4">
                              <div class="card animate fadeUp delay-1">
                                 <div class="card-content green lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-check"></i> Telepon 119</p>
                                    <p style="font-size:40px">{{ $phone }}</p>
                                 </div>
                                 <div class="card-action green">
                                    <div id="sales-compositebar" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col s12 m4 l4">
                              <div class="card animate fadeUp delay-2">
                                 <div class="card-content red lighten-1 white-text">
                                    <p style="font-size:20px;padding-bottom:13px;padding-top:10px"><i class="fa fa-close"></i> Aduan Pesan</p>
                                    <p style="font-size:40px">{{ $request }}</p>
                                 </div>
                                 <div class="card-action red">
                                    <div id="invoice-line" class="center-align"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--card stats end-->
                  </div>
               </div>
               <!--/ Current balance & total transactions cards-->

            </div>
         </div>
      </div>
   </div>
</div>
  
@endsection