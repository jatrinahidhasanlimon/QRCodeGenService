@extends('qrcode.master')
@section('main-container')
    <div class="mb-2 text-center">
        <h1>QR Code Generation Service</h1>
    </div>
    <div class="card">
        <div class="card-header text-center">
            <h6> Create QR</h6>
        </div>
        <div class="card-body">
            <div class="col-12 d-flex justify-content-center">
                <form action="/qrcode" method="post">
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
                               <option value="with-logo">With Logo</option>
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
                    <div class="form-group row mt-4">
                        <input class="form-control button btn-secondary btn-xs" type="submit">
                    </div>
                </form>

            </div>
            @php
                use SimpleSoftwareIO\QrCode\Facades\QrCode;
                QrCode::backgroundColor(255, 0, 0);
            @endphp
{{--            {!!QrCode::phoneNumber('555-555-5555'); !!}--}}
{{--            {!!QrCode::errorCorrection('H')->generate('Nahid Hasan Limo!'); !!}--}}
{{--            {!!QrCode::generate('Make me into a QrCode!', '../public/qrcodes/qrcode.svg'); !!}--}}
{{--            {!!QrCode::format('png')->generate('Make me into a QrCode!', '../public/qrcodes/second.png'); !!}--}}
{{--            {!!QrCode::format('png')->merge('https://i.ibb.co/wJxxL7q/jatri-logo-19582a96.png', .3, true)->errorCorrection('H')->generate('why this is happening','../public/qrcodes/third.png'); !!}--}}


        </div>

    </div>


    <div class="card">
        <div class="card-header text-center">
            <h6>Generated QR</h6>
        </div>
        <div class="card-body">
        <table class="table text-center">
            <thead>
            <th>SL</th>
            <th>Image</th>
            <th>Data</th>
            <th>Created At</th>
            <th>Download</th>
            </thead>
            <tbody class="text-center">
            @foreach($qr_code_histories as $index=>$qr_code_history)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>
                        <img src="{{ asset('qrcodes/'.$qr_code_history->image) }}">
                    </td>
                    <td>{{ $qr_code_history->data }}</td>
                    <td>{{$qr_code_history->created_at}}</td>
                    <td>
                        <button class="btn btn-xs bg-secondary text-xs">Download</button>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

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
