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
        $maxPricesTotals = Item::MaxTotalPriceForUrl();
        $pricesTotalsThisMonth = Item::name();

        return new JsonResponse([
            'count' => $items_count,
            'price average' => $avgStar,
            'highest prices totals'=> $maxPricesTotals,
            'total price this month'=> $pricesTotalsThisMonth
        ]);
    }
}