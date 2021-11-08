<?php

namespace App\Http\Controllers;

use App\Http\Filters\UserFilter as Filter;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\User\UserCollection
     */
    public function index(Filter $filter)
    {
        // get users
        $users = User::filter($filter)->get();

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreRequest  $request
     * @return \App\Http\Resources\User\UserResource
     */
    public function store(StoreRequest $request)
    {
        // get validated attributes
        $attributes = $request->validated();

        // hash password
        $attributes['password'] = Hash::make($attributes['password']);

        // create a new user
        $createdUser = User::create($attributes);

        return new UserResource($createdUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \App\Http\Resources\User\UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \App\Http\Resources\User\UserResource
     */
    public function update(UpdateRequest $request, User $user)
    {
        // get validated attributes
        $attributes = $request->validated();

        if ($request->has('password'))
            // hash password
            $attributes['password'] = Hash::make($attributes['password']);

        // update user
        $user->update($attributes);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        // delete user
        $userDeleted = $user->delete();

        if ($userDeleted)
            // revoke all tokens
            $user->tokens()->delete();

        return response()->json([
            'is_deleted' => $userDeleted
        ]);
    }
}
