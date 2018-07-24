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

        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'carlos cornejo',
            'email' => 'carlos.cornejo@redsalud.gov.cl',
            'password' => '123456'            
        ]);

        $this->get("/usuarios/$user->id/edit")
        	->assertStatus(200);
        	//->assertSee('usuario 5 ha sido modificado')
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
            'email' => 'prueba23@prueba.cl',
            'password' => '123456',

        ])->assertRedirect('usuarios');

        $this->assertCredentials([

            'name'  => 'usuario prueba',
            'email' => 'prueba23@prueba.cl',
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
          ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);


//        $this->assertDatabaseMissing('users', [
//            'email' => 'prueba@prueba.cl',
//
//        ]);  

          $this->assertEquals(0, User::count());


    }


    /**  @test  */
    function the_mail_is_require()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/' , [
            'name' => 'carlos',
            'email' => '',
            'password' => '123456'

        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['email']);


          $this->assertEquals(0, User::count());


    }


    /**  @test  */
    function the_password_is_require()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/' , [
            'name' => 'carlos',
            'email' => 'carlos@gmail.com',
            'password' => ''

        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['password']);


          $this->assertEquals(0, User::count());


    }


    /**  @test  */
    function the_email_must_be_valid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/' , [
            'name' => 'carlos',
            'email' => 'correo-no-valido',
            'password' => '123456'

        ])->assertRedirect('usuarios/nuevo')
          ->assertSessionHasErrors(['email']);


          $this->assertEquals(0, User::count());


    }


    /**  @test  */
    function it_loads_the_edit_user_page()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'name' => 'carlos cornejo',
            'email' => 'carlos.cornejo@redsalud.gov.cl',
            'password' => '123456'            
        ]);



        $this->get("/usuarios/$user->id/edit")
            ->assertStatus(200)
            ->assertViewIs('users.edit')   
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function ($viewUser) use ($user) {
                return $viewUser->id === $user->id;
            });  
    }


    /**  @test  */
    function it_update_a_user()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->put("/usuarios/$user->id" , [
            'name' => 'usuario prueba',
            'email' => 'prueba23@prueba.cl',
            'password' => '123456',

        ])->assertRedirect("usuarios/$user->id");

        $this->assertCredentials([

            'name'  => 'usuario prueba',
            'email' => 'prueba23@prueba.cl',
            'password' => '123456',

        ]);
           
            
    }



    /**  @test  */
    function the_name_is_required_when_updating_a_user()
    {

        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("usuarios/$user->id/edit")
            ->put("/usuarios/$user->id" , [
            'name' => '',
            'email' => 'prueba23@prueba.cl',
            'password' => '123456',

        ])->assertRedirect("usuarios/$user->id/edit")
            ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', ['email' => 'prueba23@prueba.cl']);
           
            
    }


    /**  @test  */
    function the_password_is_optional_when_updating_the_user()
    {

        $oldPassword = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password' => bcrypt($oldPassword)
        ]);

        $this->from("usuarios/$user->id/edit")
            ->put("/usuarios/$user->id" , [
            'name' => 'carlos',
            'email' => 'prueba23@prueba.cl',
            'password' => '',

        ])->assertRedirect("usuarios/$user->id");
           

        $this->assertCredentials([
            'name' => 'carlos',
            'email' => 'prueba23@prueba.cl',
            'password' => $oldPassword,

        ]);


    }


    /**  @test  */
    function the_email_must_be_valid_when_updating_the_user()
    {

        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("usuarios/$user->id/edit")
            ->put("/usuarios/$user->id" , [
            'name' => 'carlos',
            'email' => 'correo-no-valido',
            'password' => '123456',

        ])->assertRedirect("usuarios/$user->id/edit")
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', ['name' => 'carlos']);

    }

    /**  @test  */
    function the_email_must_be_unique_when_updating_the_user()
    {


        factory(User::class)->create([
            'email' => 'existing-email@prueba.cl',
        ]);

        $user = factory(User::class)->create([
            'email' => 'carlos@prueba.cl',
        ]);


        $this->from("usuarios/$user->id/edit")
            ->put("/usuarios/$user->id" , [
            'name' => 'carlos',
            'email' => 'existing-email@prueba.cl',
            'password' => '123456',

        ])->assertRedirect("usuarios/$user->id/edit")
            ->assertSessionHasErrors(['email']);

        //$this->assertDatabaseMissing('users', ['name' => 'carlos']);

    }


    /**  @test  */
    function the_users_email_can_stay_the_same_when_updating_the_user()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email' => 'prueba23@prueba.cl',
        ]);

        $this->from("usuarios/$user->id/edit")
            ->put("/usuarios/$user->id" , [
            'name' => 'carlos',
            'email' => 'prueba23@prueba.cl',
            'password' => '1123456',

        ])->assertRedirect("usuarios/$user->id"); //show
           

        $this->assertDatabaseHas('users', [
            'name' => 'carlos',
            'email' => 'prueba23@prueba.cl',

        ]);

    }


    /**  @test  */
    function it_delete_a_user()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->delete("/usuarios/$user->id" , [
            'name' => 'carlos',
            'email' => 'prueba23@prueba.cl',
            'password' => '1123456',

        ])->assertRedirect("usuarios"); //show
           
        //$this->assertEquals(0, User::count());

        $this->assertDatabaseMissing('users',[
            'id' => $user->id,
        ]);

    }


}
