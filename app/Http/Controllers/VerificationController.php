<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Http\Requests\VerificationAccountRequest;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        $name = $user->name;
        $email = $user->email;
        $type = $user->type;

        return view('verification.index', compact('name', 'email', 'type'));
    }

    /**
     * Store.
     *
     * @return Response
     */
    public function store(VerificationAccountRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('verification'));
        }

        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if($user->type == 'App\Models\Professor') {
            $user->level = $request->input('level');
            $user->class = $request->input('class');
            $user->siape = $request->input('siape');
            $user->entry_date = $request->input('entry_date');
        }

        $user->is_verified = 1;

        $user->update();

        Alert::toast('Informações cadastradas com sucesso!', 'success');

        return redirect(route('home'));
    }
}
