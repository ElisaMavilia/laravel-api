<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use Illuminate\Support\Str;
class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function projects() // project va al plurale in quanto questo metodo definisce una relazione uno-a-molti (one-to-many) tra il model corrente e il model Project = molti progetti, una categoria
    {
        return $this->hasMany(Project::class); //questa riga restituisce la relazione uno a molti attraverso il metodo hasMany. This rappresenta l'istanza corrente del model(ovvero Category)
    }

    public static function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        $count = 1;
        while (Category::where('slug', $slug)->first()) {
            $slug = Str::of($name)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;
    }

    use HasFactory;
}
