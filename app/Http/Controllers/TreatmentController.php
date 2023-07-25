<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use LaravelIdea\Helper\App\Models\_IH_Treatment_C;

class TreatmentController extends Controller
{
    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        return view('treatments.index', [
            'treatments' => Treatment::all()
        ]);
    }

    /**
     * @param $id
     * @return Treatment|Treatment[]|_IH_Treatment_C
     */
    public function show($id)
    {
        return treatment::findOrFail($id);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Treatment::create($validatedData);

        return redirect()->route('treatments.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);

        return view('treatments.edit', compact('treatment'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $treatment = treatment::findOrFail($id);
        $treatment->update($request->all());

        return redirect()->route('treatments.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $treatment = treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->back();
    }

    public function create()
    {
        return view('treatments.create');
    }
}
