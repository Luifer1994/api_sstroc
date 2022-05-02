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
 * Class TypeDocument
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Employee[] $employees
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class TypeDocument extends Model
{
	use SoftDeletes, HasFactory;
	protected $table = 'type_documents';

	protected $fillable = [
		'name'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	public function users()
	{
		return $this->hasMany(User::class);
	}
}
