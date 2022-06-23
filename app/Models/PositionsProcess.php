<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PositionsProcess
 * 
 * @property int $id
 * @property int $position_id
 * @property int $process_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Position $position
 * @property Process $process
 *
 * @package App\Models
 */
class PositionsProcess extends Model
{
	protected $table = 'positions_processes';

	protected $casts = [
		'position_id' => 'int',
		'process_id' => 'int'
	];

	protected $fillable = [
		'position_id',
		'process_id'
	];

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function process()
	{
		return $this->belongsTo(Process::class);
	}
}
