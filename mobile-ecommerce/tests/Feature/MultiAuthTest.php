<?php

namespace Tests\Feature;

use App\Features\Auth\Models\Admin;
use App\Features\Category\Models\Category;
use App\Features\Auth\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MultiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_categories_page_is_served_by_laravel(): void
    {
        Category::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'is_active' => true,
        ]);

        $this->get(route('categories.index'))
            ->assertOk()
            ->assertSee('Accessories');
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $this->actingAs(User::factory()->create(), 'web')
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_log_in_and_access_dashboard(): void
    {
        $admin = Admin::create([
            'name' => 'Store Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->post(route('admin.login.submit'), [
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin, 'admin');
        $this->get(route('admin.dashboard'))->assertOk();
    }

    public function test_customer_can_log_in_with_the_web_guard(): void
    {
        $user = User::factory()->create([
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->post(route('login'), [
            'email' => 'customer@example.com',
            'password' => 'password',
        ])->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user, 'web');
    }

    public function test_customer_can_register_and_is_logged_in(): void
    {
        $this->post(route('register'), [
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password' => 'a-secure-password',
            'password_confirmation' => 'a-secure-password',
        ])->assertRedirect(route('home'));

        $this->assertDatabaseHas('users', [
            'email' => 'customer@example.com',
        ]);
        $this->assertAuthenticated('web');
        $this->get(route('home'))->assertOk();
    }

    public function test_admin_seeder_creates_the_default_admin_with_a_hashed_password(): void
    {
        $this->seed(AdminSeeder::class);

        $admin = Admin::where('email', 'admin@example.com')->firstOrFail();

        $this->assertSame('Default Admin', $admin->name);
        $this->assertTrue(Hash::check('password', $admin->password));
    }
}
