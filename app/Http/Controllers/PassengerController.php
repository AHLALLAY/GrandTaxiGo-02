<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\TravelRoute;
use App\Models\Reservation;

class PassengerController extends Controller
{
    public function passengerDashboard()
    {
        return view('passenger.dashboard');
    }
    public function reservationDashboard()
    {
        return view('passenger.reservations');
    }

    public function readDrivers()
    {
        $availableDrivers = DB::table('drivers')
            ->join('taxis', 'drivers.id', '=', 'taxis.driver_id')
            ->leftJoin(
                DB::raw(
                    "(SELECT id, driver_id, depart, destination 
                FROM (
                    SELECT id, driver_id, depart, destination, 
                           ROW_NUMBER() OVER (PARTITION BY driver_id ORDER BY created_at DESC) AS rn
                    FROM travel_routes
                ) AS subquery 
                WHERE rn = 1) AS latest_route"
                ),
                'drivers.id',
                '=',
                'latest_route.driver_id'
            )
            ->where('drivers.isAvailable', true)
            ->select(
                'drivers.id as driver_id',
                'drivers.name as driver_name',
                'drivers.photo as driver_photo',
                'taxis.brand as taxi_brand',
                'taxis.registration as taxi_registration',
                'latest_route.id as route_id',
                'latest_route.depart as last_depart',
                'latest_route.destination as last_destination'
            )
            ->get();

        return view('passenger.reservations', compact('availableDrivers'));
    }

    public function createReservation(Request $request)
    {
        // dd($request->all());
        dd(session('user')->id);
        // Valider les données de la requête
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'route_id' => 'required|exists:travel_routes,id',
        ]);


        // Vérifier si le chauffeur et la route existent
        $driver = Driver::find($validatedData['driver_id']);
        $route = TravelRoute::find($validatedData['route_id']);

        if (!$driver || !$route) {
            return redirect()->back()->with('error', 'Chauffeur ou route non trouvé.');
        }


        try {
            Reservation::create([
                'driver_id' => $validatedData['driver_id'],
                'passenger_id' => session('user')->id,
                'route_id' => $validatedData['route_id'],
                'status' => 'en attent'
            ]);

            return redirect()->back()->with('success', 'Réservation effectuée avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la réservation.');
        }
    }
}
