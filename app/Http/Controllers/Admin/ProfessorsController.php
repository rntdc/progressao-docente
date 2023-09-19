<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Professor;
use App\Http\Requests\ProfessorStoreRequest;
use App\Http\Requests\ProfessorUpdateRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class ProfessorsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $professors = Professor::all();

        confirmDelete('Exclusão!', 'Tem certeza que deseja deletar esse professor?');

        return view('admin.professors.index', compact('professors'));
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $item = new Professor();

        return view('admin.professors.create', compact('item'));
    }

    /**
     * Store.
     *
     * @return Response
     */
    public function store(ProfessorStoreRequest $request)
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

    /**
	 * Edit.
	 *
	 * @param  Professor $professor
	 * @return Response
	 */
    public function edit(Professor $professor)
    {
        $item = Professor::find($professor->id);

        if (!$item) {
			return redirect(route('admin.professor.index'));
		}

		return view('admin.professors.edit', compact('item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(ProfessorUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $item = Professor::find($id);

        $item->name = $request->input('name');
        $item->email = $request->input('email');

        $item->update();

        Alert::toast('Professor editado com sucesso!', 'success');

        return redirect(route('admin.professors.index'));
    }

    /**
	 * Remove.
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            try {
                $item = Professor::findOrFail($request->item_id);

                $item->delete();

                return response()->json(['message' => 'Sucesso na exclusão']);
            } catch (\Exception $e) {
                // Log the exception
                Log::error($e->getMessage());

                return response()->json(['error' => 'Ocorreu um erro, tente novamente mais tarde.'], 500);
            }
        }
    }
}
