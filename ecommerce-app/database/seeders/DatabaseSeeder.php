<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Country;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserReview;
use App\Models\ViewedProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeding Countries
        $countries = Country::factory(10)->create();

        // Seed Addresses and set a default address for each User
        $users = User::factory(10)->create()->each(function ($user) use ($countries) {

            $addresses = Address::factory(rand(3, 5))->create([
                'country_id' => $countries->random()->id,
            ]);

            $addresses->each(function ($address) use ($user) {
                UserAddress::create([
                    'user_id' => $user->id,
                    'address_id' => $address->id,
                    'is_default' => false, // Set default value
                ]);
            });

            // Set a default address for each user
            $defaultAddress = $addresses->random();
            UserAddress::where('user_id', $user->id)
                ->where('address_id', $defaultAddress->id)
                ->update(['is_default' => true]);

            // Seed Shopping Carts for each User
            $carts = ShoppingCart::factory(rand(1, 3))->create(['user_id' => $user->id]);
            $carts->each(function ($cart) {
                ShoppingCartItem::factory(rand(5, 10))->create(
                    ['shopping_cart_id' => $cart->id]
                );
            });

            // Seed Orders for each User
            $orderStatuses = OrderStatus::factory()->state([
                'status' => 'pending',
            ])->create();
            $orders = OrderDetail::factory(rand(1, 3))->create([
                'user_id' => $user->id,
                'address_id' => $defaultAddress->id,
                'order_status_id' => $orderStatuses->id,
            ]);

            $orders->each(function ($order) use ($user) {
                // Seed Order Items for each Order
                OrderItem::factory(rand(1, 5))->create(['order_detail_id' => $order->id])->each(function ($orderItem) use ($user) {
                    // Seed User Reviews for each Order Item
                    UserReview::factory(rand(5, 10))->create([
                        'user_id' => $user->id,
                        'order_item_id' => $orderItem->id,
                    ]);
                });
            });

            // Seed Viewed Products
            $products = Product::factory(10)->create();
            ViewedProduct::factory(rand(1, 10))->create([
                'user_id' => $user->id,
                'product_id' => $products->random()->id,
            ]);

        });

        // Create parent categories
        $parentCategories = ProductCategory::factory(10)->create();

        // Create child categories for each parent category
        foreach ($parentCategories as $parentCategory) {
            ProductCategory::factory(3)
                ->withParent($parentCategory)
                ->create();
        }
    }
}