<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MatrixRisk
 * 
 * @property int $id
 * @property int $item
 * @property int $position_id
 * @property int $process_id
 * @property int $area_id
 * @property int $task_id
 * @property string $clasification
 * @property int $risk_id
 * @property string|null $possible_effects
 * @property string|null $consequence
 * @property string|null $hours_exposition_day
 * @property bool $exists_control
 * @property string|null $cotrol_descrption
 * @property string $control_done
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Area $area
 * @property Position $position
 * @property Process $process
 * @property Risk $risk
 * @property Task $task
 *
 * @package App\Models
 */
class MatrixRisk extends Model
{
	protected $table = 'matrix_risks';

	protected $casts = [
		'item' => 'int',
		'position_id' => 'int',
		'process_id' => 'int',
		'area_id' => 'int',
		'task_id' => 'int',
		'risk_id' => 'int',
		'exists_control' => 'bool'
	];

	protected $fillable = [
		'item',
		'position_id',
		'process_id',
		'area_id',
		'task_id',
		'clasification',
		'risk_id',
		'possible_effects',
		'consequence',
		'hours_exposition_day',
		'exists_control',
		'cotrol_descrption',
		'control_done'
	];

	public function area()
	{
		return $this->belongsTo(Area::class);
	}

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function process()
	{
		return $this->belongsTo(Process::class);
	}

	public function risk()
	{
		return $this->belongsTo(Risk::class);
	}

	public function task()
	{
		return $this->belongsTo(Task::class);
	}
}
