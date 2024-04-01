<?php

namespace App\Traits;

trait HttpResponses {
    protected function success($data, $message = null, $code = 200) {
        return response()->json([
            'status' => true,
            'message' => $message,
            'details' => $data
        ], $code);
    }

    protected function error($data, $message = null, $code = 500) {
       
        return response()->json([
            'status' => false,
            'message' => $message,
            'details' => $data
        ], $code);
    }
}