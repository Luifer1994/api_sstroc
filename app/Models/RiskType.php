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
 * Class RiskType
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Risk[] $risks
 *
 * @package App\Models
 */
class RiskType extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'risk_types';

    protected $fillable = [
        'name',
        'description'
    ];

    public function risks()
    {
        return $this->hasMany(Risk::class, 'risks_type_id');
    }
}
