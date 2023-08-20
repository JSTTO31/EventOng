<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizerStoreRequest;
use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function store(OrganizerStoreRequest $request){
        $image = null;

        if(!!$request->file('image')){
            $image = $request->file('image')->store('images/organizer', 'public');
        }

        $organizer = Organizer::create([...$request->only([
            'name',
            'description',
            'general_contact_details',
            'email_address',
            'physical_address',
            'twitter_link',
            'instagram_link',
            'youtube_link',
            'whats_app_link',
            'tiktok_link',
            'facebook_link',
            'linkedin_link',
            'organizer_link',
            'open_new_tab',
        ]), 'image' => $image]);

        return back()->with([
            'success' => [
                'title' => 'Successfully Created',
              'subtitle' => 'You have successfully create a new location.',
            ],
        ]);
    }
}
