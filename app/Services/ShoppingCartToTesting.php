<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Collection;

/**
 * Class Cart
 * @package App\Services
 */
class ShoppingCartToTesting {

    public const EXCEPTION_MESSAGE_MULTIPLE_PRODUCTS_AT_ONCE = "Only single products can be added to cart";
    public const EXCEPTION_MESSAGE_PRODUCT_ID_IS_MANDATORY = "Product id is mandatory";
    public const EXCEPTION_MESSAGE_PRODUCT_NAME_IS_MANDATORY = "Product name is mandatory";
    public const EXCEPTION_MESSAGE_PRODUCT_PRICE_IS_MANDATORY = "Product price is mandatory";

    protected Collection $cart;

    public function __construct() {
        $this->cart = session()->has('cart') ? session('cart') : new Collection;
    }

    public function getContent(): Collection {
        return $this->cart;
    }

    /**
     * Save the cart on session
     */
    protected function save(): void {
        session()->put('cart', $this->cart);
        session()->save();
    }

    /**
     * Add product to cart or update if exists
     *
     * @throws Exception
     */
    public function addProduct(array $product): void {
        $single = (count($product) == count($product, COUNT_RECURSIVE));
        if (!$single) {
            throw new Exception(self::EXCEPTION_MESSAGE_MULTIPLE_PRODUCTS_AT_ONCE);
        }

        if (!array_key_exists("id", $product)) throw new Exception(self::EXCEPTION_MESSAGE_PRODUCT_ID_IS_MANDATORY);
        if (!array_key_exists("price", $product)) throw new Exception(self::EXCEPTION_MESSAGE_PRODUCT_PRICE_IS_MANDATORY);
        if (!array_key_exists("name", $product)) throw new Exception(self::EXCEPTION_MESSAGE_PRODUCT_NAME_IS_MANDATORY);

        $exists = $this->cart->get($product['id']);
        if ($exists) {
            $this->increaseQuantity($product["id"]);
        } else {
            if ($product["price"] <= 0) {
                throw new Exception("Negative or zero prices is not allowed");
            }
            $product['quantity'] = 1;
            $this->cart->put($product['id'], $product);
            $this->save();
        }
    }

    /**
     * Increase quantity from product in cart
     *
     * @throws Exception
     */
    public function increaseQuantity(int $id): void
    {
        $product = $this->cart->get($id);
        if (!$product) {
            throw new Exception("Product not found");
        }
        $product['quantity'] = $product['quantity'] + 1;
        $this->cart->put($id, $product);
        $this->save();
    }

    /**
     * Decrease quantity from product in cart
     *
     * @throws Exception
     */
    public function decreaseQuantity(int $id): void
    {
        $product = $this->cart->get($id);
        if (!$product) {
            throw new Exception("Product not found");
        }
        if ($product['quantity'] > 1) {
            $product['quantity'] = $product['quantity'] - 1;
            $this->cart->put($id, $product);
            $this->save();
        } else {
            $this->removeProduct($id);
        }
    }

    /**
     * Remove product from cart
     */
    public function removeProduct(int $id): void {
        $this->cart = $this->cart->reject(function (array $product) use ($id) {
            return $product['id'] === $id;
        });
        $this->save();
    }

    /**
     * Total cost in the cart
     */
    public function totalAmount(): mixed
    {
        return $this->cart->sum(function (array $product) {
            return $product['price'] * $product['quantity'];
        });
    }

    /**
     * Has products in cart?
     */
    public function hasProducts(): bool {
        return $this->cart->count() > 0;
    }

    /**
     * Total quantity products in cart
     */
    public function totalProductsQuantity(): int {
        return $this->cart->sum(function (array $product) {
            return $product['quantity'];
        });
    }

    /**
     * Total quantity for product in cart
     * @throws Exception
     */
    public function totalProductQuantity(int $id): int {
        $product = $this->cart->get($id);
        if (!$product) {
            throw new Exception("Product not found");
        }
        return $product['quantity'];
    }

    public function totalProducts(): int {
        return $this->cart->count();
    }

    public function clear(): void {
        $this->cart = new Collection;
        $this->save();
    }
}
