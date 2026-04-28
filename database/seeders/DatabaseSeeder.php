<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'role' => 'super-admin',
            'email' => 'super-admin@example.com',
        ]);

        $companies = Company::factory(5)->create();
        foreach ($companies as $company) {
            $users = User::factory(10)->create([
                'company_id' => $company->id
            ]);
            foreach ($users as $user){
                Url::factory(5)->create([
                    'user_id' => $user->id,
                    'company_id' => $company->id
                ]);
            }
        }
    }
}
