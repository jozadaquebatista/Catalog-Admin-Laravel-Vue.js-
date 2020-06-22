<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

use App\Picture;

class Pictures extends Controller
{
    public function store(Request $request)
    {
        if(!$request->has('image')) return false;

        if(gettype($request->image) != 'object')
        {
            throw new \Exception('make sure it is a file.');
        }

        $path = storage_path('app\public\images');
        $imageName = time() . '.' . $request->image->extension();

        try {
            if(!File::isDirectory($path))
            {
                File::makeDirectory($path, 0777, true, true);
            }

            $request->image->move($path , $imageName);
        } catch(\Exception $e) {
            throw new \Exception('unable to create/open the directory and move the file.');
        }

        return $imageName;
    }
}
