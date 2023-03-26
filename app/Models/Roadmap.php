<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function nodes()
    {
        return $this->hasMany(RoadmapNode::class, 'parent_id', 'id');
    }

    public function mainNode()
    {
        return $this->hasOne(RoadmapNode::class, 'roadmap_id', 'id');
    }
}
