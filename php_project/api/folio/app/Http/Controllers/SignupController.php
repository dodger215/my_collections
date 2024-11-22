<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SignupController extends Controller
{
    public function store(Request $request)
    {
        // Generate a unique ID for the user
        $user_id = Str::uuid();

        // Validate incoming request data
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'required|numeric',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Hash the password
        $validatedData['password'] = Hash::make($request->password);

        // Add the user_id to the validated data
        $validatedData['id'] = $user_id;

        // Specify the file path for storage
        $filePath = 'users.json';

        // Retrieve existing data if the file exists
        $existingData = [];
        if (Storage::exists($filePath)) {
            $existingData = json_decode(Storage::get($filePath), true);
        }

        // Append new user data
        $existingData[] = $validatedData;

        // Store the updated data back into the JSON file
        Storage::put($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

        // Return a success response
        return response()->json(['message' => 'Data stored successfully!', 'user_id' => $user_id]);
    }
}
