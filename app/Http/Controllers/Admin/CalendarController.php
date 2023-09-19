<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Calendar;
use App\Http\Requests\CalendarRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class CalendarController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $calendars = Calendar::all();

        return view('admin.calendars.index', compact('calendars'));
    }

    /**
     * Create.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $item = new Calendar();

        return view('admin.calendars.create', compact('item'));
    }

    /**
     * Store.
     *
     * @return Response
     */
    public function store(CalendarRequest $request)
    {
        $validated = $request->validated();

        if(! $validated) {
            Alert::toast('Erros encontrados!', 'error');

            return redirect(route('admin.calendars.create'));
        }

        $calendar = new Calendar();
        $calendar->semester = $request->input('semester');
        $calendar->start_date = $request->input('start_date');
        $calendar->end_date = $request->input('end_date');
        $calendar->save();


        Alert::toast('Data cadastrada com sucesso!', 'success');

        return redirect(route('admin.calendars.create'));
    }

    /**
	 * Edit.
	 *
	 * @param  Calendar $calendar
	 * @return Response
	 */
    public function edit(Calendar $calendar)
    {
        $item = Calendar::find($calendar->id);

        if (!$item) {
			return redirect(route('admin.calendar.index'));
		}

		return view('admin.calendars.edit', compact('item'));
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

        $item = Calendar::find($id);

        $item->name = $request->input('name');
        $item->email = $request->input('email');

        $item->update();

        Alert::toast('Data editada com sucesso!', 'success');

        return redirect(route('admin.calendars.index'));
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
                $item = Calendar::findOrFail($request->item_id);

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
