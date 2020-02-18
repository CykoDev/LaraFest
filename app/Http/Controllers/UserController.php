<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\UsersCreateRequest;
use App\http\Requests\UsersUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use App\Photo;

class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('monitor')->only('indexRole', 'show');
        $this->middleware('admin')->except('indexRole', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function indexRole($role)
    {
        $role = Role::whereSlug($role)->firstOrFail();
        $users = $role->users;
        return view('users.index-role', compact('users', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }
        $user = new User;
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/' . $user->imageFolder, $name);
            $photo = Photo::create([
                'path' => $user->imageFolder . $name,
                'type' => 'user_photo',
                'uploaded_by_user_id' => Auth::user()->id,
            ]);
            $input['photo_id'] = $photo->id;
        }
        $user->create($input);
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
        return view('users.show', compact('user'));
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
        if (trim($request->password) == '') {
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }
        $user = User::findOrFail($id);

        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('img/' . $user->imageFolder, $name);
            $photo = Photo::create([
                'path' => $user->imageFolder . $name,
                'type' => 'user_photo',
                'uploaded_by_user_id' => Auth::user()->id,
            ]);
            $input['photo_id'] = $photo->id;

            if ($user->photo) {

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
        $user = User::findOrFail($id);
        if ($user->photo) {
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
