<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableReport extends Model
{
    use HasFactory;

    protected $table = 'durable_report';
    
    public $timestamps = false;
    //
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
            $query->where('durable_type', trim($type));
        }

        if ($isCount) { return $query->count(); }
        
        return $query->orderBy('sort_order','asc')->get();
    }

    public static function inserRow($data, $id=0, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) $id;
        $process->sort_order = (int) 1;

        if($data['durable_type'] == 'borrow'){

            $process->borrow_date = isset($data['borrow_date'])  ? getInputDateToDB($data['borrow_date']) : date('Y-m-d');
            $process->borrow_user_name = isset($data['borrow_user_name'])  ? trim($data['borrow_user_name']) : '';
            $process->borrow_institution = isset($data['borrow_institution'])  ? trim($data['borrow_institution']) : '';
            $process->borrow_affiliate = isset($data['borrow_affiliate'])  ? trim($data['borrow_affiliate']) : '';
            $process->borrow_location = isset($data['borrow_location'])  ? trim($data['borrow_location']) : '';
            $process->borrow_detail = isset($data['borrow_detail'])  ? trim($data['borrow_detail']) : '';
            $process->borrow_project = isset($data['borrow_project'])  ? trim($data['borrow_project']) : '';
            $process->borrow_file = isset($data['borrow_file'])  ? trim($data['borrow_file']) : '';

        }elseif($data['durable_type'] == 'returns'){

            $process->returns_date = isset($data['returns_date'])  ? getInputDateToDB($data['returns_date']) : date('Y-m-d');
            $process->returns_user_name = isset($data['returns_user_name'])  ? trim($data['returns_user_name']) : '';
            $process->returns_institution = isset($data['returns_institution'])  ? trim($data['returns_institution']) : '';
            $process->returns_affiliate = isset($data['returns_affiliate'])  ? trim($data['returns_affiliate']) : '';
            $process->returns_file = isset($data['returns_file'])  ? trim($data['returns_file']) : '';

        }else{

            $process->distribution_date = isset($data['distribution_date'])  ? getInputDateToDB($data['distribution_date']) : date('Y-m-d');
            $process->distribution_user_name = isset($data['distribution_user_name'])  ? trim($data['distribution_user_name']) : '';
            $process->distribution_institution = isset($data['distribution_institution'])  ? trim($data['distribution_institution']) : '';
            $process->distribution_affiliate = isset($data['distribution_affiliate'])  ? trim($data['distribution_affiliate']) : '';
            $process->distribution_number = isset($data['distribution_number'])  ? trim($data['distribution_number']) : '';
            $process->distribution_in_name = isset($data['distribution_in_name'])  ? trim($data['distribution_in_name']) : '';
            $process->distribution_date = isset($data['distribution_in_date'])  ? getInputDateToDB($data['distribution_in_date']) : date('Y-m-d');
            $process->distribution_location = isset($data['distribution_location'])  ? trim($data['distribution_location']) : '';
            $process->distribution_detail = isset($data['distribution_detail'])  ? trim($data['distribution_detail']) : '';
            $process->is_affiliate_1 = isset($data['is_affiliate_1'])  ? trim($data['is_affiliate_1']) : (int) 0;
            $process->is_affiliate_2 = isset($data['is_affiliate_2'])  ? trim($data['is_affiliate_2']) : (int) 0;
            $process->is_affiliate_3 = isset($data['is_affiliate_3'])  ? trim($data['is_affiliate_3']) : (int) 0;
            $process->is_affiliate_4 = isset($data['is_affiliate_4'])  ? trim($data['is_affiliate_4']) : (int) 0;
            $process->is_affiliate_5 = isset($data['is_affiliate_5'])  ? trim($data['is_affiliate_5']) : (int) 0;
            $process->is_affiliate_6 = isset($data['is_affiliate_6'])  ? trim($data['is_affiliate_6']) : (int) 0;
            $process->is_affiliate_7 = isset($data['is_affiliate_7'])  ? trim($data['is_affiliate_7']) : (int) 0;
        }

        $process->durable_status = isset($data['durable_status'])  ? trim($data['durable_status']) : '';
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
