<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json([
        'health' => 'ok',
    ]);
});
