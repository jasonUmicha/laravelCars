<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $cars = Car::paginate(3);

        return view('cars.index', [
            'cars' => $cars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {

        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   Request  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Redirector|RedirectResponse|Application
    {
        $car = Car::create(
            ['name' => $request->input('name'),
             'founded' => $request->input('founded'),
             'description' => $request->input('description')]
        );

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param   int  $id
     *
     * @return Application|Factory|View
     */
    public function show(int $id): View|Factory|Application
    {
        $car = Car::find($id);

        return view('cars.show')->with('car', $car );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   int  $id
     *
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        $car = Car::find($id);
        return view('cars.edit')->with('car', $car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   Request  $request
     * @param   int      $id
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, int $id): Application|RedirectResponse|Redirector
    {
        $car = Car::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'founded' => $request->input('founded'),
                'description' => $request->input('description')
        ]);

        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Car  $car
     *
     * @return Application|Redirector|RedirectResponse
     */
    public function destroy(Car $car): Redirector|RedirectResponse|Application
    {
        $car->delete();

        return redirect('/cars');
    }
}
