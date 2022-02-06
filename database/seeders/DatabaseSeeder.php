<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Role;
use App\Models\User;
use App\Models\School;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
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
            'name' => Config::get('constants.roles.admin')
        ]);
        $role_referent = Role::factory()->create([
            'name' => Config::get('constants.roles.referent')
        ]);
        $role_student = Role::factory()->create([
            'name' => Config::get('constants.roles.student')
        ]);

        // Création des ECOLES
        $school_1 = School::factory()->create([
            'name' => 'SCHOOL1',
        ]);
        $school_2 = School::factory()->create([
            'name' => 'SCHOOL2',
        ]);

        // Création de catégories
        $utilitaire = Category::create([
            'name' => 'Utilitaire',
        ]);

        $jardin = Category::create([
            'name' => 'Jardin',
        ]);

        $electromenager = Category::create([
            'name' => 'Electroménager',
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
        $etudiant1 = User::create([
            'name' => 'etudiant1',
            'firstname' => 'Christopher',
            'email'=>'etudiant1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'school_id' => $school_1->id,
            'kips' => 200,
            'register_token' => NULL
        ]);

        $etudiant2 = User::create([
            'name' => 'etudiant2',
            'firstname' => 'Maxsense',
            'email'=>'etudiant2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'school_id' => $school_2->id,
            'kips' => 50,
            'register_token' => NULL
        ]);

        // Création d'offres
        Offer::create([
            'name' => 'Cafetière',
            'description' => 'Bonjour, je vous prete ma cafetiere qui n\'a jamais servi',
            'offer_day' => '2021-11-25',
            'price' => '15',
            'user_id' => $etudiant1->id,
            'category_id' => $utilitaire->id,
        ]);

        Offer::create([
            'name' => 'Magnifique pelle',
            'description' => 'Hello je prete ma pelle si vous avez besoin d\'enterrer un cadavre',
            'offer_day' => '2021-11-28',
            'price' => '18',
            'user_id' => $etudiant2->id,
            'category_id' => $jardin->id,
        ]);

        Offer::create([
            'name' => 'Aspirateur',
            'description' => 'Salut pour ceux qui vive dans la poussiere et qui n\'ont pas d\'aspi, bah j\'en ai un :)',
            'offer_day' => '2021-11-23',
            'price' => '24',
            'user_id' => $etudiant1->id,
            'category_id' => $electromenager->id,
        ]);

        Offer::create([
            'name' => 'Grille-pain',
            'description' => 'Je vous prete mon grille pain, il est rouge',
            'offer_day' => '2021-11-26',
            'price' => '8',
            'user_id' => $etudiant2->id,
            'category_id' => $electromenager->id,
        ]);
    }
}
