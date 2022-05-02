<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property int $type_document_id
 * @property string $document_number
 * @property Carbon|null $email_verified_at
 * @property int $rol_id
 * @property int $gender_id
 * @property string $password
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Gender $gender
 * @property Rol $rol
 * @property TypeDocument $type_document
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use SoftDeletes, HasApiTokens, HasFactory, Notifiable;
	protected $table = 'users';

	protected $casts = [
		'type_document_id' => 'int',
		'rol_id' => 'int',
		'gender_id' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'last_name',
		'email',
		'phone',
		'type_document_id',
		'document_number',
		'email_verified_at',
		'rol_id',
		'gender_id',
		'password',
		'remember_token'
	];

	public function gender()
	{
		return $this->belongsTo(Gender::class);
	}

	public function rol()
	{
		return $this->belongsTo(Rol::class);
	}

	public function type_document()
	{
		return $this->belongsTo(TypeDocument::class);
	}

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}
}
