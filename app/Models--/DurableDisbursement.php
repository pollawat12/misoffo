<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurableDisbursement extends Model
{
    use HasFactory;

    protected $table = 'durable_disbursement';
    
    public $timestamps = false;

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getDurable($isCount=false)
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

                $product = Durable::getNameDataByValueAndType($row->durable_id);
                foreach ($product as $rows);
                
                $unitcount = DataSetting::getNameDataByValueAndType($rows->unitcount_id,'unitcount');

                $array[] = [
                    'id' => $row->id,
                    'durable_name' => $rows->durable_name,
                    'amount_date' => $row->amount_date,
                    'amount_num' => $row->amount_num,
                    'user_name' => $row->user_name,
                    'institution' => $row->institution,
                    'affiliate' => $row->affiliate,
                    'location' => $row->location,
                    'project_id' => $row->project_id,
                    'unitcount' => $unitcount
                ];
            }
        }


        return $array;
    }

    public static function inserRow($data , $lotid , $returnId=false)
    {
        $process = new self;
        $process->amount_date = isset($data['amount_date'])  ? getInputDateToDB($data['amount_date']) : date('Y-m-d');
        $process->amount_num = isset($data['amount_num'])  ? trim($data['amount_num']) : 0;
        $process->user_name = isset($data['user_name'])  ? trim($data['user_name']) : '';
        $process->institution = isset($data['institution'])  ? trim($data['institution']) : '';
        $process->affiliate = isset($data['affiliate'])  ? trim($data['affiliate']) : '';
        $process->location = isset($data['location'])  ? trim($data['location']) : '';
        $process->durable_id = isset($data['value_id'])  ? trim($data['value_id']) : '';
        $process->project_id = isset($data['borrow_project'])  ? trim($data['borrow_project']) : '';
        $process->lot_id = isset($data['lotid'])  ? trim($data['lotid']) : '';
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
}
