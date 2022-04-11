<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //



        Product::create([
            'category_id' => 1,
            'title' => "Asus New",
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque nostrum dignissimos numquam quia ipsa est aut ex nam magnam ratione placeat obcaecati delectus hic corrupti velit quam, aliquam eligendi! Rem dolorum excepturi minima quia voluptas iure! Animi soluta odio suscipit eligendi cum ea numquam. Iusto provident quam fugit reiciendis consequuntur rem harum eius voluptatum, quae ducimus molestiae quisquam, quibusdam sed voluptatem, soluta repellat. Dolor eos perspiciatis consectetur? Illum assumenda nesciunt, exercitationem voluptatem vitae doloremque iure modi iste reiciendis eius aspernatur dolore molestiae quaerat eligendi consequuntur perferendis similique laudantium nulla? Maxime itaque esse nobis. Ratione ad, eligendi cum a quasi minima perferendis aut ullam culpa porro fuga nam sapiente ipsum veritatis voluptas, cupiditate laudantium iste recusandae maxime hic? In quos alias voluptate! Eius dolor laborum placeat esse, voluptatibus, debitis ea vel laboriosam iste, cum eum voluptate accusantium veniam optio velit. Libero vitae quod officiis veniam iure optio cumque quia tempore sequi quidem porro perferendis similique dolorum voluptates quam rerum maiores sint neque, expedita asperiores minus recusandae vel qui? Asperiores fugit maiores, cum totam sequi dolor? Cupiditate, quam natus illo ipsum corrupti facere sed in, magnam deserunt est, fugit tenetur impedit unde aperiam nemo sint. Vero laborum corrupti possimus quod itaque doloremque!',
            'price' => 5600000,
            'src_thumnail' => '/uploads/example.png',
        ]);

        Product::create([
            'category_id' => 1,
            'title' => "Macbook Chip M1 2021",
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque nostrum dignissimos numquam quia ipsa est aut ex nam magnam ratione placeat obcaecati delectus hic corrupti velit quam, aliquam eligendi! Rem dolorum excepturi minima quia voluptas iure! Animi soluta odio suscipit eligendi cum ea numquam. Iusto provident quam fugit reiciendis consequuntur rem harum eius voluptatum, quae ducimus molestiae quisquam, quibusdam sed voluptatem, soluta repellat. Dolor eos perspiciatis consectetur? Illum assumenda nesciunt, exercitationem voluptatem vitae doloremque iure modi iste reiciendis eius aspernatur dolore molestiae quaerat eligendi consequuntur perferendis similique laudantium nulla? Maxime itaque esse nobis. Ratione ad, eligendi cum a quasi minima perferendis aut ullam culpa porro fuga nam sapiente ipsum veritatis voluptas, cupiditate laudantium iste recusandae maxime hic? In quos alias voluptate! Eius dolor laborum placeat esse, voluptatibus, debitis ea vel laboriosam iste, cum eum voluptate accusantium veniam optio velit. Libero vitae quod officiis veniam iure optio cumque quia tempore sequi quidem porro perferendis similique dolorum voluptates quam rerum maiores sint neque, expedita asperiores minus recusandae vel qui? Asperiores fugit maiores, cum totam sequi dolor? Cupiditate, quam natus illo ipsum corrupti facere sed in, magnam deserunt est, fugit tenetur impedit unde aperiam nemo sint. Vero laborum corrupti possimus quod itaque doloremque!',
            'price' => 19600000,
            'src_thumnail' => '/uploads/example.png',
        ]);
    }
}
