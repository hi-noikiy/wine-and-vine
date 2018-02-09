<?php

namespace Tests\Unit;

use App\User;
use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_wine_into_is_wishlist() {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);

        $wine = factory(Wine::class)->create();
        $this->assertDatabaseHas('wines', [
            'id' => $wine->id
        ]);

        $this->assertDatabaseMissing('user_wine', [
            'user_id' => $user->id,
            'wine_id' => $wine->id
        ]);

        $user->wishlist()->attach($wine);

        $this->assertDatabaseHas('user_wine', [
            'user_id' => $user->id,
            'wine_id' => $wine->id
        ]);
    }
}
