<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class City
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Country $country
 *
 * @package App\Models
 */
class City extends Model
{
	use SoftDeletes, HasFactory, Notifiable;
	protected $table = 'cities';

	protected $casts = [
		'country_id' => 'int'
	];

	protected $fillable = [
		'name',
		'country_id'
	];

	public function country()
	{
		return $this->belongsTo(Country::class);
	}
}
