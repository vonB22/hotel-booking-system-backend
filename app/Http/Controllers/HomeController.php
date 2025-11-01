<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Keep auth middleware for most actions but allow the public landing view
        $this->middleware('auth')->except('publicHome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user && method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
            return redirect()->route('overview.index');
        }

    return view('home', ['hotels' => Hotel::latest()->take(6)->get()]);
    }

    /**
     * Public landing page - returns the same home view but accessible without auth.
     */
    public function publicHome()
    {
        $hotels = Hotel::latest()->take(6)->get();
        return view('home', compact('hotels'));
    }
}
