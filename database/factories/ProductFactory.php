<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'size_table' => [
                // some dummy sizes
                [
                    'values' => [
                        ['uk' => 'S', 'en' => 'S'],
                        ['uk' => '114 см', 'en' => '114 sm'],
                        ['uk' => '56 см', 'en' => '56 sm'],
                    ],
                ],
                [
                    'values' => [
                        ['uk' => 'M', 'en' => 'M'],
                        ['uk' => '122 см', 'en' => '122 sm'],
                        ['uk' => '60 см', 'en' => '60 sm'],
                    ],
                ],
                [
                    'values' => [
                        ['uk' => 'L', 'en' => 'L'],
                        ['uk' => '130 см', 'en' => '130 sm'],
                        ['uk' => '64 см', 'en' => '64 sm'],
                    ],
                ],
                [
                    'values' => [
                        ['uk' => 'XL', 'en' => 'XL'],
                        ['uk' => '144 см', 'en' => '144 sm'],
                        ['uk' => '68 см', 'en' => '68 sm'],
                    ],
                ],
                [
                    'values' => [
                        ['uk' => '2XL', 'en' => '2XL'],
                        ['uk' => '150 см', 'en' => '150 sm'],
                        ['uk' => '71 см', 'en' => '71 sm'],
                    ],
                ],
                [
                    'values' => [
                        ['uk' => 'XL', 'en' => 'XL'],
                        ['uk' => '160 см', 'en' => '160 sm'],
                        ['uk' => '73 см', 'en' => '73 sm'],
                    ],
                ],
            ],
            'render_columns' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
