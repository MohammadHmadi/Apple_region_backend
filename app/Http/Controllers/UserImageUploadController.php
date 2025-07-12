<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserImageUploadController extends Controller
{
    public function userUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();

        // Store directly in public/storage/image/users
        $publicPath = public_path('storage/image/users');
        $image->move($publicPath, $imageName);

        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'url' => asset("storage/image/users/$imageName")
        ]);
    }
}