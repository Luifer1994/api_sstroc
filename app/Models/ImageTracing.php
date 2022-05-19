<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImageTracing
 * 
 * @property int $id
 * @property int $tracing_id
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Tracing $tracing
 *
 * @package App\Models
 */
class ImageTracing extends Model
{
	protected $table = 'image_tracings';

	protected $casts = [
		'tracing_id' => 'int'
	];

	protected $fillable = [
		'tracing_id',
		'url'
	];

	public function tracing()
	{
		return $this->belongsTo(Tracing::class);
	}
}
