<?php

namespace App\Http\Controllers\Api;

use App\Companies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    public function all(Request $request)
    {

        $data = Companies::get();
        return response($data); 

    }

    public function store(Request $request)
    {

        $item = new Companies;

        $item->name = $request->company_name;
        $item->address = $request->company_address;
        $item->city = $request->company_city;
        $item->region = $request->company_region;
        $item->zip_code = $request->company_zip_code;
        $item->phone = $request->company_phone;

        $item->save();

        return response('Company Created', 201);
        
    }
    public function update(Request $request)
    {
        $update = Companies::where('id', $request->id)
                ->update([
            'name' => $request->company_name,
            'address' => $request->company_address,
            'city' => $request->company_city,
            'region' => $request->company_region,
            'zip_code' => $request->company_zip_code,
            'phone' => $request->company_phone,
    ]);
        return response($update);
    }
    public function destroy(Request $request)
    {
        Companies::findOrFail($request->id)->delete();
        return response('Company have been deleted!', 201);
    }
}
