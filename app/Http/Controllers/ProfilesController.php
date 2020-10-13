<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class ProfilesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {

        return view('profiles.index', compact('user'));
    }

    public function secret(User $user)
    {
        $nombres = [
            'Alejandro',
            'Manuel',
            'Enrique',
            'Elisardo',
        ];

        return view('profiles.index',[
            'nombres' => $nombres,
            'user' => $user,
        ]);
    }

    public function edit(User $user){

        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath ];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? [],
        ));


        return redirect("/profile/{$user->id}");
        }
}
