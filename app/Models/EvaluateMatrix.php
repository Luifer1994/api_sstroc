<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EvaluateMatrix
 * 
 * @property int $id
 * @property int $matrix_risk_id
 * @property int $deficiency_level
 * @property int $exposition_level
 * @property int $probability_level
 * @property int $consequence_level
 * @property int $risk_level
 * @property int $number_exposed_plant
 * @property int $number_exposed_visitor
 * @property int $number_exposed_contrataing
 * @property int $total_exposed
 * @property bool $exist_legal_requirement
 * @property string|null $detail_legal_requirement
 * @property string $exist_new_control
 * @property string|null $detail_control
 * @property string|null $control_type
 * @property Carbon|null $date_programing_control
 * @property int $position_id
 * @property string|null $tracing
 * @property Carbon|null $date_tracing
 * @property string $state_compliance
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MatrixRisk $matrix_risk
 * @property Position $position
 *
 * @package App\Models
 */
class EvaluateMatrix extends Model
{
	protected $table = 'evaluate_matrices';

	protected $casts = [
		'matrix_risk_id' => 'int',
		'deficiency_level' => 'int',
		'exposition_level' => 'int',
		'probability_level' => 'int',
		'consequence_level' => 'int',
		'risk_level' => 'int',
		'number_exposed_plant' => 'int',
		'number_exposed_visitor' => 'int',
		'number_exposed_contrataing' => 'int',
		'total_exposed' => 'int',
		'exist_legal_requirement' => 'bool',
		'position_id' => 'int'
	];

	protected $dates = [
		'date_programing_control',
		'date_tracing'
	];

	protected $fillable = [
		'matrix_risk_id',
		'deficiency_level',
		'exposition_level',
		'probability_level',
		'consequence_level',
		'risk_level',
		'number_exposed_plant',
		'number_exposed_visitor',
		'number_exposed_contrataing',
		'total_exposed',
		'exist_legal_requirement',
		'detail_legal_requirement',
		'exist_new_control',
		'detail_control',
		'control_type',
		'date_programing_control',
		'position_id',
		'tracing',
		'date_tracing',
		'state_compliance'
	];

	public function matrix_risk()
	{
		return $this->belongsTo(MatrixRisk::class);
	}

	public function position()
	{
		return $this->belongsTo(Position::class);
	}
}
