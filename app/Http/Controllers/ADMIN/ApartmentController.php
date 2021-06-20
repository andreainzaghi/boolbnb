<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;
use App\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            /*
            * -- Long max 180 da problemi--
            * 
            * Ho riscontrato il problema con queste coordinate (Lat: 44.427155, Long: 8.839384),
            * anche se la Long è meno di 180 mi resituisce un'errore dicendo che non piò inserire
            * una long maggiore di 180.
            * Quindi ho temporaneamente disabilitato max 180 per permettere il corretto inserimento del dato.
            * possibili solizioni:
            * - Validazione front-end e successivamente back-end
            */
           /**/ 'long' => 'required | numeric | min: -180', /**/ 

            'city' => 'required | string | max:50', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
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

        // Generazione dello slug univoco
        do{
            $randomNumSlug = "-".rand(0, 100000000);
            $slugTmp = Str::slug( $data['title'], '-' ).$randomNumSlug;
        }
        while( Apartment::where('slug', $slugTmp)->first() );

        $data['slug'] = $slugTmp;

       $newapartment = Apartment::create( $data );

        if ( isset($data['services']) ) {
            $newapartment->services()->attach( $data['services'] );
        }

       return redirect()->route( 'admin.apartments.show', [ 'apartment' => $newapartment ] );
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

        return view('admin.apartments.show', compact('apartment'));
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
        return view('admin.apartments.edit', compact('apartment', 'services'));
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

        $validation = $this->validation;
        $validation['title'] = 'required|string|max:100|unique:apartments,title,' . $apartment->id;

        $request->validate($validation);

        $data = $request->all();
        
        if ( isset($data['image']) ) {
            $data['image'] = Storage::disk('public')->put('images', $data['image']);
        }

        $data['visible'] = !isset( $data['visible'] ) ? 0 : 1;


        // Generazione dello slug univoco
        do{
            $randomNumSlug = "-".rand(0, 100000000);
            $slugTmp = Str::slug( $data['title'], '-' ).$randomNumSlug;
        }
        while( Apartment::where('slug', $slugTmp)->first() );

        $data['slug'] = $slugTmp;
        $data['user_id'] = Auth::id();

        $apartment->update($data);

        if ( isset($data['services']) ) {
            $apartment->services()->sync( $data['services'] );
        }

        return redirect()
                ->route( 'admin.apartments.show', [ 'apartment' => $apartment ] )
                ->with('message', $apartment->title . 'è stato modificato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Apartment $apartment )
    {

        if( $apartment->user_id != Auth::id() ) {
            abort('403');
        }
        $apartment->delete();

        return redirect()
                ->route('admin.apartments.index')
                ->with('message', $apartment->title . 'è stato eliminato');
    }

    public function messages( Apartment $apartment )
    {

        if( $apartment->user_id != Auth::id() ) {
            abort('403');
        }

        $messages = $apartment->messages()->orderBy('created_at', 'desc')->get();
        foreach ( $messages as $message ) {
            $createdAt = Carbon::parse( $message['created_at'] )->format('d/m/Y');
            $message->date = $createdAt;
        }

        return view('admin.apartments.messages', compact('apartment', 'messages'));
    }
}
