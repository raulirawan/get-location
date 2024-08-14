<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();

        return view('location.index', compact('locations'));
    }

    public function postLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'latt' => 'required',
            'long' => 'required',
        ]);

        $data = $validator->validated();
        $userAgent = $request->header('User-Agent');
        $device = $this->getDevice($userAgent);
        $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
        $data['device'] = $device;


        Location::create($data);
    }

    private function getDevice($userAgent)
    {
        if (strpos($userAgent, 'Mobile') !== false) {
            if (strpos($userAgent, 'Android') !== false) {
                return 'Android';
            } elseif (strpos($userAgent, 'iPhone') !== false) {
                return 'iPhone';
            } elseif (strpos($userAgent, 'iPad') !== false) {
                return 'iPad';
            }
            return 'Mobile Device';
        }

        if (strpos($userAgent, 'Windows NT') !== false) {
            return 'Windows PC';
        } elseif (strpos($userAgent, 'Mac OS X') !== false) {
            return 'Mac';
        } elseif (strpos($userAgent, 'Linux') !== false) {
            return 'Linux PC';
        }

        return 'Unknown Device';
    }
}
