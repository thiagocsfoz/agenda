<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Phone;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get( 'search' );

        $userLogged = auth()->user();

        if($userLogged->group != null)
        {
            if(!$userLogged->group->verifyRole("VIEW_PHONES"))
            {
                $clients = [];
                return view('clients.index', compact('clients', 'search'));
            }

            $userId = $userLogged->group->user->id;
        }
        else
        {
            $userId = auth()->user()->id;
        }

        $clients = Client::where('user_id', $userId)
            ->leftJoin('phones', 'clients.id', '=', 'phones.client_id');

        if($request->has( 'search' ))
        {
            $clients->where(function($query) use ($search){
                $query->orWhere('name', 'LIKE', "%$search%");
                $query->orWhere('email', 'LIKE', "%$search%");
                $query->orWhere('phones.number', 'LIKE', "%$search%");
            });
        }

        $clients->select('clients.*', 'phones.number');

        $clients = $clients->orderBy('name', 'asc')->get();

        return view('clients.index', compact('clients', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $client = new Client([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        $client->user()->associate(auth()->user());
        $client->save();

        foreach ($request->phones as $phone)
        {
            $phoneDb = new Phone([
                'number' => $phone
            ]);

            $phoneDb->client()->associate($client);
            $phoneDb->save();
        }

        return redirect('/')->with('sucess', 'Cliente salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        return view('clients.detail', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
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
        $request->validate([
           'name'=>'required',
           'email'=>'required'
        ]);

        $client = Client::find($id);
        $client->name = $request->get('name');
        $client->email = $request->get('email');

        $phonesDic = [];
        foreach ($client->phones as $phone)
            $phonesDic[$phone->number] = $phone;

        foreach ($request->get('phones') as $phone)
        {
            if(array_key_exists($phone,$phonesDic))
            {
                $phonesDic[$phone]->number = $phone;
                $phonesDic[$phone]->save();
                unset($phonesDic[$phone]);
            }
            else
            {
                $phoneDb = new Phone([
                    'number' => $phone
                ]);

                $phoneDb->client()->associate($client);
                $phoneDb->save();
            }
        }

        foreach ($phonesDic as $phone)
            $phone->delete();

        $client->save();

        return redirect('/')->with('success', 'Cliente atualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();

        return redirect('/')->with('success', 'Cliente deletado!');
    }
}
