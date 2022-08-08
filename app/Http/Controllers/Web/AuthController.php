<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordChangeRequest;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Web\Auth\Signin;
use App\Http\Requests\Web\Auth\Signup;
use App\Http\Requests\Web\Auth\\UpdateProfile;
use App\Mail\NewStoreManagerMail;
use App\Mail\ResetPassword;
use App\Models\ApplicationSetting;
use App\Models\Cart;
use App\Models\Email;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\PortalUser;
use App\Models\PortalUserAddress;
use App\Models\Store;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->module_name = 'auth';
        $this->primary_model = new PortalUser();
        $this->address_model = new PortalUserAddress();
        $this->store_model = new Store();
        $this->order_model = new Order();
        $this->invoice_model = new Invoice();
        $this->cart_model = new Cart();
    }

    public function login()
    {
        $this->dataAssign['page_title'] = "Login";

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->dataAssign);
    }

    public function account()
    {
        $this->dataAssign['page_title'] = "Account";

        $this->dataAssign['body_class'] = "my-account";

        $this->dataAssign['close_dropdown'] = true;

        if (strtolower(getLoggedInUser()->user_type) == 'manager') {

            $this->dataAssign['orders'] = $this->order_model->with(['products'])->where('store_id', getLoggedInUser()->store_id)->get();

        }else{

            $this->dataAssign['orders'] = $this->order_model->with(['products'])->where('user_id', getLoggedInUser()->id)->get();

        }

        $this->dataAssign['invoices'] = $this->invoice_model->with(['products'])->where('invoice_customer', getLoggedInUser()->store_id)->orderBy('created_at', 'desc')->get();

        $this->dataAssign['saved_carts'] = $this->cart_model->getSavedCarts();

        return view($this->module_directory . '.' . $this->module_name . '.' . __FUNCTION__, $this->dataAssign);
    }

    public function signup(Signup $request)
    {
        $request->merge([
            'role_slug' => '',
            'web_login' => 1,
            'password' => bcrypt($request->register_password),
            'email' => $request->register_email,
            'name' => $request->register_name,
            'phone' => $request->register_phone,
            'user_type' => $request->register_user_type,
            'store_id' => $request->register_store_id,
        ]);

        $user = $this->primary_model->create($request->all());

        session()->flash('success', 'Approval request has been sent to administrator.');

        $application_setting_emails = Email::where('slug', 'new_user')->first();

        $emails = explode(',', $application_setting_emails->recipients);

        Mail::to($emails)->send(new NewStoreManagerMail($user));

        return redirect()->route(config('constants.WEB_PREFIX') . 'login', ['login' => true]);
    }

    public function authenticate(Signin $request)
    {
        $user = $this->primary_model->whereNull('deleted_at')->where('email', $request->email)->first();

        if (!$user) {

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        if (!$user->approved_by_admin) {

            return back()->withErrors([
                'email' => 'Your account is inactive, please contact administrator.',
            ]);
        }

        if (Auth::guard(config('constants.WEB_GUARD_NAME'))->attempt($request->validated(), $request->has('remember_me'))) {
            $request->session()->regenerate();
            return redirect()->route(config('constants.WEB_PREFIX') . 'account');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard(config('constants.WEB_GUARD_NAME'))->logout();

        return redirect()->route(config('constants.WEB_PREFIX') . 'home');
    }

    public function updateProfile()
    {
        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), ['page_title' => 'Update Profile']);
    }

    public function updateProfileRequest(UpdateProfile $request)
    {
        $this->primary_model->updateProfile($request->all(), auth()->guard(config('constants.WEB_GUARD_NAME'))->id());

        $request->session()->flash('success', 'Profile updated');

        return back();
    }

    public function forgotPassword()
    {
        $this->dataAssign['page_title'] = "Forgot Password";

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->dataAssign);
    }

    public function forgotPasswordRequest(ForgotPasswordRequest $request)
    {
        $user = $this->primary_model->where('email', $request->email)->first();

        $token = Str::random(60);

        $user->update(['remember_token' => $token]);

        Mail::to($request->email)->send(new ResetPassword($user->name, $token, config('constants.WEB_PREFIX') . 'forgot_password_verify_email'));

        if (Mail::failures() != 0) {

            $request->session()->flash('success', 'Success! password reset link has been sent to your email');

            return back();

        }

        return back()->withErrors(['email' => 'Failed! there is some issue with email provider']);
    }

    public function verifyEmail($token)
    {
        $user = $this->primary_model->where('remember_token', $token)->count();

        if (!$user) {
            abort(403);
        }

        $this->dataAssign['token'] = $token;

        $this->dataAssign['page_title'] = "Change Password";

        $this->dataAssign['close_dropdown'] = true;

        return view($this->module_directory . '.' . $this->module_name . '.' . Str::snake(__FUNCTION__), $this->dataAssign);
    }

    public function forgotPasswordChangeRequest(ForgotPasswordChangeRequest $request)
    {
        $user = $this->primary_model->where('remember_token', $request->token)->where('email', $request->email)->first();

        $user->update(['password' => bcrypt($request->password), 'remember_token' => '']);

        return redirect()->route(config('constants.WEB_PREFIX') . 'login');
    }
}
