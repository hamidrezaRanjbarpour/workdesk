<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\WorkHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class WorkingHoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Company $company)
    {
        if ($company->user->id != auth()->user()->id)
            abort(403);

//        dd($company->workingHours()->get());
        $work_hours = $company->workingHours()->paginate(5);

        return view('work_hours.index', [
            'work_hours' => $work_hours,
            'company' => $company
        ]);
    }

    public function create()
    {
        return view('work_hours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start' => 'required|date_format:Y-m-d H:i:s',
            'end' => 'nullable|date_format:Y-m-d H:i:s',
            'company_id' => 'required',
        ]);

        if (Company::find($request->company_id)) {
            WorkHour::create($validated);
            return redirect()->route('working_hours.index', ['company' => $request->company_id]);
        } else {
            return redirect()->route('working_hours.create')->withErrors(['error' => 'شرکت انتخاب شده نامعتبر است']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\WorkHour $workHour
     * @return \Illuminate\Http\Response
     */
    public function show(WorkHour $workHour)
    {
        //
    }


    public function edit(WorkHour $workHour)
    {
    }

    public function update(Request $request, WorkHour $workHour)
    {
        if (auth()->user()->id != $workHour->company->user_id)
            abort(403);

        $validated = $request->validate([
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'nullable|date_format:Y-m-d H:i',
//            'company_id' => 'required',
        ]);

        if($validated['end']) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i', $request->start);
            $end_date = Carbon::createFromFormat('Y-m-d H:i', $request->end);
            $validated['activity_duration'] = $start_date->diff($end_date)->format('%H:%i');
        }

        $workHour->update($validated);

        return response()->json([
           'message' => 'work hour updated successfully'
        ]);
    }


    public function destroy(WorkHour $workHour)
    {
        if (auth()->user()->id != $workHour->company->user_id)
            return response()->json([
                'message' => 'Forbidden'
            ], 403);

        $workHour->delete();
        return response()->json([
           'message' => 'operation completed successfully.'
        ]);
    }
}
