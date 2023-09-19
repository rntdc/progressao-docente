<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Question;
use App\Models\SubItem;
use App\Models\Item;
use App\Http\Requests\QuestionsStoreRequest;
use App\Http\Requests\QuestionsUpdateRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class QuestionsController extends Controller
{

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request, Item $item)
    {
        $question = new Question();

        if (!$item) {
            return route('admin.form.items.index');
		}

        return view('admin.form.questions.create', compact('question', 'item'));
    }


    /**
     * Store.
     *
     * @return Response
     */
    public function store(QuestionsStoreRequest $request, Item $item)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.questions.create'));
        }

        $question = new Question();

        /* temporary */

        $question->id_item = $item->id;
        $question->name = $request->input('name');
        $question->pontuation = $request->input('pontuation');
        $question->id_subitem = ($item->has_subitem) ? $request->input('subitem') : null;

        $question->save();

        Alert::toast('Questão cadastrada com sucesso!', 'success');

		return redirect(route('admin.items.show', compact('item')));
    }

    /**
	 * Edit.
	 *
	 * @param  Question $question
	 * @return Response
	 */
    public function edit(Item $item, Question $question)
    {
        $question = Question::find($question->id);

        if (!$question) {
            return redirect(route('admin.items.show', compact('item')));
		}

		return view('admin.form.questions.edit', compact('question', 'item'));
    }

    /**
	 * Update.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(Item $item, QuestionsUpdateRequest $request, $id)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return back();
        }

        $question = Question::find($id);

        $question->name = $request->input('name');
        $question->pontuation = $request->input('pontuation');
        $question->update();

        Alert::toast('Questão editada com sucesso!', 'success');

		return redirect(route('admin.items.show', compact('item')));
    }

    /**
	 * Remove.
	 *
	 * @param  Question $question
	 * @return Response
	 */
    public function destroy(Request $request)
    {
        if($request->ajax()){
            try {
                $question = Question::findOrFail($request->question_id);

                $question->delete();

                return response()->json(['message' => 'Sucesso na exclusão']);
            } catch (\Exception $e) {
                // Log the exception
                Log::error($e->getMessage());

                return response()->json(['error' => 'Ocorreu um erro, tente novamente mais tarde.'], 500);
            }
        }
    }
}
