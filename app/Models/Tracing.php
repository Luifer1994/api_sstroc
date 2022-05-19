<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tracing
 * 
 * @property int $id
 * @property int $finding_id
 * @property int $user_id
 * @property string $description
 * @property string $long_description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Finding $finding
 * @property User $user
 * @property Collection|ImageTracing[] $image_tracings
 *
 * @package App\Models
 */
class Tracing extends Model
{
	protected $table = 'tracings';

	protected $casts = [
		'finding_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'finding_id',
		'user_id',
		'description',
		'long_description'
	];

	public function finding()
	{
		return $this->belongsTo(Finding::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function image_tracings()
	{
		return $this->hasMany(ImageTracing::class);
	}
}
