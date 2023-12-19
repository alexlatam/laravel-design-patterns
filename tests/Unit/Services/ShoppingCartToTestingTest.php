<?php

namespace Tests\Unit\Services;

use App\Services\ShoppingCartToTesting;
use Exception;
use Tests\TestCase;

class ShoppingCartToTestingTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function it_should_add_product(): void
    {
        // Creamos una instancia de la clase ShoppingCartToTesting
        $cart = new ShoppingCartToTesting;
        // Agregamos un producto usando el metodo addProduct
        $cart->addProduct([
            "id" => 1,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        // Verificamos que el carrito tenga un producto
        $this->assertEquals(1, $cart->totalProducts());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_increase_quantity(): void
    {
        $cart = new ShoppingCartToTesting;
        $productId = 1;
        $cart->addProduct([
            "id" => $productId,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $this->assertEquals(1, $cart->totalProducts());

        $cart->increaseQuantity($productId);

        $this->assertEquals(1, $cart->totalProducts());
        $this->assertEquals(2, $cart->totalProductQuantity($productId));
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_decrease_quantity(): void
    {
        $cart = new ShoppingCartToTesting;
        $productId = 1;
        $cart->addProduct([
            "id" => $productId,
            "name" => "Producto 1",
            "price" => 1020,
        ]);

        $cart->increaseQuantity($productId);

        $cart->decreaseQuantity($productId);
        $this->assertEquals(1, $cart->totalProductQuantity($productId));
    }

    /**
     * Test que valida que solo se pueda agregar un producto a la vez.
     *
     * @test
     * @throws Exception
     */
    public function it_not_should_add_multiple_products_at_once(): void
    {
        // Esperamos que se lance una excepcion de tipo Exception.
        // Mas especificamente que el mensaje de la excepcion sea el que esperamos.
        $this->expectExceptionMessage(ShoppingCartToTesting::EXCEPTION_MESSAGE_MULTIPLE_PRODUCTS_AT_ONCE);
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([[
            "id" => 1,
            "name" => "Producto 1",
            "price" => 1020,
        ], [
            "id" => 2,
            "name" => "Producto 2",
            "price" => 1020,
        ]]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_remove_product(): void
    {
        $cart = new ShoppingCartToTesting;
        $product1Id = 1;
        $cart->addProduct([
            "id" => $product1Id,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $product2Id = 2;
        $cart->addProduct([
            "id" => $product2Id,
            "name" => "Producto 2",
            "price" => 520,
        ]);
        $cart->removeProduct($product1Id);
        $cart->removeProduct($product2Id);
        $this->assertEquals(0, $cart->totalProducts());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_remove_a_product_if_quantity_is_zero(): void
    {
        $cart = new ShoppingCartToTesting;
        $productId = 1;
        $cart->addProduct([
            "id" => $productId,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $cart->decreaseQuantity($productId);
        $this->assertEquals(0, $cart->totalProducts());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_empty_cart(): void
    {
        $cart = new ShoppingCartToTesting;
        $productId = 1;
        $cart->addProduct([
            "id" => $productId,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $cart->clear();
        $this->assertEquals(0, $cart->totalProducts());
        $this->assertEquals(0, $cart->totalProductsQuantity());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_calculates_all_quantities(): void {
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $this->assertEquals(1, $cart->totalProductsQuantity());

        $cart->addProduct([
            "id" => 2,
            "name" => "Producto 2",
            "price" => 520,
        ]);
        $this->assertEquals(2, $cart->totalProductsQuantity());

        $cart->increaseQuantity(1);
        $this->assertEquals(3, $cart->totalProductsQuantity());

        $cart->increaseQuantity(1);
        $cart->increaseQuantity(1);
        $cart->increaseQuantity(1);
        $this->assertEquals(6, $cart->totalProductsQuantity());

        $cart->decreaseQuantity(1);
        $this->assertEquals(5, $cart->totalProductsQuantity());

        $cart->increaseQuantity(2);
        $this->assertEquals(6, $cart->totalProductsQuantity());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_check_if_have_products(): void {
        $cart = new ShoppingCartToTesting;
        $this->assertFalse($cart->hasProducts());

        $cart->addProduct([
            "id" => 1,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $this->assertTrue($cart->hasProducts());

        $cart->clear();
        $this->assertFalse($cart->hasProducts());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_should_calculates_total_amount(): void {
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "name" => "Producto 1",
            "price" => 1020,
        ]);
        $this->assertEquals(1020, $cart->totalAmount());

        $cart->addProduct([
            "id" => 2,
            "name" => "Producto 2",
            "price" => 520,
        ]);
        $this->assertEquals(1540, $cart->totalAmount());

        $cart->increaseQuantity(1);
        $this->assertEquals(2560, $cart->totalAmount());

        $cart->decreaseQuantity(1);
        $this->assertEquals(1540, $cart->totalAmount());
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_not_should_add_without_product_id(): void {
        $this->expectExceptionMessage(ShoppingCartToTesting::EXCEPTION_MESSAGE_PRODUCT_ID_IS_MANDATORY);
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "name" => "Producto 1",
            "price" => 1020,
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_not_should_add_without_product_name(): void {
        $this->expectExceptionMessage(ShoppingCartToTesting::EXCEPTION_MESSAGE_PRODUCT_NAME_IS_MANDATORY);
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "price" => 1020,
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_not_should_add_without_product_price(): void {
        $this->expectExceptionMessage(ShoppingCartToTesting::EXCEPTION_MESSAGE_PRODUCT_PRICE_IS_MANDATORY);
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "name" => "Product 1"
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_not_should_add_product_with_negative_prices(): void {
        $this->expectExceptionMessage("Negative or zero prices is not allowed");
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "name" => "Product 1",
            "price" => -100,
        ]);
    }

    /**
     * @test
     * @throws Exception
     */
    public function it_not_should_add_product_with_zero_prices(): void {
        $this->expectExceptionMessage("Negative or zero prices is not allowed");
        $cart = new ShoppingCartToTesting;
        $cart->addProduct([
            "id" => 1,
            "name" => "Product 1",
            "price" => 0,
        ]);
    }
}
