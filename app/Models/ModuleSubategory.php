<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class ModuleSubcategory extends BaseModel
{
	public ?int $id = null;
	public ?int $category_id = null;
	public ?int $module_id = null;
	public ?string $guid = null;
	public ?string $name = null;
	public ?string $keywords = null;
	public ?string $description = null;
	public ?string $image = null;
	public ?string $thumbnail = null;
	public ?int $hit = null;
	public ?int $data_count = null;
	public ?int $sort_order = null;
	public ?int $owner_id = null;
	public ?string $last_post_date = null;
	public ?int $last_post_member_id = null;
	public ?string $url = null;
	public ?int $status = null;

	protected static array $casts = [
		'id' => 'int',
		'category_id' => 'int',
		'module_id' => 'int',
		'guid' => 'string',
		'name' => 'string',
		'keywords' => 'string',
		'description' => 'string',
		'image' => 'string',
		'thumbnail' => 'string',
		'hit' => 'int',
		'data_count' => 'int',
		'sort_order' => 'int',
		'owner_id' => 'int',
		'last_post_date' => 'string',
		'last_post_member_id' => 'int',
		'url' => 'string',
		'status' => 'int',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
