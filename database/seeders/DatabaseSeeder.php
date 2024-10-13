<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Bill;
use App\Models\Dish;
use App\Models\DishType;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Table;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Account::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Admin',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Brooklynn',
            'role' => 1,
        ]);

        Account::create([
            'email' => 'manager@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Manager',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Jessica',
            'role' => 2,
        ]);

        Account::create([
            'email' => 'waiter@example.com',
            'password' => bcrypt('password'),
            'full_name' => 'Waiter',
            'sdt' => '0123456789',
            'image_url' => 'https://api.dicebear.com/9.x/avataaars-neutral/svg?seed=Jocelyn',
            'role' => 3,
        ]);

        $dishTypes = [
            'Main course',
            'Appetizer',
            'Dessert',
            'Drink',
        ];

        foreach ($dishTypes as $type) {
            DishType::create([
                'name' => $type,
            ]);
        }

        $dishes = [
            [
                'name' => 'Spaghetti with meatballs',
                'price' => 10.99,
                'status' => 'Good',
                'id_type' => 1,
                'information' => 'Spaghetti with meatballs is an Italian-American dish that usually consists of spaghetti, tomato sauce, and meatballs.',
                'image_url' => 'https://img.freepik.com/free-photo/meatballs-with-sweet-sour-tomato-sauce-trenette-pasta-plate_23-2147925987.jpg?t=st=1728808448~exp=1728812048~hmac=84d186352cfb90f49e3aa8f3f975d14c3694ed0341da1d10d7b155d800f32f55&w=1800',
            ],
            [
                'name' => 'Caesar salad',
                'price' => 7.99,
                'status' => 'Good',
                'id_type' => 2,
                'information' => 'Caesar salad is a green salad of romaine lettuce and croutons dressed with lemon juice, olive oil, egg, Worcestershire sauce, anchovies, garlic, Dijon mustard, Parmesan cheese, and black pepper.',
                'image_url' => 'https://img.freepik.com/free-photo/top-view-caesar-salad-oval-plate-green-white-checkered-tablecloth-fork-knife-dark-red-background_140725-124900.jpg?t=st=1728808473~exp=1728812073~hmac=998f86581bd9ed8bb53df6d6a920ee88e55378ebfc9e717412376fc11ada06db&w=1800',
            ],
            [
                'name' => 'Chocolate cake',
                'price' => 5.99,
                'status' => 'Good',
                'id_type' => 3,
                'information' => 'Chocolate cake is a cake flavored with melted chocolate, cocoa powder, or both.',
                'image_url' => 'https://img.freepik.com/free-photo/close-up-chocolate-cake_23-2148604534.jpg?t=st=1728808499~exp=1728812099~hmac=eef5b8a54c1cb8045fa46b4e890ee257246a5c52098703ab3e38b609d01a1904&w=1800',
            ],
            [
                'name' => 'Mojito',
                'price' => 4.99,
                'status' => 'Good',
                'id_type' => 4,
                'information' => 'Mojito is a traditional Cuban highball. Traditionally, a mojito is a cocktail that consists of five ingredients: white rum, sugar, lime juice, soda water, and mint.',
                'image_url' => 'https://img.freepik.com/free-photo/traditional-mojito-with-ice-mint-table_140725-867.jpg?t=st=1728808523~exp=1728812123~hmac=bec844e0cb328d8250a626de8e7512dc2be1d3203ca2de8797021347c0aadc71&w=1060',
            ],
        ];

        foreach ($dishes as $dish) {
            $newDish = Dish::create($dish);

            $path = 'dishes/' . Str::random(10) . '.jpg';
            Storage::put($path, file_get_contents($dish['image_url']));
            $newDish->image_url = Storage::url($path);
            $newDish->save();
        }

        $tables = [
            'Table 1',
            'Table 2',
            'Table 3',
            'Table 4',
            'Table 5',
            'Table 6',
            'Table 7',
            'Table 8',
            'Table 9',
            'Table 10',
        ];

        foreach ($tables as $table) {
            Table::create([
                'table_name' => $table,
                'status' => 'Available',
                'customer_name' => null,
            ]);
        }

        $orders = [
            [
                'table_id' => 1,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 2,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 3,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 4,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 5,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 6,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 7,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 8,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 9,
                'dish_id' => 3,
                'amount' => 10,
            ],
            [
                'table_id' => 10,
                'dish_id' => 3,
                'amount' => 10,
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }

        $bills = [
            [
                'order_id' => 1,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 2,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 3,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 4,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 5,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 6,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 7,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 8,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 9,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
            [
                'order_id' => 10,
                'status' => 1,
                'tong_tien' => 59.9,
            ],
        ];

        foreach ($bills as $bill) {
            Bill::create($bill);
        }

        $ingredients = [
            [
                'name' => 'Spaghetti',
                'image' => 'https://img.freepik.com/free-photo/raw-spaghetti-pasta-white_114579-37443.jpg?t=st=1728808547~exp=1728812147~hmac=9e445fb1dcf65edbe083c97cd5d21bc593becd9743a24262ff34dcea39da7560&w=1800',
                'amount' => 100,
            ],
            [
                'name' => 'Meatballs',
                'image' => 'https://img.freepik.com/free-photo/high-angle-arrangement-delicious-indonesian-bakso_23-2148933319.jpg?t=st=1728808572~exp=1728812172~hmac=a378e092e0e64ab0ed4d0734d46181aa34205840b02ba5827c6c06e9ed34e6a1&w=826',
                'amount' => 100,
            ],
            [
                'name' => 'Romaine lettuce',
                'image' => 'https://img.freepik.com/free-psd/romaine-isolated-transparent-background_191095-31476.jpg?w=1380&t=st=1728808612~exp=1728809212~hmac=40070d7437407b12e9c39a2daa083c3b7462700f3beb82f36c3de906ea3d4e14',
                'amount' => 100,
            ],
            [
                'name' => 'Croutons',
                'image' => 'https://img.freepik.com/free-photo/crumbs-bread-croutons_93675-132587.jpg?t=st=1728808628~exp=1728812228~hmac=de8061f4476d765e5bfc7e77bc71f4cb3b17926234f4f693d3f27e1336a21f54&w=1800',
                'amount' => 100,
            ],
        ];

        foreach ($ingredients as $ingredient) {
            $path = 'ingredients/' . Str::random(10) . '.jpg';
            Storage::put($path, file_get_contents($ingredient['image']));
            $ingredient['image'] = Storage::url($path);

            Ingredient::create($ingredient);
        }
    }
}
