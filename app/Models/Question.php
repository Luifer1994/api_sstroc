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
 * Class Question
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $order
 * @property bool $required
 * @property string $category
 * @property int $survey_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Survey $survey
 * @property Collection|Employee[] $employees
 * @property Collection|Response[] $responses
 *
 * @package App\Models
 */
class Question extends Model
{
	use SoftDeletes;
	protected $table = 'questions';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'order' => 'int',
		'required' => 'bool',
		'survey_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description',
		'order',
		'required',
		'category',
		'survey_id'
	];

	public function survey()
	{
		return $this->belongsTo(Survey::class);
	}

	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employees_has_questions')
					->withPivot('response', 'response_id', 'deleted_at')
					->withTimestamps();
	}

	public function responses()
	{
		return $this->hasMany(Response::class, 'question_id');
	}
}
