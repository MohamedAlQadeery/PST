<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $model;

    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    //upload image to specifc directory
    public function uploadDirImage($image, $dir, $height = 300)
    {
        if (!file_exists(public_path('uploads\\'.$dir))) {
            Storage::disk('public_uploads')->makeDirectory($dir);
        }
        Image::make($image)->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads\\'.$dir.'\\'.$image->hashName()));

        return $image->hashName();
    }

    public function uploadImage($image, $height = 300)
    {
        Image::make($image)->resize(null, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('uploads\\'.$image->hashName()));

        return $image->hashName();
    }

    public function getPluralModelName()
    {
        return Str::plural(strtolower(class_basename($this->model)));
    }

    public function success($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'errors' => 0,
        ], $status)
            ->header('Content-type', 'application/json');
    }

    public function error($data, $status = 500)
    {
        if ($data instanceof MessageBag) {
            $data = $data->first();
        }
        $response = response()->json([
            'status' => 'error',
            'data' => $data,
            'errors' => 1,
        ], $status)
            ->header('Content-type', 'application/json');

        return $response;
    }
}
