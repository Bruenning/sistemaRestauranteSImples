<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
   /**
    * Display a listing of the resource.
    */

    public function index()
    {
        return ReservationsResource::collection(Reservations::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reservations = Reservations::create($request->validated());

        return new ReservationsResource($reservations);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservations $reservations)
    {
        return new ReservationsResource($reservations);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservations $reservations)
    {
        $reservations->update($request->validated());

        return new ReservationsResource($reservations);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservations)
    {
        $reservations->delete();

        return response()->noContent();
    }
}
