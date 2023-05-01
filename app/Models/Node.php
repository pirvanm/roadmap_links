<?php

namespace App\Models;

use App\Models\Node;
use App\Models\Roadmap;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Node extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $guarded = ['id'];

    protected $with = ['nodes'];

    protected $casts = [
        'created_at' => 'date:Y-m-d'
    ];

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class);
    }

    public function parent()
    {
        return $this->belongsTo(Node::class, 'parent_id');
    }

    public function nodes()
    {
        return $this->hasMany(Node::class, 'parent_id', 'id');
    }

    public function links()
    {
        return $this->belongsToMany(Link::class, 'link_node');
    }
}
