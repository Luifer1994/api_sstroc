<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 * 
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property Carbon $start_date
 * @property bool $active
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Event extends Model
{
	protected $table = 'events';

	protected $casts = [
		'active' => 'bool',
		'user_id' => 'int'
	];

	protected $dates = [
		'start_date'
	];

	protected $fillable = [
		'title',
		'description',
		'start_date',
		'active',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
