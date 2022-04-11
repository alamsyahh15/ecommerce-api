<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $this->respondWithSuccess([
            'address' =>  Address::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        //

        $validatedData =  $this->validate($request, [
            'title' => ['required', 'string'],
            'province_id' => ['required', 'numeric'],
            'regency_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],

        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                // save address data
                $validatedData['user_id'] = auth()->user()->id;
                $address = Address::create($validatedData);
            });

            return $this->respondWithSuccess([
                'message' => 'Berhasil membuat address'
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }


    public function update(Request $request)
    {
        //

        $validatedData =  $this->validate($request, [
            'id' => ['required', 'numeric'],
            'title' => ['nullable', 'string'],
            'province_id' => ['nullable', 'numeric'],
            'regency_id' => ['nullable', 'numeric'],
            'district_id' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],

        ]);


        try {

            $address = Address::find($validatedData['id']);
            $address->update($validatedData);

            return $this->respondWithSuccess([
                'message' => 'Success update',
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validatedData =  $this->validate($request, [
            'id' => ['required', 'numeric'],
        ]);


        try {

            Address::find($validatedData['id'])->delete();
            return $this->respondWithSuccess([
                'message' => 'Success delete',
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }
}
