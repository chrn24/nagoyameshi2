<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Cashier\Subscription;
use Illuminate\Support\Facades\Hash;


class SubscriptionTest extends TestCase
{
     use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Stripe関連を使うにはメールアドレス検証済みユーザーが必要
        \Config::set('cashier.payment_notification.email', 'test@example.com');
    }

    /** @test */
    public function test_guest_cannot_access_subscription_create_page()
    {
        $response = $this->get('/subscription/create');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_free_user_can_access_subscription_create_page()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);
        $response = $this->get('/subscription/create');
        $response->assertStatus(200);
    }

     /** @test */
    public function test_paid_user_cannot_access_subscription_create_page()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $this->actingAs($user);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');

        $response = $this->get('/subscription/create');
        $response->assertRedirect('/subscription/edit');
    }

    /** @test */
    public function test_admin_cannot_access_subscription_create_page()
    {
        $admin = User::factory()->create(['is_admin' => true, 'email_verified_at' => now()]);
        $this->actingAs($admin);
        $response = $this->get('/subscription/create');
        $response->assertRedirect('/'); // 管理者向けにミドルウェア設定している場合はこちらでOK
    }

    /** @test */
    public function test_free_user_can_subscribe()
    {
       
    $user = User::factory()->create([
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
    ]);

    $this->actingAs($user);

    // Stripe カスタマーを明示的に作成
    $user->createAsStripeCustomer();

    $request_parameter = [
        'paymentMethodId' => 'pm_card_visa',
        'plan' => 'price_1ReV1jD5Qlq0dVs6KhZZsjqz',
    ];

    $response = $this->post('/subscription', $request_parameter);

    $response->assertRedirect('/');
    $this->assertTrue($user->fresh()->subscribed('premium_plan'));}

     /** @test */
    public function test_guest_cannot_subscribe()
    {
        $response = $this->post('/subscription', ['paymentMethodId' => 'pm_card_visa']);
        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_paid_user_cannot_subscribe_again()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');
        $this->actingAs($user);

        $response = $this->post('/subscription', ['paymentMethodId' => 'pm_card_visa']);
        $response->assertRedirect('/subscription/edit');
    }

    /** @test */
    public function test_paid_user_can_access_edit_page()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');
        $this->actingAs($user);

        $response = $this->get('/subscription/edit');
        $response->assertStatus(200);
    }

     /** @test */
    public function test_guest_cannot_access_edit_page()
    {
        $response = $this->get('/subscription/edit');
        $response->assertRedirect('/login');
    }

    /** @test */
    public function test_paid_user_can_update_payment_method()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');
        $this->actingAs($user);

        $oldPaymentId = $user->defaultPaymentMethod()->id;

        $response = $this->patch('/subscription', ['paymentMethodId' => 'pm_card_mastercard']);
        $response->assertRedirect('/');
        $newPaymentId = $user->fresh()->defaultPaymentMethod()->id;

        $this->assertNotEquals($oldPaymentId, $newPaymentId);
    }

      /** @test */
    public function test_paid_user_can_access_cancel_page()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');
        $this->actingAs($user);

        $response = $this->get('/subscription/cancel');
        $response->assertStatus(200);
    }

    /** @test */
    public function test_paid_user_can_cancel_subscription()
    {
        $user = User::factory()->create(['email_verified_at' => now()]);
        $user->newSubscription('premium_plan', 'price_1ReV1jD5Qlq0dVs6KhZZsjqz')->create('pm_card_visa');
        $this->actingAs($user);

        $response = $this->delete('/subscription');
        $response->assertRedirect('/');
        $this->assertFalse($user->fresh()->subscribed('premium_plan'));
    }
}
