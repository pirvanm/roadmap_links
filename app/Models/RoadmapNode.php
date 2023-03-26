<?php

namespace App\Models;

use App\Models\Roadmap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class RoadmapNode extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function parent()
    {
        return $this->belongsTo(RoadmapNode::class, 'parent_id');
    }

    public function nodes()
    {
        return $this->hasMany(RoadmapNode::class, 'parent_id', 'id');
    }
}
