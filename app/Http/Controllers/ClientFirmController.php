<?php

namespace App\Http\Controllers;

use App\Models\Http\ClientFirm;
use Illuminate\Http\Request;
use Validator, Str, Config, Image;

class ClientFirmController extends Controller
{
    public function getNewClientFirm(){
        return view('pages.client.newclienfirm');
    }
}
