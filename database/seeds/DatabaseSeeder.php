<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CreatorSeeder::class);
        $this->call(ImageSeeder::class);

        $this->call(SupplierSeeder::class);
        $this->call(ProductDetailsSeeder::class);
        $this->call(ProductionDetailsSeeder::class);
        // $this->call(ProductPropertiesSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);

        $this->call(OrderSeeder::class);
        $this->call(OrderItemSeeder::class);

    }
}
