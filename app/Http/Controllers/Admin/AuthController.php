<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordChangeRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\SignInRequest;
use App\Http\Requests\Admin\UpdateProfile;
use App\Mail\ResetPassword;
use App\Models\PortalUser;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->primary_model = new PortalUser();
        $this->module_name = 'auth';
        $this->module_directory = 'admin_panel';
    }

    public function login()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__);
    }

    public function authenticate(SignInRequest $request)
    {
        if (Auth::guard(config('constants.ADMIN_GUARD_NAME'))->attempt($request->validated(), $request->has('remember_me'))) {
            $request->session()->regenerate();
            return redirect()->route('admin_dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function forgotPassword()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__));
    }

    public function forgotPasswordRequest(ForgotPasswordRequest $request)
    {
        $user = $this->primary_model->where('email', $request->email)->first();

        $token = Str::random(60);

        $user->update(['remember_token' => $token]);

        Mail::to($request->email)->send(new ResetPassword($user->name, $token));

        if(Mail::failures() != 0) {

            $request->session()->flash('success', 'Success! password reset link has been sent to your email');

            return back();

        }

        return back()->withErrors(['email' => 'Failed! there is some issue with email provider']);
    }

    public function verifyEmail($token)
    {
        $user = $this->primary_model->where('remember_token',$token)->count();

        if (!$user){
            abort(403);
        }

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), ['token' => $token]);
    }

    public function forgotPasswordChangeRequest(ForgotPasswordChangeRequest $request)
    {
        $user = $this->primary_model->where('remember_token',$request->token)->where('email',$request->email)->first();

        $user->update(['password' => bcrypt($request->password) , 'remember_token' => '']);

        return redirect()->route('admin_login');
    }

    public function logout()
    {
        Auth::guard(config('constants.ADMIN_GUARD_NAME'))->logout();

        return redirect()->route(config('constants.ADMIN_PREFIX') . 'login');
    }

    public function updateProfile()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), ['page_title' => 'Update Profile']);
    }

    public function updateProfileRequest(UpdateProfile $request)
    {
        $this->primary_model->updateProfile($request->all(), auth()->guard(config('constants.ADMIN_GUARD_NAME'))->id());

        $request->session()->flash('success', 'Profile updated');

        return back();
    }
}
