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
 * Class Area
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Finding[] $findings
 * @property Collection|MatrixRisk[] $matrix_risks
 *
 * @package App\Models
 */
class Area extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'areas';

	protected $fillable = [
		'name'
	];

	public function finding()
	{
		return $this->hasMany(Finding::class);
	}

	public function matrix_risks()
	{
		return $this->hasMany(MatrixRisk::class);
	}
}
