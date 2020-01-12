<?php

namespace Tests\Feature;

use Tests\TestCase;

class UsuariosTest extends TestCase {

	public function testListaUsuarios() {
		$response = $this->get( '/usuarios' );

		$response->assertStatus( 200 );
	}
}