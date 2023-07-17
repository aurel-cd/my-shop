<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rules;
use Spatie\Permission\Traits\HasRoles;
use Yajra\DataTables\Services\DataTable;


class UserController extends Controller
{
    use HasRoles;

    public function index(Request $request)
    {
        $roles = Role::all();
        return view('admin.index', compact('roles'));
    }


    public function getForDatatable()
    {
        $users = User::with('roles');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $actionBtn = '
                            <button type="button" id="' . $user->id . '" class="px-2 editUserBtn shadow-lg text-white inline-flex items-center bg-[#2c7da0]  hover:bg-[#61a5c2] focus:ring-4 focus:outline-none focus:ring-[#61a5c2] font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class=" w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                            </button>
                            <button type="button" id="' . $user->id . '" class="deleteBtn shadow-lg inline-flex items-center text-white bg-red-600 hover:bg-red-100 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            <svg aria-hidden="true" class="w-5 h-5 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </button>';

                return $actionBtn;
            })
            ->addColumn('role', function ($user) {
                return $user->getRoleNames()->first();
            })
            ->rawColumns(['role'])
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addUser(Request $request)
    {

        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:10'],
            'role' => ['required', 'exists:roles,name']
        ]);


        $newUser = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ])->assignRole($request->role);


        if (!$newUser) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data added Succesfully',

        ]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUserData(Request $request)
    {
        $user = User::where('id', $request->id)->with('roles')->first();
        if (!$user) {
            return response()->json([
                'message' => 'Internal Server Error',
            ], 500);
        }
        return response()->json([
            'message' => 'Data retrieved Succesfully',
            'data' => $user
        ]);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['', 'string', 'max:10'],
            'role' => ['required']
        ]);
        $updateUser = User::where('email', $request->email)->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'phone' => $request->phone,
        ]);

        $user =User::where('email', $request->email)->first();
        $role = $request->role;
        $roles = $user->getRoleNames()->first();

        if (!($user->hasRole($role))) {
            $user->removeRole($roles);
            $user->assignRole($request->role);
        }

        if ($updateUser) {
            return response()->json([
                'message' => 'User Updated Succesfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $result = User::where('id', $request->id)->delete();
        if ($result) {
            return response()->json([
                'message' => 'User Deleted Succesfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Internal Server Error'
            ], 500);

        }

    }

}
