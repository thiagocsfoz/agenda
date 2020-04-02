<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::where('user_id', auth()->user()->id)->get();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
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
            'name' => 'required'
        ]);

        $group = new Group([
            'name' => $request->get('name')
        ]);

        $group->user()->associate(auth()->user());
        $group->save();

        if($request->get("VIEW_PHONES") == "on")
        {
            $role = new Role([
                'name' => 'VIEW_PHONES'
            ]);

            $role->group()->associate($group);
            $role->save();
        }

        if($request->get("MANAGER_PHONES") == "on")
        {
            $role = new Role([
                'name' => 'MANAGER_PHONES'
            ]);

            $role->group()->associate($group);
            $role->save();
        }

        if($request->get("VIEW_LOGS") == "on")
        {
            $role = new Role([
                'name' => 'VIEW_LOGS'
            ]);

            $role->group()->associate($group);
            $role->save();
        }

        return redirect('/groups')->with('sucess', 'Grupo criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);

        return view('groups.detail', compact('group'));
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
        //
    }
}
