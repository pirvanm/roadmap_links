<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Link>
     */
    public function links() : BelongsToMany
    {
        return $this->belongsToMany(Link::class, 'link_tag');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
