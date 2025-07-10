<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Katalog;
use App\Models\Category;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Pastikan ada kategori terlebih dahulu
        $categories = Category::all();
        
        if ($categories->count() == 0) {
            // Buat kategori sample jika belum ada
            $categories = collect([
                Category::create(['nama_kategori' => 'Brownies Original']),
                Category::create(['nama_kategori' => 'Brownies Premium']),
                Category::create(['nama_kategori' => 'Brownies Spesial']),
                Category::create(['nama_kategori' => 'Kue Lainnya']),
            ]);
        }

        // Data sample katalog
        $katalogData = [
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Coklat Original',
                'deskripsi' => 'Brownies coklat dengan tekstur lembut dan rasa coklat yang kaya. Dibuat dengan bahan-bahan berkualitas tinggi.',
                'harga' => 25000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Keju Premium',
                'deskripsi' => 'Kombinasi sempurna antara brownies coklat dan keju yang creamy. Favorit pelanggan!',
                'harga' => 35000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Pandan Spesial',
                'deskripsi' => 'Inovasi rasa pandan yang segar dengan topping kelapa parut. Rasa Indonesia yang autentik.',
                'harga' => 30000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Red Velvet',
                'deskripsi' => 'Brownies dengan warna merah menarik dan cream cheese frosting yang lezat.',
                'harga' => 40000,
                'status' => 'habis',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Nutella',
                'deskripsi' => 'Brownies dengan lapisan nutella yang melimpah. Cocok untuk pecinta coklat.',
                'harga' => 45000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Matcha',
                'deskripsi' => 'Rasa matcha yang autentik dengan tekstur yang lembut. Limited edition!',
                'harga' => 38000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Strawberry',
                'deskripsi' => 'Brownies dengan rasa strawberry yang segar dan topping buah strawberry asli.',
                'harga' => 42000,
                'status' => 'habis',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Oreo Crunch',
                'deskripsi' => 'Kombinasi brownies dengan serpihan oreo yang memberikan tekstur renyah.',
                'harga' => 36000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Brownies Salted Caramel',
                'deskripsi' => 'Perpaduan manis dan asin dari caramel dengan sedikit garam laut.',
                'harga' => 48000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
            [
                'category_id' => $categories->random()->id,
                'nama_produk' => 'Mini Brownies Mix',
                'deskripsi' => 'Paket mini brownies dengan berbagai rasa dalam satu box. Perfect untuk sharing!',
                'harga' => 55000,
                'status' => 'tersedia',
                'gambar_produk' => null,
            ],
        ];

        // Insert data ke database
        foreach ($katalogData as $data) {
            Katalog::create($data);
        }
    }
}