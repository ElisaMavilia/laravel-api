<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'content',
        'slug',
        'category_id',
    ];

    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Project::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;
    }

    public function category() // category va al singolare 
    {
        return $this->belongsTo(Category::class); //questo metodo serve per mappare la relazione inversa (molti a uno): rappresenta la relazione di dipendenza verso il Model principale (Project)
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
