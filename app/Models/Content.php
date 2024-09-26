<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    // Define the fillable fields to allow mass assignment
    protected $fillable = ['title', 'image', 'content']; 

    /**
     * If the content is related to a specific therapist, you can define a relationship.
     * Assuming you have a therapist as a user.
     */
    public function therapist()
    {
        return $this->belongsTo(User::class, 'therapist_id'); // Adjust the foreign key if necessary
    }

    /**
     * If the content is categorized, you can define a relationship with a category model (optional).
     */
    public function category()
    {
        return $this->belongsTo(Category::class); // Only if you have a Category model
    }
}
