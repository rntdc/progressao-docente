<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProfessorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $data = auth()->user();

        $data->entry_date = date('d/m/Y', strtotime($data->entry_date));

        return view('professors.perfil', compact('data'));
    }

    public function edit()
    {
        $data = Auth::user();
        $data->entry_date = date('d/m/Y', strtotime($data->entry_date));

        return view('professors.edit', compact('data'));
    }

    public function update(UserUpdateRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('profile.edit'));
        }

        $user = User::find(Auth::user()->id);

        $user->email = $request->input('email');
        $user->siape = $request->input('siape');
        $user->entry_date = $request->input('entry_date');

        $user->update();

        Alert::toast('Informações cadastradas com sucesso!', 'success');

        return redirect(route('profile'));
    }
}
