<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelRoute;
use App\Models\Taxi;

class DriverController extends Controller
{
    public function driverDashboard()
    {
        return view('driver.dashboard');
    }
    public function routesDashboard()
    {
        return view('driver.routes');
    }

    public function createRoute(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'depart' => 'required|string|max:20',
            'destination' => 'required|string|max:20',
        ]);

        // Vérifier que le conducteur est authentifié
        if (!session('driver') || !session('driver')->id) {
            return redirect()->back()->with('error', 'Driver not authenticated.');
        }

        try {
            // Créer la route
            $route = TravelRoute::create([
                'depart' => $validatedData['depart'],
                'destination' => $validatedData['destination'],
                'driver_id' => session('driver')->id
            ]);

            return redirect()->back()->with('success', 'Route created successfully.');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the route.');
        }
    }

    public function readRoute()
    {
        $routes = TravelRoute::where('driver_id', session('driver')->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('driver.routes', compact('routes'));
    }

    public function createTaxi(Request $request)
    {
        $validatedData = $request->validate([
            'taxiModel' => 'required|string|max:20',
            'taxiPlate' => 'required|string|max:20',
        ]);

        if (!session('driver') || !session('driver')->id) {
            return redirect()->back()->with('error', 'Driver not authenticated.');
        }

        try {
            $taxi = Taxi::create([
                'brand' => $validatedData['taxiModel'],
                'registration' => $validatedData['taxiPlate'],
                'driver_id' => session('driver')->id
            ]);



            return redirect()->route('driver')->with('success', 'Taxi information saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving taxi information.');
        }
    }

    public function readTaxi()
    {
        $taxi = Taxi::where('driver_id', session('driver')->id)->get();
        return view('driver.dashboard', compact('taxi'));
    }

    public function updateTaxi(Request $request)
    {

        $validatedData = $request->validate([
            'newTaxiModel' => 'required|string|max:20',
            'newTaxiPlate' => 'required|string|max:20',
        ]);

        if (!session('driver') || !session('driver')->id) {
            return redirect()->back()->with('error', 'Driver not authenticated.');
        }

        $taxi = Taxi::where('driver_id', session('driver')->id)->first();

        try {
            $taxi->update([
                'brand' => $validatedData['newTaxiModel'],
                'registration' => $validatedData['newTaxiPlate'],
            ]);

            return redirect()->route('driver')->with('success', 'Taxi information updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating taxi information.');
        }
    }
}
