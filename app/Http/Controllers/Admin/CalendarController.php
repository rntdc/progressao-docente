<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Calendar;
use App\Http\Requests\CalendarRequest;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

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

        confirmDelete('Exclusão!', 'Tem certeza que deseja deletar esse calendar?');

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


        Alert::toast('Calendar cadastrado com sucesso!', 'success');

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

        Alert::toast('Calendar editado com sucesso!', 'success');

        return redirect(route('admin.calendars.index'));
    }

    /**
	 * Remove.
	 *
	 * @param  Calendar $calendar
	 * @return Response
	 */
    public function destroy(Calendar $calendar)
    {
        $item = Calendar::findOrFail($calendar->id);
        $item->delete();

        return redirect(route('admin.calendars.index'));
    }
}
