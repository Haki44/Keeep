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

        // REFERENT 1 de SCHOOL 1
        $referent_1 = User::create([
            'name' => 'referent1',
            'email'=>'referent1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_referent->id
        ]);
        $school_1 = School::factory()->create([
            'name' => 'SCHOOL1',
            'user_id' => $referent_1->id
        ]);

        // REFERENT 2 de SCHOOL 2
        $referent_2 = User::create([
            'name' => 'referent2',
            'email'=>'referent2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_referent->id
        ]);
        $school_2 = School::factory()->create([
            'name' => 'SCHOOL2',
            'user_id' => $referent_2->id
        ]);

        // ETDUDIANT 1 de SCHOOL 1
        $student_1 = User::create([
            'name' => 'etudiant1',
            'email'=>'etudiant1@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'register_token' => NULL
        ]);
        
        DB::table('school_student')->insert(
            [
                'school_id' => $school_1->id,
                'user_id' => $student_1->id,
            ]
        );

        // ETDUDIANT 2 de SCHOOL 2
        $student_2 = User::create([
            'name' => 'etudiant2',
            'email'=>'etudiant2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => $role_student->id,
            'register_token' => NULL
        ]);

        DB::table('school_student')->insert(
            [
                'school_id' => $school_2->id,
                'user_id' => $student_2->id,
            ]
        );
    }
}
