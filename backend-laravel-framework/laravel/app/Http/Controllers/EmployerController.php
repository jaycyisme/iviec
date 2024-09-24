<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function selectCompany(Request $request) {
        $request->validate([
            'company_id' => 'required|integer',
        ]);

        $request->session()->put('company_id', $request->company_id);
        return $this->apiResponse();
    }


    public function apiResponse($data = null, $status = true, $status_code = 200, $message = null) {
        return response()->json([
            'data' => $data,
            'status' => $data = null ? false : $status,
            'status_code' => $data = null ? 404 : $status_code,
            'message' => $data = null ? 'Không tìm thấy dữ liệu' : $message,
        ]);
    }
}
