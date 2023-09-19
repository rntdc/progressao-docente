<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class ItemsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::all();

        confirmDelete('Exclusão!', 'Tem certeza que deseja deletar?');

        return view('admin.form.items.index', compact('items'));
    }

    /**
	 * Show.
	 *
	 * @param  Item $item
	 * @return Response
	 */
    public function show(Item $item)
    {
        confirmDelete('Exclusão!', 'Tem certeza que deseja deletar?');

        $item = Item::find($item->id);

        if (!$item) {
			return redirect(route('admin.items.index'));
		}

		return view('admin.form.items.show', compact('item'));
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $item = new Item();

        return view('admin.form.items.create', compact('item'));
    }


    /**
     * Store.
     *
     * @return Response
     */
    public function store(ItemStoreRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.items.create'));
        }

        $item = new Item();

        /* temporary */
        $index = count(Item::all());

        $item->name = $request->input('name');
        $item->has_subitem = $request->input('has_subitem') == '1';
        $item->index = 1 + $index;
        $item->save();

        Alert::toast('Item cadastrado com sucesso!', 'success');

        return redirect(route('admin.items.index'));
    }

    /**
	 * Edit.
	 *
	 * @param  Item $item
	 * @return Response
	 */
    public function edit(Item $item)
    {
        $item = Item::find($item->id);

        if (!$item) {
			return redirect(route('admin.items.index'));
		}

		return view('admin.form.items.edit', compact('item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(ItemUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $item = Item::find($id);

        $item->name = $request->input('name');

        $item->update();

        Alert::toast('Item editado com sucesso!', 'success');

        return redirect(route('admin.items.index'));
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
                $item = Item::findOrFail($request->item_id);

                $questions = $item->questions()->get();
                $subitems = $item->subitems()->get();

                if(count($questions) > 0) {
                    foreach($questions as $question) {
                        $question->delete();
                    }
                }

                if(count($subitems) > 0) {
                    foreach($subitems as $subitem) {
                        $subitem->delete();
                    }
                }

                $item->delete();

                return response()->json(['message' => 'Sucesso na exclusão', 'back' => true]);
            } catch (\Exception $e) {
                // Log the exception
                Log::error($e->getMessage());

                return response()->json(['error' => 'Ocorreu um erro, tente novamente mais tarde.'], 500);
            }
        }
    }
}
