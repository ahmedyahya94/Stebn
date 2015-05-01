<?php namespace App\Http\Controllers;

use App\BikeStation;
use App\Card;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OutstandingPayment;
use App\OutstandingTime;
use App\User;
use App\Bike;
use Auth;
use App\Price;
use App\Time;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
//use Symfony\Component\Process\Process;
use App\Process;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::User();
		return view('admin.welcome', compact('user'));
	}

    /**
     * @return \Illuminate\View\View
     * Returns the view for creating cards.
     */

    public function cards()
    {
        $user = Auth::User();
        return view('admin.create.cards', compact('user'));
    }

    /**
     * @return \Illuminate\View\View
     * Returns the view for creating a new bike.
     */

    public function bikes()
    {
        $user = Auth::User();
        return view('admin.create.bikes', compact('user'));
    }

    /**
     * @return \Illuminate\View\View
     * Returns the view for creating a new bike station.
     */
    public function bikeStations()
    {
        $user = Auth::User();
        return view('admin.create.bikestations', compact('user'));
    }

    /**
     * @param Requests\CreateBikeStation $request
     * @return \Illuminate\Http\RedirectResponse
     * Creates a new bike station.
     */

    public function CreateBikeStations(Requests\CreateBikeStation $request)
    {
        BikeStation::create($request->all());
        return redirect('admin/welcome')->with([
            'flash_message' => 'Bike Station
            created successfully!',
            'flash_message_important' => true,
        ]);
    }

    /**
     * @param Requests\CreateBike $request
     * @return \Illuminate\Http\RedirectResponse
     * Creates a new bike.
     */

    public function CreateBikes(Requests\CreateBike $request)
    {
        Bike::create($request->all());
        return redirect('admin/welcome')->with([
             'flash_message' => 'Bike created successfully!',
             'flash_message_important' => true,
         ]);
    }

    /**
     * @param Requests\CreateCards $request
     * @return \Illuminate\Http\RedirectResponse
     * Creates cards based on the admin's request.
     */

    public function CreateCards(Requests\CreateCards $request)
    {
        //dd($request->number);

        $n = $request->number;

        while($n > 0)
        {
            $card = new Card;
            $card->save();
            $n = $n - 1;
        }

        return redirect('admin/welcome')->with([
        'flash_message' => 'Card(s) created successfully!',
        'flash_message_important' => true,
    ]);
    }

    /**
     * @return \Illuminate\View\View
     * Returns all bikestations in a drop down list.
     */

    public function viewBikeStations()
    {
        $user = Auth::User();
        $bikeStations = BikeStation::all();
        return view('admin.view.bikeStations', compact('user'), compact('bikeStations'));
    }

    /**
     * This method returns the bikes in a certain given station.
     */
    public function viewBikes(Requests\viewBikes $request)
    {
        $bikestation = BikeStation::find($request->bikeStations +1);
        $bikes = $bikestation->bikes->toArray();
        $user = Auth::User();

        return view('admin.view.BikesInStation', compact('bikes'), compact('user'));
    }


    /**
     * Views the update minimum time page.
     * @return mixed
     */
    public function UpdateMinTime()
    {
        $user = Auth::User();
        if(is_null(Time::first())){
            $minimum_time = 0;
        }
        else{
            $minimum_time = Time::first();
            $minimum_time = $minimum_time->minimum_time;
        }
        return view('admin.update.minimumTime', compact('user'), compact('minimum_time'));
    }

    /**
     * Updates the minimum time attribute in table time.
     *
     */

    public function UpdateBikeTime(Requests\UpdateMinTime $request)
    {
        $x = $request->minimum_time;

        if(is_null(Time::first()))
        {
            $time = new Time;
            $time->minimum_time = $request->minimum_time;
            $time->save();
        }
        else{
        $oldTime = Time::first()->id;
        DB::table('times')
            ->where('id', $oldTime)
            ->update(['minimum_time' => $x]);
        }
        return redirect('admin/welcome')->with([
            'flash_message' => 'Minimum time updated successfully!',
            'flash_message_important' => true,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     * Returns the view responsible for updating table price.
     */

    public function updatePrice()
    {
        if(is_null(Price::first()))
        {
            $price = 0;
        }
        else{
        $price = Price::first()->price;
        }
        $user = Auth::User();
        return view('admin.update.price', compact('user'), compact('price'));
    }

    /**
     * @param Requests\updatePrice $request
     * @return \Illuminate\Http\RedirectResponse
     * Updates table price with the requested new price.
     */


    public function updateBikePrice(Requests\updatePrice $request)
    {
        if(is_null(Price::first()))
        {
            $price = new Price;
            $price->price = $request->price;
            $price->save();
        }
        else{
        $x = $request->price;
        $oldPrice = Price::first()->id;
        //dd($x);
        DB::table('prices')
            ->where('id', $oldPrice)
            ->update(['price' => $x]);
        }
        return redirect('admin/welcome')->with([
            'flash_message' => 'Price updated successfully!',
            'flash_message_important' => true,
        ]);
    }

    /**
     * @return \Illuminate\View\View
     * Views all the processes done by all the users in a table layout.
     */

    public function viewProcesses()
    {
        $processes = Process::all();
        $user = Auth::User();

        $totalPayments = OutstandingPayment::all();
        $sum = 0;
        foreach($totalPayments as $totalPayment)
        {
            $sum = $totalPayment->outstanding_price + $sum;
        }

        $totalPayments = number_format($sum, 2);

        $totalTimes = OutstandingTime::all();
        $sum = 0;
        foreach($totalTimes as $totalTime)
        {
            $sum = $totalTime->outstanding_time + $sum;
        }

        $totalTimes = number_format($sum, 2);

        return view('admin.view.viewProcesses', compact('user', 'processes', 'totalPayments', 'totalTimes'));
    }

    /**
     * Views the bikes in a drop down list in order to view them later
     */
    public function viewBikeStationFinance()
    {
        $user = Auth::User();
        $bikeStations = BikeStation::all();
        return view('admin.view.viewBikeStationFinance', compact('user'), compact('bikeStations'));
    }

    /**
     * Views the financial data of a certain bike station
     */
    public function viewEachBikeStationFinance(Requests\viewBikes $request)
    {
        $user = Auth::User();
        $bike_station = $request->bikeStations;
        $bike_station++;
        $bike_station = BikeStation::find($bike_station);

        $processes = Process::where('station_from', $bike_station->location)->get();

        $totalPayments = OutstandingPayment::all();

        $sum = 0;

        foreach($totalPayments as $totalPayment)
        {
            $card_id = $totalPayment->card_id;
            $customer = User::where('card_id', $card_id)->first();

            if($customer->location == $bike_station->location)
                $sum += $totalPayment->outstanding_price;
        }

        $total = 0;
        $totalTimes = OutstandingTime::all();
        foreach($totalTimes as $totalTime)
        {
            $card_id = $totalTime->card_id;
            $customer = User::where('card_id', $card_id)->first();
            if($customer->location == $bike_station->location)
                $total += $totalTime->outstanding_time  ;
        }

        $totalPayments = number_format($sum, 2);
        $totalTimes = number_format($total, 2);

        return view('admin.view.viewEachBikeStationFinance', compact('user', 'processes', 'totalPayments', 'totalTimes'));
    }

    /**
     * @return \Illuminate\View\View
     * Returns the view to register a manager by the admin.
     */
    public function registerManager()
    {
        $user = Auth::User();
        $bikeStations = BikeStation::all();
        $bikeStations = $bikeStations->lists('location');

        return view('admin.create.registerManager', compact('user', 'bikeStations'));
    }

    /**
     * Registers and stores the manager.
     */
    public function registerTheManager(Requests\CreateUser $request)
    {
        $user = Auth::User();
        $manager = User::create($request->all());
        $manager->type = 3;
        $location = $request->location;
        $location++;
        $location = BikeStation::find($location);
        $location = $location->location; //Hahahaha
        $manager->location = $location;
        $manager->save();

        return redirect('admin/welcome')->with([
            'flash_message' => 'Hotel Manager created successfully',
            'flash_message_important' => true,
        ], compact($user));
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
