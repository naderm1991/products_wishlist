<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Serializers\ItemSerializer;
use Illuminate\Http\JsonResponse;

class StatisticsController
{
    public function index(): JsonResponse
    {
        $items_count = Item::count();
        $avgStar = Item::avg('price');
        $maxPricesTotals = Item::getMaxTotalPriceForUrl();
        $pricesTotalsThisMonth = Item::getTotalPriceThisMonth();

        return new JsonResponse(['statistics' =>[
            'count' => $items_count,
            'price average' => $avgStar,
            'highest prices totals'=> $maxPricesTotals,
            'total price this month'=> $pricesTotalsThisMonth
        ]]);
    }
}