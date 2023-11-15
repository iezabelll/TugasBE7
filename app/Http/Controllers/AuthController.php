<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataArray = [
            [
                'nama' => 'Rahul muzammil',
                'nomor_telepon' => '123456789',
                'email' => 'muzammil@gmail.com'
            ],
            [
                'nama' => 'eza',
                'nomor_telepon' => '987654321',
                'email' => 'eza@gmail.com'
            ],
        ];
    
        $data = [
            'message' => 'Data Array Contoh',
            'data' => $dataArray
        ];
    
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    
    # Membuat fitur Register
    public function register(Request $request) { 
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully'
        ];

        return response()->json($data, 200);
        }

        
    #Membuat fitur Login
    public function login (Request $request) { 
        #Menangkap input user
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        #Mengambil data user (DB)
        $user = User::where('email', $input['email'])->first();

        #Membandingkan input user dengan data user (DB) 
        $isLoginSuccessfully = (
            $input['email'] == $user->email
            &&
            Hash::check($input['password'], $user->password)
        );

        if ($isLoginSuccessfully) {
        #Membuat token
        $token = $user->createToken('auth_token');

        $data = [
            'message' => 'Login successfully', 
            'token' => $token->plainTextToken
        ];
    
        #Mengembalikan response JSON
        return response()->json($data, 200);
        } else { 
            $data = [
            'message' => 'Username or Password is wrong'
        ];
        
        return response()->json($data, 401);
        }
    }
}