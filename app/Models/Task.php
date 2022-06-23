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
 * Class Task
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|MatrixRisk[] $matrix_risks
 *
 * @package App\Models
 */
class Task extends Model
{
    use SoftDeletes, HasFactory;

	protected $table = 'tasks';

	protected $fillable = [
		'name'
	];

	public function matrix_risks()
	{
		return $this->hasMany(MatrixRisk::class);
	}
}
