<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApplicantProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;

use App\User;
use App\Photo;
use App\Package;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('applicant')->only('updateApplicant', 'editApplicant');
    }

    public function show()
    {

        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $route)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($images = $request->file('data')) {
            foreach ($images as $key => $image) {
                $type = substr($key, 0, strrpos($key, '_id'));
                $name = time() . $image->getClientOriginalName();
                $image->move('img/users/data/', $name);
                $photo = Photo::create([
                    'path' => 'users/data/' . $name,
                    'type' => $type,
                    'uploaded_by_user_id' => Auth::user()->id,
                ]);
                $input['data'][$key] = $photo->id;
                if ($user->photo($type)) {
                    unlink(public_path() . $user->photo($type)->path);
                    Photo::findOrFail($user->photo($type)->id)->delete();
                }
            }
        }
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
        if (isset($input['data']) && isset($user->data)) {
            $input['data'] = array_merge($user->data, $input['data']);
        }
        $user->update($input);

        if ($route == 'packages.view') {
            switch (Auth::user()->data['registration_type']) {
                case 'nustian':
                    return redirect(route('packages.view', 'nustian-package'));
                    break;
                case 'non_nustian':
                    return redirect(route('packages.view', 'non-nustian-package'));
                    break;
                case 'professional':
                    return redirect(route('packages.view', 'professional-package'));
                    break;
                default:
                    abort(404);
                    break;
            }
        }

        return redirect(route($route));
    }

    public function updateProfile(ProfileUpdateRequest $request, $route)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($images = $request->file('data')) {
            foreach ($images as $key => $image) {
                $type = substr($key, 0, strrpos($key, '_id'));
                $name = time() . $image->getClientOriginalName();
                $image->move('img/users/data/', $name);
                $photo = Photo::create([
                    'path' => 'users/data/' . $name,
                    'type' => $type,
                    'uploaded_by_user_id' => Auth::user()->id,
                ]);
                $input['data'][$key] = $photo->id;
                if ($user->photo($type)) {
                    unlink(public_path() . $user->photo($type)->path);
                    Photo::findOrFail($user->photo($type)->id)->delete();
                }
            }
        }

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

        if ($request->data['accomodation']) {
            switch ($request->data['accomodation']) {
                case 'yes':
                    if (!$user->expenses()->whereName('accomodation')->first()) {
                        $user->expenses->create([
                            'name' => 'accomodation',
                            'price' => $user->accomodationPrice,
                        ]);
                    }
                    break;
                default:
                    if ($user->expenses()->whereName('accomodation')->first()) {
                        $user->expenses()->whereName('accomodation')->delete();
                    }
                    break;
            }
        }

        if (isset($input['data']) && isset($user->data)) {
            $input['data'] = array_merge($user->data, $input['data']);
        }

        $user->update($input);

        if ($route == 'packages.view') {
            switch (Auth::user()->data['registration_type']) {
                case 'nustian':
                    return redirect(route('packages.view', 'nustian-package'));
                    break;
                case 'non_nustian':
                    return redirect(route('packages.view', 'non-nustian-package'));
                    break;
                case 'professional':
                    return redirect(route('packages.view', 'professional-package'));
                    break;
                default:
                    abort(404);
                    break;
            }
        }

        return redirect(route($route));
    }

    public function updateApplicant(ApplicantProfileRequest $request, $route)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($images = $request->file('data')) {
            foreach ($images as $key => $image) {
                $type = substr($key, 0, strrpos($key, '_id'));
                $name = time() . $image->getClientOriginalName();
                $image->move('img', $name);
                $photo = Photo::create([
                    'path' => $name,
                    'type' => $type,
                    'uploaded_by_user_id' => Auth::user()->id,
                ]);
                $input['data'][$key] = $photo->id;
                if ($user->photo($type)) {
                    unlink(public_path() . $user->photo($type)->path);
                    Photo::findOrFail($user->photo($type)->id)->delete();
                }
            }
        }
        if ($file = $request->file('photo_id')) {
            $name = time() . $file->getClientOriginalName();
            $file->move('img', $name);
            $photo = Photo::create([
                'path' => $name,
                'type' => 'user_photo',
                'uploaded_by_user_id' => Auth::user()->id,
            ]);
            $input['photo_id'] = $photo->id;
            if ($user->photo) {
                unlink(public_path() . $user->photo->path);
                Photo::findOrFail($user->photo->id)->delete();
            }
        }
        if (isset($input['data']) && isset($user->data)) {
            if ($user->data == null) $user->data = [];
            $input['data'] = array_merge($user->data, $input['data']);
        }
        $user->update($input);
        return redirect(route($route));
    }

    public function editApplicant(Request $request)
    {

        if (!isset(Auth::user()->data['registration_type'])) {
            $packages = Package::where('id', 2)->orWhere('id', 3)->get();
            return view('profile.applicant.package-options', compact('packages'));
        }
        switch (Auth::user()->data['registration_type']) {
            case 'nustian':
                return view('profile.applicant.edit.nustian');
                break;
            case 'non_nustian':
                return view('profile.applicant.edit.non-nustian');
                break;
            case 'professional':
                return view('profile.applicant.edit.professional');
                break;
            default:
                Auth::user()['data->registration_type'] = null;
                Auth::user()->save();
                return redirect(route('dashboard'));
                break;
        }
    }

    public function resetProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->events) {
            foreach ($user->events as $event) {
                $user->events()->detach($event);
            }
        }

        if ($user->expenses) {
            foreach ($user->expenses as $expense) {
                $user->expenses()->delete($expense);
            }
        }
        if ($user->invoiceProof) {
            $proof = Photo::findOrFail($user->invoiceProof->id);
            unlink(public_path() . $proof->path);
            $user->invoiceProof->delete();
        }
        if ($user->photo) {
            $photo = Photo::findOrFail($user->photo->id);
            unlink(public_path() . $photo->path);
            $user->photo->delete();
        }

        $user->update([
            'payment_status' => 'unpaid',
            'profile_completed_at' => null,
            'package_id' => null,
            'data' => null,
        ]);

        return redirect(route('dashboard'));
    }
}
