<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect('orders.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['numeric', 'digits:11'],
            'email' => ['email', 'required'],
            'description' => ['required', 'string', 'max:255']
        ]);
        Storage::append(
            path:'Orders',
            data:json_encode([
                'id' => fake()->randomDigitNotNull(),
                ...$request->only([
                    'name',
                    'phone',
                    'email',
                    'description',
                ]),
                'created_at' => now('Europe/Moscow')
            ]) . ','
        );
        return redirect('index', 201 );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect('index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect('index');
    }
}
