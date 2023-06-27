<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\Type;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;

    // All fields to be filled with fill() method
    protected $fillable = [
        "name",
        "purpose",
        "type_id",

        "team_members",
        "description",
        "project_manager",
        "repository",
        "is_done",
        "original_img_name",
        "image_path",
    ];

    // Generate slug using the name of the Project is beeing created or updated
    // use Str to generate the string

    public static function generateSlug($str){
        $slug = Str::slug($str, '-');
        $first_slug = $slug;
        $is_slug_used = Project::where('slug', $slug)->first();
        $counter =  1;

        // While the slug is already in the database add an ascendent suffix using a counter
        while($is_slug_used){
            $slug = $first_slug . $counter;
            $is_slug_used = Project::where('slug', $slug)->first();
            $counter++;
        }

        return $slug;
    }

    // Tables Relationships

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
