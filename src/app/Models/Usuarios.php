<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * App\Models\Usuarios
 * @property string nombre
 * @property string password
 * @property string|null $api_token
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_a
 * @mixin Eloquent
 */
class Usuarios extends Authenticatable {
	public $incrementing = false;
	protected $keyType = 'string';
	protected $primaryKey = 'nombre';
	protected $table = 'Usuarios';
	protected $fillable = [ 'nombre', 'api_token' ];

	protected $hidden = [ 'remember_token', 'api_token' ];

	public function generateToken() {
		$this->api_token = Str::random( 60 );
		$this->save();

		return $this->api_token;
	}

}