<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            
            User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@demo.com',
                'password' => Hash::make('password'),
                'userType' => 'Admin',
            ]);

            
            User::factory()->create([
                'name' => 'Customer User',
                'email' => 'customer@demo.com',
                'password' => Hash::make('password'),
                'userType' => 'Customer',
            ]);

            User::factory()->create([
                'name' => 'Superadmin User',
                'email' => 'super@demo.com',
                'password' => Hash::make('password'),
                'userType' => 'SuperAdmin',
            ]);
        }
    }

?>
