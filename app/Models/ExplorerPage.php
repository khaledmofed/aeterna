<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExplorerPage extends Model
{
    protected $fillable = ['slug','title','description','tag','icon_svg','content_json','sort_order','is_active'];

    protected $casts = ['content_json' => 'array', 'is_active' => 'boolean'];

    public function scopeActive($q) { return $q->where('is_active', true); }

    public function getContentAttribute(): array
    {
        return $this->content_json ?? [];
    }
}
