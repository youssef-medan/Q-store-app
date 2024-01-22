<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Category;
use \App\Models\CategoryImage;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
// use App\Models\User;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        \App\Models\User::factory()->create([
            'id'=>'1',
            'name' => 'youssef medan',
            'email' => 'user@mail.com',
            'password' => bcrypt('123456'),
            'role'=>'user',
            'mobile' => '01011017386',
        ]);
        \App\Models\User::factory()->create([
            'id'=>'2',
            'name' => 'youssef medan admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('123456'),
            'role'=>'admin',
            'mobile' => '01472569843',
        ]);
        \App\Models\User::factory()->create([
            'id'=>'3',
            'name' => 'youssef medan super admin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('123456'),
            'role'=>'superadmin',
            'mobile' => '82364016985',
        ]);

        Category::create(['name' => 'Home Appliances']);
        Category::create(['name' => 'Fashion']);
        Category::create(['name' => 'Mobile']);
        Category::create(['name' => 'Snacks']);
        Category::create(['name' => 'Sporting']);
        Category::create(['name' => 'Books, Movies and Music']);
        Category::create(['name' => 'Pet Supplies']);
        Category::create(['name' => 'Gaming']);
        Category::create(['name' => 'Health and Beauty']);
        Category::create(['name' => 'Baby Products']);


        Category::create(['name' => 'Tv', 'category_id' => 1]);
        Category::create(['name' => 'Air condtion', 'category_id' => 1]);
        Category::create(['name' => 'PC', 'category_id' => 1]);
        Category::create(['name' => 'T-shirts', 'category_id' => 2]);
        Category::create(['name' => 'Jeans', 'category_id' => 2]);

        Category::create(['name' => 'Android', 'category_id' => 3]);
        Category::create(['name' => 'iphone', 'category_id' => 3]);

        Category::create(['name' => 'Chips', 'category_id' => 4]);
        Category::create(['name' => 'Biscuits', 'category_id' => 4]);

        Category::create(['name' => 'Gym', 'category_id' => 5]);
        Category::create(['name' => 'Football', 'category_id' => 5]);

        Category::create(['name' => 'Books', 'category_id' => 6]);
        Category::create(['name' => 'lastest Album & Movies', 'category_id' => 6]);

        Category::create(['name' => 'Pet food', 'category_id' => 7]);
        Category::create(['name' => 'Pet Tools', 'category_id' => 7]);

        Category::create(['name' => 'Consles', 'category_id' => 8]);
        Category::create(['name' => 'Games Cd', 'category_id' => 8]);

        Category::create(['name' => 'Makeup & Perfume', 'category_id' => 9]);
        Category::create(['name' => 'Helthy Food', 'category_id' => 9]);

        Category::create(['name' => 'Pampers', 'category_id' => 10]);


        // \App\Models\Product::factory(10)->create();

        // \App\Models\Image::factory(10)->create();
        // \App\Models\Review::factory(10)->create();


        CategoryImage::create(['url' => 'category_images/1.jpg','category_id' => 1]);
        CategoryImage::create(['url' => 'category_images/2.jpg','category_id' => 2]);
        CategoryImage::create(['url' => 'category_images/3.webp','category_id' => 3]);
        CategoryImage::create(['url' => 'category_images/4.jpg','category_id' => 4]);
        CategoryImage::create(['url' => 'category_images/5.jpeg','category_id' => 5]);
        CategoryImage::create(['url' => 'category_images/6.jpg','category_id' => 6]);
        CategoryImage::create(['url' => 'category_images/7.jpg','category_id' => 7]);
        CategoryImage::create(['url' => 'category_images/8.jpg','category_id' => 8]);
        CategoryImage::create(['url' => 'category_images/9.webp','category_id' => 9]);
        CategoryImage::create(['url' => 'category_images/10.jpg','category_id' => 10]);


        CategoryImage::create(['url' => 'category_images/11.jpg', 'category_id' => 11]);
        CategoryImage::create(['url' => 'category_images/12.webp', 'category_id' => 12]);
        CategoryImage::create(['url' => 'category_images/13.jpg', 'category_id' => 13]);
        CategoryImage::create(['url' => 'category_images/14.webp', 'category_id' => 14]);
        CategoryImage::create(['url' => 'category_images/15.jpg', 'category_id' => 15]);

        CategoryImage::create(['url' => 'category_images/16.png', 'category_id' => 16]);
        CategoryImage::create(['url' => 'category_images/17.jpg', 'category_id' => 17]);

        CategoryImage::create(['url' => 'category_images/18.jpeg', 'category_id' => 18]);
        CategoryImage::create(['url' => 'category_images/19.jpg', 'category_id' => 19]);

        CategoryImage::create(['url' => 'category_images/20.jpg', 'category_id' => 20]);
        CategoryImage::create(['url' => 'category_images/21.jpg', 'category_id' => 21]);

        CategoryImage::create(['url' => 'category_images/22.jpg', 'category_id' => 22]);
        CategoryImage::create(['url' => 'category_images/23.jpg', 'category_id' => 23]);

        CategoryImage::create(['url' => 'category_images/24.webp', 'category_id' => 24]);
        CategoryImage::create(['url' => 'category_images/25.jpg', 'category_id' => 25]);

        CategoryImage::create(['url' => 'category_images/26.jpg', 'category_id' => 26]);
        CategoryImage::create(['url' => 'category_images/27.jpg', 'category_id' => 27]);

        CategoryImage::create(['url' => 'category_images/28.webp', 'category_id' => 28]);
        CategoryImage::create(['url' => 'category_images/29.jpg', 'category_id' => 29]);

        CategoryImage::create(['url' => 'category_images/30.jpg', 'category_id' => 30]);


        Product::create([
            'name'=>'samsung tv',
            'price'=>'8000',
            'description'=>'smart tv',
            'category_id'=>'11',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/1.webp',
            'product_id'=>'1',

        ]);

        Product::create([
            'name'=>'sharp air-condition',
            'price'=>'7000',
            'description'=>'2 horsepowe',
            'category_id'=>'12',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/2.webp',
            'product_id'=>'2',

        ]);

        Product::create([
            'name'=>'dell pc',
            'price'=>'10000',
            'description'=>'16g ram - intel core i9',
            'category_id'=>'13',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/3.webp',
            'product_id'=>'3',

        ]);

        Product::create([
            'name'=>'basic t-shirt',
            'price'=>'300',
            'description'=>'100% cotton',
            'category_id'=>'14',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/4.webp',
            'product_id'=>'4',

        ]);

        Product::create([
            'name'=>'clasic jeans',
            'price'=>'700',
            'description'=>'hight quallty blue jeans ',
            'category_id'=>'15',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/5.jpeg',
            'product_id'=>'5',

        ]);

        Product::create([
            'name'=>'Mi Poco f5',
            'price'=>'1500',
            'description'=>'8g ram snapdragon , 120H',
            'category_id'=>'16',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/6.jpeg',
            'product_id'=>'6',

        ]);

        Product::create([
            'name'=>'iphone 15 pro max',
            'price'=>'50000',
            'description'=>'apple iphone with pro camera ',
            'category_id'=>'17',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/7.jpeg',
            'product_id'=>'7',

        ]);

        Product::create([
            'name'=>'Tiger chips',
            'price'=>'5',
            'description'=>'high quallty potato chips',
            'category_id'=>'18',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/8.jpeg',
            'product_id'=>'8',

        ]);

        Product::create([
            'name'=>'Blazo',
            'price'=>'3',
            'description'=>'chocolate biscuit',
            'category_id'=>'19',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/9.jpeg',
            'product_id'=>'9',

        ]);

        Product::create([
            'name'=>'dumbbell',
            'price'=>'500',
            'description'=>'20kg metal dumbbell ',
            'category_id'=>'20',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/10.jpeg',
            'product_id'=>'10',

        ]);

        Product::create([
            'name'=>'champins league ball',
            'price'=>'2000',
            'description'=>'champins league 2024 ball made in indonsia',
            'category_id'=>'21',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/11.jpeg',
            'product_id'=>'11',

        ]);

        Product::create([
            'name'=>'Way to success',
            'price'=>'400',
            'description'=>'By Venom ',
            'category_id'=>'22',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/12.jpeg',
            'product_id'=>'12',

        ]);

        Product::create([
            'name'=>'fast & farious 2024',
            'price'=>'350',
            'description'=>'action film',
            'category_id'=>'23',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/13.jpeg',
            'product_id'=>'13',

        ]);

        Product::create([
            'name'=>'Dry food',
            'price'=>'600',
            'description'=>'2kg ',
            'category_id'=>'24',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/14.jpeg',
            'product_id'=>'14',

        ]);

        Product::create([
            'name'=>'collar',
            'price'=>'550',
            'description'=>'red collar for dogs',
            'category_id'=>'25',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/15.jpeg',
            'product_id'=>'15',

        ]);

        Product::create([
            'name'=>'Ps5',
            'price'=>'25000',
            'description'=>'sony ps5 with 2 daulshoke',
            'category_id'=>'26',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/16.jpeg',
            'product_id'=>'16',

        ]);

        Product::create([
            'name'=>'god of war ragnarok',
            'price'=>'900',
            'description'=>'exclusive of sony gow ragnarok',
            'category_id'=>'27',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/17.jpeg',
            'product_id'=>'17',

        ]);

        Product::create([
            'name'=>'212 sexy',
            'price'=>'2000',
            'description'=>'orignal perfiume',
            'category_id'=>'28',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/18.jpeg',
            'product_id'=>'18',

        ]);

        Product::create([
            'name'=>'green tea',
            'price'=>'200',
            'description'=>'organic tea',
            'category_id'=>'29',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/19.jpeg',
            'product_id'=>'19',

        ]);

        Product::create([
            'name'=>'pampers',
            'price'=>'550',
            'description'=>'size 4 ',
            'category_id'=>'30',
            'user_id'=>'2',

        ]);

        Image::create([
            'url'=>'product_images/20.jpeg',
            'product_id'=>'20',

        ]);




        \App\Models\User::factory()->has(Product::factory()->count(50)->has(Review::factory()->count(5)),'sellproducts')->create([
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->has(Product::factory()->count(50)->has(Review::factory()->count(5)),'sellproducts')->create([
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->has(Product::factory()->count(50)->has(Review::factory()->count(5)),'sellproducts')->create([
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->has(Product::factory()->count(50)->has(Review::factory()->count(5)),'sellproducts')->create([
            'role' => 'admin',
        ]);
    //   User::factory()->has(Product::factory()->count(50))->create([
    //         'role' => 'admin',
    //     ]);
    //   User::factory()->has(Product::factory()->count(50))->create([
    //         'role' => 'admin',
    //     ]);
    //   User::factory()->has(Product::factory()->count(50))->create([
    //         'role' => 'admin',
    //     ]);







    }
}
