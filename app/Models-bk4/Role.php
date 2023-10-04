<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    
    public $timestamps = false;
    
    /**
     * getAll
     *
     * @return void
     */
    public static function getAll()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        return self::where($conditions)->get();
    }

    public static function updateWithArray($array=[], $id=0)
    {
        $editInfo = [
            'name' => trim($array['name']),
            'name_alias' => trim($array['name_alias'])
        ];

        
        $process = self::where('id', (int) $id)->first();
        $process->name = trim($array['name']);
        $process->name_alias = trim($array['name_alias']);

        return $process->save();
        //->update($editInfo);
    }
}
