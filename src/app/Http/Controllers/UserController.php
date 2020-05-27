<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Usersaccess;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('usersaccesses')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function fetchData(Request $request)
    {
        if($request->ajax())
        {
            if($request->ordenation) {
                $users = User::withCount('usersaccesses')->orderBy('name', $request->ordenation)->paginate($request->pagination);
            } else {
                $users = User::withCount('usersaccesses')->paginate($request->pagination);
            }

            return view('users.pagination_data', compact('users'));
        }

        return $this->index();
    }

    public function searchName(Request $request)
    {
        if($request->ajax())
        {
            $users = User::withCount('usersaccesses')->where('name','LIKE','%'.$request->name.'%')->paginate(10);

            return view('users.pagination_data', compact('users'));
        }

        return $this->index();
    }

    public function moreOrLessAccess(Request $request)
    {
        if($request->ajax())
        {
            $users = User::withCount('usersaccesses')->orderBy('usersaccesses_count', $request->search)->take(10)->get();

            return view('users.pagination_data', compact('users'));
        }

        return $this->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'name'=>'required',
            'email'=>'required'
        ]);


        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'active' => 1
            ]);
        $user->save();
        return redirect('/users')->with('success', 'User saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
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

        $user = User::find($id);
        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->save();
        return redirect('/users')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }
}
