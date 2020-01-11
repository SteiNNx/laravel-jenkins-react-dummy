<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Eloquent
 *
 * @method static Builder|Eloquent newModelQuery()
 * @method static Builder|Eloquent newQuery()
 * @method static Builder|Eloquent query()
 * @mixin Eloquent
 */
class Eloquent extends Model {

	protected $dateFormat = 'Y-m-d H:i:s.v';
}
