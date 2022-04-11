<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Authl;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validatedData =  $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'string'],
            'photo' => ['required', 'file'],
            'province_id' => ['required', 'numeric'],
            'regency_id' => ['required', 'numeric'],
            'district_id' => ['required', 'numeric'],
            'description' => ['required', 'string'],

        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                // save user data
                $validatedData['photo'] = $this->storeFileToPublic($validatedData['photo']);
                $validatedData['password'] = Hash::make($validatedData['password']);
                $user = User::create($validatedData);

                // save user's address
                $user->addresses()->create([
                    'province_id' => $validatedData['province_id'],
                    'regency_id' => $validatedData['regency_id'],
                    'district_id' => $validatedData['district_id'],
                    'title' => $validatedData['name'],
                    'description' => $validatedData['description'],
                ]);
            });

            return $this->respondWithSuccess([
                'message' => 'Berhasil registrasi User'
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->respondWithSuccess([
            'user' => Auth::user()->load('addresses'),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        $validatedData =  $this->validate($request, [
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'unique:users,email'],
            'password' => ['nullable', 'string'],
            'photo' => ['nullable', 'file'],
        ]);

        try {
            if (isset($validatedData['photo'])) {
                $validatedData['photo'] = $this->storeFileToPublic($validatedData['photo']);
            }
            if (isset($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }
            Auth::user()->update($validatedData);

            return $this->respondWithSuccess([
                'message' => 'Berhasil registrasi User'
            ]);
        } catch (\Exception $e) {
            report($e);

            return $this->respondError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroySession(Request $request)
    {
        //
        $request->user()->update(['fcm_token' => null]);
        // delete bearer token
        $request->user()->tokens()->delete();

        return $this->respondWithSuccess([
            'message' => 'User Berhasil Logout'
        ]);
    }


    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::firstWhere('email', $request->email);
        if (isset($user)) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->plainTextToken;
                $user->addresses->first();


                return $this->respondWithSuccess([
                    'message' => 'User login berhasil',
                    'token' => $token,
                    'user' => $user
                ]);
            }
        }
        return $this->respondError('Email atau password tidak sesuai');
    }
}
