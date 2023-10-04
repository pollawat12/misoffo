<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';
    
    public $timestamps = false;


    
    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
    /**
     * insertRow
     *
     * @param  mixed $data
     * @param  mixed $userId
     * @return void
     */
    public static function insertRow($data, $userId=0)
    {
        $process = new self;

        $process->code =  null;
        $process->prename = (isset($data['prename'])) ? $data['prename'] : null;
        $process->firstname = $data['firstname'];
        $process->lastname = (isset($data['lastname'])) ? $data['lastname'] : null;
        $process->nickname = null;
        $process->firstname_en = null;
        $process->lastname_en = null;
        $process->gender = null;
        $process->blood_type = null;
        $process->weight = (int) 0;
        $process->height = (int) 0;
        $process->has_race = null;
        $process->has_nationality = null;
        $process->has_religion = (int) 0;
        $process->maritial_status = (int) 0;
        $process->card_no = null;
        $process->dob = null;
        $process->tel = null;
        $process->fax = null;
        $process->avatar_image = null;
        $process->email = (isset($data['email'])) ? $data['email'] : null;
        $process->mobile = (isset($data['mobile'])) ? $data['mobile'] : null;
        $process->users_id = (int) $userId;
        $process->positions_no = (isset($data['positions_no'])) ? $data['positions_no'] : 0;

        return $process->save();
    }
    
    /**
     * updateRow
     *
     * @param  mixed $data
     * @param  mixed $id
     * @return void
     */
    public static function updateRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        $process->code =  null;
        $process->prename = (isset($data['prename'])) ? $data['prename'] : null;
        $process->firstname = $data['firstname'];
        $process->lastname = (isset($data['lastname'])) ? $data['lastname'] : null;
        $process->nickname = (isset($data['nickname'])) ? $data['nickname'] : null;
        $process->firstname_en = (isset($data['firstname_en'])) ? $data['firstname_en'] : null;
        $process->lastname_en = (isset($data['lastname_en'])) ? $data['lastname_en'] : null;
        $process->gender = (isset($data['gender'])) ? $data['gender'] : null;
        $process->blood_type = (isset($data['blood_type'])) ? $data['blood_type'] : null;
        $process->weight = (isset($data['weight'])) ? $data['weight'] : (int) 0;
        $process->height = (isset($data['height'])) ? $data['height'] : (int) 0;
        $process->has_race = (isset($data['has_race'])) ? $data['has_race'] : null;
        $process->has_nationality = (isset($data['has_nationality'])) ? $data['has_nationality'] : null;
        $process->has_religion = (isset($data['has_religion'])) ? $data['has_religion'] : (int) 0;
        $process->maritial_status = (isset($data['maritial_status'])) ? $data['maritial_status'] : (int) 0;
        $process->card_no = (isset($data['card_no'])) ? $data['card_no'] : null;
        $process->dob = (isset($data['dob'])) ? getInputDateToDB($data['dob']) : null;
        $process->tel = (isset($data['tel'])) ? $data['tel'] : null;
        $process->fax = (isset($data['fax'])) ? $data['fax'] : null;
        // $process->avatar_image = (isset($data['avatar_image'])) ? $data['avatar_image'] : null;
        $process->email = (isset($data['email'])) ? $data['email'] : null;
        $process->mobile = (isset($data['mobile'])) ? $data['mobile'] : null;
        $process->line_id = (isset($data['line_id'])) ? $data['line_id'] : null;
        
        return $process->save();
    }

    
    /**
     * getDashboardGenderData
     *
     * @return void
     */
    public static function getDashboardGenderData()
    {
        // gender
        $fCounts = self::where('gender','f')->count();
        $mCounts = self::where('gender','m')->count();

        return ['gender_m' => $mCounts, 'gender_f' => $fCounts];
    }
    
    /**
     * getDashboardRangeAgeData
     *
     * @return void
     */
    public static function getDashboardRangeAgeData()
    {
        $conditions = [
            // 'roles_id' => '3',
            // 'is_deleted' => (int) 0,
            // 'is_active' => (int) 1
        ];
        
        $query = self::where($conditions);
        $records = $query->get();
        $array = [];

        $age1 = 0;
        $age2 = 0;
        $age3 = 0;
        $age4 = 0;
        if (!empty($records)) {
            foreach ($records as $row) {
                $then = strtotime($row['dob']);
                $age = floor((time()-$then)/31556926);

                if($age > '19' && $age <= '30'){
                    $age1 += 1;
                }elseif($age > '30' && $age <= '45'){
                    $age2 += 1;
                }elseif($age > '45' && $age <= '50'){
                    $age3 += 1;
                }elseif($age > '50'){
                    $age4 += 1;
                }
            }
        }

        $rangeAgeArray = [
            0 => [
                'lable' => '20-30 ปี',
                'nums' => $age1
            ],
            1 => [
                'lable' => '31-45 ปี',
                'nums' => $age2
            ],
            2 => [
                'lable' => '46-50 ปี',
                'nums' => $age3
            ],
            3 => [
                'lable' => '51-65 ปี',
                'nums' => $age4
            ]
        ];


        return $rangeAgeArray;
    }

    
    /**
     * getDashboardDegreeData
     *
     * @return void
     */
    public static function getDashboardDegreeData()
    {
        
        $degrees = [
            3 => 'มัธยมศึกษาตอนต้น', // value="S"
            4 => 'มัธยมศึกษาตอนปลาย', // value="H"
            5 => 'ประกาศวิชาชีพชั้นสุง (ปวส.)', // value="A"
            6 => 'ปริญญาตรี', // value="B"
            7 => 'ปริญญาโท', // value="M"
            8 => 'ปริญญาเอก', // value="PH"
            9 => 'ใบประกอบวิชาชีพ' // value="C"
        ];

        $array = [];

        foreach ($degrees as $k => $val) {
            $array[$k] = [
                'label' => $val,
                'nums' => \App\Models\UserEducation::where('degress_no',$k)->count(),
            ];
        }


        return $array;
    }

    
    /**
     * getDashboardCourseTypeData
     *
     * @param  mixed $startDate
     * @param  mixed $endDate
     * @return void
     */
    public static function getDashboardCourseTypeData($startDate='', $endDate='')
    {
        $conditions = [
            'group_type' => 'course',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $courseTypes = \App\Models\DataSetting::where($conditions)->get();

        $array = [];

        if (!empty($courseTypes)) {
            foreach ($courseTypes as $item) {

                $array[] = [
                    'label' => $item->name,
                    'nums' => \App\Models\Courses::where('categroy_courses_id',$item->id)->count()
                ];
            }
        }


        return $array;
    }

    public static function getDashboardDepartmentData()
    {
        $conditions = [
            'group_type' => 'department',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $departments = \App\Models\DataSetting::where($conditions)->get();

        $array = [];

        if (!empty($departments)) {
            foreach ($departments as $item) {
                $array[] = [
                    'label' => $item->name,
                    'nums' => \App\Models\UserDutyDetail::where('department_no',$item->id)->count()
                ];
            }
        }

        return $array;
    }

    public static function getDashboardPositionData()
    {
        $conditions = [
            'group_type' => 'position',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $departments = \App\Models\DataSetting::where($conditions)->get();
        //PositionAction
        $array = [];

        if (!empty($departments)) {
            foreach ($departments as $item) {
                $PositionAction = \App\Models\PositionAction::where('position_id',$item->id)->get();
                foreach ($PositionAction as $itemnAction);

                $array[] = [
                    'id' => $item->id,
                    'label' => $item->name,
                    'minNum' => $itemnAction->position_min,
                    'maxNum' => $itemnAction->position_max,
                    'nums' => \App\Models\UserDutyDetail::where('position_no',$item->id)->count()
                ];
            }
        }

        return $array;
    }

    
}
