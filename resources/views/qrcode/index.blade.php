@extends('qrcode.master')
@section('main-container')
    <h1>From Index Page</h1>
    <div class="card">
        <div class="card-header text-center">
            <h6> Create QR</h6>

        </div>
        <div class="card-body">
            @php
                use SimpleSoftwareIO\QrCode\Facades\QrCode;
                QrCode::backgroundColor(255, 0, 0);
            @endphp
            {!!QrCode::phoneNumber('555-555-5555'); !!}
{{--            {!!QrCode::errorCorrection('H')->generate('Nahid Hasan Limo!'); !!}--}}
{{--            {!!QrCode::generate('Make me into a QrCode!', '../public/qrcodes/qrcode.svg'); !!}--}}
{{--            {!!QrCode::format('png')->generate('Make me into a QrCode!', '../public/qrcodes/second.png'); !!}--}}
{{--            {!!QrCode::format('png')->merge('https://i.ibb.co/wJxxL7q/jatri-logo-19582a96.png', .3, true)->errorCorrection('H')->generate('why this is happening','../public/qrcodes/third.png'); !!}--}}


        </div>

    </div>

@endsection
