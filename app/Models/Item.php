<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static count()
 * @method static avg(string $string)
 * @method static select(\Illuminate\Database\Query\Expression $raw, \Illuminate\Database\Query\Expression $raw1, \Illuminate\Database\Query\Expression $raw2)
 */
class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    // todo  why it's bad to add static functions
    //- the website with the highest total price of its items
    public static function getMaxTotalPriceForUrl()
    {
        $maxTotal = DB::table('items')
            ->select([DB::raw('sum(price) as total'),'url'])
            ->groupBy('url')
            ->orderBy("total","DESC")
            ->limit(1)
            ->first('url');

        return $maxTotal?parse_url($maxTotal->url)['host']:"";
    }

    public static function getTotalPriceThisMonth(){

        $priceSum=  DB::table('items')->select(
            DB::raw('month(created_at) as month'),
            DB::raw('sum(price) as price_sum')
        )
            ->where(DB::raw('created_at'), '>=', Carbon::now()->startOfMonth())
            ->groupBy('month')
            ->limit(1)
            ->first('price_sum')
        ;
        return $priceSum?$priceSum->price_sum:0;
    }
}
