<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = [];
        $str = rtrim(Storage::get('Orders') ?? '', ',');
        if($str){
            $arr = explode(",\n",$str);
            foreach ($arr as $orderStr){
                $order = json_decode($orderStr, true);
                $orders[] = $order;
            }
        }
        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.orders.create');
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
        return response()->redirectTo(route('admin.orders.index'),201);
       redirect(route('admin.orders.index'), 201 );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orders = explode("\n",(Storage::get('Orders')));
        foreach ($orders as $order) {
            if(is_array($order) && $order['id'] === $id) {
                return view('admin.orders.show', ['order' => $id]);
            }
        }
        return route('404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
