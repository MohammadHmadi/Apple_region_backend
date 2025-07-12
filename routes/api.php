<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\UserImageUploadController;


Route::post('/upload', [ImageUploadController::class, 'upload']);
Route::post('/userUpload', [UserImageUploadController::class, 'userUpload']);