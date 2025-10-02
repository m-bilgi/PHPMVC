<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class ModuleData extends BaseModel
{
	public ?int $id = null;
	public ?int $category_id = null;
	public ?int $subcategory_id = null;
	public ?int $module_id = null;
	public ?string $guid = null;
	public ?int $member_id = null;
	public ?string $title = null;
	public ?string $keywords = null;
	public ?string $summary = null;
	public ?string $content = null;
	public ?string $image = null;
	public ?string $thumbnail = null;
	public ?string $author = null;
	public ?string $author_contact = null;
	public ?string $created_date = null;
	public ?int $status = null;
	public ?int $hit = null;
	public ?int $rating = null;
	public ?int $reply_count = null;
	public ?string $poster_email_address = null;
	public ?int $badlink = null;
	public ?int $owner_id = null;
	public ?string $url = null;
	public ?string $file_size = null;
	public ?string $file_licence = null;
	public ?string $file_language = null;
	public ?string $file_platform = null;
	public ?string $ip_address = null;
	public ?string $last_post_date = null;
	public ?int $last_post_member_id = null;
	public ?int $mail = null;
	public ?int $locked = null;

	protected static array $casts = [
		'id' => 'int',
		'category_id' => 'int',
		'subcategory_id' => 'int',
		'module_id' => 'int',
		'guid' => 'string',
		'member_id' => 'int',
		'title' => 'string',
		'keywords' => 'string',
		'summary' => 'string',
		'content' => 'string',
		'image' => 'string',
		'thumbnail' => 'string',
		'author' => 'string',
		'author_contact' => 'string',
		'created_date' => 'string',
		'status' => 'int',
		'hit' => 'int',
		'rating' => 'int',
		'reply_count' => 'int',
		'poster_email_address' => 'string',
		'badlink' => 'int',
		'owner_id' => 'int',
		'url' => 'string',
		'file_size' => 'string',
		'file_licence' => 'string',
		'file_language' => 'string',
		'file_platform' => 'string',
		'ip_address' => 'string',
		'last_post_date' => 'string',
		'last_post_member_id' => 'int',
		'mail' => 'int',
		'locked' => 'int',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
