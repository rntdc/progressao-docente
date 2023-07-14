<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Manager;
use App\Http\Requests\ManagerStoreRequest;
use App\Http\Requests\ManagerUpdateRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ManagersController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $managers = Manager::all();

        confirmDelete('Exclusão!', 'Tem certeza que deseja deletar esse manager?');

        return view('admin.managers.index', compact('managers'));
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $item = new Manager();

        return view('admin.managers.create', compact('item'));
    }

    /**
     * Store.
     *
     * @return Response
     */
    public function store(ManagerStoreRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.managers.create'));
        }

        $manager = new Manager();
        $manager->name = $request->input('name');
        $manager->email = $request->input('email');
        $manager->password = bcrypt('12345678');
        $manager->is_verified = false;
        $manager->setRememberToken(Str::random(60));
        $manager->save();

        Alert::toast('Manager cadastrado com sucesso!', 'success');

        return redirect(route('admin.managers.create'));
    }

    /**
	 * Edit.
	 *
	 * @param  Manager $manager
	 * @return Response
	 */
    public function edit(Manager $manager)
    {
        $item = Manager::find($manager->id);

        if (!$item) {
			return redirect(route('admin.manager.index'));
		}

		return view('admin.managers.edit', compact('item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(ManagerUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $item = Manager::find($id);

        $item->name = $request->input('name');
        $item->email = $request->input('email');

        $item->update();

        Alert::toast('Manager editado com sucesso!', 'success');

        return redirect(route('admin.managers.index'));
    }

    /**
	 * Remove.
	 *
	 * @param  Manager $manager
	 * @return Response
	 */
    public function destroy(Manager $manager)
    {
        $item = Manager::findOrFail($manager->id);
        $item->delete();

        return redirect(route('admin.managers.index'));
    }
}
