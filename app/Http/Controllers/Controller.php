<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function uploadImage($image,$dir,$height=300){

        if(!file_exists(public_path('uploads\\'.$dir))){
            Storage::disk('public_uploads')->makeDirectory($dir);
        }
        Image::make($image)->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads\\'.$dir.'\\'.$image->hashName()));

        return $image->hashName();
    }
}
