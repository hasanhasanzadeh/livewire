<?php


use App\Livewire\ArticleShowAll;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', ArticleShowAll::class);
