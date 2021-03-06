<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Utilities\Country;
use App\Http\Requests\FlyerRequest;
use Illuminate\Support\Facades\Auth;



class FlyersController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth', ['except' => ['show']]);

       parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();

        return view('flyers.create')->with('countries', $countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        $flyer = $this->user->publish(
            new Flyer($request->all())
        );
        
        flash()->success('Success!', "Your flyer has been created.");

        return redirect(flyer_path($flyer));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $zip
     * @param string $street
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Flyer::findOrFail($id)->delete();

        return redirect('/');
    }

}
