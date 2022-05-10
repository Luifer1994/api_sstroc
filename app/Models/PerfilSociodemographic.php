<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PerfilSociodemographic
 * 
 * @property int $id
 * @property int $employee_id
 * @property int $city_id
 * @property string|null $address
 * @property int $housing_type_id
 * @property string $contact_emergency
 * @property int $kindred_id
 * @property string $phone_contact
 * @property int $education_level_id
 * @property int $dependents
 * @property int $number_of_children
 * @property string|null $use_free_time
 * @property int $position_id
 * @property int $type_contract_id
 * @property Carbon $contract_date
 * @property float $average_income
 * @property string $seniority_range
 * @property int $social_security_id
 * @property int $marital_status_id
 * @property int $arl_id
 * @property int $pension_fund_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Arl $arl
 * @property City $city
 * @property EducationLevel $education_level
 * @property Employee $employee
 * @property HousingType $housing_type
 * @property Kindred $kindred
 * @property MaritalStatus $marital_status
 * @property PensionFund $pension_fund
 * @property Position $position
 * @property SocialSecurity $social_security
 * @property TypeContract $type_contract
 *
 * @package App\Models
 */
class PerfilSociodemographic extends Model
{
	protected $table = 'perfil_sociodemographics';

	protected $casts = [
		'employee_id' => 'int',
		'city_id' => 'int',
		'housing_type_id' => 'int',
		'kindred_id' => 'int',
		'education_level_id' => 'int',
		'dependents' => 'int',
		'number_of_children' => 'int',
		'position_id' => 'int',
		'type_contract_id' => 'int',
		'average_income' => 'float',
		'social_security_id' => 'int',
		'marital_status_id' => 'int',
		'arl_id' => 'int',
		'pension_fund_id' => 'int'
	];

	protected $dates = [
		'contract_date'
	];

	protected $fillable = [
		'employee_id',
		'city_id',
		'address',
		'housing_type_id',
		'contact_emergency',
		'kindred_id',
		'phone_contact',
		'education_level_id',
		'dependents',
		'number_of_children',
		'use_free_time',
		'position_id',
		'type_contract_id',
		'contract_date',
		'average_income',
		'seniority_range',
		'social_security_id',
		'marital_status_id',
		'arl_id',
		'pension_fund_id'
	];

	public function arl()
	{
		return $this->belongsTo(Arl::class);
	}

	public function city()
	{
		return $this->belongsTo(City::class);
	}

	public function education_level()
	{
		return $this->belongsTo(EducationLevel::class);
	}

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function housing_type()
	{
		return $this->belongsTo(HousingType::class);
	}

	public function kindred()
	{
		return $this->belongsTo(Kindred::class);
	}

	public function marital_status()
	{
		return $this->belongsTo(MaritalStatus::class);
	}

	public function pension_fund()
	{
		return $this->belongsTo(PensionFund::class);
	}

	public function position()
	{
		return $this->belongsTo(Position::class);
	}

	public function social_security()
	{
		return $this->belongsTo(SocialSecurity::class);
	}

	public function type_contract()
	{
		return $this->belongsTo(TypeContract::class);
	}
}
