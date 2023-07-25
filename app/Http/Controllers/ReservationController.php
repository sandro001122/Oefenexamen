<?php

namespace App\Http\Controllers;

use App\Mail\editReservationConfirmation;
use App\Mail\ReservationConfirmation;
use App\Models\Appointment;
use App\Models\Timeblock;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('appointment.index', [
            'appointments' => Appointment::where('canceled', '!=', true)
                ->orWhere('canceled', '!=', 1)
                ->orderBy('date', 'asc')
                ->get()
        ]);
    }


    public function create()
    {
        //get all users/stylist
        $stylists = User::all();
        //get all possible treatments
        $treatments = Treatment::all();
        //get all timeblocks
        $timeblocks = Timeblock::all()->sortBy('start_time');

        //return to frontend with the stylists and the treatments data
        return view('appointment.makeApp', compact('stylists', 'treatments', 'timeblocks'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'timeblock' => 'required|exists:timeblocks,id',
            'stylist' => 'required',
            'treatment' => 'required|exists:treatments,id',
        ]);
    
        // Check if the selected stylist is available at the chosen date and time
        $stylist = User::findOrFail($request->stylist);
        $selectedTimeblock = Timeblock::findOrFail($request->timeblock);
    
        $isAvailable = !Appointment::where('date', $request->date)
            ->where('user_id', $stylist->id)
            ->whereHas('timeblock', function ($query) use ($selectedTimeblock) {
                $query->where(function ($q) use ($selectedTimeblock) {
                    $q->where('start_time', '<', $selectedTimeblock->end_time)
                        ->where('end_time', '>', $selectedTimeblock->start_time);
                })->orWhere(function ($q) use ($selectedTimeblock) {
                    $q->where('start_time', '>', $selectedTimeblock->start_time)
                        ->where('start_time', '<', $selectedTimeblock->end_time);
                })->orWhere(function ($q) use ($selectedTimeblock) {
                    $q->where('end_time', '>', $selectedTimeblock->start_time)
                        ->where('end_time', '<', $selectedTimeblock->end_time);
                });
            })
            ->exists();
    
        // Check if the selected stylist is available, and if not, display an error message
        if (!$isAvailable) {
            $request->flash();
            return back()->with('error', 'De kapper is al bezet op deze tijd');
        }
    
        // Create the reservation
        $appointment = Appointment::create([
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'customer_telephone_number' => $request->phone,
            'date' => $request->date,
            'timeblock_id' => $request->timeblock,
            'user_id' => $stylist->id,
            'treatment_id' => $request->treatment,
            'canceled' => 0,
        ]);
    
        $appointmentId = $appointment->id;
    
        // Send reservation confirmation email
        Mail::to($request->email)->send(new ReservationConfirmation($appointmentId));
    
        return redirect()->back()->with('success', 'Afspraak is gemaakt. Kijk u mail voor bevestiging');
    }
    
    //get data edit form
    public function edit(Appointment $appointment)
    {
        $timeblocks = Timeblock::all();
        $stylists = User::all();
        $treatments = Treatment::all();

        return view('appointment.edit', compact('appointment', 'timeblocks', 'stylists', 'treatments'));
    }

    //update appointment
    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'date' => 'required',
            'timeblock' => 'required|exists:timeblocks,id',
            'stylist' => 'required|exists:users,id',
            'treatment' => 'required|exists:treatments,id',
        ]);

        // Check if the selected stylist is available at the chosen date and time
        $stylist = User::findOrFail($request->stylist);
        $selectedTimeblock = Timeblock::findOrFail($request->timeblock);

        $isAvailable = !Appointment::where('date', $request->date)
        ->where('user_id', $stylist->id)
        ->where('id', '!=', $appointment->id) // Exclude the current appointment being updated
        ->whereHas('timeblock', function ($query) use ($selectedTimeblock) {
            $query->where(function ($q) use ($selectedTimeblock) {
                $q->where('start_time', '<', $selectedTimeblock->end_time)
                    ->where('end_time', '>', $selectedTimeblock->start_time);
            })->orWhere(function ($q) use ($selectedTimeblock) {
                $q->where('start_time', '>', $selectedTimeblock->start_time)
                    ->where('start_time', '<', $selectedTimeblock->end_time);
            })->orWhere(function ($q) use ($selectedTimeblock) {
                $q->where('end_time', '>', $selectedTimeblock->start_time)
                    ->where('end_time', '<', $selectedTimeblock->end_time);
            });
        })
        ->exists();

        // Error message back if not available
        if (!$isAvailable) {
            return back()->with('error', 'Op het moment dat u een afspraak wil maken met deze kapper is niet mogelijk.');
        }

        // Create or update the reservation
        $appointment = Appointment::updateOrCreate(
            ['id' => $request->appointment_id],
            [
                'customer_name' => $request->name,
                'customer_email' => $request->email,
                'customer_telephone_number' => $request->phone,
                'date' => $request->date,
                'timeblock_id' => $request->timeblock,
                'user_id' => $stylist->id,
                'treatment_id' => $request->treatment,
                'canceled' => 0,
            ]
        );

        // Send confirmation email
        Mail::to($request->email)->send(new editReservationConfirmation($request->appointment_id));

        return redirect()->back()->with('success', 'Afspraak is gewijzigd kijk u email voor bevestiging');
    }

    //cancle appointent
    public function cancel(Appointment $appointment)
    {
        $appointment->update([
            'canceled' => 1,
        ]);

        return redirect()->back()->with('success', 'Afspraak is geannuleerd.');
    }

    public function getTreatments()
    {
        $data = Treatment::all();

        return response()->json($data);
    }
}

