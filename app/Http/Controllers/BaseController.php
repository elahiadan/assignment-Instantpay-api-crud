<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($data, $msg = "", $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $msg
        ];
        return response()->json($response, $code);
    }

    public function sendError($err, $code = 404, $errMsg = [])
    {
        $response = [
            'success' => false,
            'message' => $err
        ];

        if (!empty($errMsg)) {
            $response['errors'] = $errMsg;
        }
        return response()->json($response, $code);
    }
}
