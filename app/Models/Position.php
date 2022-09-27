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
 * Class Position
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|MatrixRisk[] $matrix_risks
 * @property Collection|PerfilSociodemographic[] $perfil_sociodemographics
 * @property Collection|Process[] $processes
 *
 * @package App\Models
 */
class Position extends Model
{
    use SoftDeletes, HasFactory;
	protected $table = 'positions';

	protected $fillable = [
		'name'
	];

	public function matrix_risks()
	{
		return $this->hasMany(MatrixRisk::class);
	}

	public function perfil_sociodemographics()
	{
		return $this->hasMany(PerfilSociodemographic::class);
	}

	public function processes()
	{
		return $this->belongsToMany(Process::class, 'positions_processes')
					->withPivot('id')
					->withTimestamps();
	}

    public function proccesses()
	{
		return $this->hasMany(PositionsProcess::class)->with('process');
	}
}
