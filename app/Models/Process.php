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
 * Class Process
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Position[] $positions
 *
 * @package App\Models
 */
class Process extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'processes';

	protected $fillable = [
		'name'
	];

	public function positions()
	{
		return $this->belongsToMany(Position::class, 'positions_processes')
					->withPivot('id')
					->withTimestamps();
	}
}
