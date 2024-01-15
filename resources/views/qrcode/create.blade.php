@extends('qrcode.master')
@section('main-container')
    <div class="row card-header mb-4 text-center">
      <div class="col-sm-8">
          <h4>QR Code Create</h4>
      </div>
        <div class="col-sm-4">
            <a class="btn btn-lg border border-info" href="/qrcode"> See All</a>
      </div>

    </div>
   <div class="row">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header text-center">
                   <h6> Create QR</h6>
               </div>
               <div class="card-body">
                   <div class="col-md-12 p-4">
                       <form action="/qrcode/store" method="post">
                           @csrf

                           <div class="form-group row">
                               <label for="qr_data" class="col-sm-4 col-form-label">Data</label>
                               <div class="col-sm-8">
                                   <textarea required class="form-control" name="qr_data" id="qr_data" cols="28" rows="5"></textarea>
                               </div>
                           </div>
                           <div class="form-group row mt-2">
                               <label for="qr_option" class="col-sm-4 col-form-label">Size [df 100]</label>
                               <div class="col-sm-8">
                                   <input placeholder="enter size between 50 to 500 default 100 " class="form-control" type="text" name="size">
                               </div>
                           </div>

                           <div class="form-group row mt-2">
                               <label for="qr_option" class="col-sm-4 col-form-label">Option</label>
                               <div class="col-sm-8">
                                   <select name="qr_option" id="qr_option" class="form-control">
                                       <option value="default">Default</option>
                                       <option value="background-color">Background color</option>
                                       <option value="color">Color</option>
                                       <option value="dot">Dot</option>
                                       <option value="eye-color">Eye Color</option>
                                   </select>
                               </div>
                           </div>

                           <div class="form-group row mt-2" id="custom_value_div">
                               <label for="qr_option" class="col-sm-4 col-form-label">Custom Value</label>
                               <div class="col-sm-8">
                                   <input placeholder="enter custom value if needed" class="form-control" type="text" name="custom-value">
                               </div>
                           </div>
                           <div class="form-check">
                               <input class="form-check-input" name="with_logo" type="checkbox" value="with_logo" id="with_logo">
                               <label class="form-check-label" for="with_logo">
                                   With Logo
                               </label>
                           </div>
                           <div class="mt-4 d-flex  justify-content-center">
                               <div class="d-flex  justify-content-center">
                                   <input class="form-control button btn-success btn-lg" type="submit">
                               </div>
                           </div>
                       </form>

                   </div>

               </div>

           </div>
       </div>
       <div class="col-md-4">
         <div class="col">
             <h4>Preview After Store</h4>
             @if( Session::get('qr_code_history'))
                 <img src="{{ asset('qrcodes/'.Session::get('qr_code_history')->image) }}">

             @endif
         </div>

       </div>

   </div>


@endsection
@section('custom-script')
    <script>
        $(document).ready(function() {
            $('#custom_value_div').hide();
        });
        $('#qr_option').on('change', function() {
            if(this.value === 'background-color' || this.value === 'color' || this.value === 'eye-color'){
                $('#custom_value_div').show();
            }else{
                $('#custom_value_div').hide();
            }

        });

    </script>
@endsection
