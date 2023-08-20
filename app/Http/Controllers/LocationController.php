<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationStoreRequest;
use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(LocationStoreRequest $request)
    {
        $image = null;

        if(!!$request->file('image')){
            $image = $request->file('image')->store('images/location', 'public');
        }

        $location = Location::create([...$request->only([
            'name',
            'description',
            'address',
            'city',
            'state',
            'country',
            'link',
            'open_new_tab',
        ]), 'image' => $image]);

        return back()->with(['success' => [
            'title' => 'Successfully Created',
            'subtitle' => 'You have successfully create a new location.',
        ]]);
    }
}
