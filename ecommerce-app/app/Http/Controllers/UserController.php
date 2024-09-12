<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    public function store(Request $request)
    {
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->telephone;
        $user->is_admin = false;
        $user->email_verified_at = now();
        $user->remember_token = fake()->randomNumber(8);
        $user->save();

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
        User::query()->where('id', $user->id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
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
