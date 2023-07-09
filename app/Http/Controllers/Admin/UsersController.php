<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Professor;
use App\Http\Requests\ProfessorRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $item = new Professor();

        return view('admin.users.create', compact('item'));
    }

    /**
     * Store.
     *
     * @return Response
     */
    public function store(ProfessorRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.professors.create'));
        }

        $professor = new Professor();
        $professor->name = $request->input('name');
        $professor->email = $request->input('email');
        $professor->password = bcrypt('12345678');
        $professor->is_verified = false;
        $professor->setRememberToken(Str::random(60));
        $professor->save();

        Alert::toast('Professor cadastrado com sucesso!', 'success');

        return redirect(route('admin.professors.create'));
    }
}
