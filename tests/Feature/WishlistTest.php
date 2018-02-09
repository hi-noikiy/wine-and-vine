<?php

namespace Tests\Feature;

use App\User;
use App\Wine;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_add_a_wine_into_his_wishlist() {
        $user = factory(User::class)->create();

        $wine = factory(Wine::class)->create();

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

    /** @test */
    public function a_user_can_add_multiple_wines_into_his_wishlist() {
        $user = factory(User::class)->create();

        $wines = factory(Wine::class, 5)->create();

        $wines->each(function ($wine) use ($user) {
            $this->assertDatabaseMissing('user_wine', [
                'user_id' => $user->id,
                'wine_id' => $wine->id
            ]);
        });

        $user->wishlist()->attach($wines);

        $wines->each(function ($wine) use ($user) {
            $this->assertDatabaseHas('user_wine', [
                'user_id' => $user->id,
                'wine_id' => $wine->id
            ]);
        });
    }

    /** @test */
    public function a_user_can_remove_a_wine_from_his_wishlist() {
        $user = factory(User::class)->create();

        $wine = factory(Wine::class)->create();

        $user->wishlist()->attach($wine);

        $this->assertDatabaseHas('user_wine', [
            'user_id' => $user->id,
            'wine_id' => $wine->id
        ]);

        $user->wishlist()->detach($wine);

        $this->assertDatabaseMissing('user_wine', [
            'user_id' => $user->id,
            'wine_id' => $wine->id
        ]);
    }

    /** @test */
    public function a_user_can_remove_multiple_wines_from_his_wishlist() {
        $user = factory(User::class)->create();

        $wines = factory(Wine::class, 5)->create();

        $user->wishlist()->attach($wines);

        $wines->each(function ($wine) use ($user) {
            $this->assertDatabaseHas('user_wine', [
                'user_id' => $user->id,
                'wine_id' => $wine->id
            ]);
        });

        $user->wishlist()->detach($wines);

        $wines->each(function ($wine) use ($user) {
            $this->assertDatabaseMissing('user_wine', [
                'user_id' => $user->id,
                'wine_id' => $wine->id
            ]);
        });


    }
}