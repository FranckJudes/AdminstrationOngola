@extends('Master.main')

@section('content')
<section class="section">

    <section class="section">
        <div class="row ">
            <div id="id_edition" onclick="event.preventDefault();default_password_livreurs();"
            class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
           <div class="card derd">
               <div class="card-statistic-4">
                   <div class="align-items-center justify-content-between">
                       <div class="row ">
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                               <div class="card-content">
                                   <h5 class="font-15"> Parametrage de mot de passe</h5>
                               </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                               <div class="banner-img">
                                <img src="assets/img/banner/5.png"  style="height:141px;" alt="">

                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>



        </div>


</section>
@endsection

@section('scripts')

    <script>
         function default_password_livreurs(){
            window.location.href = "{{ route('livreur_password') }}";
        }
    </script>

@endsection
