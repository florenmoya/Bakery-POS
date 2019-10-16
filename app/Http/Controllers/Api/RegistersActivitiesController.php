<?php

namespace App\Http\Controllers\Api;

use App\RegistersActivities;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistersActivitiesController extends Controller
{
    
    public function select(Request $request)

    {

        $latest = RegistersActivities::where('company_id', $request->user()->company_id)->latest('created_at')->first();
        return response($latest); 
        
    }

    public function store(Request $request)
    { 		
        $item = new RegistersActivities;

        $item->starting_amount = $request->starting_amount;
        $item->starting_user = $request->user()->id;
        $item->company_id = $request->user()->company_id;

        $item->save();

        return response('Register have been created!', 201);
    }

        public function update(Request $request){

        	$latest = RegistersActivities::where('company_id', $request->user()->company_id)->latest('created_at')->first();
            if($latest->released_amount){ 
                return response('Error', 401);
            }
    		$update = RegistersActivities::where('id', $latest->id)
            ->update(['released_amount' => $request->released_amount, 'released_user' => $request->user()->id]);
            return $update;
        }

        public function destroy(Request $request)
        {
            RegistersActivities::findOrFail($request->id)->delete();
            return response('Item have been deleted!', 201);
        }
	}
