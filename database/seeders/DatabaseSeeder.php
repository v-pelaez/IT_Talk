<?php

namespace Database\Seeders;

use App\Models\Likeable;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class); // Llamar al seeder de roles y permisos

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'Moderador',
            'email' => 'mod@mod.com',
            'password' => bcrypt('mod'),
        ])->assignRole('moderator');

        User::factory()->create([
            'name' => 'Usuario',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
        ])->assignRole('user');

        // Crear 20 usuarios adicionales con rol 'user'
        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('user');
        });

        // Crear 50 posts con usuarios y comentarios asociados
        Post::factory(50)->create()->each(function ($post) {
            $post->update(['user_id' => User::inRandomOrder()->first()->id]); // Asignar un usuario aleatorio al post
            // Crear entre 0 y 5 comentarios para cada post
            Comment::factory(rand(0, 5))->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id, // Asignar un usuario aleatorio al comentario
            ]);
        });

        Likeable::factory(300)->create();
    }
}
