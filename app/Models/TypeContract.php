<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TypeContract
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|PerfilSociodemographic[] $perfil_sociodemographics
 *
 * @package App\Models
 */
class TypeContract extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'type_contracts';

	protected $fillable = [
		'name'
	];

	public function perfil_sociodemographics()
	{
		return $this->hasMany(PerfilSociodemographic::class);
	}
}
