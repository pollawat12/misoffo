<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToEstimate extends Model
{
    use HasFactory;

    protected $table = 'user_to_estimate';
    
    public $timestamps = false;


    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->job_id = isset($data['job_id'])  ? trim($data['job_id']) : 0;
        $process->users_id = isset($data['users_id'])  ? trim($data['users_id']) : 0;
        $process->work_id = isset($data['work_id'])  ? trim($data['work_id']) : 0;
        $process->director_id = isset($data['director_id'])  ? trim($data['director_id']) : 0;
        $process->estimate_date = isset($data['estimate_date'])  ? getInputDateToDB($data['estimate_date']) : NULL;
        $process->score_1 = isset($data['score_1'])  ? trim($data['score_1']) : 0.00;
        $process->score_2 = isset($data['score_2'])  ? trim($data['score_2']) : 0.00;
        $process->score_3 = isset($data['score_3'])  ? trim($data['score_3']) : 0.00;
        $process->score_4 = isset($data['score_4'])  ? trim($data['score_4']) : 0.00;
        $process->score_5 = isset($data['score_5'])  ? trim($data['score_5']) : 0.00;
        $process->score_6 = isset($data['score_6'])  ? trim($data['score_6']) : 0.00;
        $process->score_7 = isset($data['score_7'])  ? trim($data['score_7']) : 0.00;
        $process->score_8 = isset($data['score_8'])  ? trim($data['score_8']) : 0.00;
        $process->comments_name = isset($data['comments_name'])  ? trim($data['comments_name']) : '';
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

    public static function updateRow($data , $id)
    {
        $process = self::find((int) $id);

        $process->score_1 = isset($data['score_1'])  ? trim($data['score_1']) : 0.00;
        $process->score_2 = isset($data['score_2'])  ? trim($data['score_2']) : 0.00;
        $process->score_3 = isset($data['score_3'])  ? trim($data['score_3']) : 0.00;
        $process->score_4 = isset($data['score_4'])  ? trim($data['score_4']) : 0.00;
        $process->score_5 = isset($data['score_5'])  ? trim($data['score_5']) : 0.00;
        $process->score_6 = isset($data['score_6'])  ? trim($data['score_6']) : 0.00;
        $process->score_7 = isset($data['score_7'])  ? trim($data['score_7']) : 0.00;
        $process->score_8 = isset($data['score_8'])  ? trim($data['score_8']) : 0.00;
        $process->comments_name = isset($data['comments_name'])  ? trim($data['comments_name']) : '';
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
