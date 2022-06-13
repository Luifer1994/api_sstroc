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
 * Class Risk
 *
 * @property int $id
 * @property int $risks_type_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property RiskType $risk_type
 * @property Collection|IdentificationHazardAndRisk[] $identification_hazard_and_risks
 *
 * @package App\Models
 */
class Risk extends Model
{
    use SoftDeletes, HasFactory;
	protected $table = 'risks';

	protected $casts = [
		'risks_type_id' => 'int'
	];

	protected $fillable = [
		'risks_type_id',
		'name'
	];

	public function risk_type()
	{
		return $this->belongsTo(RiskType::class, 'risks_type_id');
	}

	public function identification_hazard_and_risks()
	{
		return $this->hasMany(IdentificationHazardAndRisk::class);
	}
}
