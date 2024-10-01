<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controller;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon; // Import Carbon for handling dates


class UserController extends BaseController
{
  /*  public function updateOtp(Request $request, $userId)
    {
        // Validate the request
        $request->validate([
            'otp' => 'required|string',
        ]);

        // Find the user
        $user = User::find($userId);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Update the OTP
        $user->otp = $request->otp;
        $user->save();

        return response()->json(['success' => true, 'message' => 'OTP updated successfully']);
    } */

    public function updateToken(Request $request, $userId)
    {
        \Log::info('Request Data:', $request->all());

        // Validate the request
        $request->validate([
            'token' => 'required|string',
        ]);

        // Find the user
        $user = User::find($userId);
        
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        // Update the token
        $user->api_token = $request->token; // Assuming 'api_token' is the column name
        $user->save();

        return response()->json(['success' => true, 'message' => 'Token updated successfully']);
    }

    public function loginOrRegister(Request $request)
    {
        $request->validate([
            'mobile' => 'required|digits:10',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);

         // Set OTP expiration time (e.g., 5 minutes from now)
    $otp_expires_at = now()->addMinutes(5);


     /*   $user = User::where(
            ['mobile' => $request->mobile],
            [
                'otp' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(5) // OTP valid for 5 minutes
            ]
        );    */

        // Check if user exists
        $user = User::where('mobile', $request->mobile)->first();

        if (!$user) {
            // Register the user if not found
          /*  $user = User::create([
                'mobile' => $request->mobile,
                'otp' => $otp,

            ]); */

            // Create the user if not found
      //  $user = User::create([
         /*  'mobile' => $validatedData['mobile'],
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'usertype' => $validatedData['usertype'],
            'status' => 1, // Default to active
            'createdBy' => $validatedData['createdBy'], // From request or system 
            'mobile' => $request->mobile,
            'otp' => $otp, // Include OTP if needed
        ]); */

      /*  $validated = $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'nullable|string|max:50|unique:users',
            'email' => 'nullable|email|unique:users',
            'mobile' => 'nullable|string|max:20',
            'usertype' => 'nullable|string|max:5',
            'encpassword' => 'required|string',
            'createdBy' => 'required|string|max:5',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password), // Encrypt the password
            'usertype' => '0', // Default user type
            'emailVerified' => 1, // Default email verification status
            'phoneVerified' => 1, // Default phone verification status
            'status' => 1, // Default status
            'createdBy' => '1', // Example default created by user ID
            // Add other default values as needed...
        ]);

        // Assuming you're using the User model to create a new user.
/*$user = User::create([
    'name' => $request->name,
    'username' => $request->mobile,
    'email' => $request->email,
    'mobile' => $request->mobile,
    'usertype' => $request->usertype,
    'HosId' => $request->HosId,
    'BlockId' => $request->BlockId,
    'PhcId' => $request->PhcId,
    'HscId' => $request->HscId,
    'PanchayatId' => $request->PanchayatId,
    'VillageId' => $request->VillageId,
    'password' => $request->otp,
    'otp' => $otp,
    'createdBy' => auth()->user() ? auth()->user()->id : null, // Handle null case
 //   'createdBy' => auth()->user()->id, // Set the `createdBy` field with the ID of the logged-in user
]); */
$user = User::create([
    'name' => 'Mobile User', // You can customize this as needed
    'username' => $request->mobile,
    'email' => $request->email,
    'mobile' => $request->mobile,
    'usertype' => '6',    
    'HosId' => $request->HosId,
    'BlockId' => $request->BlockId,
    'PhcId' => $request->PhcId,
    'HscId' => $request->HscId,
    'PanchayatId' => $request->PanchayatId,
    'VillageId' => $request->VillageId,
    'password' => $otp, // Store the hashed OTP
    'encpassword' => bcrypt($request->otp),
    'emailVerified' => 0, // Default value for email verification
    'phoneVerified' => 1, // Assume mobile verification is done
    'status' => 1, // Active user
    'otp' => $otp,
    'otp_expires_at' => $otp_expires_at,
   //'createdBy' => $username, // Assuming this is created by a system process
    'createdBy' => 'MUser',
 /*  if (!isset($validatedData['createdBy'])) {
    $validatedData['createdBy'] = str_pad((string)(auth()->user()->id ?? 1), 5, "0", STR_PAD_LEFT);
} */
]);

        } else {
            // Update OTP if user exists
            $user->update([
                'otp' => $otp,
                'otp_expires_at' => $otp_expires_at
            ]);
        }

        // Return success with OTP (in a real-world application, send via SMS)
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'data' => ['otp' => $otp]
        ]);
    }


    public function verifyOtp(Request $request)
    {
        
        $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('mobile', $request->mobile)->where('otp', $request->otp)->first();           

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP',
            ], 401);
        }

       // if (now()->greaterThan($user->otp_expires_at)) {
        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired.',
            ], 400);
        }
        
        // Generate API token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Update the user token in the database
        $user->token = $token; // Assuming 'api_token' is the column name
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => ['token' => $token]
        ]);
    }
}
