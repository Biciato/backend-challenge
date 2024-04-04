<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = [
            [
                'name' => 'Suprimento Alimentar',
                'price' => 5.00,
                'thumb' => 'https://cdn.shopify.com/s/files/1/1830/5085/products/VE0007_BCAA_Capsule_90ct_2048x2048.png?v=1494855182'
            ],
            [
                'name' => 'Cerveja Aleatória',
                'price' => 2.50,
                'thumb' => 'https://source.unsplash.com/user/c_v_r/1900×800'
            ],
            [
                'name' => 'Café Pelé',
                'price' => 1.50,
                'thumb' => 'https://fastly.picsum.photos/id/63/5000/2813.jpg?hmac=HvaeSK6WT-G9bYF_CyB2m1ARQirL8UMnygdU9W6PDvM'
            ],
            [
                'name' => 'Leite',
                'price' => 6.20,
                'thumb' => 'https://fastly.picsum.photos/id/30/1280/901.jpg?hmac=A_hpFyEavMBB7Dsmmp53kPXKmatwM05MUDatlWSgATE'
            ],
            [
                'name' => 'Óleo',
                'price' => 20.10,
                'thumb' => 'https://fastly.picsum.photos/id/41/1280/805.jpg?hmac=W9CWeYdlZisqEfhjuODl83T3lCXAqjUZrOe9iMFPYmI'
            ],
        ];

        foreach ($produtos as $attributes) {
            Produto::create($attributes);
        }
    }
}
