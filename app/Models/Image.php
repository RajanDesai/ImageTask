<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImageVariation;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['search_keyword', 'filename'];

    /**
     * Get the variations for the image.
     */
    public function variations()
    {
        return $this->hasMany(ImageVariation::class, 'image_id', 'id');
    }
}
