<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QRCodeHistory;
use SimpleSoftwareIO\QrCode\Generator;


class QRCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(QrCode::generate('Make me into a QrCode!'));

        $qr_code_histories = QRCodeHistory::orderBy('created_at', 'desc')->get();
        return view('qrcode.index', compact('qr_code_histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function stringToRGB($str)
    {
        return array_map(function ($item) {
            return (int)($item);
        }, explode(',', $str));
    }

    public function store(Request $request)
    {
        $qrGen            = new Generator;
        $qr_upload_dir    = '../public/qrcodes/';
        $qr_name          = uniqid() . '.svg';
        $qr_img_full_path = $qr_upload_dir . $qr_name;
        $rgb_arr          = [255, 0, 0];

        if ($request['qr_option'] == 'with-logo') {
            $qr_name          = uniqid() . '.png';
            $qr_img_full_path = $qr_upload_dir . $qr_name;
            $qrGen->format('png')
                  ->merge('https://i.ibb.co/wJxxL7q/jatri-logo-19582a96.png', .3, true)
                  ->errorCorrection('H');
        }

        if ($request['qr_option'] == 'background-color') {
            if ($request['custom-value']) {
                $rgb_arr = $this->stringToRGB($request['custom-value']);
            }
            if (count($rgb_arr) == 3) {
                $qrGen->backgroundColor($rgb_arr[0], $rgb_arr[1], $rgb_arr[2]);
            }
            if (count($rgb_arr) == 4) {
                $qrGen->backgroundColor($rgb_arr[0], $rgb_arr[1], $rgb_arr[2], $rgb_arr[3]);
            }

            $qrGen->backgroundColor($rgb_arr[0], $rgb_arr[1], $rgb_arr[2]);
        }

        if ($request['qr_option'] == 'color') {
            if ($request['custom-value']) {
                $rgb_arr = $this->stringToRGB($request['custom-value']);
            }
            if (count($rgb_arr) == 3) {
                $qrGen->color($rgb_arr[0], $rgb_arr[1], $rgb_arr[2]);
            }
            if (count($rgb_arr) == 4) {
                $qrGen->color($rgb_arr[0], $rgb_arr[1], $rgb_arr[2], $rgb_arr[3]);
            }
        }
        if ($request['qr_option'] == 'eye-color') {

            if ($request['custom-value']) {
                $rgb_arr = $this->stringToRGB($request['custom-value']);
//                dd($rgb_arr);
                $qrGen->eyeColor($rgb_arr[0], $rgb_arr[1], $rgb_arr[2], $rgb_arr[3], $rgb_arr[4], $rgb_arr[5], $rgb_arr[6]);
//
            }

//            $qrGen->eyeColor(0, 70, 70, 89, 0, 0, 0);


        }

        if (isset($request['size'])) {
            if ($request['size'] > 50 && $request['size'] <= 500) {
                $qrGen->size($request['size']);
            }
        }

//        $qrGen->eyeColor(0, 255, 255, 255, 0, 0, 0);
//        $qrGen->eyeColor(0, 255,160,122, 0, 0, 0);
//        $qrGen->style('dot');
        $qrGen->generate($request->qr_data, $qr_img_full_path);

        $qr_code_history        = new QRCodeHistory();
        $qr_code_history->data  = $request->qr_data;
        $qr_code_history->image = $qr_name;
        $qr_code_history->save();

        $qr_code_histories = QRCodeHistory::orderBy('created_at', 'desc')->get();
        return view('qrcode.index', compact('qr_code_histories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
