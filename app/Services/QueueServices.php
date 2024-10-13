<?php

namespace App\Services;

/**
 * Class QueueServices
 * @package App\Services
 */

use App\Models\User;
use App\Models\UserRole;
use App\Models\Queue;
use App\Models\QueueConfig;
use Auth;

class QueueServices
{
    public function doLoginWilayah($request)
    {
        $kodeWilayah = $request->kode_wilayah;
        $userRole = null;

        try {
            // $user = User::where('wilayah', '=', $kodeWilayah)->first();
            $user = User::with('UserRoles')->whereWilayah($kodeWilayah)->whereHas('UserRoles', function ($query) {
                $query->where('default_role', 'user'); // Adjust 'role' to the actual column name in your userRole table
            })->first();

            if($user){
                $userRole = UserRole::where('user_id', '=', $user->id)->whereDefaultRole('user')->first();
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
        //Check Condition already confirmed  or Not
        if ($user == null || $userRole == null) {
            return redirect()->back()->with('error', 'Wilayah tidak terdaftar !');
        }

        if($user->is_active == false) {
            return redirect()->back()->with('error', 'Wilayah tidak aktif, silahkan menghubungi Administrator !');
        }
        
        // Set Auth Details
        Auth::login($user, true);

        return redirect()->route('antrian.home');
    }

    public function getNumberAntrian($tipeLoket, $kodeWilayah)
    {
        $data = Queue::where('tipe_loket', '=', $tipeLoket)
            ->where('wilayah', '=', $kodeWilayah)
            ->where('tanggal', '=', date('Y-m-d'))
            ->orderBy('number', 'desc')
            ->first();

        if ($data == null) {
            return 1;
        } else {
            return $data->number + 1;
        }
    }
}
