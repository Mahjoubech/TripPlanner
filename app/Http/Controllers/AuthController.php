<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'showLoginForm',
            'login',
            'showClientRegistrationForm',
            'showOrganizerRegistrationForm',
            'registerClient',
            'registerOrganizer'
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showClientRegistrationForm()
    {
        return view('auth.register-client');
    }

    public function showOrganizerRegistrationForm()
    {
        return view('auth.register-organizer');
    }

    public function registerClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'type' => 'client'
        ]);


        return redirect()->route('login')
            ->with('status', 'Registration successful!');
    }

    public function registerOrganizer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string',
            'CIN' => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'identification_document' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle document upload
        $filePath = null;
        if ($request->hasFile('identification_document')) {
            $file = $request->file('identification_document');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('organizers/docs', $filename, 'public');
        }

        $organizer = Organizer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'CIN' => $request->CIN,
            'document_number' => $request->document_number,
            'identification_document' => $filePath,
            'type' => 'organizer',
            'approval_status' => 'pending'
        ]);

        

        return redirect()->route('organizer.pending')
            ->with('status', 'Registration successful! Your account is pending approval.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->type === 'organizer' && $user->approval_status !== 'approved') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Your account is pending approval.'
                ]);
            }
    
            $token = JWTAuth::fromUser($user);
    
            $cookie = cookie('jwt_token', $token, 60);
    
            switch ($user->type) {
                case 'admin':
                    return redirect()->route('admin.dashboard')->withCookie($cookie);
                case 'organizer':
                    return redirect()->route('organizer.dashboard')->withCookie($cookie);
                case 'client':
                    return redirect()->route('client.dashboard')->withCookie($cookie);
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'email' => 'Unknown account type.'
                    ]);
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->withInput($request->except('password'));
    }
    public function logout()
    {
        Auth::logout();
        $cookie = Cookie::forget('jwt_token');
    
        return redirect()->route('login')->withCookie($cookie);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|file|image|max:2048',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'phone', 'bio']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('status', 'Profile updated successfully!');
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'avatar' => 'nullable|file|image|max:2048',
            'bio' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only(['name', 'phone', 'bio']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('status', 'Profile updated successfully!');
    }
}
