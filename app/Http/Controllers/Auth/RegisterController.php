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
            'password' => ['required', 'string', 'alpha_num', 'between:8,20', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'alpha_num', 'between:8,20'],
            'email' => ['required', 'string', 'email', 'max:200', 'unique:members'],
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
     * 入力画面から確認画面へ遷移
     */
    function post(Request $request)
    {
        $this->validator($request->all())->validate();

        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->form_confirm);
    }

    /**
     * 登録処理
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
     * 登録完了後
     */
    function registered(Request $request, $member)
    {
        return redirect()->action($this->form_complete);
    }

    /**
     * 会員情報登録フォーム出力
     * 
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register.register');
    }

    /**
     *確認画面出力
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
     * 完了画面出力
     */
    public function complete()
    {
        return view('auth.register.complete');
    }
}
