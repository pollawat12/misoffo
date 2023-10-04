<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\InvoiceSubject;
use App\Models\InvoiceHasReceipt;
use App\Models\BudgetYear;
use App\Models\Province;


class InvoiceDetail extends Model
{
    use HasFactory;

    protected $table = 'invoice_details';
    
    public $timestamps = false;

    
    /**
     * getInvoiceCounts
     *
     * @param  mixed $reportId
     * @param  mixed $type
     * @return void
     */
    public static function getInvoiceCounts($reportId=0, $type='')
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'invoice_subjects_id' => (int) $reportId
        ];

        $results = self::where($conditions);

        if ($type == 'wait') {
            $results->where('is_approved', (int) 1);
        }

        return $results->count();
    }
    
    /**
     * getInvoiceHasReceipt
     *
     * @param  mixed $subjectId
     * @return void
     */
    public static function getInvoiceHasReceipt($subjectId=0)
    {
        $conditions = ['is_active' => (int) 1, 'is_deleted' => (int) 0];
        $invoiceQuery = self::where('invoice_subjects_id', (int) $subjectId)->where($conditions)->get();

        $array = [];

        if (!empty($invoiceQuery)) {
            foreach ($invoiceQuery as $row) {
                $receipts = InvoiceHasReceipt::getReceiptWithInvoiceId($row->id);

                $tmp = [];
                if (!empty($receipts)) {
                    foreach ($receipts as $r_row) {
                        $tmp[] = $r_row->receipt_code;
                    }
                }

                // array
                $array[] = [
                    'invoice_id' => $row->id,
                    'invoice_code' => $row->invoice_code,
                    'license_code' => $row->license_code,
                    'pond_master_no' => $row->pond_master_no,
                    'province' => $row->province_name,
                    'company' => $row->company,
                    'total_cost' => $row->total_cost,
                    'receipt_code' => $tmp,
                    'invoice_status' => getLabelStatusApprovedPayment($row->is_approved)
                ];
            }
        }

        return $array;
    }


   

    
    /**
     * getInvoiceSummay
     *
     * @param  mixed $reportId
     * @return void
     */
    public static function getInvoiceSummay($reportId=0)
    {
        $invoiceCounts = self::where(['invoice_subjects_id' => (int) $reportId, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->count();

        $invoiceWaitCounts = self::where(['invoice_subjects_id' => (int) $reportId, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->count();

        $invoiceWaitTotal = self::where(['invoice_subjects_id' => (int) $reportId, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->sum('total_cost');

        $invoiceGrandTotal = self::where(['invoice_subjects_id' => (int) $reportId, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->sum('total_cost');
        
        return [
            'invoice_total' => $invoiceCounts,
            'invoice_wait' => $invoiceWaitCounts,
            'invoice_wait_total' => $invoiceWaitTotal,
            'invoice_grand_total' => $invoiceGrandTotal
        ];
    }

    
    /**
     * getInvoiceSummayOfMonth
     *
     * @param  mixed $strMonthYear
     * @return void
     */
    public static function getInvoiceSummayOfMonth($strMonthYear='2020-10')
    {
        $invoiceCounts = 0;
        $invoiceWaitCounts = 0;
        $invoiceWaitTotal = 0;
        $invoiceGrandTotal = 0;

        $reports = InvoiceSubject::where('create_report_date', 'like', '%'.$strMonthYear.'%')->where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

        if ($reports) {
            foreach ($reports as $report_row) {
                $invoiceCounts += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->count();

                $invoiceWaitCounts += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->count();

                $invoiceWaitTotal += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->sum('total_cost');

                $invoiceGrandTotal += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->sum('total_cost');
            }
        }
        
        return [
            'invoice_total' => $invoiceCounts,
            'invoice_wait' => $invoiceWaitCounts,
            'invoice_wait_total' => $invoiceWaitTotal,
            'invoice_grand_total' => $invoiceGrandTotal
        ];
    }


    public static function getInvoiceSummayLastImport()
    {
        $invoiceCounts = 0;
        $invoiceWaitCounts = 0;
        $invoiceWaitTotal = 0;
        $invoiceGrandTotal = 0;

        $reports = InvoiceSubject::where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->orderBy('updated_at', 'desc')->first();

        if ($reports) {
            foreach ($reports as $report_row) {
                $invoiceCounts += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->count();

                $invoiceWaitCounts += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->count();

                $invoiceWaitTotal += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 1])->sum('total_cost');

                $invoiceGrandTotal += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->sum('total_cost');
            }
        }
        
        return [
            'invoice_total' => $invoiceCounts,
            'invoice_wait' => $invoiceWaitCounts,
            'invoice_wait_total' => $invoiceWaitTotal,
            'invoice_grand_total' => $invoiceGrandTotal
        ];
    }

    
    /**
     * getInvoiceIncomeSummayOfMonth
     *
     * @param  mixed $strMonthYear
     * @return void
     */
    public static function getInvoiceIncomeSummayOfMonth($strMonthYear='2020-10')
    {
        $stateIncomeTotal = 0;
        $fundIncomeTotal = 0;
        $grandIncomeTotal = 0;

        $reports = InvoiceSubject::where('create_report_date', 'like', '%'.$strMonthYear.'%')->where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

        if ($reports) {
            foreach ($reports as $report_row) {

                $invoices = self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

                if (!empty($invoices)) {
                    foreach ($invoices as $item) {

                        $stateIncomeTotal += (float) InvoiceHasReceipt::where(
                            ['invoice_details_id' => (int) $item->id, 
                            'is_deleted' => (int) 0, 
                            'is_active' => (int) 1]
                        )->sum('state_income_cost');

                        $fundIncomeTotal += (float) InvoiceHasReceipt::where(
                            ['invoice_details_id' => (int) $item->id, 
                            'is_deleted' => (int) 0, 
                            'is_active' => (int) 1]
                        )->sum('fund_income_cost');

                        $grandIncomeTotal += (float) InvoiceHasReceipt::where(
                            ['invoice_details_id' => (int) $item->id, 
                            'is_deleted' => (int) 0, 
                            'is_active' => (int) 1]
                        )->sum('net_income_cost');

                    }
                }
            }
        }
        
        return [
            'state_income_total' => $stateIncomeTotal,
            'fund_income_total' => $fundIncomeTotal,
            'net_income_total' => $grandIncomeTotal
        ];
    }

    
    /**
     * getIncomeWithProvince
     *
     * @return void
     */
    public static function getIncomeWithProvince()
    {
        # code...
        $yearInfo = BudgetYear::where('status_approved', (int) 1)->first();

        $reports = InvoiceSubject::where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->whereBetween('create_report_date', [$yearInfo->date_start, $yearInfo->date_end])->get();

        $array = [];

        $provinces = Province::orderBy('PROVINCE_NAME','asc')->get();


        foreach ($provinces as $item) {

            $nPonds = 0;
            $waterQT = 0;
            $waterAllowedQT = 0;
            $incomeTotal = 0;

            if (!empty($reports)) {
                foreach ($reports as $report_row) {
                    $nPonds += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->where('province_name','like','%'.trim($item->PROVINCE_NAME).'%')->sum('pond_amount');

                    $waterAllowedQT += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->where('province_name','like','%'.trim($item->PROVINCE_NAME).'%')->sum('volumn_water_allowed');

                    $waterQT += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->where('province_name','like','%'.trim($item->PROVINCE_NAME).'%')->sum('volumn_water_use');

                    $incomeTotal += self::where(['invoice_subjects_id' => (int) $report_row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->where('province_name','like','%'.trim($item->PROVINCE_NAME).'%')->sum('total_cost');
                }
            }



            $array[] = [
                'province_id' => (int) $item->PROVINCE_ID,
                'province_name' => trim($item->PROVINCE_NAME),
                'column_data' => [
                    'pond_counts' => $nPonds,
                    'water_allowed_qt' => $waterAllowedQT,
                    'water_use_qt' => $waterQT,
                    'net_income_total' => $incomeTotal
                ]
            ];
        }
        return $array;
    }


    
    /**
     * getVolumnOfMonth
     *
     * @return void
     */
    public static function getVolumnOfMonth()
    {
        # code...
    }

    
    /**
     * deleteRow
     *
     * @param  mixed $id
     * @return void
     */
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
     * getInvoiceRateup
     *
     * @param  mixed $subjectId
     * @return void
     */
    public static function getInvoiceRateup($subjectId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $results = self::where($conditions)->where('invoice_subjects_id', (int) $subjectId)->where('rate_up_cost', '>', (float) 0.00);
        return $results->get();
    }
    
    /**
     * getInvoiceRateupWait
     *
     * @param  mixed $subjectId
     * @return void
     */
    public static function getInvoiceRateupWait($subjectId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'is_approved' => (int) 1,
            'invoice_subjects_id' => $subjectId
        ];

        $results = self::where($conditions)->where('rate_up_cost', '>', (float) 0);
        return $results->get();
    }


    public static function getInvoiceWithoutRateUpWait($subjectId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1,
            'is_approved' => (int) 1,
            'invoice_subjects_id' => $subjectId
        ];

        $results = self::where($conditions);
        return $results->get();
    }

    
    /**
     * getInvoiceRateupApproved
     *
     * @param  mixed $subjectId
     * @return void
     */
    public static function getInvoiceRateupApproved($subjectId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $results = self::where($conditions)->where('invoice_subjects_id', (int) $subjectId)->where('is_approved',  (int) 3);
        return $results->get();
    }

    
    /**
     * getInvoiceWithoutCancel
     *
     * @param  mixed $subjectId
     * @return void
     */
    public static function getInvoiceWithoutCancel($subjectId=0)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $results = self::where($conditions)->where('invoice_subjects_id', (int) $subjectId)->where('is_approved', '>' ,(int) 0);
        return $results->get();
    }


    // -- Report -- //    
    /**
     * getCompareIncomeWithVolumnWator
     *
     * @return void
     */
    public static function getCompareIncomeWithVolumnWator()
    {
        $limit = 10;
        $array = [];
        $tmpIncome = [];
        $tmpUseWator = [];
        $labels = [];
        $no = 0;

        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        $reports = InvoiceSubject::where($conditions)->orderBy('start_date', 'desc')->take($limit)->get();
        if (!empty($reports)) {
            foreach ($reports as $row) {
                $labels[] = $row->subject . ' ' .$row->time_no .'/'.$row->budget_year;
                $no++;
                $gReceiveTotal = $gWaterCostTotal = $gConvTotal = 0;

                $invoiceAll = self::getInvoiceWithoutCancel($row->id);
                if (!empty($invoiceAll)) {
                    foreach ($invoiceAll as $subItem) {
                        if ($subItem->rec_water_cost > 0) {
                            $gConvTotal += $subItem->rec_conversion_cost;
                            $gWaterCostTotal += ($subItem->rec_water_cost)/2;
                        } else {
                            $gConvTotal += $subItem->conversation_cost;
                            $gWaterCostTotal += ($subItem->water_cost/2);
                        }
                    }
                    $gReceiveTotal = $gWaterCostTotal + $gConvTotal;
                }
                // use wator
                $conditions = [
                    'is_deleted' => (int) 0,
                    'is_active' => (int) 1,
                    'invoice_subjects_id' => (int) $row->id
                ];
                $totalUseWator = self::where($conditions)->sum('volumn_water_use');

                $tmpIncome[] = (float) getNumberWithoutCurrency($gReceiveTotal/1000000);
                $tmpUseWator[] = (float) getNumberWithoutCurrency($totalUseWator/1000000);
            }

            if ($no < 10) {
                for ($i=$no; $i <=10; $i++) { 
                    $tmpIncome[] = 0.00;
                    $tmpUseWator[] = 0;
                }
            }
        } // end if
        
        $array= [
            'labels' => $labels,
            'income' => [
                'label' => 'รายได้',
                'data_value' => $tmpIncome
            ],
            'wator' => [
                'label' => 'ปริมาณการใช้น้ำ',
                'data_value' => $tmpUseWator
            ]
        ];


        return $array;
    }
}
