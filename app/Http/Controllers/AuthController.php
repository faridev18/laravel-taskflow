<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //
    public function register()
    {
        return view("auth.register");
    }

    public function saveuser(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'name'            => 'required',
            'email'           => 'required|email|unique:users',
            'password'        => 'required|min:6',
            "repeat-password" => "required|same:password",
        ], [
            'name.required'            => 'Le champ nom est obligatoire.',
            'email.required'           => 'Le champ e-mail est obligatoire.',
            'email.email'              => 'Veuillez entrer une adresse e-mail valide.',
            'email.unique'             => 'Cette adresse e-mail est déjà utilisée.',
            'password.required'        => 'Le champ mot de passe est obligatoire.',
            'password.min'             => 'Le mot de passe doit contenir au moins :min caractères.',
            'repeat-password.required' => 'Le champ répéter le mot de passe est obligatoire.',
            'repeat-password.same'     => 'Les mots de passe ne correspondent pas.',
        ]);

        $query = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect("login")->with('success', 'You have been successfuly registered');

    }

    public function login()
    {
        return view("auth.login");
    }

    public function connection(Request $request)
    {

        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Le champ e-mail est obligatoire.',
            'email.email'       => 'Veuillez entrer une adresse e-mail valide.',
            'password.required' => 'Le champ mot de passe est obligatoire.',
            'password.min'      => 'Le mot de passe doit contenir au moins :min caractères.',
        ]);

        // Methode 1

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/my-workspace');
        } else {
            return back()->with('error', 'Email ou mot de passe incorrect.');
        }

        // Methode 2

        // $user = User::where('email',$request->email)->first();

        // if(!$user || !Hash::check($request->password,$user->password)){
        //     return back()->with('error','Email ou mot de passe incorrect.');
        // }else{
        //     auth()->login($user);
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard');
        // }

    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
