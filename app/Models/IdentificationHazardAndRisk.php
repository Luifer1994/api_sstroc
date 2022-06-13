<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class IdentificationHazardAndRisk
 *
 * @property int $id
 * @property int $employee_id
 * @property int $risk_id
 * @property bool $response
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Employee $employee
 * @property Risk $risk
 *
 * @package App\Models
 */
class IdentificationHazardAndRisk extends Model
{
    use SoftDeletes;
	protected $table = 'identification_hazard_and_risks';

	protected $casts = [
		'employee_id' => 'int',
		'risk_id' => 'int',
		'response' => 'bool'
	];

	protected $fillable = [
		'employee_id',
		'risk_id',
		'response',
		'description'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function risk()
	{
		return $this->belongsTo(Risk::class);
	}
}
