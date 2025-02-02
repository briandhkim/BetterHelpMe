<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'display_order'];

    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }
}
