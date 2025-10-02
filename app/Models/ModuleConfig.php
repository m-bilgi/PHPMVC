<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class ModuleConfig extends BaseModel
{
	public ?int $id = null;
	public ?string $guid = null;
	public ?string $name = null;
	public ?int $member_level = null;
	public ?int $content_add_member_level = null;
	public ?int $status = null;
	public ?string $upload_file_extensions = null;
	public ?string $upload_file_size = null;
	public ?string $upload_file_member_level = null;
	public ?string $upload_file_status = null;

	protected static array $casts = [
		'id' => 'int',
		'guid' => 'string',
		'name' => 'string',
		'member_level' => 'int',
		'content_add_member_level' => 'int',
		'status' => 'int',
		'upload_file_extensions' => 'string',
		'upload_file_size' => 'string',
		'upload_file_member_level' => 'string',
		'upload_file_status' => 'string',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
