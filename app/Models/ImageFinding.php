<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ImageFinding
 * 
 * @property int $id
 * @property int $finding_id
 * @property int $user_id
 * @property string $url
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Finding $finding
 *
 * @package App\Models
 */
class ImageFinding extends Model
{
	use SoftDeletes;
	protected $table = 'image_findings';

	protected $casts = [
		'finding_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'finding_id',
		'user_id',
		'url'
	];

	public function finding()
	{
		return $this->belongsTo(Finding::class);
	}
}
