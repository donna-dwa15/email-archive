<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender',
        'recipient',
        'subject',
        'html_body',
        'text_body',
        'attachments'
    ];
        
    public function tag(string $name): void
    {   
        $tag = Tag::firstOrCreate(['name' => trim($name)]);
        
        $this->tags()->attach($tag);
    }
    
    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
        
    }
}
