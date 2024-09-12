<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.crud.users', [
            'users' => User::all(),
        ]);
    }

    public function exportCSV()
    {
        $filename = 'user-data.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'First Name',
                'Last Name',
                'Email',
                'Phone Number',
                'Address',
            ]);

            // Fetch and process data in chunks
            User::query()->chunk(25, function ($users) use ($handle) {

                foreach ($users as $user) {
                    $addresses = $this->getAddresses($user);
                    $data = [
                        $user->first_name ?? '',
                        $user->last_name ?? '',
                        $user->email ?? '',
                        $user->telephone ?? '',
                        $addresses,
                    ];
                    // Write data to a CSV file.
                    fputcsv($handle, $data);
                }
            });

            // Close CSV file handle
            fclose($handle);
        }, 200, $headers);
    }

    private function getAddresses($user)
    {
        if (! isset($user->userAddresses)) {
            return [];
        }

        return $user->userAddresses->map(function ($address) {
            return implode(', ', array_filter([
                $address->address->address_line1 ?? '',
                $address->address->address_line2 ?? '',
                $address->address->city ?? '',
                $address->address->state ?? '',
                $address->address->country->country_name ?? '',
                $address->address->postal_code ?? '',
            ]));
        })->implode('; ');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $new_image = $request->file('photo')->store('users');
        } else {
            $new_image = null;
        }

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'photo' => $new_image,
            'telephone' => $validated['telephone'],
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users/show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users/edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($request->hasFile('new_image')) {
            $new_image = $request->file('new_image')->store('avatars');

            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }
        } else {
            $new_image = $user->photo;
        }

        User::query()->where('id', $user->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'photo' => $new_image,
                'telephone' => $request->telephone,
                'password' => Hash::make($request->new_password),
            ]);

        return redirect(route('admin.users.index'));
    }

    public function toggleStatus(User $user)
    {
        User::query()->where('id', $user->id)
            ->update([
                'is_active' => ! ($user->is_active),
            ]);

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('admin.users.index'));
    }
}
