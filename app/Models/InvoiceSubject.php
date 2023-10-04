<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\InvoiceDetail;

/**
 * InvoiceSubject
 */
class InvoiceSubject extends Model
{
    use HasFactory;

    protected $table = 'invoice_subjects';
    
    public $timestamps = false;
    
    /**
     * getItems
     *
     * @param  mixed $returnCount
     * @return void
     */
    public static function getItems($returnCount=false)
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];

        $exeItems = self::where($conditions)->orderBy('created_at', 'desc')->get();

        $array = [];
        if (!empty($exeItems)) {
            foreach ($exeItems as $row) {
                $array[] = [
                    'id' => $row->id,
                    'start_date' => getDateTimeTH($row->start_date, false, true),
                    'end_date' => getDateTimeTH($row->end_date, false, true),
                    'subject' => $row->subject . ' ' . $row->time_no . '/' . $row->budget_year,
                    'invoice_total' => (int) InvoiceDetail::getInvoiceCounts($row->id),
                    'wait_total' => (int) InvoiceDetail::getInvoiceCounts($row->id, 'wait'),
                    'updated_date' => getDateTimeTH($row->updated_at, true, true)
                ];
            }
        }

        return $array;
    }

    
    /**
     * insertOne
     *
     * @param  mixed $array
     * @param  mixed $returnId
     * @return void
     */
    public static function insertOne($array=[], $returnId= false)
    {
        $process = new self();

        $process->subject = trim($array['name']);
        $process->time_no = trim($array['time_no']);
        $process->budget_year = trim($array['budget_year']);
        $process->note = trim($array['note']);
        $process->start_date = getInputDateToDB(trim($array['start_date']));
        $process->end_date = getInputDateToDB(trim($array['end_date']));
        $process->paid_expire_date = getInputDateToDB(trim($array['paid_expire_date']));
        $process->create_report_date = getInputDateToDB(trim($array['start_date']));
        $process->is_approved = (int) 0;
        $process->is_deleted = (int) 0;
        $process->is_active = (int) 1;
        $process->created_at = getDateNow();
        $process->updated_at = getDateNow();
        $process->save();

        if ($returnId) return $process->id;
        
        return true;
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


    public static function getReportIncomeData($array=[])
    {
        $tmpDatas = [];
        if (count($array) > 0) {
            # code...
        } else {
            $conditions = [
                'is_deleted' => (int) 0,
                'is_active' => (int) 1
            ];
            $reports = self::where($conditions)->orderBy('budget_year','desc')->orderBy('time_no', 'desc')->get();

            if (!empty($reports)) {
                foreach ($reports as $item) {
                    $invoices = InvoiceDetail::where('invoice_subjects_id', (int) $item->id)->where('is_approved', '!=' ,(int) 0)->where($conditions)->get();

                    

                    $tmpDatas[] = [
                        'subject' => $reportRow->subject . ' ' . $reportRow->time_no . '/' . $reportRow->budget_year,
    
                        'g_conv_total' => getNumberCurrency($gConvTotal),
                        'g_water_cost_total' => getNumberCurrency($gWaterCostTotal),
                        'g_receive_total' => getNumberCurrency($gReceiveTotal),
    
                        'receive_conv_total' => getNumberCurrency($paidConvTotal),
                        'receive_water_cost_total' => getNumberCurrency($paidWaterCostTotal),
                        'receive_receive_total' => getNumberCurrency($paidReceiveTotal),
    
                        'wait_conv_total' => getNumberCurrency($waitConvTotal),
                        'wait_water_cost_total' => getNumberCurrency($waitWaterCostTotal),
                        'wait_receive_total' => getNumberCurrency($waitReceiveTotal),
    
                        'g_rateup_conv_total' => getNumberCurrency($gRateUpConvTotal),
                        'g_rateup_water_cost_total' => getNumberCurrency($gRateUpWaterCostTotal),
                        'g_rateup_receive_total' => getNumberCurrency($gRateUpReceiveTotal),
    
                        'wait_rateup_conv_total' => getNumberCurrency($waitRateUpConvTotal),
                        'wait_rateup_water_cost_total' => getNumberCurrency($waitRateUpWaterCostTotal),
                        'wait_rateup_receive_total' => getNumberCurrency($waitRateUpReceiveTotal),
                        'wait_payment_total' => getNumberCurrency($waitPaymentTotal)
                    ];
                }   
            }
        }
    }


    
    /**
     * getReportImcome
     *
     * @return void
     */
    public static function getReportImcome()
    {
        $conditions = [
            'is_deleted' => (int) 0,
            'is_active' => (int) 1
        ];
        // $reports = self::where($conditions)->orderBy('budget_year','desc')->orderBy('time_no', 'desc')->get();
        $reports = self::where($conditions)->orderBy('id','desc')->get();

        $array = [];

        if (!empty($reports)) {
            foreach ($reports as $reportRow) {
                // -- grand total -- // 
                $gReceiveTotal = $gWaterCostTotal = $gConvTotal = 0;
                $gRateUpReceiveTotal = $gRateUpWaterCostTotal = $gRateUpConvTotal = 0;

                $invoiceAll = InvoiceDetail::getInvoiceWithoutCancel($reportRow->id);
                if (!empty($invoiceAll)) {
                    foreach ($invoiceAll as $subItem) {
                        if ($subItem->rec_water_cost > 0) {
                            // $gConvTotal += $subItem->rec_conversion_cost + $subItem->rec_addon_conv_cost;
                            // $gWaterCostTotal += ($subItem->rec_water_cost + $subItem->rec_addon_water_cost)/2;
                            $gConvTotal += $subItem->rec_conversion_cost;
                            $gWaterCostTotal += ($subItem->rec_water_cost)/2;

                            $gRateUpConvTotal += $subItem->rec_addon_conv_cost;
                            $gRateUpWaterCostTotal += $subItem->rec_addon_water_cost/2;
                        } else {
                            // $rateUp = (float) $subItem->rate_up_cost;
                            // if ($rateUp > 0) {
                            //     $gConvTotal += getSumIncomeAndRateUp($subItem->conversation_cost, $rateUp);
                            //     $gWaterCostTotal += getSumIncomeAndRateUp($subItem->water_cost, $rateUp, true);
                            // } else {
                                
                            //     $gConvTotal += $subItem->conversation_cost;
                            //     $gWaterCostTotal += ($subItem->water_cost/2);
                            // }
                            $gConvTotal += $subItem->conversation_cost;
                            $gWaterCostTotal += ($subItem->water_cost/2);
                        }
                        // $rateUp = (float) $subItem->rate_up_cost;
                        // if ($rateUp > 0) {
                        //     $gConvTotal += getSumIncomeAndRateUp($subItem->conversation_cost, $rateUp);
                        //     $gWaterCostTotal += getSumIncomeAndRateUp($subItem->water_cost, $rateUp, true);
                        // } else {
                            
                        //     $gConvTotal += $subItem->conversation_cost;
                        //     $gWaterCostTotal += ($subItem->water_cost/2);
                        // }
                    }
                    $gReceiveTotal = $gWaterCostTotal + $gConvTotal;

                    $gRateUpReceiveTotal = $gRateUpWaterCostTotal + $gRateUpConvTotal;
                }

                // -- paid total -- //
                $paidReceiveTotal = $paidWaterCostTotal = $paidConvTotal = 0;
                $invoiceRateupApproveds = InvoiceDetail::getInvoiceRateupApproved($reportRow->id);

                    
                if (!empty($invoiceRateupApproveds)) {
                    foreach ($invoiceRateupApproveds as $subItem) {
                        if ($subItem->rec_water_cost > 0) {
                            // var_dump($subItem->rec_water_cost);
                            $paidConvTotal += $subItem->rec_conversion_cost + $subItem->rec_addon_conv_cost;
                            $paidWaterCostTotal += ($subItem->rec_water_cost + $subItem->rec_addon_water_cost)/2;
                        } else {
                            $rateUp = (float) $subItem->rate_up_cost;
                            if ($rateUp > 0) {
                                $paidConvTotal += getSumIncomeAndRateUp($subItem->conversation_cost, $rateUp);
                                $paidWaterCostTotal += getSumIncomeAndRateUp($subItem->water_cost, $rateUp, true);
                            } else {
                                $paidConvTotal += $subItem->conversation_cost;
                                $paidWaterCostTotal += ($subItem->water_cost/2);
                            }
                        }
                    }
                    $paidReceiveTotal = $paidConvTotal + $paidWaterCostTotal;
                }
                

                // -- wait first -- //
                $waitReceiveTotal = $waitWaterCostTotal = $waitConvTotal = 0;
                $waitRateUpReceiveTotal = $waitRateUpWaterCostTotal = $waitRateUpConvTotal = 0;

                $invoiceWithoutRateupWaits = InvoiceDetail::getInvoiceWithoutRateUpWait($reportRow->id);
                if (!empty($invoiceWithoutRateupWaits)) {
                    foreach ($invoiceWithoutRateupWaits as $subItem) {
                        $waitConvTotal += $subItem->conversation_cost;
                        $waitWaterCostTotal += ($subItem->water_cost/2);
                    }

                    $waitReceiveTotal = $waitConvTotal + $waitWaterCostTotal;
                }


                $invoiceRateupWaits = InvoiceDetail::getInvoiceRateupWait($reportRow->id);
                if (!empty($invoiceRateupWaits)) {
                    foreach ($invoiceRateupWaits as $subItem) {
                        $rateUp = (float) $subItem->rate_up_cost;

                        if ($rateUp > 0) {
                            $waitRateUpConvTotal += getSumIncomeAndRateUpOnly($subItem->conversation_cost, $rateUp);
                            $waitRateUpWaterCostTotal += getSumIncomeAndRateUpOnly($subItem->water_cost, $rateUp, true);
                        } 
                    }
                    
                    $waitRateUpReceiveTotal = $waitRateUpConvTotal + $waitRateUpWaterCostTotal;
                }


                $waitPaymentTotal = $waitRateUpReceiveTotal + $waitReceiveTotal;

                $array[] = [
                    'subject' => $reportRow->subject . ' ' . $reportRow->time_no . '/' . $reportRow->budget_year,

                    'g_conv_total' => getNumberCurrency($gConvTotal),
                    'g_water_cost_total' => getNumberCurrency($gWaterCostTotal),
                    'g_receive_total' => getNumberCurrency($gReceiveTotal),

                    'receive_conv_total' => getNumberCurrency($paidConvTotal),
                    'receive_water_cost_total' => getNumberCurrency($paidWaterCostTotal),
                    'receive_receive_total' => getNumberCurrency($paidReceiveTotal),

                    'wait_conv_total' => getNumberCurrency($waitConvTotal),
                    'wait_water_cost_total' => getNumberCurrency($waitWaterCostTotal),
                    'wait_receive_total' => getNumberCurrency($waitReceiveTotal),

                    'g_rateup_conv_total' => getNumberCurrency($gRateUpConvTotal),
                    'g_rateup_water_cost_total' => getNumberCurrency($gRateUpWaterCostTotal),
                    'g_rateup_receive_total' => getNumberCurrency($gRateUpReceiveTotal),

                    'wait_rateup_conv_total' => getNumberCurrency($waitRateUpConvTotal),
                    'wait_rateup_water_cost_total' => getNumberCurrency($waitRateUpWaterCostTotal),
                    'wait_rateup_receive_total' => getNumberCurrency($waitRateUpReceiveTotal),
                    'wait_payment_total' => getNumberCurrency($waitPaymentTotal)
                ];
            }
        }

        // var_dump($array); exit;

        return $array;
    }


    /*
     $gRateUpConvTotal = InvoiceDetail::where($conditions)->where('invoice_subjects_id', $reportRow->id)->where('rate_up_cost', '>', (float) 0.00)->sum('conversation_cost');
    $gRateUpConvTotal = $gRateUpConvTotal * 1.1;

    $gRateUpWaterCostTotal = InvoiceDetail::where($conditions)->where('invoice_subjects_id', $reportRow->id)->where('rate_up_cost', '>', (float) 0.00)->sum('water_cost');
    $gRateUpWaterCostTotal = ($gRateUpWaterCostTotal * 1.1);
    $gRateUpWaterCostTotal = $gRateUpWaterCostTotal/2;
    $gRateUpReceiveTotal = $gRateUpWaterCostTotal + $gRateUpConvTotal;
     */
}
