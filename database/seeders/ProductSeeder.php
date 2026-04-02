<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Wireless Bluetooth Headphones',
                'price'       => 49.99,
                'description' => 'Over-ear headphones with noise cancellation and 30-hour battery life.',
            ],
            [
                'name'        => 'Mechanical Keyboard',
                'price'       => 89.99,
                'description' => 'Compact TKL layout with Cherry MX Red switches and RGB backlight.',
            ],
            [
                'name'        => 'USB-C Hub 7-in-1',
                'price'       => 34.99,
                'description' => 'Expands a single USB-C port to HDMI, USB 3.0, SD card reader, and more.',
            ],
            [
                'name'        => 'Ergonomic Office Chair',
                'price'       => 249.00,
                'description' => 'Adjustable lumbar support, breathable mesh back, and 360° swivel base.',
            ],
            [
                'name'        => 'Portable SSD 1TB',
                'price'       => 79.99,
                'description' => 'USB 3.2 Gen 2 portable solid-state drive with read speeds up to 1050 MB/s.',
            ],
            [
                'name'        => '4K Webcam',
                'price'       => 129.99,
                'description' => 'Ultra HD video conferencing camera with built-in mic and autofocus.',
            ],
            [
                'name'        => 'Smart LED Desk Lamp',
                'price'       => 39.99,
                'description' => 'Touch-dimmable lamp with adjustable colour temperature and USB charging port.',
            ],
            [
                'name'        => 'Laptop Stand Aluminium',
                'price'       => 29.99,
                'description' => 'Foldable, height-adjustable stand compatible with 10–17 inch laptops.',
            ],
            [
                'name'        => 'Noise-Cancelling Earbuds',
                'price'       => 59.99,
                'description' => 'True wireless earbuds with ANC, 28-hour total playtime, and IPX4 rating.',
            ],
            [
                'name'        => 'Wireless Charging Pad',
                'price'       => 19.99,
                'description' => '10W fast wireless charger compatible with Qi-enabled smartphones.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        Product::factory(10)->create();
    }
}
