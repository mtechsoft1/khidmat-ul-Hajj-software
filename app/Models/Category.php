<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public const VISA = 'Visa';
    public const TRANSPORTATION = 'Transportation';
    public const HOTEL_RESERVATION = 'Hotel Reservation';
    public const AIRLINE = 'Airline';

    protected $table = 'categories';

    protected $fillable = ['name'];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    public static $rules = [
        'name' => 'required|unique:categories,name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function defaultCategories(): array
    {
        return [
            self::VISA,
            self::TRANSPORTATION,
            self::HOTEL_RESERVATION,
            self::AIRLINE,
        ];
    }
}
