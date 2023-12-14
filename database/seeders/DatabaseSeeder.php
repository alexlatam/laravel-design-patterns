<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Citizen;
use App\Models\Product;
use App\Models\User;
use Faker\Provider\es_VE\Address;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        User::factory(120)->create();
        Article::factory(120)->create();
        Product::factory(120)->create();

        $users = User::all();

        foreach ($users as $user) {
            $citizen = Citizen::create([
                'user_id' => $user->id,
                'community' => Address::community(),
                'total' => 0,
            ]);

            $deliveries = random_int(0, 5);
            if($deliveries > 0) {
                for ($i=0; $i < $deliveries; $i++) {
                    $citizen->deliveryItems($deliveries);
                }
            }
        }
    }
}
