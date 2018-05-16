<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AgeGroup extends Model
{
    protected $fillable = [
        'group_name', 'age_from', 'age_to', 'user_id'
    ];
    
    public static function getAgeGroups()
    {
        $ageGroupData = DB::table('age_groups')->select("id","group_name",DB::raw("CONCAT(age_from,'-',age_to) AS age_range"))->get();
        return $ageGroupData;
    }
    
    public static function getGroupById($id)
    {
        $group_data = DB::table('age_groups')->where('id','=', $id)->first();
        return $group_data;

    }
}
