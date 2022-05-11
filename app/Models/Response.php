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
 * Class Response
 * 
 * @property int $id
 * @property string|null $indicator
 * @property string|null $text
 * @property bool|null $response_true
 * @property int $question_id
 * @property int|null $question_next_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Question|null $question
 * @property Collection|EmployeesHasQuestion[] $employees_has_questions
 *
 * @package App\Models
 */
class Response extends Model
{
	use SoftDeletes;
	protected $table = 'responses';
	public $incrementing = false;

	protected $casts = [
		'id' => 'int',
		'response_true' => 'bool',
		'question_id' => 'int',
		'question_next_id' => 'int'
	];

	protected $fillable = [
		'indicator',
		'text',
		'response_true',
		'question_id',
		'question_next_id'
	];

	public function question()
	{
		return $this->belongsTo(Question::class, 'question_next_id');
	}

	public function employees_has_questions()
	{
		return $this->hasMany(EmployeesHasQuestion::class);
	}
}
