<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request){
        $request->validate(['images.*' => ['mimes:png,jpg'], 'images' => ['required', 'array'], 'folder_id' => ['nullable', 'numeric']]);
        $data = [];

        foreach($request->file('images') as $image){
            $location = Storage::url($image->store('library/images', 'public'));
            array_push($data, ['location' => $location, 'folder_id' => $request->folder_id, 'name' => $image->getClientOriginalName()]);
        }

        DB::table('images')->insert($data);

        return back();
    }
}
