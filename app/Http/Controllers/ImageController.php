<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/image/' . $filename);

        if (!Storage::disk('public')->exists($filename)) {
            abort(404);
        }

        $file = Storage::disk('public')->get($filename);
        $type = Storage::mimeType($filename);

        return (new Response($file, 200))
            ->header('Content-Type', $type);
    }
}
