<?php
declare(strict_types=1);

namespace App\Models;

/**
* Simple and reusable model base.
* - Public typed properties are defined in child classes.
* - Child classes declare type conversions with protected static array $casts.
*/
abstract class BaseModel
{
    /** @var array Extra fields coming from outside the property can be kept here */
    protected array $attributes = [];

    /** To be filled in child classes: ['id' => 'int', 'name' => 'string'] */
    protected static array $casts = [];

    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Fill with array (DB row or form data).
     */
    public function fill(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $cast = static::$casts[$key] ?? null;
                $this->{$key} = self::castValue($value, $cast);
            } else {
                // Save Unknown fields (optional)
                $this->attributes[$key] = $value;
            }
        }
    }

    /**
     * Convert the model to an array. Gets the public properties + the content of $attributes.
     */
    public function toArray(): array
    {
        $public = [];
        foreach (get_object_vars($this) as $k => $v) {
            // Treat the attributes bag separately
            if ($k === 'attributes') continue;
            $public[$k] = $v;
        }
        return array_merge($public, $this->attributes);
    }

    /**
     * Static creating helper.
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Simple cast function. You can add conversions here if needed, such as for date/array objects.
     */
    protected static function castValue(mixed $value, ?string $cast): mixed
    {
        if ($value === null || $cast === null) {
            return $value;
        }

        return match ($cast) {
            'int' => (int) $value,
            'string' => (string) $value,
            'float' => (float) $value,
            'bool' => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? (bool)$value,
            'datetime' => ($value instanceof \DateTime) ? $value : new \DateTime((string)$value),
            'array' => is_array($value) ? $value : json_decode((string)$value, true) ?? [],
            default => $value
        };
    }
}
