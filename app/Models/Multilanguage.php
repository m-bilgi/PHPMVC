<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class Multilanguage extends BaseModel
{
	public ?int $id = null;
	public ?string $table_name = null;
	public ?string $guid = null;
	public ?string $title = null;
	public ?string $keywords = null;
	public ?string $summary = null;
	public ?string $content = null;
	public ?string $language = null;

	protected static array $casts = [
		'id' => 'int',
		'table_name' => 'string',
		'guid' => 'string',
		'title' => 'string',
		'keywords' => 'string',
		'summary' => 'string',
		'content' => 'string',
		'languag' => 'string',
	];

	public function isActive(): bool
	{
		return (int)$this->status === 1;
	}
}
