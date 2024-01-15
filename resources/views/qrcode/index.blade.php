@extends('qrcode.master')
@section('main-container')
    <div class="mb-2 text-center">
        <h1>QR Code Generation Service</h1>
    </div>
    <div class="d-flex justify-content-end m-2">
        <a class="btn btn-lg border border-success" href="/qrcode/create"> Create</a>
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
                    <td>{{$qr_code_history->data }}</td>
                    <td>{{$qr_code_history->created_at}}</td>
                    <td>
                        <a download="{{ asset('qrcodes/'.$qr_code_history->image) }}" href="{{ asset('qrcodes/'.$qr_code_history->image) }}" class="btn btn-xs bg-dark text-white text-xs">Download</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

        </div>

    </div>

@endsection


