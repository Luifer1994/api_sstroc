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

/**
 * Class Employee
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property int $type_document_id
 * @property string $document_number
 * @property Carbon $birth_date
 * @property int $gender_id
 * @property int $user_id
 * @property Carbon|null $register_identification_risk
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Gender $gender
 * @property TypeDocument $type_document
 * @property User $user
 * @property Collection|Question[] $questions
 * @property Collection|IdentificationHazardAndRisk[] $identification_hazard_and_risks
 * @property Collection|PerfilSociodemographic[] $perfil_sociodemographics
 *
 * @package App\Models
 */
class Employee extends Model
{
	use SoftDeletes,HasFactory;
	protected $table = 'employees';

	protected $casts = [
		'type_document_id' => 'int',
		'gender_id' => 'int',
		'user_id' => 'int'
	];

	protected $dates = [
		'birth_date',
		'register_identification_risk'
	];

	protected $fillable = [
		'name',
		'last_name',
		'email',
		'phone',
		'type_document_id',
		'document_number',
		'birth_date',
		'gender_id',
		'user_id',
		'register_identification_risk'
	];

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function type_document()
	{
		return $this->belongsTo(TypeDocument::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function users()
	{
		return $this->hasMany(User::class);
	}

	public function questions()
	{
		return $this->belongsToMany(Question::class, 'employees_has_questions')
					->withPivot('response', 'response_id', 'deleted_at')
					->withTimestamps();
	}

	public function identification_hazard_and_risks()
	{
		return $this->hasMany(IdentificationHazardAndRisk::class);
	}

	public function perfil_sociodemographics()
	{
		return $this->hasMany(PerfilSociodemographic::class);
	}
}
