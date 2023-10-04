<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSetting extends Model
{
    use HasFactory;

    protected $table = 'data_settings';
    
    public $timestamps = false;

    
    /**
     * getDataAll
     *
     * @param  mixed $type
     * @param  mixed $parentId
     * @param  mixed $isCount
     * @return void
     */
    public static function getDataAll($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'parent_id' => (int) $parentId
        ];

        $query = self::where($conditions);

        if (!empty($type)) {
            $query->where('group_type', trim($type));
        }

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('sort_order','asc')->get();
    }


    public static function getNameDataByValueAndType($value=0,$type='')
    {
        if ($value == 0) { return '-'; }

        $conditions = [
            'id' => (int) $value,
            'group_type' => trim($type),
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions)->first();

        if(isset($query)){
            return $query->name;

        }else{

            return false;
        }

        
    }
    
    /**
     * insertArray
     *
     * @param  mixed $array
     * @param  mixed $return_id
     * @return void
     */
    public static function insertArray($array, $return_id=false)
    {
        // $query = new self;
        if ($return_id) {
            return self::create($array)->id;
        }
        return self::insert($array);
    }

    /**
     * updateArray
     *
     * @param  mixed $input
     * @param  mixed $return_id
     * @return void
     */
    public static function updateArray($array, $id=0)
    {
        // $query = new self;
        return self::where('id', $id)->update($array);
    }

    
    /**
     * inserRow
     *
     * @param  mixed $data
     * @param  mixed $returnId
     * @return void
     */
    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) $data['parent_id'];
        $process->sort_order = (int) 1;
        $process->name = trim($data['name']);
        $process->group_type = trim($data['group_type']);
        $process->value_type = (int) $data['value_type'];
        $process->data_value = ($data['value_type'] == 1) ? $data['data_value'] : 0;
        $process->data_string = ($data['value_type'] == 2) ? $data['data_value'] : '-';
        $process->amount = isset($data['amount'])  ? trim($data['amount']) : NULL;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        
        if ($returnId) { 
            $process->save();

            return $process->id;
        } 
        
        return $process->save();
    }

    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->parent_id = (int) $data['parent_id'];
        $process->name = trim($data['name']);
        $process->group_type = trim($data['group_type']);
        $process->value_type = (int) $data['value_type'];
        $process->data_value = ($data['value_type'] == 1) ? $data['data_value'] : 0;
        $process->data_string = ($data['value_type'] == 2) ? $data['data_value'] : '-';
        $process->amount = isset($data['amount'])  ? trim($data['amount']) : NULL;
        $process->is_deleted = (int) $data['is_deleted'];
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function deleteRow($id=0)
    {
        $process = self::find((int) $id);
        
        $process->is_deleted = (int) 1;
        $process->is_active = (int) 0;
        $process->updated_at = getDateNow();
        $process->save();
        
        return $process->save();
    }
}
