<?php

namespace Tests\Feature\Livewire;

use App\Livewire\DashbComponent;
use App\Models\Proyecto;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class DashbTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        $user = User::find(1);
        $this->be($user);
        Livewire::test(DashbComponent::class)
            ->assertStatus(200);
    }

    /** @test */
    public function can_control_proyec()
    {
        Proyecto::truncate();
        $user = User::find(1);
        $this->be($user);
        $this->assertEquals(0, Proyecto::count());

        //create validate required
        Livewire::test(DashbComponent::class)
            ->set('user_id', 1)
            ->set('titulo', '')
            ->set('descripcion', '')
            ->set('publico', '')
            ->call('store')
            ->assertHasErrors('titulo')
            ->assertHasErrors('descripcion')
            ->assertHasErrors('publico')
        ;
        $this->assertEquals(0, Proyecto::count());

        //create
        Proyecto::truncate();
        Livewire::test(DashbComponent::class)
            ->set('user_id', 'user_id')
            ->set('titulo', 'titulo')
            ->set('descripcion', 'descripcion')
            ->set('publico', 1)
            ->call('store');
        $this->assertEquals(1, Proyecto::count());

        //update
        Livewire::test(DashbComponent::class)
            ->set('postId', '1')
            ->set('titulo', 'titulo2')
            ->set('descripcion', 'descripcion2')
            ->set('publico', 1)
            ->call('update');
        $this->assertEquals(1, Proyecto::count());
        $this->assertEquals(Proyecto::first()->titulo, 'titulo2');

        //delete
        Livewire::test(DashbComponent::class)
            ->call('delete', 1)
        ;
        $this->assertEquals(0, Proyecto::count());
    }
}


