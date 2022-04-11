<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Province;
use App\Models\Regency;

class RegencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        //
        return $this->respondWithSuccess([
            'regencies' => $id != null ? Regency::where('province_id', $id)->get() : Regency::all(),
        ]);
    }
}
