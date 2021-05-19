<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->hasPosts(2)->hasComments(5)->hasLikes(5)->create();

        $this->call([
            // UserSeeder::class,
            // PostSeeder::class,
            // CommentSeeder::class,
        ]);
    }
}
