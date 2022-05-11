<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EmployeesHasQuestion
 * 
 * @property int $employee_id
 * @property int $question_id
 * @property string|null $response
 * @property int|null $response_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property Question $question
 *
 * @package App\Models
 */
class EmployeesHasQuestion extends Model
{
	use SoftDeletes;
	protected $table = 'employees_has_questions';
	public $incrementing = false;

	protected $casts = [
		'employee_id' => 'int',
		'question_id' => 'int',
		'response_id' => 'int'
	];

	protected $fillable = [
		'response',
		'response_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function question()
	{
		return $this->belongsTo(Question::class);
	}

	public function response()
	{
		return $this->belongsTo(Response::class);
	}
}
