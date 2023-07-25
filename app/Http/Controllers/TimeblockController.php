<?php

namespace App\Http\Controllers;

use App\Models\Timeblock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LaravelIdea\Helper\App\Models\_IH_Timeblock_C;
use Carbon\Carbon;

class TimeblockController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('timeblock.index', [
            'timeblocks' => Timeblock::orderBy('start_time', 'asc')->get()
        ]);
    }

    /**
     * @param $id
     * @return Timeblock|Timeblock[]|_IH_Timeblock_C
     */
    public function show($id)
    {
        return Timeblock::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'time_start' => 'required',
        ]);
    
        $startDateTime = Carbon::parse($validatedData['time_start']);
        $endDateTime = $startDateTime->copy()->addMinutes(59);
    
        Timeblock::create([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
        ]);
    
        return redirect()->route('timeblock.index');
    }
    

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $timeblock = Timeblock::findOrFail($id);

        return view('timeblock.edit', compact('timeblock'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $timeblock = Timeblock::findOrFail($id);
        
        $validatedData = $request->validate([
            'time_start' => 'required',
        ]);
    
        $startDateTime = Carbon::parse($validatedData['time_start']);
        $endDateTime = $startDateTime->copy()->addMinutes(59);
    
        $timeblock->update([
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
        ]);
    
        return redirect()->route('timeblock.index');
    }
    

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $timeblock = Timeblock::findOrFail($id);

        // Retrieve all the appointments associated with the timeblock
        $appointments = $timeblock->appointments;

        // Delete the timeblock
        $timeblock->delete();

        // Delete all the associated appointments
        foreach ($appointments as $appointment) {
            $appointment->delete();
        }

        return redirect()->back();
    }


    public function create()
    {
        return view('timeblock.create');
    }
}
