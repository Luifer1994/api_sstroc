<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Finding
 * 
 * @property int $id
 * @property string $description
 * @property string|null $long_description
 * @property int $user_id
 * @property int $area_id
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Area $area
 * @property User $user
 * @property Collection|ImageFinding[] $image_findings
 * @property Collection|Tracing[] $tracings
 *
 * @package App\Models
 */
class Finding extends Model
{
	protected $table = 'findings';

	protected $casts = [
		'user_id' => 'int',
		'area_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'description',
		'long_description',
		'user_id',
		'area_id',
		'status'
	];

	public function area()
	{
		return $this->belongsTo(Area::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function image_findings()
	{
		return $this->hasMany(ImageFinding::class);
	}

	public function tracings()
	{
		return $this->hasMany(Tracing::class);
	}
}
