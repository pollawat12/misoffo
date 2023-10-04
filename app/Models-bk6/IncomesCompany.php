<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomesCompany extends Model
{
    use HasFactory;
    
    protected $table = 'incomes_company';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getData($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $array[] = [
                    'id' => $row->id,
                    'company_name' => $row->company_name,
                    'company_tel' => $row->company_tel,
                    'company_email' => $row->company_email,
                    'company_contact' => $row->company_contact,
                ];
            }
        }


        return $array;
    }


    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->company_name = isset($data['company_name'])  ? trim($data['company_name']) : '';
        $process->company_address = isset($data['company_address'])  ? trim($data['company_address']) : '';
        $process->company_tel = isset($data['company_tel'])  ? trim($data['company_tel']) : '';
        $process->company_email = isset($data['company_email'])  ? trim($data['company_email']) : '';
        $process->company_contact = isset($data['company_contact'])  ? trim($data['company_contact']) : '';
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
        
        $process->parent_id = (int) 0;
        $process->sort_order = (int) 1;
        $process->company_name = isset($data['company_name'])  ? trim($data['company_name']) : '';
        $process->company_address = isset($data['company_address'])  ? trim($data['company_address']) : '';
        $process->company_tel = isset($data['company_tel'])  ? trim($data['company_tel']) : '';
        $process->company_email = isset($data['company_email'])  ? trim($data['company_email']) : '';
        $process->company_contact = isset($data['company_contact'])  ? trim($data['company_contact']) : '';
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
