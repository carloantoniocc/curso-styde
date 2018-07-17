<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    /**  @test  */
    function it_loads_the_users_list_page()
    {

        $this->withoutExceptionHandling();

        $this->get('/usuarios')
        	->assertStatus(200)
        	->assertSee('Usuarios')
            ->assertSee('Joel')
            ->assertSee('Ellie')
            ->assertSee('Tess');
    }

    /**  @test  */
    function it_loads_the_users_detail_page()
    {
        $this->get('/usuarios/5')
        	->assertStatus(200)
        	->assertSee('Mostrando detalle del usuario: 5');    	
    }

    /**  @test  */
    function it_loads_the_users_nuevo_page()
    {

        $this->withoutExceptionHandling();

        $this->get('/usuarios/nuevo')
        	->assertStatus(200)
        	->assertSee('Crear usuario nuevo');    	
    }

    /**  @test  */
    function it_loads_the_users_modified_page()
    {
        $this->get('/usuarios/5/edit')
        	->assertStatus(200)
        	->assertSee('usuario 5 ha sido modificado');    	
    }

    /**  @test  
    function it_loads_the_users_modified_page()
    {
        $this->get('/usuarios/texto/edit')
        	->assertStatus(200);    	
    }
	
	*/


}
