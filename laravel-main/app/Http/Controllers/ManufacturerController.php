<?php

namespace App\Http\Controllers;

use App\Models\Manufacturers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManufacturerController extends Controller
{
    public function show(int $id)
    {
        $manufacturers = DB::table('manufacturers')
            ->leftJoin('manufacturers', 'manufacturers_id', '=', 'manufacturers.id')
            ->where('manufacturers.id', '=', $id)
            ->get();
        return view('manufacturers.show', ['manufacturers' => $manufacturers]);
    }
}
