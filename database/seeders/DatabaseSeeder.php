<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    private function generateUsers()
    {
        User::query()->delete();

        for ($i = 1; $i <= 20; $i++) {
            $email = fake()->unique()->safeEmail;
            if ($i > 10) {
                User::factory()->create([
                    'avatar_url' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $email,
                    'email' => $email,
                    'role' => 'user',
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                ]);
            } else {
                $id = fake()->uuid;
                User::factory()->create([
                    'id' => $id,
                    'avatar_url' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $email,
                    'email' => $email,
                    'role' => 'client',
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                ]);
                Client::create([
                    'user_id' => $id,
                    'company_name' => fake()->company(),
                    'bank_account_number' => fake()->randomNumber(9, true),
                    'bank_account_name' => fake()->name(),
                ]);
            }
        }

        $roles = ['user', 'client', 'admin'];

        foreach ($roles as $role) {
            $id = fake()->uuid;
            $email = $role . '@email.com';

            User::factory()->create([
                'id' => $id,
                'name' => 'Demo ' . $role,
                'email' => $role . '@email.com',
                'avatar_url' => 'https://api.dicebear.com/7.x/adventurer/svg?seed=' . $email,
                'password' => $role,
                'role' => $role,
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ]);
            if ($role === 'client') {
                Client::create([
                    'user_id' => $id,
                    'company_name' => fake()->company(),
                    'bank_account_number' => fake()->randomNumber(9, true),
                    'bank_account_name' => fake()->name(),
                ]);
            }
        }
    }

    private function generateServices()
    {
        Service::query()->delete();

        $users = User::all();

        foreach ($users as $user) {
            if (fake()->boolean(20)) {
                continue;
            }
            for ($i = 0; $i <= fake()->numberBetween(1, 5); $i++) {
                Service::create([
                    'id' => fake()->uuid,
                    'user_id' => $user->id,
                    'name' => fake()->sentence(3),
                    'description' => fake()->paragraphs(3, true),
                    'type' => fake()->randomElement(['translation', 'transcribing', 'writing', 'editing', 'proofreading', 'other']),
                    'language' => fake()->randomElement(['english', 'bahasa', 'french', 'spanish', 'german', 'italian', 'portuguese', 'dutch', 'russian', 'chinese', 'japanese', 'arabic', 'other']),
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                ]);
            }
        }
    }

    private function generateProjects()
    {
        Project::query()->delete();

        $services = Service::all();

        foreach ($services as $service) {
            $isClientRequest = $service->user->role === 'client';

            for ($i = 1; $i <= fake()->numberBetween(1, 5); $i++) {
                if (fake()->boolean()) {
                    continue;
                }
                $status = fake()->randomElement(['application', 'planing', 'ongoing', 'finished']);
                $isFinished = $status === 'finished';
                $isPaid = $isFinished && fake()->boolean();

                Project::create([
                    'service_id' => $service->id,
                    'user_id' => $isClientRequest ? User::where('role', 'user')->inRandomOrder()->first()->id : $service->user->id,
                    'client_id' => $isClientRequest ?
                        Client::where('user_id', $service->user->id)->first()->id
                        : Client::inRandomOrder()->first()->id,
                    'status' => $status,
                    'price' => fake()->numberBetween(100, 1000),
                    'payment_due_date' => $isFinished ? fake()->dateTimeBetween('now', '+3 months') : null,
                    'paid_at' => $isPaid ? fake()->dateTimeBetween('-3 months', 'now') : null,
                ]);
            }
        }
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Cache::flush();

        $this->generateUsers();
        $this->generateServices();
        $this->generateProjects();
    }
}
