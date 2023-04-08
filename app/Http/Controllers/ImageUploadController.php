<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Intervention\Image\Facades\Image as ImgPackage;
use Exception;
use App\Jobs\Blur;
use App\Jobs\GreyScale;
use App\Jobs\Rotate;

class ImageUploadController extends Controller
{
    public function index()
    {

        $images=image::all();
        return view('image',['images'=>$images]);
    }

    public function save(Request $request)
    {
      try{
        $validatedData = $request->validate([
         'img' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);


            $filenameWithExt = $request->file('img')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('img')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('img')->storeAs('public/images', $fileNameToStore);



        \Bus::chain([
            new Blur($path),
            new GreyScale($path),
            new Rotate($path)
            ])->dispatch();

        // Blur::dispatch($path);

        $var = new Image();
        $var->name = $fileNameToStore;
        $var->path = '-';
        $var->save();

        return redirect('upload-image')->with('status', 'Image Has been uploaded');
    }
        catch(Exception $e) {
        return $e->getMessage();
        }
    }

}
