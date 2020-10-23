<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Route;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
//        Post::factory()->count(10)->create();
//        Permission::create(['name' => 'Super Admin']);
//        Role::create(['name' => 'Super Admin']);
//        $superAdmin = User::query()->where('email', 'admin@gmail.com')->first();
//        $superAdmin->assignRole(['Super Admin']);
//        Comment::factory()->count(30)->create();

//        User::query()->create([
//            'name' => 'Super Admin',
//            'email' => 'admin@gmail.com',
//            'password' => Hash::make('adminadmin'),
//        ]);

//        Route::factory()->count(5)->create();
        Product::factory()->count(10)->hasAttached(
            Category::factory()->count(3)
        )->create();
    }
}
