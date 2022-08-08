<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCustomersRequest;
use App\Imports\CustomersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    public function import(ImportCustomersRequest $request)
    {
        Excel::import(new CustomersImport,$request->file('file'));

        return back();
    }
}
