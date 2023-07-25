<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormConfirmation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        $kapperRole = Role::where('name', 'Kapper')->firstOrFail();
        $users = User::role($kapperRole)->get();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    /**
     * Store user
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'telephone_number' => 'required|numeric|unique:users',
            'email' => 'required|email|unique:users,email',
        ], [
            'name.required' => 'Naam is verplicht.',
            'telephone_number.required' => 'Telefoonnummer is verplicht.',
            'telephone_number.numeric' => 'Telefoonnummer moet numeriek zijn.',
            'telephone_number.regex' => 'Telefoonnummer moet xxxxxxxxxx of xx-xxxxxxxx zijn.',
            'telephone_number.unique' => 'Telefoonnummer is al in gebruik.',
            'email.required' => 'E-mailadres is verplicht.',
            'email.email' => 'Ongeldig e-mailadres.',
            'email.unique' => 'E-mailadres is al in gebruik.',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->password = Hash::make($request->get('password'));
        $user->telephone_number = $validatedData['telephone_number'];
        $user->email = $validatedData['email'];
        $user->save();

        $kapperRole = Role::where('name', 'Kapper')->firstOrFail();
        $user->assignRole($kapperRole);

        return redirect()->route('user.index')->with('success', 'Gebruiker toegevoegd');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('user.create');
    }

    /**
     * @param $user_id
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit($user_id): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $user = User::findOrFail($user_id);

        return view('user.edit', compact('user'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $treatment = User::findOrFail($id);
        $treatment->update($request->all());

        return redirect()->route('user.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendEmail(Request $request): RedirectResponse
    {
        //send data from form on homepage to client
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        Mail::to($request->email)->send(new ContactFormConfirmation($data));

        return redirect()->back()->with('success', 'E-mail verzonden');
    }
}
