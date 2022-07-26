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

    public function index(Request $request, Company $company)
    {
        if ($company->user->id != auth()->user()->id)
            abort(403);

//        $validated = $request->validate([
//            'start' => 'required|date_format:Y-m-d',
//            'end' => 'nullable|date_format:Y-m-d',
//        ]);

        if ($request->from_date) {
            $date_split = explode('-', $request->from_date);
            $from_jalali_date = verta()->createJalaliDate($date_split[0], $date_split[1], $date_split[2]);
        } else {
            $from_jalali_date = verta()->startMonth();
        }

        $from_date = verta()->jalaliToGregorian($from_jalali_date->year, $from_jalali_date->month, $from_jalali_date->day);
        $to_date = $request->to_date ?? now();

        $work_hours = $company->workingHours()->when(($from_date && $to_date), function ($query) use ($from_date, $to_date) {
            return $query->whereBetween('start', [implode('-', $from_date) . ' 00:00:00', $to_date]);
        })->paginate(5);

        $cnt = $company->workingHours()->when(($from_date && $to_date), function ($query) use ($from_date, $to_date) {
            return $query->whereBetween('start', [implode('-', $from_date) . ' 00:00:00', $to_date]);
        })->distinct(\DB::raw('date(start)'))->count('id');

        $total_activity_duration = $company->workingHours()->whereNotNull('activity_duration')->when(($from_date && $to_date), function ($query) use ($from_date, $to_date) {
            return $query->whereBetween('start', [implode('-', $from_date) . ' 00:00:00', $to_date]);
        })->sum('activity_duration');

        return view('work_hours.index', [
            'work_hours' => $work_hours,
            'company' => $company,
            'number_of_working_days' => $cnt,
            'total_activity_duration' => $total_activity_duration,
            'month_filtered' => $from_jalali_date->month,
            'year_filtered' => $from_jalali_date->year,
        ]);
    }

    public function create()
    {
        return view('work_hours.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start' => 'required|date_format:Y-m-d H:i',
            'end' => 'nullable|date_format:Y-m-d H:i',
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

        if ($request->end) {
            $start_date = Carbon::createFromFormat('Y-m-d H:i', $request->start);
            $end_date = Carbon::createFromFormat('Y-m-d H:i', $request->end);
            $validated['activity_duration'] = $start_date->diff($end_date)->format('%H:%i');
        } else {
            $validated['end'] = null;
            $validated['activity_duration'] = null;
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
