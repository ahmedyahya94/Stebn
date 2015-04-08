<?php namespace App\Http\Controllers;

use App\BikeStation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OutstandingPayment;
use App\OutstandingTime;
use App\Price;
use App\Renting;
use Auth;
use App\Bike;
use DB;
use DateTime;
use Carbon\Carbon;
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
     * @return \Illuminate\View\View
     *
     */

    public function ViewRentedBikes(){
        $user = Auth::User();
        $bikes= $user->bikes->toArray();
        $bikestation = BikeStation::first();

        return view('Customer.View.ViewRentedBikes', compact('user', 'bikes', 'bikestation'));


    }

    /**
     * @return \Illuminate\View\View
     * Returns the view for renting a bike, compacting all the bikes and their corresponding bike stations.
     */
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

    /**
     * @param Requests\Rent $request
     * @return \Illuminate\Http\RedirectResponse
     * Actually renting a bike, updating table rentings, and associating the bike with the current user.
     */
    public function RentTheBike(Requests\Rent $request)
    {
        //dd($request->card_id);
        $user = Auth::User();
        $bike_id = $request->bike_id;

        DB::table('bikes')
            ->where('id', $bike_id)
            ->update(['bike_station_id' => -1]);

        $user->bikes()->attach($request->bike_id);

        Renting::create($request->all());

        DB::table('rentings')
            ->where('card_id', $request->card_id)
            ->update(['start_time' => Carbon::now()]);


        return redirect('Customer/welcome')->with([
            'flash_message' => 'Bike successfully chosen at: ' .Carbon::now(),
            'flash_message_important' => true,
        ]);
    }

    /**
     * Returns the view for parking the bike
     *
     */

    public function ParkABike()
    {
        $user = Auth::User();
        return view('Customer.Create.ParkABike', compact('user'));
    }

    /**
     * Parks the bike in a certain station
     */
    public function ParkTheBike(Requests\Rent $request)
    {
        $bikestation_id = $request->bike_station_id;
        $bike_id = $request->bike_id;
        $bike = Bike::find($bike_id);

        DB::table('bikes')
            ->where('id', $bike_id)
            ->update(['bike_station_id' => $bikestation_id]);

        DB::table('rentings')
            ->where('card_id', $request->card_id)
            ->update(['end_time' => Carbon::now()]);

       $card_id = $request->card_id;
       $renting = Renting::where('card_id', $card_id)->first();

       $strStart = $renting->start_time;
       $strEnd = $renting->end_time;

       $dteStart = new DateTime($strStart);
       $dteEnd   = new DateTime($strEnd);

       $dteDiff  = $dteStart->diff($dteEnd);

       $dteDiff->format('Y-m-d H:i:s%');
       $minutes = $dteDiff->i;
       $hours = 0;
       if($dteDiff->h != 0)
       {
           $hours = $dteDiff->h * 60;
       }

       $minutes = $minutes + $hours;

       $price = Price::first();
       $price = $price->price;

       $minutes = $minutes/60;
       $payment = $price * $minutes;

       //dd($payment);

       $userExists = OutstandingPayment::where('card_id', $card_id)->first();

       //dd($userExists);

       if(is_null($userExists))
       {
           $outstandingPayment = new OutstandingPayment;
           $outstandingPayment->card_id = $card_id;
           $outstandingPayment->outstanding_price = $payment;
           $outstandingPayment->save();
       }
        else{
            $userExists->outstanding_price = $userExists->outstanding_price + $payment;
            $userExists->save();
        }

        $userExists = OutstandingTime::where('card_id', $card_id)->first();

        //dd($userExists);

        if(is_null($userExists))
        {
            $outstandingTime = new OutstandingTime();
            $outstandingTime->card_id = $card_id;
            $outstandingTime->outstanding_time = $minutes;
            $outstandingTime->save();
        }
        else{
            $userExists->outstanding_time = $userExists->outstanding_time + $minutes;
            $userExists->save();
        }

        $renting->delete();

        return redirect('Customer/welcome')->with([
            'flash_message' => 'Bike successfully parked at: ' .Carbon::now(),
            'flash_message_important' => true,
        ]);


    }

    /**
     * This methods returns the outstanding price for the signed in user.
     */

    public function viewOutstandingPrice()
    {
        $user = Auth::User();
        $outstandingPayment = OutstandingPayment::where('card_id', $user->card_id)->first();
        return view('Customer.View.outstandingPrice', compact('user'), compact('outstandingPayment'));
    }

    public function viewOutstandingTime()
    {
        $user = Auth::User();
        $outstandingTime = OutstandingTime::where('card_id', $user->card_id)->first();
        return view('Customer.View.outstandingTime', compact('user'), compact('outstandingTime'));
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
