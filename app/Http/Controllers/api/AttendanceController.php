<?php

namespace App\Http\Controllers\Api;

use App\Models\attandences;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkIn(Request $request){

        $request->validate([
            'latitude'      => 'required',
            'longtitude'    => 'required',
        ]);

        DB::beginTransaction();
        try {

            $result     = attandences::create([
                'latlong_in'    => $request->latitude.','.$request->longitude,
                'time_in'       => date('H:i:s'),
                'date'          => date('Y-m-d'),
                'user_id'       => $request->user()->id
            ]);
            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'Checkin Success',
                'data'      => $result
            ],200);

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success'   => false,
                'message'   => 'Checkin Field',
            ],200);

        }

    }

    public function checkOut(Request $request){
        $request->validate([
            'latitude'      => 'required',
            'longtitude'    => 'required',
        ]);

        DB::beginTransaction();
        try {
            attandences::where('user_id',$request->user()->id)->where('date',date('Y-m-d'))->update([
                'latlong_out'    => $request->latitude.','.$request->longitude,
                'time_out'       => date('H:i:s'),
            ]);
            DB::commit();

            return response()->json([
                'success'   => true,
                'message'   => 'CheckOut Success',
            ],200);

        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success'   => false,
                'message'   => 'CheckOut Field',
            ],200);

        }

    }

    public function isCheckedIn(Request $request){
        $check = attandences::where('user_id',$request->user()->id)->where('date',date('Y-m-d'))->first();
        return response()->json([
            'checkedIn' =>$check? true: false,
        ],200);
    }

   
}
