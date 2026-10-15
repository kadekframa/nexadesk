<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_creates_user()
    {
        $this->artisan('user:create')
            ->expectsQuestion('Nama', 'Admin NexaDesk')
            ->expectsQuestion('Email', 'admin@nexadesk.test')
            ->expectsQuestion('Password (minimal 8 karakter)', 'rahasia123')
            ->expectsQuestion('Ulangi password', 'rahasia123')
            ->assertSuccessful();

        $user = User::where('email', 'admin@nexadesk.test')->firstOrFail();

        $this->assertSame('Admin NexaDesk', $user->name);
        $this->assertTrue(Hash::check('rahasia123', $user->password));
    }

    public function test_command_rejects_duplicate_email()
    {
        User::factory()->create(['email' => 'admin@nexadesk.test']);

        $this->artisan('user:create')
            ->expectsQuestion('Nama', 'Admin Lain')
            ->expectsQuestion('Email', 'admin@nexadesk.test')
            ->expectsQuestion('Password (minimal 8 karakter)', 'rahasia123')
            ->expectsQuestion('Ulangi password', 'rahasia123')
            ->assertFailed();

        $this->assertSame(1, User::count());
    }
}
