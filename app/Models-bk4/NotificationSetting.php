<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $table = 'notification_settings';
    
    public $timestamps = false;

    public static function getAll()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        return self::where($conditions)->orderBy('id', 'asc')->get();
    }

    public static function insertOne($array=[], $isReturnId=false)
    {
        $data = [
            'notify_type' => $array['notify_type'],
            'subject' => $array['subject'],
            'note' => $array['note'],
            'token_code' => $array['token_code'],
            'message' => $array['message'],
            'is_publish' => $array['is_publish'],
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $insertResult = self::save($array);
    }
}
