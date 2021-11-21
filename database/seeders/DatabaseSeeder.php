<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Type\NullType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Création des ROLES
        $role_admin = Role::factory()->create([
            'name' => 'ADMIN'
        ]);
        $role_referent = Role::factory()->create([
            'name' => 'REFERENT'
        ]);
        $role_student = Role::factory()->create([
            'name' => 'STUDENT'
        ]);

        // Création des ECOLES
        $school_1 = School::factory()->create([
            'name' => 'SCHOOL1',
        ]);
        $school_2 = School::factory()->create([
            'name' => 'SCHOOL2',
        ]);

        // Création des users
        // ADMIN
        User::create([
            'name' => 'admin',
            'email'=> 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_admin->id
        ]);

        // REFERENTS
        User::create([
            'name' => 'referent1',
            'email'=>'referent1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_referent->id,
            'school_id' => $school_1->id
        ]);

        User::create([
            'name' => 'referent2',
            'email'=>'referent2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_referent->id,
            'school_id' => $school_2->id
        ]);

        // ETDUDIANTS
        User::create([
            'name' => 'etudiant1',
            'email'=>'etudiant1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'school_id' => $school_1->id,
            'register_token' => NULL
        ]);

        User::create([
            'name' => 'etudiant2',
            'email'=>'etudiant2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'school_id' => $school_2->id,
            'register_token' => NULL
        ]);
    }
}
