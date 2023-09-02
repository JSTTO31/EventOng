<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImageLibraryController extends Controller
{
    public function index(Request $request, Folder $folder){
        $folder->load('folders', 'images', 'folder.folder');


        return Inertia::render('ImageLibrary', [
            'folders' => $folder->getAttributes() ? $folder->folders : Folder::whereNull('folder_id')->get(),
            'images' => $folder->getAttributes() ? $folder->images : Image::whereNull('folder_id')->get(),
            'folder' => $folder,
        ]);
    }
}
