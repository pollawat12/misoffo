<?php

namespace App\Http\Controllers\Office\Budget;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;

use Session;

use App\Models\ReportDashboard;
use App\Models\BudgetYear;
use App\Models\ReportDashboardContent;
use App\Models\InvoiceSubject;
use App\Models\InvoiceDetail;
use App\Models\BudgetImport;
use App\Imports\InvoiceDetailsImport;
use App\Imports\InvoiceDetailUpdateImport;
use App\Imports\BudgetDetailsImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportsController extends Base 
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    
    /**
     * invimport
     *
     * @param  mixed $req
     * @return void
     */
    public function invimport(Request $req)
    {
        set_time_limit(0);

        $response = ['status' => false, 'msg' => 'error!', 'report_id' => 0];

        if ($req->ajax() && $req->isMethod('post')) {
            $subject = $req->input('subject');

            // -- insert invoice_subjects -- //
            $subjectId = InvoiceSubject::insertOne($subject, true);

            // -- upload file --//
            $fileTmp = $req->file('file_upload');

            $importResult = Excel::import(new InvoiceDetailsImport($subjectId), $fileTmp);

            if ($importResult) {
                $response = ['status' => true, 'msg' => 'นำเข้าข้อมูลสำเร็จ', 'report_id' => $subjectId];
            }
        }
        
        return response()->json($response, 200);
    }
    
    /**
     * updateinvimport
     *
     * @param  mixed $req
     * @return void
     */
    public function updateinvimport(Request $req)
    {
        set_time_limit(0);
        
        $response = ['status' => false, 'msg' => 'error!'];

        if ($req->ajax() && $req->isMethod('post')) {
            $subjectId = $req->input('subject_id');

            $subject = $req->input('subject');

            $subjectInfo = InvoiceSubject::find((int) $subjectId);
            $subjectInfo->subject = trim($subject['name']);
            $subjectInfo->note = trim($subject['note']);
            // $subjectInfo->create_report_date = getInputDateToDB(trim($subject['create_report_date']));
            $subjectInfo->start_date = getInputDateToDB(trim($subject['start_date']));
            $subjectInfo->end_date = getInputDateToDB(trim($subject['end_date']));
            $subjectInfo->paid_expire_date = getInputDateToDB(trim($subject['paid_expire_date']));
            $subjectInfo->create_report_date = getInputDateToDB(trim($subject['start_date']));
            $subjectInfo->save();

            // -- upload file --//
            $fileTmp = $req->file('file_upload');   
            // update invoice has receipt
            $importResult = Excel::import(new InvoiceDetailUpdateImport($subjectId), $fileTmp);

            if ($importResult) {
                $response = ['status' => true, 'msg' => 'นำเข้าข้อมูลสำเร็จ'];
            }
        }

        return response()->json($response, 200);
    }


    public function updatedashboard(Request $req)
    {
        set_time_limit(0);

        $reportDate = getDateNow();
        $yearBudgetInfo = \App\Models\YearBudget::where(['is_default' => (int) 1, 'is_deleted' => (int) 0, 'is_active' => (int) 1])->first();

        $reportItems = [
            1 => [
                'item_id' => 1,
                'div_target' => ''
            ],
            2 => [
                'item_id' => 2,
                'div_target' => 'income-group-pie-chart-1'
            ],
            3 => [
                'item_id' => 3,
                'div_target' => 'income-group-pie-chart-2'
            ],
            4 => [
                'item_id' => 4,
                'div_target' => 'income-compare-line-chart-1'
            ],
            5 => [
                'item_id' => 5,
                'div_target' => 'expensive-dgr-1'
            ],
            7 => [
                'item_id' => 7,
                'div_target' => 'expensive-project-dgr-2'
            ],
            6 => [
                'item_id' => 6,
                'div_target' => ''
            ]
        ];

        $waterAllowedTotal = 0;
        $waterUseTotal = 0;
        $waterCostAmount =0;
        $conversationCostAmount =0;
        $grandAmountTotal =0;
        $cateId = 1;

        $categoryTmp = [];
        $valueTmp1 = [];
        $valueTmp2 = [];

        $grandTotal = 0;
        $waterUserTotal = 0;

        $importInvoiceInYears = InvoiceSubject::whereBetween('create_report_date', [$yearBudgetInfo->date_start, $yearBudgetInfo->date_end])
            ->where(['is_deleted' => (int) 0, 'is_active' => (int) 1])->get();

        foreach ($reportItems as $k => $val) {
            $itemId = $val['item_id'];
            $data['title_box'] = [];
            $data['chart_data'] = [];

            if ($k == 1) {
                $summaryInfo = InvoiceDetail::getInvoiceSummayOfMonth();
                //getInvoiceSummay($reportId);
                $data['chart_data'] = [];
                $data['title_box'] = [
                    'invoice_total' => $summaryInfo['invoice_total'],
                    'invoice_wait' => $summaryInfo['invoice_wait'],
                    'invoice_wait_total' => getNumberCurrency($summaryInfo['invoice_wait_total']),
                    'invoice_grand_total' => getNumberCurrency($summaryInfo['invoice_grand_total'])
                ];
            }

            if ($k == 2) {
                if ($importInvoiceInYears) {
                    foreach ($importInvoiceInYears as $row) {
                        $waterCostAmount += InvoiceDetail::where(['invoice_subjects_id' => (int) $row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 3])->sum('water_cost');

                        $conversationCostAmount += InvoiceDetail::where(['invoice_subjects_id' => (int) $row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 3])->sum('conversation_cost');

                        $grandAmountTotal += InvoiceDetail::where(['invoice_subjects_id' => (int) $row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 3])->sum('total_cost');
                    }
                }

                $data['title_box'] = [
                    'water_cost' => $waterCostAmount,
                    'conversation_cost' => $conversationCostAmount,
                    'total_cost' => $grandAmountTotal
                ];

                $data['chart_data'] = [
                    'water_cost' => [
                        'title_name' => 'ค่าใช้น้ำ (ล้านบาท)',
                        'amount' => $waterCostAmount
                    ],
                    'conversation_cost' => [
                        'title_name' => 'ค่าอนุรักษ์ (ล้านบาท)',
                        'amount' => $conversationCostAmount
                    ],
                    'total_cost' => [
                        'title_name' => 'รายได้ทั้งหมด (ล้านบาท)',
                        'amount' => $grandAmountTotal
                    ]
                ];

            }

            if ($k == 3) {
                if ($importInvoiceInYears) {
                    foreach ($importInvoiceInYears as $row) {
                        $waterAllowedTotal += InvoiceDetail::where(['invoice_subjects_id' => (int) $row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 3])->sum('volumn_water_allowed');

                        $waterUseTotal += InvoiceDetail::where(['invoice_subjects_id' => (int) $row->id, 'is_deleted' => (int) 0, 'is_active' => (int) 1, 'is_approved' => (int) 3])->sum('volumn_water_use');
                    }
                }

                $waterAllowedTotal = $waterAllowedTotal;

                $data['title_box'] = [
                    'volumn_water_allowed' => $waterAllowedTotal,
                    'volumn_water_use' => $waterUseTotal
                ];
                
                $data['chart_data'] = [
                    'volumn_water_allowed' => [
                        'title_name' => 'ปริมาณน้ำอนุญาต(ลบ.ม.)',
                        'amount' => $waterAllowedTotal
                    ],
                    'volumn_water_use' => [
                        'title_name' => 'ค่าอนุรักษ์ (ลบ.ม.)',
                        'amount' => $waterUseTotal
                    ]
                ];
            }

            if ($k == 4) {
                $invoiceSubjects = InvoiceSubject::where('is_deleted',(int) 0)
                    ->where('is_active', (int) 1)
                    ->orderBy('id', 'desc')
                    ->take(8)
                    ->get();
                
                if ($invoiceSubjects) {
                    foreach ($invoiceSubjects as $invoiceRows) {
                        $grandTotal = 0;
                        $waterUserTotal = 0;

                        $categoryTmp[] = $invoiceRows->subject . ' ' . $invoiceRows->time_no . '/' . $invoiceRows->budget_year;

                        $cond1 = ['is_deleted' => (int) 0, 'is_active' => (int) 1, 'invoice_subjects_id' => (int) $invoiceRows->id];
                        $grandTotal = InvoiceDetail::where($cond1)->sum('total_cost');

                        $waterUserTotal = InvoiceDetail::where($cond1)->sum('volumn_water_use');

                        $valueTmp1[] = $grandTotal/10000000; $valueTmp2[] = $waterUserTotal/10000000; 
                    }
                }
                // 8 งวดงาน
                $data['title_box'] = [];
                $data['chart_data'] = [
                    'category' => $categoryTmp,
                    'data' => [
                        'value_tmp1' => $valueTmp1,
                        'value_tmp2' => $valueTmp2
                    ]
                ];
            }

            if ($k == 6) {
                $data['title_box'] = [];
                $data['chart_data'] = InvoiceDetail::getIncomeWithProvince();;
                // $data = InvoiceDetail::getIncomeWithProvince();
            }

            $cateInfo = [
                'item_id' => (int) $itemId,
                'cate_id' => (int) $cateId,
                'div_target' => $val['div_target']
            ];

            ReportDashboard::createReportDashboard($cateInfo, $reportDate, $data);
        } // end foreach loop

        
    }

    /**
     * invimport
     *
     * @param  mixed $req
     * @return void
     */
    public function expensesimport(Request $req)
    {
        set_time_limit(0);

        $response = ['status' => false, 'msg' => 'error!', 'report_id' => 0];

        if ($req->ajax() && $req->isMethod('post')) {
            $subject = $req->input('subject');

            // -- insert invoice_subjects -- //
            $subjectId = BudgetImport::insertOne($subject, true);

            // -- upload file --//
            $fileTmp = $req->file('file_upload');

            $importResult = Excel::import(new BudgetDetailsImport($subjectId), $fileTmp);

            if ($importResult) {

                Session::forget('expensesid');

                $response = ['status' => true, 'msg' => 'นำเข้าข้อมูลสำเร็จ', 'report_id' => $subjectId];
            }
        }
        
        return response()->json($response, 200);
    }
}
