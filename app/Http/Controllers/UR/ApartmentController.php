<?php

namespace App\Http\Controllers\UR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use App\Sponsor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{

    protected $validation = [];

    public function __construct() {
        $this->validation = [
            'title' => 'required | string | max:100',
            'description' => 'required | string',
            'rooms' => 'required | numeric | max:127',
            'bathrooms' => 'required | numeric | max:4',
            'beds' => 'required | numeric | max:10',
            'mq' => 'required | numeric | max:300',
            'address' => 'required | string | max:100',
            'city' => 'required | string | max:50',
            'lat' => 'required | numeric | max:90 | min: -90',
            'long' => 'required | numeric | max:180 | min: -180',
            'city' => 'required | string | max:50',
            'image' => 'nullable| image | mimes:jpeg,png,jpg,gif,svg | max:2048',
            'visible' => 'boolean'
        ];
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $apartments = Apartment::where( 'user_id', $userId )->get();
        return view('ur.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('ur.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( $this->validation );
        $data = $request->all();

        if ( isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $data['user_id'] = Auth::id();

        $data['visible'] = !isset( $data['visible'] ) ? 0 : 1;

        $data['slug'] = Str::slug ($data['title'], '-' );

        $newapartment = Apartment::create( $data );

        if ( isset($data['services']) ) {
            $newapartment->services()->attach( $data['services'] );
        }

        return redirect()->route( 'ur.apartments.show', [ 'apartment' => $newapartment ] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Apartment $apartment )
    {
        if($apartment->user_id != Auth::id()){
            abort('403');
        }
        return view('ur.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Apartment $apartment )
    {
        if($apartment->user_id != Auth::id()){
            abort('403');
        }
        $services = Service::all();
        return view('ur.apartments.edit', compact('apartment', 'service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $request->validate( $this->validation );
        $data = $request->all();

        if ( isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $data['visible'] = !isset( $data['visible'] ) ? 0 : 1;

        $data['slug'] = Str::slug ($data['title'], '-' );

        $newapartment = Apartment::create( $data );
        
        $apartment->update($data);

        if ( isset($data['services']) ) {
            $newapartment->services()->sync( $data['services'] );
        }

        return redirect()->route( 'ur.apartments.show', [ 'apartment' => $newapartment ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Apartment $apartment )
    {
        $apartment->delete();

        return redirect()
        ->route('ur.apartments.index')
        ->with('message', $apartment->title . 'è stato eliminato');
    }
}
