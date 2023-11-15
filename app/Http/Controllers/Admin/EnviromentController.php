<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Enviroment;
use App\Http\Requests\EnviromentRequest;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class EnviromentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $enviroment = Enviroment::first();

        return view('admin.enviroments.index', compact('enviroment'));
    }


    /**
	 * Edit.
	 *
	 *
	 * @return Response
	 */
    public function edit()
    {
        $item = Enviroment::first();

        if (!$item) {
			return redirect(route('admin.enviroments.index'));
		}

		return view('admin.enviroments.edit', compact('item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EnviromentRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $item = Enviroment::find($id);

        $item->reitor_name = $request->input('reitor_name');
        $item->cppd_president = $request->input('cppd_president');
        $item->cppd_secretary = $request->input('cppd_secretary');

        $item->update();

        Alert::toast('Variáveis editadas com sucesso!', 'success');

        return redirect(route('admin.enviroments.index'));
    }
}
