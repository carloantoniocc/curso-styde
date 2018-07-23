<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;
    /**  @test  */
    function it_loads_the_users_list_page()
    {

        $user = User::all();

        $this->withoutExceptionHandling();

        $this->get('/usuarios')
        	->assertStatus(200)
        	->assertSee('Usuarios');

    }


    function it_show_a_default_message_if_the_users_list_is_empty()
    {

        $this->withoutExceptionHandling();

        $this->get('/usuarios?empty')
            ->assertStatus(200)
            ->assertSee('No existen usuarios registrados');
    }


    /**  @test  */
    function it_displays_the_users_details()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'Carlos Cornejo'
        ]);

        $this->get('/usuarios/' . $user->id)
        	->assertStatus(200)
            ->assertSee('Carlos Cornejo');	
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


    /**  @test  */
    function it_display_a_404_if_user_is_not_found()
    {

        $this->get('/usuarios/100000')
            ->assertStatus(404) 
            ->assertSee('Usuario no encontrado');
    }

    /**  @test  */
    function it_create_a_new_user()
    {

        $this->withoutExceptionHandling();

        $this->post('/usuarios/' , [
            'name' => 'usuario prueba',
            'email' => 'prueba@prueba.cl',
            'password' => '123456',

        ])->assertRedirect('usuarios');

        $this->assertCredentials([

            'name'  => 'usuario prueba',
            'email' => 'prueba@prueba.cl',
            'password' => '123456',

        ]);
           
            
    }

    /**  @test  */
    function the_name_is_required()
    {

        //$this->withoutExceptionHandling();

        $this->from('usuarios/nuevo')
            ->post('/usuarios/' , [
            'name' => '',
            'email' => 'prueba@prueba.cl',
            'password' => '123456',

        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['name' => 'The name field is required.']);


//        $this->assertDatabaseMissing('users', [
//            'email' => 'prueba@prueba.cl',
//
//        ]);  

          $this->assertEquals(0, User::count());


    }

}
