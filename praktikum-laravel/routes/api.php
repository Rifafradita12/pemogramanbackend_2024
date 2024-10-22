<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
#menthod Get
// Menampilkan data hewan  Animals
Route::get('/animals', [AnimalController::class, 'index']);

#menthod Post
// Menambahkan Animals hewan baru 
Route::post('/animals', [AnimalController::class, 'store']);

#menthod Put
// Mengupdate hewan 
Route::put('/animals/{id}', [AnimalController::class, 'update']);

#menthod Delete
// Menghapus hewan 
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);