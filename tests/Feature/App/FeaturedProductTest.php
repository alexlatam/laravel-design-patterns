<?php

namespace Tests\Feature\App;

use App\Models\FeaturedProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class FeaturedProductTest extends TestCase
{
    /** @test */
    public function givenEmptyFeaturedProductController_whenFeaturedProductCreated_thenFeaturedProductFoundOnDatabase() {
        $name = $this->faker->name;
        $data = [
            "name" => $name,
            "description" => $this->faker->text(500),
            "stock" => $this->faker->numberBetween(10, 100),
            "available" => true,
        ];

        $response = $this->post(route("api.products.store"), $data);

        $response->assertStatus(201);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas("featured_products", [
            "name" => $name,
        ]);
    }

    /** @test */
    public function givenEmptyFeaturedProductController_whenFeaturedProductCreatedWithoutName_thenValidationNameFails() {
        $data = [
            "description" => $this->faker->text(500),
            "stock" => $this->faker->numberBetween(10, 100),
            "available" => true,
        ];
        $response = $this->post(route("api.products.store"), $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors("name");
    }

    /** @test */
    public function givenFeaturedProductControllerWithMultipleFeaturedProducts_whenFetchAll_thenFeaturedProductsCanBeListed() {
        $products = FeaturedProduct::factory(10)->create();

        $response = $this->get(route("api.products.index"));
        $response->assertStatus(200);
        $response->assertExactJson($products->toArray());
        $response->assertJsonCount($products->count());
        $response->assertJsonFragment([
            "name" => $products->first()->name,
        ]);
        $response->assertJsonFragment([
            "stock" => $products->last()->stock,
        ]);
    }

    /** @test */
    public function givenFeaturedProductControllerWithOneFeaturedProduct_whenFindById_thenFeaturedProductCanBeFetched() {
        $product = FeaturedProduct::factory()->create();

        $response = $this->get(route("api.products.show", $product->id));
        $response->assertStatus(200);
        $response->assertExactJson($product->toArray());
        $response->assertJsonStructure(["name", "description", "stock", "available"]);

        $this->assertDatabaseHas("featured_products", [
            "id" => $product->id,
        ]);
    }

    /** @test */
    public function givenEmptyFeaturedProductController_whenFeaturedProductNotFound_thenStatusCodeIs404() {
        $response = $this->get(route("api.products.show", 1));
        $response->assertStatus(404);
    }

    /** @test */
    public function givenEmptyFeaturedProductController_whenFeaturedProductNotFoundWithoutHandlingException_thenThrowsModelNotFoundException() {
        $this->expectException(ModelNotFoundException::class);

        $this->withoutExceptionHandling();

        $this->get(route("api.products.show", 1));
    }

    /** @test */
    public function givenFeaturedProductControllerWithMultipleFeaturedProducts_whenFindByName_thenFeaturedProductFoundOnDatabase() {
        FeaturedProduct::factory()->create();
        $product = FeaturedProduct::factory()->create();
        FeaturedProduct::factory()->create();

        $response = $this->get(route("api.products.find_by_name", $product->name));
        $response->assertStatus(200);
        $response->assertExactJson($product->toArray());

        $this->assertDatabaseHas("featured_products", [
            "name" => $product->name,
        ]);
    }

    /** @test */
    public function givenFeaturedProductControllerWithOneFeaturedProduct_whenFeaturedProductUpdated_thenFeaturedProductFoundOnDatabase() {
        $product = FeaturedProduct::factory()->create();

        $product->name = $product->name . " updated";

        $response = $this->put(route("api.products.update", $product->id), $product->toArray());
        $response->assertStatus(200);
        $response->assertExactJson($product->toArray());

        $this->assertDatabaseHas("featured_products", [
            "name" => $product->name,
        ]);
    }

    /** @test */
    public function givenFeaturedProductControllerWithOneFeaturedProduct_whenFeaturedProductDeleted_thenFeaturedProductNotFoundOnDatabase() {
        $product = FeaturedProduct::factory()->create();

        $this->assertDatabaseCount("featured_products", 1);

        $response = $this->delete(route("api.products.destroy", $product->id));
        $response->assertStatus(201);

        $this->assertDatabaseCount("featured_products", 0);
        $this->assertDatabaseMissing("featured_products", [
            "id" => $product->id,
        ]);
    }
}
