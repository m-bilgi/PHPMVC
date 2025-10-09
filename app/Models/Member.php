<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class Member extends BaseModel
{
	public ?int $id = null;
	public ?string $name = null;
	public ?string $surname = null;
	public ?string $email = null;
	public ?string $username = null;
	public ?string $password = null;
	public ?int $level = null;
	public ?int $status = null;

	protected static array $casts = [
		'id' => 'int',
		'name' => 'string',
		'surname' => 'string',
		'email' => 'string',
		'username' => 'string',
		'password' => 'string',
		'level' => 'int',
		'status' => 'int',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
