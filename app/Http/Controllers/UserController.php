<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\UsersCreateRequest;
use App\http\Requests\UsersUpdateRequest;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Photo;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersCreateRequest $request)
    {
        //

        if(trim($request->password) == '' ) {
            $input = $request->except('password');
        }
        else {
            $input = $request->all();
        }
        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'user_photo',
                ]);
            $input['photo_id'] = $photo->id;
        }
        User::create($input);
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();
        return view('users.edit', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::whereSlug($slug)->firstOrFail();
        $roles = Role::pluck('name', 'id')->all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersUpdateRequest $request, $id)
    {
        //

        if(trim($request->password) == '') {
            $input = $request->except('password');
        }
        else {
            $input = $request->all();
        }
        $user = User::findOrFail($id);

        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'user_photo',
                ]);
            $input['photo_id'] = $photo->id;

            if($user->photo){

                unlink(public_path() . $user->photo->path);
                Photo::findOrFail($user->photo->id)->delete();
            }
        }

        $user->update($input);
        Session::flash('status', [
            'class' => 'success',
            'message' => 'User successfully updated',
        ]);
        return redirect(route('users.index'));
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

        $user = User::findOrFail($id);
        if($user->photo){
            unlink(public_path() . $user->photo->path);
            Photo::findOrFail($user->photo->id)->delete();
        }
        $user->delete();
        Session::flash('status', [
            'class' => 'danger',
            'message' => 'User successfully deleted',
        ]);
        return redirect(route('users.index'));
    }
}
