<?php

namespace App\Console\Commands;

use App\Enums\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->renderName();
        $email = $this->renderEmail();
        $role = $this->renderRole();
        $password = $this->renderPassword();

        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => bcrypt($password),
        ]);

        $this->info('✅ User berhasil dibuat!');

        $this->table(
            ['Nama', 'Email', 'Role'],
            [[
                $name,
                $email,
                $role,
            ]]
        );
    }

    private function renderName(): string
    {
        return text(
            label: 'Enter the name of the user',
            placeholder: 'John Doe',
            required: true
        );
    }

    private function renderEmail(): string
    {
        return text(
            label: 'Enter the email of the user',
            placeholder: 'john.doe@example.com',
            required: true
        );
    }

    private function renderRole(): string
    {
        $roles = collect(UserRole::cases())
            ->mapWithKeys(fn (UserRole $role): array => [
                $role->value => $role->getLabel(),
            ])
            ->all();

        return select(
            label: 'Select the role of the user',
            options: $roles,
            required: true
        );
    }

    private function renderPassword(): string
    {
        return text(
            label: 'Enter the password of the user',
            placeholder: '********',
            required: true
        );
    }
}
