<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $amount
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 * @property string $orderReference
 * @property string $orderDate
 * @property string $productName
 * @property string $productPrice
 * @property string $productCount
 */
class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'json',
    ];

    protected $fillable = [
        'user_id',
        'orderReference',
        'orderDate',
        'amount',
        'currency',
        'productName',
        'productPrice',
        'productCount',
        'hash'
    ];
}
