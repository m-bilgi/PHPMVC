<?php
declare(strict_types=1);

namespace App\Models;

use DateTime;

class ModuleCategory extends BaseModel
{
  public ?int $id = null;
	public ?int $module_id = null;
	public ?string $guid = null;
	public ?string $name = null;
	public ?int $hit = null;
	public ?string $image = null;
	public ?int $sort_order = null;
	public ?string $url = null;
	public ?int $status = null;

    protected static array $casts = [
        'id' => 'int',
        'module_id' => 'int',
        'guid' => 'string',
        'name' => 'string',
        'hit' => 'int',
        'image' => 'string',
        'sort_order' => 'int',
        'url' => 'string',
        'status' => 'int',
    ];

    public function isActive(): bool
    {
        return (int)$this->status === 1;
    }

    public function getPublicImagePath(): ?string
    {
        return $this->image ? '/uploads/categories/' . ltrim($this->image, '/') : null;
    }
}
