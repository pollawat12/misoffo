<?php

namespace App\Models;

use DB;
use URL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ModuleFunction
 */
class ModuleFunction extends Model
{
    use HasFactory;

    protected $table = 'module_functions';
    
    public $timestamps = false;

    
    /**
     * getMenuMains
     *
     * @param  mixed $cid
     * @return void
     */
    public static function getMenuMains($cid=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'parent_id' => (int) $cid
        ];

        return self::where($conditions)->get();
    }

    
    /**
     * insertByArray
     *
     * @param  mixed $array
     * @param  mixed $isReturnId
     * @return void
     */
    public static function insertByArray($array=[], $isReturnId=false)
    {
        $parentId = ($array['sub_group_menu'] == 0) ? (int) $array['group_menu'] : (int) 0;

        $data = [
            'parent_id' => $parentId,
            'sort_order' => $array['sort_order'],
            'name' => $array['name'],
            'name_menu' => $array['name_menu'],
            'slug' => $array['slug'],
            'group_menu' => $array['group_menu'],
            'sub_group_menu' => $array['sub_group_menu'],
            'folder_name' => $array['folder_name'],
            'controller_name' => $array['controller_name'],
            'function_name' => $array['function_name'],
            'is_menu' => (int) $array['is_menu'],
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'created_at' => getDateNow(),
            'updated_at' => getDateNow()
        ];

        $process = new self;

        $insertResult = DB::table('module_functions')->insert($data);

        if ($isReturnId) { return DB::getPdo()->lastInsertId(); }

        return $insertResult;
    }


    public static function updateByArray($array=[], $id=0)
    {
        $data = [
            'name' => $array['name'],
            'name_menu' => $array['name_menu'],
            'slug' => $array['slug'],
            'group_menu' => $array['group_menu'],
            'sub_group_menu' => $array['sub_group_menu'],
            'folder_name' => $array['folder_name'],
            'controller_name' => $array['controller_name'],
            'function_name' => $array['function_name'],
            'is_menu' => (int) $array['is_menu'],
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'created_at' => getDateNow(),
            'updated_at' => getDateNow()
        ];

        $process = new self;

        $insertResult = DB::table(self::$table)->insert($data);

        if ($returnId) { return DB::getPdo()->lastInsertId(); }

        return $insertResult;
    }

    public static function getFunctionForRoles($selected=[])
    {
        $categories = [2 => 'นำเข้ารายการข้อมูล', 3 => 'ตั้งค่าระบบ'];

        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'is_menu' => (int) 1
        ];

        $menus = [];
        foreach ($categories as $k => $v) {
            $groups = self::where($conditions)->where('parent_id', (int) $k)->get();
            $groupArr = [];
            if (!empty($groups)) {
                foreach ($groups as $group) {
                    $subGroups = self::where($conditions)->where('sub_group_menu', (int) $group->id)->orderBy('sort_order', 'asc')->get();

                    $subGroupArr = [];
                    if (!empty($subGroups)) {
                        foreach ($subGroups as $subGroup) {
                            $subGroupArr[$subGroup->id] = [
                                'id' => $subGroup->id,
                                'name' => $subGroup->name,
                                'url' => $subGroup->slug
                            ];
                        }
                    }

                    $groupArr[$group->id] = [
                        'id' => $group->id,
                        'name' => $group->name,
                        'url' => $group->slug,
                        'sub_menus' => $subGroupArr
                    ];
                }
            }
            $menus[$k] = [
                'id' => $k,
                'name' => $v,
                'sub_menus' => $groupArr
            ];
        }

        return $menus;
        
    }
}
