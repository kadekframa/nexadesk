<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_greets_user_by_time_of_day()
    {
        $this->travelTo(now()->setTime(9, 0));
        $user = User::factory()->create(['name' => 'Pengguna Uji']);

        $this->actingAs($user)
            ->get('/')
            ->assertOk()
            ->assertSee('Selamat pagi, Pengguna Uji');
    }

    public function test_sidebar_menu_follows_gate_of_logged_in_user()
    {
        Gate::define('menu-boleh', fn () => true);
        Gate::define('menu-terlarang', fn () => false);

        config(['menu.KT_MENUS' => [
            $this->menu('Menu Boleh', ['menu-boleh']),
            $this->menu('Menu Terlarang', ['menu-terlarang']),
            $this->menu('Menu Tanpa Gate', ['belum-didefinisikan']),
        ]]);

        $this->actingAs(User::factory()->create())
            ->get('/')
            ->assertOk()
            ->assertSee('Menu Boleh')
            ->assertDontSee('Menu Terlarang')
            ->assertDontSee('Menu Tanpa Gate');
    }

    private function menu($label, array $permission)
    {
        return [
            'label'          => $label,
            'type'           => 'item',
            'route'          => 'home',
            'permission'     => $permission,
            'permissionType' => 'gate',
            'icon'           => 'dot',
        ];
    }
}
