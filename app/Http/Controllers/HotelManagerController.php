<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

use Illuminate\Http\Request;

class HotelManagerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::User();
		return view('hotelManager.welcome', compact('user'));
	}

    /**
     * @return \Illuminate\View\View
     * Creates a hotel receptionist
     */
    public function registerReceptionist()
    {
        $user = Auth::User();
        return view('hotelManager.registerReceptionist', compact('user'));
    }

    /**
     * Registers the Receptionist
     */
    public function registerTheReceptionist(Requests\CreateUser $request)
    {
        $user = Auth::User();
        $receptionist = User::create($request->all());
        $receptionist->type = 2;
        $receptionist->location = $user->location;
        $receptionist->save();

        return redirect('hotelManager/welcome')->with([
            'flash_message' => 'Hotel Receptionist created successfully',
            'flash_message_important' => true,
        ], compact($user));
    }
    public function stores(CreateUser $request)
    {
        $type = $request->type;
        $card = Card::first();
        $card_id = $card->id;
        $user = Auth::user();

        switch($type)
        {
            case '1':   User::create($request->all());

                return redirect('admin/welcome')->with([
                    'flash_message' => 'Administrator created successfully',
                    'flash_message_important' => true,
                ], compact($user));
                break;

            case '2':   User::create($request->all());

                return redirect('hotelreceptionist/welcome')->with([
                    'flash_message' => 'Hotel Receptionist created successfully',
                    'flash_message_important' => true,
                ], compact($user));
                break;

            case '0':  User::create($request->all());
                DB::table('users')
                    ->where('email', $request->email)
                    ->update(['card_id' => $card_id]);
                //dd($request->card_id);
                $card->delete();


                return redirect('Customer/welcome')->with([
                    'flash_message' => 'User created with Card ID:' .$card->id,
                    'flash_message_important' => true,
                ], compact($user));
                break;
        }

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
