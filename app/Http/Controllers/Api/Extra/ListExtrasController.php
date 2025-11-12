<?php

namespace App\Http\Controllers\Api\Extra;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\JsonResponse;

class ListExtrasController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $extras = Extra::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'price_type', 'price', 'max_quantity']);

        return response()->json([
            'extras' => $extras,
        ]);
    }
}
