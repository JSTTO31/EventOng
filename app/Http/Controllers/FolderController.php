<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function store(Request $request){
        $request->validate(['name' => ['required', 'string'], 'folder_id' => ['nullable', 'numeric']]);
        Folder::create($request->only(['name', 'folder_id']));

        return back();
    }
}
