<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Survey
 * 
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Question[] $questions
 *
 * @package App\Models
 */
class Survey extends Model
{
	use SoftDeletes;
	protected $table = 'surveys';

	protected $fillable = [
		'title',
		'description'
	];

	public function questions()
	{
		return $this->hasMany(Question::class);
	}
}
