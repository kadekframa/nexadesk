<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CreateUser extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Membuat akun pengguna NexaDesk';

    public function handle()
    {
        $input = [
            'name' => $this->ask('Nama'),
            'email' => $this->ask('Email'),
            'password' => $this->secret('Password (minimal 8 karakter)'),
            'password_confirmation' => $this->secret('Ulangi password'),
        ];

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            // email:filter: aturan `email` bawaan Laravel 10 meloloskan CR/LF (CVE-2026-48019).
            'email' => ['required', 'string', 'email:filter', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $this->info("Akun {$input['email']} berhasil dibuat. Login di " . route('login'));

        return self::SUCCESS;
    }
}
