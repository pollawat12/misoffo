<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Durable extends Model
{
    use HasFactory;

    protected $table = 'durable';
    
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


    public static function getDataDashboard()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'durable_type' => 'durable'
        ];

        $query = self::where($conditions);
        $results = $query->orderBy('sort_order','asc')->get();

        $array = [];
        $no = 0;
        if ($results) {
            foreach ($results as $result) {
                $no++;
                $diff_price = 0;
                $array[] = [
                    'no' => $no,
                    'item_name' => $result->durable_name,
                    'import_date' => getDateMonthTH($result->durable_received_date, false, true),
                    'item_code' => $result->durable_number,
                    'item_status' => getLabelStatusDurable($result->durable_status),
                    'item_price' => getNumberCurrency($result->durable_price),
                    'item_dep_price' => getNumberCurrency($diff_price)
                ];
            }
        }

        return $array;
    }

    public static function inserRow($data, $returnId=false)
    {
        $process = new self;
        $process->parent_id = (int) $data['parent_id'];
        $process->sort_order = (int) 1;
        $process->durable_type = trim($data['durable_type']);
        $process->durable_name = trim($data['durable_name']);
        $process->durable_serial = isset($data['durable_serial'])  ? trim($data['durable_serial']) : '';
        $process->durable_number = isset($data['durable_number'])  ? trim($data['durable_number']) : '';
        $process->category_id = isset($data['category_id'])  ? trim($data['category_id']) : 0;
        $process->typedata_id = isset($data['typedata_id'])  ? (int) $data['typedata_id'] : 0;
        $process->unitcount_id = isset($data['unitcount_id'])  ? (int) $data['unitcount_id'] : 0;
        $process->money_id = isset($data['money_id'])  ? (int) $data['money_id'] : 0;
        $process->means_id = isset($data['means_id'])  ? (int) $data['means_id'] : 0;
        $process->province_no = (isset($data['province_no'])) ? $data['province_no'] : (int) 0;
        $process->district_no = (isset($data['district_no'])) ? $data['district_no'] : (int) 0;
        $process->subdistrict_no = (isset($data['subdistrict_no'])) ? $data['subdistrict_no'] : (int) 0;
        $process->zipcode = (isset($data['zipcode'])) ? $data['zipcode'] : null;
        $process->durable_brand = isset($data['durable_brand'])  ? trim($data['durable_brand']) : '';
        $process->durable_generation = isset($data['durable_generation'])  ? trim($data['durable_generation']) : '';
        $process->durable_storage_location = isset($data['durable_storage_location'])  ? trim($data['durable_storage_location']) : '';
        $process->durable_image = (isset($data['education_file'])) ? $data['education_file'] : null;
        $process->durable_detail = isset($data['durable_detail'])  ? trim($data['durable_detail']) : '';
        $process->durable_received_date = isset($data['durable_received_date'])  ? getInputDateToDB($data['durable_received_date']) : NULL;
        $process->durable_invoice_date = isset($data['durable_invoice_date'])  ? getInputDateToDB($data['durable_invoice_date']) : NULL;
        $process->durable_invoice_file = isset($data['durable_invoice_file'])  ? trim($data['durable_invoice_file']) : '';
        $process->durable_price = isset($data['durable_price'])  ? trim($data['durable_price']) : '0';
        $process->durable_vat = isset($data['durable_vat'])  ? trim($data['durable_vat']) : '0';
        $process->durable_sum = isset($data['durable_sum'])  ? trim($data['durable_sum']) : '0';
        $process->durable_year = isset($data['durable_year'])  ? trim($data['durable_year']) : '';
        $process->durable_depreciation_rate = isset($data['durable_depreciation_rate'])  ? trim($data['durable_depreciation_rate']) : '';
        $process->institution_id = (isset($data['institution_id'])) ? $data['institution_id'] : (int) 0;
        $process->year_id = (isset($data['year_id'])) ? $data['year_id'] : (int) 0;
        $process->budget_categroy = (isset($data['budget_categroy'])) ? $data['budget_categroy'] : (int) 0;
        $process->budget_type = (isset($data['budget_type'])) ? $data['budget_type'] : (int) 0;
        $process->projects_id = (isset($data['projects_id'])) ? $data['projects_id'] : (int) 0;
        $process->durable_purchase = isset($data['durable_purchase'])  ? trim($data['durable_purchase']) : '';
        $process->durable_company = isset($data['durable_company'])  ? trim($data['durable_company']) : '';
        $process->durable_size = isset($data['durable_size'])  ? trim($data['durable_size']) : NULL;
        $process->durable_mix = isset($data['durable_mix'])  ? trim($data['durable_mix']) : NULL;
        $process->durable_max = isset($data['durable_max'])  ? trim($data['durable_max']) : NULL;
        $process->durable_status = (int) 0;
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
        $process->sort_order = (int) 1;
        $process->durable_type = trim($data['durable_type']);
        $process->durable_name = trim($data['durable_name']);
        $process->durable_serial = isset($data['durable_serial'])  ? trim($data['durable_serial']) : '';
        $process->durable_number = isset($data['durable_number'])  ? trim($data['durable_number']) : '';
        $process->category_id = isset($data['category_id'])  ? trim($data['category_id']) : 0;
        $process->typedata_id = isset($data['typedata_id'])  ? (int) $data['typedata_id'] : 0;
        $process->unitcount_id = isset($data['unitcount_id'])  ? (int) $data['unitcount_id'] : 0;
        $process->money_id = isset($data['money_id'])  ? (int) $data['money_id'] : 0;
        $process->means_id = isset($data['means_id'])  ? (int) $data['means_id'] : 0;
        $process->province_no = (isset($data['province_no'])) ? $data['province_no'] : (int) 0;
        $process->district_no = (isset($data['district_no'])) ? $data['district_no'] : (int) 0;
        $process->subdistrict_no = (isset($data['subdistrict_no'])) ? $data['subdistrict_no'] : (int) 0;
        $process->zipcode = (isset($data['zipcode'])) ? $data['zipcode'] : null;
        $process->durable_brand = isset($data['durable_brand'])  ? trim($data['durable_brand']) : '';
        $process->durable_generation = isset($data['durable_generation'])  ? trim($data['durable_generation']) : '';
        $process->durable_storage_location = isset($data['durable_storage_location'])  ? trim($data['durable_storage_location']) : '';
        // $process->durable_image = (isset($data['durable_image'])) ? $data['durable_image'] : null;
        $process->durable_detail = isset($data['durable_detail'])  ? trim($data['durable_detail']) : '';
        $process->durable_received_date = isset($data['durable_received_date'])  ? getInputDateToDB($data['durable_received_date']) : NULL;
        $process->durable_invoice_date = isset($data['durable_invoice_date'])  ? getInputDateToDB($data['durable_invoice_date']) : NULL;
        // $process->durable_invoice_file = isset($data['durable_invoice_file'])  ? trim($data['durable_invoice_file']) : '';
        $process->durable_price = isset($data['durable_price'])  ? trim($data['durable_price']) : '0';
        $process->durable_vat = isset($data['durable_vat'])  ? trim($data['durable_vat']) : '0';
        $process->durable_sum = isset($data['durable_sum'])  ? trim($data['durable_sum']) : '0';
        $process->durable_year = isset($data['durable_year'])  ? trim($data['durable_year']) : '';
        $process->durable_depreciation_rate = isset($data['durable_depreciation_rate'])  ? trim($data['durable_depreciation_rate']) : '';
        $process->institution_id = (isset($data['institution_id'])) ? $data['institution_id'] : (int) 0;
        $process->year_id = (isset($data['year_id'])) ? $data['year_id'] : (int) 0;
        $process->budget_categroy = (isset($data['budget_categroy'])) ? $data['budget_categroy'] : (int) 0;
        $process->budget_type = (isset($data['budget_type'])) ? $data['budget_type'] : (int) 0;
        $process->projects_id = (isset($data['projects_id'])) ? $data['projects_id'] : (int) 0;
        $process->durable_purchase = isset($data['durable_purchase'])  ? trim($data['durable_purchase']) : '';
        $process->durable_company = isset($data['durable_company'])  ? trim($data['durable_company']) : '';
        $process->durable_size = isset($data['durable_size'])  ? trim($data['durable_size']) : NULL;
        $process->durable_mix = isset($data['durable_mix'])  ? trim($data['durable_mix']) : NULL;
        $process->durable_max = isset($data['durable_max'])  ? trim($data['durable_max']) : NULL;
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


    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getDurable($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        if (!empty($type)) {
            $query->where('durable_type', trim($type));
        }

        $query->where('durable_status' , '!=', 2);

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $category = DataSetting::getNameDataByValueAndType($row->category_id,'category');
                $typedata = DataSetting::getNameDataByValueAndType($row->typedata_id,'typedata');
                $unitcount = DataSetting::getNameDataByValueAndType($row->unitcount_id,'unitcount');

                $array[] = [
                    'id' => $row->id,
                    'durable_name' => $row->durable_name,
                    'durable_serial' => $row->durable_serial,
                    'durable_number' => $row->durable_number,
                    'durable_received_date' => $row->durable_received_date,
                    'durable_price' => $row->durable_sum,
                    'durable_status' => $row->durable_status,
                    'durable_year' => $row->durable_year,
                    'durable_depreciation_rate' => $row->durable_depreciation_rate,
                    'durable_size' => $row->durable_size,
                    'durable_mix' => $row->durable_mix,
                    'durable_max' => $row->durable_max,
                    'durable_image' => $row->durable_image,
                    'durable_invoice_file' => $row->durable_invoice_file,
                    'borrow_date' => $row->borrow_date,
                    'borrow_user_name' => $row->borrow_user_name,
                    'borrow_location' => $row->borrow_location,
                    'borrow_institution' => $row->borrow_institution,
                    'borrow_file' => $row->borrow_file,
                    'returns_date' => $row->returns_date,
                    'returns_user_name' => $row->returns_user_name,
                    'distribution_date' => $row->distribution_date,
                    'distribution_user_name' => $row->distribution_user_name,
                    'distribution_location' => $row->distribution_location,
                    'distribution_institution' => $row->distribution_institution,
                    'category' => $category,
                    'typedata' => $typedata,
                    'unitcount' => $unitcount
                ];
            }
        }


        return $array;
    }

    /**
     * getActivity
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getActivity($type='', $parentId=0, $isCount=false)
    {
        $conditions = [
            'durable_type' => 'durable',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        if($type == 'borrow') {
            $query->where('durable_status', 1);
        }elseif($type == 'returns'){
            $query->where('durable_status' , '!=', 2);
            $query->where('borrow_user_name' , '!=', '');
        }else{
            $query->where('durable_status', 2);
        }

        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $category = DataSetting::getNameDataByValueAndType($row->category_id,'category');
                $typedata = DataSetting::getNameDataByValueAndType($row->typedata_id,'typedata');
                $unitcount = DataSetting::getNameDataByValueAndType($row->unitcount_id,'unitcount');

                $array[] = [
                    'id' => $row->id,
                    'durable_name' => $row->durable_name,
                    'durable_serial' => $row->durable_serial,
                    'durable_number' => $row->durable_number,
                    'durable_received_date' => $row->durable_received_date,
                    'durable_price' => $row->durable_sum,
                    'durable_status' => $row->durable_status,
                    'durable_year' => $row->durable_year,
                    'durable_depreciation_rate' => $row->durable_depreciation_rate,
                    'borrow_date' => $row->borrow_date,
                    'borrow_user_name' => $row->borrow_user_name,
                    'borrow_location' => $row->borrow_location,
                    'borrow_file' => $row->borrow_file,
                    'returns_date' => $row->returns_date,
                    'returns_user_name' => $row->returns_user_name,
                    'distribution_date' => $row->distribution_date,
                    'distribution_user_name' => $row->distribution_user_name,
                    'distribution_location' => $row->distribution_location,
                    'category' => $category,
                    'typedata' => $typedata,
                    'unitcount' => $unitcount
                ];
            }
        }


        return $array;
    }

    public static function updateActivityRow($data, $id=0)
    {
        $process = self::find((int) $id);
        
        if($data['durable_type'] == 'borrow'){

            $process->borrow_date = isset($data['borrow_date'])  ? getInputDateToDB($data['borrow_date']) : date('Y-m-d');
            $process->borrow_user_name = isset($data['borrow_user_name'])  ? trim($data['borrow_user_name']) : '';
            $process->borrow_institution = isset($data['borrow_institution'])  ? trim($data['borrow_institution']) : '';
            $process->borrow_affiliate = isset($data['borrow_affiliate'])  ? trim($data['borrow_affiliate']) : '';
            $process->borrow_location = isset($data['borrow_location'])  ? trim($data['borrow_location']) : '';
            $process->borrow_detail = isset($data['borrow_detail'])  ? trim($data['borrow_detail']) : '';
            $process->borrow_project = isset($data['borrow_project'])  ? trim($data['borrow_project']) : '';
            // $process->borrow_file = isset($data['borrow_file'])  ? trim($data['borrow_file']) : '';
            $process->returns_date = NULL;
            $process->returns_user_name = '';
            $process->returns_institution = '';
            $process->returns_affiliate = '';
            $process->returns_file = '';

        }elseif($data['durable_type'] == 'returns'){

            $process->returns_date = isset($data['returns_date'])  ? getInputDateToDB($data['returns_date']) : date('Y-m-d');
            $process->returns_user_name = isset($data['returns_user_name'])  ? trim($data['returns_user_name']) : '';
            $process->returns_institution = isset($data['returns_institution'])  ? trim($data['returns_institution']) : '';
            $process->returns_affiliate = isset($data['returns_affiliate'])  ? trim($data['returns_affiliate']) : '';
            // $process->returns_file = isset($data['returns_file'])  ? trim($data['returns_file']) : '';
            $process->borrow_file = '';

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

        $process->durable_status = isset($data['durable_status'])  ? trim($data['durable_status']) : 0;
        $process->updated_at = getDateNow();
        
        return $process->save();
    }

    public static function deleteActivityRow($id=0)
    {
        $process = self::find((int) $id);
        
        $process->durable_status = (int) 0;
        $process->updated_at = getDateNow();
        $process->save();
        
        return $process->save();
    }

    public static function getNameDataByValueAndType($value=0)
    {
        if ($value == 0) { return '-'; }

        $conditions = [
            'id' => (int) $value,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);

        return $query->get();
    }

    /**
     * getDurable
     *
     * @param  mixed $arrConds
     * @param  mixed $isCount
     * @return void
     */
    public static function getDurableDetail($id='')
    {
        $conditions = [
            'id' => (int) $id,
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $query = self::where($conditions);
        $records = $query->get();
        $array = [];

        if (!empty($records)) {
            foreach ($records as $row) {

                $category = DataSetting::getNameDataByValueAndType($row->category_id,'category');
                $typedata = DataSetting::getNameDataByValueAndType($row->typedata_id,'typedata');
                $unitcount = DataSetting::getNameDataByValueAndType($row->unitcount_id,'unitcount');

                $institution = DataSetting::getNameDataByValueAndType($row->borrow_institution,'institution');

                if($row['borrow_project'] == 0){

                    $project = 'ภายในสำนักงาน';

                }else{

                    $projects = Project::find((int) $row['borrow_project']);

                    $project = $projects->name;
                }

                if($row['durable_purchase'] == 0){

                    $purchase = '';

                }else{

                    $purchases = Purchases::find((int) $row['durable_purchase']);

                    $purchase = $purchases->purchases_name;
                }
                

                // $product = Durable::getNameDataByValueAndType($row->durable_id);
                // foreach ($product as $rows);

                $array[] = [
                    'id' => $row->id,
                    'durable_name' => $row->durable_name,
                    'durable_serial' => $row->durable_serial,
                    'durable_number' => $row->durable_number,
                    'durable_received_date' => $row->durable_received_date,
                    'durable_storage_location' => $row->durable_storage_location,
                    'durable_price' => $row->durable_sum,
                    'durable_status' => $row->durable_status,
                    'durable_year' => $row->durable_year,
                    'durable_depreciation_rate' => $row->durable_depreciation_rate,
                    'durable_size' => $row->durable_size,
                    'durable_mix' => $row->durable_mix,
                    'durable_max' => $row->durable_max,
                    'durable_image' => $row->durable_image,
                    'durable_company' => $row->durable_company,
                    'means_id' => $row->means_id,
                    'money_id' => $row->money_id,
                    'durable_invoice_file' => $row->durable_invoice_file,
                    'borrow_date' => $row->borrow_date,
                    'borrow_user_name' => $row->borrow_user_name,
                    'borrow_location' => $row->borrow_location,
                    'borrow_institution' => $institution,
                    'borrow_file' => $row->borrow_file,
                    'returns_date' => $row->returns_date,
                    'returns_user_name' => $row->returns_user_name,
                    'distribution_date' => $row->distribution_date,
                    'distribution_user_name' => $row->distribution_user_name,
                    'distribution_location' => $row->distribution_location,
                    'distribution_institution' => $row->distribution_institution,
                    'category' => $category,
                    'typedata' => $typedata,
                    'unitcount' => $unitcount,
                    'projects'  => $project,
                    'purchase' => $purchase
                ];
            }
        }


        return $array;
    }

    public static function getDashboarddurableData()
    {
        $conditions = [
            'group_type' => 'category',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $categorys = \App\Models\DataSetting::where($conditions)->get();
        
        $array = [];

        if (!empty($categorys)) {
            foreach ($categorys as $item) {

                $array[] = [
                    'id' => $item->id,
                    'label' => $item->name,
                    'projects' => self::where('borrow_project' , '!=' , '0')->where('category_id',$item->id)->count(),
                    'office' => self::where('borrow_project', '0')->where('category_id',$item->id)->count(),
                    'nums' => self::where('category_id',$item->id)->count()
                ];
            }
        }

        return $array;
    }

    public static function getDashboarddurableNumData()
    {
        $conditions = [
            'group_type' => 'category',
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $categorys = \App\Models\DataSetting::where($conditions)->get();

        $array = [
            'projects' => self::where('borrow_project' , '!=' , '0')->count(),
            'office' => self::where('borrow_project', '0')->count(),
        ];

        return $array;
    }
}
