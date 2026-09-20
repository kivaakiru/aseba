<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $rules = [
            'phone'    => 'required|string|max:20|unique:users,phone,' . $user->id,
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ];

        if ($user->user_type === 'personal') {

            $rules['name'] = 'required|string|max:255';

        } else {

            $rules['name'] = 'required|string|max:255';
            $rules['leader_name'] = 'required|string|max:255';

        }

        $data = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | FOTO PROFIL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            if ($user->photo && Storage::disk('public')->exists('users/'.$user->photo)) {

                Storage::disk('public')->delete('users/'.$user->photo);

            }

            $photo = $request->file('photo');

            $filename = time().'_'.$photo->getClientOriginalName();

            $photo->storeAs(
                'users',
                $filename,
                'public'
            );

            $user->photo = $filename;

        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $user->name = $data['name'];

        $user->phone = $data['phone'];

        if ($user->user_type === 'club') {

            $user->leader_name = $data['leader_name'];

        }

        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        */

        if (!empty($data['password'])) {

            $user->password = Hash::make(
                $data['password']
            );

        }

        $user->save();

        return redirect()
            ->route('user.profile.index')
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }
}
