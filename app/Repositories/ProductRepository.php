<?php

namespace App\Repositories;

use App\Models\Product;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ProductRepository
 */
class ProductRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    public $fieldSearchable = [
        'name',
        'price',
        'category.name',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Product::class;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();
            $product = Product::create($this->prepareProductInput($input));
            if (isset($input['image']) && ! empty($input['image'])) {
                $product->addMedia($input['image'])->toMediaCollection(Product::Image, config('app.media_disc'));
            }
            if (! empty($input['image_remove']) && empty($input['image'])) {
                $product->clearMediaCollection(Product::Image);
                $product->media()->delete();
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateProduct(array $input, int $id): bool
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            $product->update($this->prepareProductInput($input));
            if (isset($input['image']) && ! empty($input['image'])) {
                $product->clearMediaCollection(Product::Image);
                $product->media()->delete();
                $product->addMedia($input['image'])->toMediaCollection(Product::Image, config('app.media_disc'));
            }
            if (! empty($input['image_remove']) && empty($input['image'])) {
                $product->clearMediaCollection(Product::Image);
                $product->media()->delete();
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    private function prepareProductInput(array $input): array
    {
        $fields = ['name', 'category_id', 'unit_price', 'description'];
        $optionalHotelFields = ['room_type', 'default_no_of_pax', 'meal_plan', 'special_remarks'];

        foreach ($optionalHotelFields as $column) {
            if (Schema::hasColumn('products', $column)) {
                $fields[] = $column;
            }
        }

        return Arr::only($input, $fields);
    }
}
