<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HotelController extends Controller
{
    function __construct()
    {
        // use hotel permissions (product permissions remain available via seeder for compatibility)
        $this->middleware('permission:hotel-list|hotel-create|hotel-edit|hotel-delete', ['only' => ['index','show']]);
        $this->middleware('permission:hotel-create', ['only' => ['create','store']]);
        $this->middleware('permission:hotel-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:hotel-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $hotels = Hotel::latest()->paginate(5);
        return view('hotels.index', compact('hotels'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        return view('hotels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'price' => 'nullable|numeric',
            'location' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
            'rooms' => 'nullable|integer|min:0',
            'amenities' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

    $data = $request->only(['name', 'detail', 'price', 'location', 'rating', 'rooms']);
    if ($request->filled('amenities') && is_array($request->input('amenities'))) {
        $data['amenities'] = implode(',', $request->input('amenities'));
    }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^a-z0-9\.\-_]/i', '_', $file->getClientOriginalName());
            $dest = public_path('img/hotels');
            if (!file_exists($dest)) {
                @mkdir($dest, 0755, true);
            }
            $file->move($dest, $filename);
            $data['image'] = 'img/hotels/' . $filename;
        }

        Hotel::create($data);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

    public function show(Hotel $hotel): View
    {
        return view('hotels.show', compact('hotel'));
    }

    public function edit(Hotel $hotel): View
    {
        return view('hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel): RedirectResponse
    {
        request()->validate([
            'name' => 'required|string',
            'detail' => 'required|string',
            'price' => 'nullable|numeric',
            'location' => 'nullable|string',
            'rating' => 'nullable|integer|min:0|max:5',
            'rooms' => 'nullable|integer|min:0',
            'amenities' => 'nullable|array',
            'image' => 'nullable|image|max:2048',
        ]);

    $data = $request->only(['name', 'detail', 'price', 'location', 'rating', 'rooms']);
    if ($request->filled('amenities') && is_array($request->input('amenities'))) {
        $data['amenities'] = implode(',', $request->input('amenities'));
    }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^a-z0-9\.\-_]/i', '_', $file->getClientOriginalName());
            $dest = public_path('img/hotels');
            if (!file_exists($dest)) {
                @mkdir($dest, 0755, true);
            }
            $file->move($dest, $filename);
            $data['image'] = 'img/hotels/' . $filename;
        }

        $hotel->update($data);

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel updated successfully');
    }
    public function destroy(Hotel $hotel): RedirectResponse
    {
        $hotel->delete();

        return redirect()->route('hotels.index')
            ->with('success', 'Hotel deleted successfully');
    }
}