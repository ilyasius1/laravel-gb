<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profiles\Store;
use App\Http\Requests\Profiles\Update;
use App\Models\User;
use App\Queries\UsersQueryBuilder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected UsersQueryBuilder $usersQueryBuilder;

    public function __construct(
        UsersQueryBuilder $usersQueryBuilder
    )
    {
        $this->usersQueryBuilder = $usersQueryBuilder;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Application|Factory|View
    {
        $profiles = $this->usersQueryBuilder->getAll();
        return view('admin.profiles.index', [
            'profiles' => $profiles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Application|Factory|View
    {
        return view('admin.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Store $request): RedirectResponse
    {
        $requestData = $request->validated();
        $user = User::create([
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
        ]);
        if($user) {
            return redirect()
                ->route('admin.profiles.index', status: 201)
                ->with('success', __('Profile has been created'));
        }
        return back()->with('error', __('Profile has not been created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $profile): Application|Factory|View
    {
        return view('admin.profiles.show', [
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $profile): Application|Factory|View
    {
        return view('admin.profiles.edit', [
            'profile' => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request, User $profile): RedirectResponse
    {
        $requestData = [...$request->validated(), 'is_admin' => $request->boolean('is_admin')];
        $user = $profile->fill($requestData);
        if($user->save()){
            return redirect()->route('admin.profiles.index')->with('success',  __('Profile has been updated'));
        }
        return \back()->with('error', __('Error! News has not been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $profile)
    {
        try {
            $profile->delete();
        }
        catch (\Throwable $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }
    }
}
