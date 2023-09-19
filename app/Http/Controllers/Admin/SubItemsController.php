<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\SubItem;
use App\Models\Item;
use App\Http\Requests\SubItemStoreRequest;
use App\Http\Requests\SubItemUpdateRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class SubItemsController extends Controller
{

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Item $item)
    {
        $subitem = new SubItem();

        if (!$item) {
            return route('admin.form.items.index');
		}

        return view('admin.form.subitems.create', compact('subitem', 'item'));
    }


    /**
     * Store.
     *
     * @return Response
     */
    public function store(SubItemStoreRequest $request, Item $item)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.subitems.create'));
        }

        $subitem = new SubItem();

        /* temporary */
        $index = count(SubItem::all());

        $subitem->id_item = $item->id;
        $subitem->name = $request->input('name');
        $subitem->index = 1 + $index;
        $subitem->save();

        Alert::toast('SubItem cadastrado com sucesso!', 'success');

		return redirect(route('admin.items.show', compact('item')));
    }

    /**
	 * Edit.
	 *
	 * @param  SubItem $subitem
	 * @return Response
	 */
    public function edit(Item $item, SubItem $subitem)
    {
        $subitem = SubItem::find($subitem->id);

        if (!$subitem) {
            return redirect(route('admin.items.show', compact('item')));
		}

		return view('admin.form.subitems.edit', compact('subitem', 'item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Item $item, SubItemUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $subitem = SubItem::find($id);

        $subitem->name = $request->input('name');

        $subitem->update();

        Alert::toast('SubItem editado com sucesso!', 'success');

		return redirect(route('admin.items.show', compact('item')));
    }

    /**
	 * Remove.
	 *
	 * @param  SubItem $subitem
	 * @return Response
	 */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            try {
                $subitem = SubItem::findOrFail($request->subitem_id);

                $questions = $subitem->questions()->get();

                if(count($questions) > 0) {
                    foreach($questions as $question) {
                        $question->delete();
                    }
                }

                $subitem->delete();

                return response()->json(['message' => 'Sucesso na exclusão']);
            } catch (\Exception $e) {
                // Log the exception
                Log::error($e->getMessage());

                return response()->json(['error' => 'Ocorreu um erro, tente novamente mais tarde.'], 500);
            }
        }
    }
}
