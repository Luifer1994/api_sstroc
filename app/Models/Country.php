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
use Illuminate\Notifications\Notifiable;

/**
 * Class Country
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|City[] $cities
 *
 * @package App\Models
 */
class Country extends Model
{
	use SoftDeletes, HasFactory, Notifiable;
	protected $table = 'countries';

	protected $fillable = [
		'name'
	];

	public function cities()
	{
		return $this->hasMany(City::class);
	}
}
