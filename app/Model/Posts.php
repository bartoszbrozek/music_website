<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Timestamps
     *
     * @var boolean
     */
    public $timestamps = true;

    public function getAll()
    {
        return self::get();
    }

    public function scopeOrderByColumn(Builder $query, string $column, string $direction = 'asc'): Builder
    {
        return $query->orderBy($column, $direction);
    }

    public function scopeSearch(Builder $query, string $filter)
    {
        return $query
            ->where("title", "LIKE", "%{$filter}%")
            ->orWhere("content", "LIKE", "%{$filter}%")
            ->orWhere("id", "=", "{$filter}");
    }
}
