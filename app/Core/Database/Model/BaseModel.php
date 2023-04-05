<?php

namespace App\Core\Database\Model;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public const ID = 'id';
    public const TABLE_NAME = 'base_table';
    abstract public function getTableName(): string;

    public static function column(string $columnName): string
    {
        return static::TABLE_NAME . '.' . $columnName;
    }
}
