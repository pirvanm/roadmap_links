<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static static create(array $attributes)
 */
class Link extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Tag>
     */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'link_tag');
    }

    public function nodes()
    {
        return $this->belongsToMany(Node::class, 'link_node');
    }
}
