<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'project_image', 'project_live_url', 'project_source_code'];

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }

    public function Type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function Technology()
    {
        return $this->belongsToMany(Technology::class);
    }
}
