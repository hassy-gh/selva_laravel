<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Rules\Hankaku;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    private $form_show = 'Auth\RegisterController@showRegistrationForm';
    private $form_confirm = 'Auth\RegisterController@confirm';
    private $form_complete = 'Auth\RegisterController@complete';

    private $formItems = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'password_confirmation',
        'email',
    ];

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_sei' => ['required', 'string', 'max:20'],
            'name_mei' => ['required', 'string', 'max:20'],
            'nickname' => ['required', 'string', 'max:10'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'password' => ['required', 'string', new Hankaku(), 'between:8,20', 'confirmed'],
            'password_confirmation' => ['required', 'string', new Hankaku(), 'between:8,20'],
            'email' => ['required', 'string', "regex:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", 'email', 'max:200', 'unique:members'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Member
     */
    protected function create(array $data)
    {
        return Member::create([
            'name_sei' => $data['name_sei'],
            'name_mei' => $data['name_mei'],
            'nickname' => $data['nickname'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }

    /**
     * ???????????????????????????????????????
     */
    function post(Request $request)
    {
        $this->validator($request->all())->validate();

        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->form_confirm);
    }

    /**
     * ????????????
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->form_show)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->form_show);
        }

        $this->validator($request->all())->validate();

        event(new Registered($member = $this->create($request->all())));

        $request->session()->forget('form_input');

        // $this->guard()->login($member, true);

        return $this->registered($request, $member) ?: redirect($this->redirectPath());
    }

    /**
     * ???????????????
     */
    function registered(Request $request, $member)
    {
        return redirect()->action($this->form_complete);
    }

    /**
     * ????????????????????????????????????
     * 
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register.register');
    }

    /**
     *??????????????????
     */
    public function confirm(Request $request)
    {
        $input = $request->session()->get('form_input');

        $gender = config('master.gender');

        if (!$input) {
            return redirect()->action('Auth\RegisterController');
        }

        return view('auth.register.confirm', [
            'input' => $input,
            'gender' => $gender
        ]);
    }

    /**
     * ??????????????????
     */
    public function complete()
    {
        return view('auth.register.complete');
    }
}
