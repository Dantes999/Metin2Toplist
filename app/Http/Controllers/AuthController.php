<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route("login")->withErrors('Oopsie! You have entered invalid credentials');
    }

    public function postRegistration(Request $request)
    {
        //return redirect()->route("login")->withErrors('Disabled');
        $request->validate([
            //'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $user = $this->create($data);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        if (Auth::check()) {
            $servers = Server::where('userId', Auth::id())->get();
            foreach ($servers as $server) {
                $server->votesCount = $server->getVotesCount();
            }
            return view('dashboard', ['servers' => $servers]);
        }

        return redirect()->route("login")->withErrors('Oopsie! You do not have access');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => 'NoName',
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        //Session::flush();
        Auth::logout();
        return redirect()->route('welcome');
    }
}
