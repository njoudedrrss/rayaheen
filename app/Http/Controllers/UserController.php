<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Password; // Add this line
use Illuminate\Support\Facades\Mail;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Mail\VerificationCodeMail; // Import the VerificationCodeMail class

class UserController extends Controller
{

        

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
                        'phone' => 'sometimes|string|max:20', // Add this line

        ]);
       
              $verificationCode = rand(100000, 999999);
          $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? '', // Add this line
            'password' => Hash::make($request->password),
                        'email_verification_code' => $verificationCode,
        ]);
          //      Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));



     //   $user->notify(new VerifyEmailNotification());
    
        return response()->json(['message' => 'User registered successfully'], 200);
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
          //  throw ValidationException::withMessages([
            //    'email' => ['The provided credentials are incorrect.'],
            //]);

         return response()->json(['message'=>'false'],302);

        }
        
        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token,'message'=>'true', 'token_type' => 'Bearer'], 200);
     
     
     
      }
    public function editprofile()
    {
        return response()->json(['message'=>'Edit Profile successful'],200);
    }

    // Handle logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
 public function indexweb(){

     $users = User::all();
        return view('user.index', compact('users'));}
public function edit()
{
    return 'edit';
}
public function cart(User $user )
{
            $cart = Cart::where('user_id',$user->id)->with('items.book')->first();

if(!$cart)
{     $users = User::all();

    return view('user.index',compact('users'));
}
$cartitem=$cart->items;
return view('user.cart',compact ('cartitem')); 

}
   /*  public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
   print($user);
                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? response()->json(['message' => __($status)], 200)
                    : response()->json(['message' => __($status)], 400);
    }

public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => __($status)], 200)
                    : response()->json(['message' => __($status)], 400);
    }*/
}


