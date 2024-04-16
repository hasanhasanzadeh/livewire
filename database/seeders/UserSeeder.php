<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $user->avatar()->save(Photo::factory()->create([
                'original_name' => 'avatars/default-' . $user->id . '.png',
                'path' => 'avatars/default-' . $user->id . '.png',
                'photoable_id' => $user->id,
                'photoable_type' => User::class
            ])
            );
        }

    }
}
