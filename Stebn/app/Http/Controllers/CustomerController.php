<?php namespace App\Http\Controllers;

use App\BikeStation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\renting;
use Auth;
use App\Bike;

use Illuminate\Http\Request;

class CustomerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::User();
        return view('Customer.welcome', compact('user'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

    public function ViewRentedBikes(){
        $user = Auth::User();
        //$bikeStations = BikeStation::all();
        //$bikes= Bike::all();

        return view('Customer.View.ViewRentedBikes', compact('user'));

    }

    public function RentABike()
    {
        $user = Auth::User();
       $bikestations = BikeStation::all();
        $bikes = Bike::all(); //Must be handles only to view the bikes in the current station not all stations.

        return view('Customer/Create/RentABike', compact('user'));
        /*return redirect('Customer/welcome')->with([
            'flash_message' => 'You have successfully rented the choosen bike!',
            'flash_message_important' => true,
        ]);
        */
    }
    public function RentTheBike(Requests\Rent $request){
        //dd($request->bike_station_id);
        $user = Auth::User();
        $card_id= $user->card_id;
        $request->card_id = 1; //Remember that this is not working

        renting::create($request->all());
        return redirect('Customer/welcome')->with([
            'flash_message' => 'You have successfully rented the choosen bike!',
            'flash_message_important' => true,
        ]);
    }

    public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
