<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Citizen;
use App\Models\EventSourcing\Sync\Citizen as EventSourcingCitizen;
use App\Models\EventSourcing\Sync\TransactionCount;
use App\Models\Product;
use App\Models\User;
use Faker\Provider\es_VE\Address;
use Illuminate\Database\Seeder;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
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
            if ($deliveries > 0) {
                for ($i = 0; $i < $deliveries; $i++) {
                    $citizen->deliveryItems($deliveries);
                }
            }
        }


        for ($i = 0; $i < 10; $i++) {
            User::factory(random_int(5, 25))->create()->each(function (User $user) {
                $citizen = EventSourcingCitizen::createWithAttributes([
                    "user_id" => $user->id,
                    "community" => Address::community(),
                ]);

                TransactionCount::createWithAttributes([
                    'user_id' => $user->id,
                    'total' => 0,
                ]);

                $deliveries = random_int(0, 5);
                if ($deliveries > 0) {
                    for ($j = 0; $j < $deliveries; $j++) {
                        $citizen
                            ->deliveryItems(random_int(0, 9));
                    }
                }
            });
        }

    }
}
