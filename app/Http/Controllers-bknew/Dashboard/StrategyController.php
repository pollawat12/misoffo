<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Base;
use Illuminate\Http\Request;
// model
use App\Models\ReserveMeeting;

use App\Models\OilPrice;
use App\Models\OilPriceDetail;
use App\Models\DataSetting;
use App\Models\ExchangeRate;

use DB;

/**
 * StrategyController
 */
class StrategyController extends Base 
{    
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request)
    {
        $auth_status = session('is_logined');
        $auth_info = session('auth_info');
        $meeting_lists = ReserveMeeting::getMeetingLists();

        $t = $request->input('t');
        $pr = $request->input('pr');
        $Day = $request->input('chackdate');
        if($pr == 1){

            $sum = 0.0000;

            $chackDay = isset($Day) ? getInputDateToDB($Day) : date('Y-m-d');


            $chackDayTo = date ("Y-m-d", strtotime("-1 day", strtotime($chackDay)));

            // crude
            $infocrude = OilPrice::where('oil_price_type', '1')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            
            if (count($infocrude) > 0){
                
                foreach ($infocrude as $itemstart);

                $infocrudes = OilPriceDetail::where('oil_price_id', $itemstart['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if (!empty($infocrudes)){
                    foreach ($infocrudes as $infocrude){

                        if($infocrude['oil_type'] == '364'){

                            $Dubai = $infocrude['oil_min'];
                            $DubaiMax = $infocrude['oil_max'];

                        }elseif($infocrude['oil_type'] == '365'){

                            $Brent = $infocrude['oil_min'];
                            $BrentMax = $infocrude['oil_max'];

                        }elseif($infocrude['oil_type'] == '367'){

                            $WTI = $infocrude['oil_min'];
                            $WTIMax = $infocrude['oil_max'];

                        }

                    }
                }else{

                    $Dubai = 0.0000;
                    $Brent = 0.0000;
                    $WTI = 0.0000;

                    
                    $DubaiMax = 0.0000;
                    $BrentMax = 0.0000;
                    $WTIMax = 0.0000;

                }

            }else{

                $Dubai = 0.0000;
                $Brent = 0.000000;
                $WTI = 0.0000;

                $DubaiMax = 0.0000;
                $BrentMax = 0.0000;
                $WTIMax = 0.0000;
            }


            $infocrudeTo = OilPrice::where('oil_price_type', '1')->where('oil_price_date', '=', $chackDayTo)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infocrudeTo) > 0){


                foreach ($infocrudeTo as $itemstartto);

                $infocrudestos = OilPriceDetail::where('oil_price_id', $itemstartto['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if (!empty($infocrudes)){
                    foreach ($infocrudestos as $infocrudesto){

                        if($infocrudesto['oil_type'] == '364'){

                            $DubaiTo = $infocrudesto['oil_min'];
                            $DubaiToMax = $infocrudesto['oil_max'];

                        }elseif($infocrudesto['oil_type'] == '365'){

                            $BrentTo = $infocrudesto['oil_min'];
                            $BrentToMax = $infocrudesto['oil_max'];

                        }elseif($infocrudesto['oil_type'] == '367'){

                            $WTITo = $infocrudesto['oil_min'];
                            $WTIToMax = $infocrudesto['oil_max'];

                        }

                    }
                }else{

                    
                    $DubaiTo = 0.0000;
                    $BrentTo = 0.0000;
                    $WTITo = 0.0000;

                    $DubaiToMax = 0.0000;
                    $BrentToMax = 0.0000;
                    $WTIToMax = 0.0000;

                }


            }else{

                $DubaiTo = 0.0000;
                $BrentTo = 0.0000;
                $WTITo = 0.0000;

                $DubaiToMax = 0.0000;
                $BrentToMax = 0.0000;
                $WTIToMax = 0.0000;
            }

            $CheckDubai = $Dubai - $DubaiTo; 
            $CheckBrent = $Brent - $BrentTo; 
            $CheckWTI = $WTI - $WTITo; 

            if($CheckDubai > 0){ $checktextDubai = 'text-success'; $SumDubai =  '(+'.number_format($CheckDubai, 4, '.', '').')';}else{ $checktextDubai= 'text-danger'; $SumDubai =  '('.number_format($CheckDubai, 4, '.', '').')';  }
            if($CheckBrent > 0){ $checktextBrent = 'text-success'; $SumBrent =  '(+'.number_format($CheckBrent, 4, '.', '').')';}else{ $checktextBrent = 'text-danger'; $SumBrent =  '('.number_format($CheckBrent, 4, '.', '').')';  }
            if($CheckWTI > 0){ $checktextWTI = 'text-success'; $SumWTI =  '(+'.number_format($CheckWTI, 4, '.', '').')';}else{ $checktextWTI = 'text-danger'; $SumWTI =  '('.number_format($CheckWTI, 4, '.', '').')';  }
            

            $CheckDubaiMax = $DubaiMax - $DubaiToMax; 
            $CheckBrentMax = $BrentMax - $BrentToMax; 
            $CheckWTIMax = $WTIMax - $WTIToMax; 

            if($CheckDubaiMax > 0){ $checktextDubaiMax = 'text-success'; $SumDubaiMax =  '(+'.number_format($CheckDubaiMax, 4, '.', '').')';}else{ $checktextDubaiMax = 'text-danger';  $SumDubaiMax =  '('.number_format($CheckDubaiMax, 4, '.', '').')';  }
            if(($CheckBrentMax) > 0){ $checktextBrentMax = 'text-success'; $SumBrentMax =  '(+'.number_format($CheckBrentMax, 4, '.', '').')';}else{ $checktextBrentMax = 'text-danger'; $SumBrentMax =  '('.number_format($CheckBrentMax, 4, '.', '').')';  }
            if(($CheckWTIMax) > 0){ $checktextWTIMax = 'text-success'; $SumWTIMax =  '(+'.number_format($CheckWTIMax, 4, '.', '').')';}else{ $checktextWTIMax = 'text-danger'; $SumWTIMax =  '('.number_format($CheckWTIMax, 4, '.', '').')';  }
            // end crude


            // Inside
            $infoInsides = OilPrice::where('oil_price_type', '2')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoInsides) > 0){
                
                foreach ($infoInsides as $infoInside);

                $infoInsidecrudes = OilPriceDetail::where('oil_price_id', $infoInside['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if (!empty($infoInsidecrudes)){
                    foreach ($infoInsidecrudes as $infoInsidecrude){

                        if($infoInsidecrude['oil_type'] == '348'){

                            $Unl95 = $infoInsidecrude['oil_min'];
                            $Unl95Max = $infoInsidecrude['oil_max'];

                        }elseif($infoInsidecrude['oil_type'] == '349'){

                            $Unl91 = $infoInsidecrude['oil_min'];
                            $Unl91Max = $infoInsidecrude['oil_max'];

                        }elseif($infoInsidecrude['oil_type'] == '355'){

                            $Gasoil005 = $infoInsidecrude['oil_min'];
                            $Gasoil005Max = $infoInsidecrude['oil_max'];

                        }elseif($infoInsidecrude['oil_type'] == '357'){

                            $Gasoil001 = $infoInsidecrude['oil_min'];
                            $Gasoil001Max = $infoInsidecrude['oil_max'];

                        }

                    }
                }else{

                    $Unl95 = 0.0000;
                    $Unl91 = 0.0000;
                    $Gasoil005 = 0.0000;
                    $Gasoil001 = 0.0000;

                    
                    $Unl95Max = 0.0000;
                    $Unl91Max = 0.0000;
                    $Gasoil005Max = 0.0000;
                    $Gasoil001Max = 0.0000;

                }

            }else{

                $Unl95 = 0.0000;
                $Unl91 = 0.0000;
                $Gasoil005 = 0.0000;
                $Gasoil001 = 0.0000;

                
                $Unl95Max = 0.0000;
                $Unl91Max = 0.0000;
                $Gasoil005Max = 0.0000;
                $Gasoil001Max = 0.0000;
            }

            $infoInsideTos = OilPrice::where('oil_price_type', '2')->where('oil_price_date', '=', $chackDayTo)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoInsideTos) > 0){
                
                foreach ($infoInsideTos as $infoInsideTo);

                $infoInsidecrudetos = OilPriceDetail::where('oil_price_id', $infoInsideTo['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if (!empty($infoInsidecrudetos)){
                    foreach ($infoInsidecrudetos as $infoInsidecrudeto){

                        if($infoInsidecrudeto['oil_type'] == '348'){

                            $Unl95To = $infoInsidecrudeto['oil_min'];
                            $Unl95MaxTo = $infoInsidecrudeto['oil_max'];

                        }elseif($infoInsidecrudeto['oil_type'] == '349'){

                            $Unl91To = $infoInsidecrudeto['oil_min'];
                            $Unl91MaxTo = $infoInsidecrudeto['oil_max'];

                        }elseif($infoInsidecrudeto['oil_type'] == '355'){

                            $Gasoil005To = $infoInsidecrudeto['oil_min'];
                            $Gasoil005MaxTo = $infoInsidecrudeto['oil_max'];

                        }elseif($infoInsidecrudeto['oil_type'] == '357'){

                            $Gasoil001To = $infoInsidecrudeto['oil_min'];
                            $Gasoil001MaxTo = $infoInsidecrudeto['oil_max'];

                        }

                    }
                }else{

                    $Unl95To = 0.0000;
                    $Unl91To = 0.0000;
                    $Gasoil005To = 0.0000;
                    $Gasoil001To = 0.0000;

                    
                    $Unl95MaxTo = 0.0000;
                    $Unl91MaxTo = 0.0000;
                    $Gasoil005MaxTo = 0.0000;
                    $Gasoil001MaxTo = 0.0000;

                }

            }else{

                $Unl95To = 0.0000;
                $Unl91To = 0.0000;
                $Gasoil005To = 0.0000;
                $Gasoil001To = 0.0000;

                
                $Unl95MaxTo = 0.0000;
                $Unl91MaxTo = 0.0000;
                $Gasoil005MaxTo = 0.0000;
                $Gasoil001MaxTo = 0.0000;
            }

            $CheckUnl95 = $Unl95 - $Unl95To; 
            $CheckUnl91 = $Unl91 - $Unl91To; 
            $CheckGasoil005 = $Gasoil005 - $Gasoil005To; 
            $CheckGasoil001 = $Gasoil001 - $Gasoil001To; 

            if($CheckUnl95 > 0){ $checktextUnl95 = 'text-success'; $SumUnl95 =  '(+'.number_format($CheckUnl95, 4, '.', '').')';}else{ $checktextUnl95 = 'text-danger'; $SumUnl95 =  '('.number_format($CheckUnl95, 4, '.', '').')';  }
            if($CheckUnl91 > 0){ $checktextUnl91 = 'text-success'; $SumUnl91 =  '(+'.number_format($CheckUnl91, 4, '.', '').')';}else{ $checktextUnl91 = 'text-danger'; $SumUnl91 =  '('.number_format($CheckUnl91, 4, '.', '').')';  }
            if($CheckGasoil005 > 0){ $checktextGasoil005 = 'text-success'; $SumGasoil005 =  '(+'.number_format($CheckGasoil005, 4, '.', '').')';}else{ $checktextGasoil005 = 'text-danger'; $SumGasoil005 =  '('.number_format($CheckGasoil005, 4, '.', '').')';  }
            if($CheckGasoil001 > 0){ $checktextGasoil001 = 'text-success'; $SumGasoil001 =  '(+'.number_format($CheckGasoil001, 4, '.', '').')';}else{ $checktextGasoil001 = 'text-danger'; $SumGasoil001 =  '('.number_format($CheckGasoil001, 4, '.', '').')';  }
            

            $CheckUnl95Max = $Unl95Max - $Unl95MaxTo; 
            $CheckUnl91Max = $Unl91Max - $Unl91MaxTo; 
            $CheckGasoil005Max = $Gasoil005Max - $Gasoil005MaxTo; 
            $CheckGasoil001Max = $Gasoil001Max - $Gasoil001MaxTo; 

            if($CheckUnl95Max > 0){ $checktextUnl95Max = 'text-success'; $SumUnl95Max =  '(+'.number_format($CheckUnl95Max, 4, '.', '').')';}else{ $checktextUnl95Max = 'text-danger'; $SumUnl95Max =  '('.number_format($CheckUnl95Max, 4, '.', '').')';  }
            if($CheckUnl91Max > 0){ $checktextUnl91Max = 'text-success'; $SumUnl91Max =  '(+'.number_format($CheckUnl91Max, 4, '.', '').')';}else{ $checktextUnl91Max = 'text-danger'; $SumUnl91Max =  '('.number_format($CheckUnl91Max, 4, '.', '').')';  }
            if($CheckGasoil005Max > 0){ $checktextGasoil005Max = 'text-success'; $SumGasoil005Max =  '(+'.number_format($CheckGasoil005Max, 4, '.', '').')';}else{ $checktextGasoil005Max = 'text-danger'; $SumGasoil005Max =  '('.number_format($CheckGasoil005Max, 4, '.', '').')';  }
            if($CheckGasoil001Max > 0){ $checktextGasoil001Max = 'text-success'; $SumGasoil001Max =  '(+'.number_format($CheckGasoil001Max, 4, '.', '').')';}else{$checktextGasoil001Max = 'text-danger';  $SumGasoil001Max =  '('.number_format($CheckGasoil001Max, 4, '.', '').')';  }
            // enc Inside  
            
            // LPG
            $infoLPGs = OilPrice::where('oil_price_type', '3')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoLPGs) > 0){
                
                foreach ($infoLPGs as $infoLPG);

                $LGP = $infoLPG['oil_price_lpg_cargo'];

            }else{

                $LGP = 0.0000;

            }

            $infoLPGTos = OilPrice::where('oil_price_type', '3')->where('oil_price_date', '=', $chackDayTo)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoLPGTos) > 0){
                
                foreach ($infoLPGTos as $infoLPGTo);

                $LGPTo = $infoLPGTo['oil_price_lpg_cargo'];

            }else{

                $LGPTo = 0.0000;

            }


            $checkLPG = $LGP - $LGPTo;
            if($checkLPG > 0){ $checktextLPG = 'text-success'; $SumLPG =  '(+'.number_format($checkLPG, 4, '.', '').')';}else{ $checktextLPG = 'text-danger'; $SumLPG =  '('.number_format($checkLPG, 4, '.', '').')';  }

            // enc LPG  

            // Exchange
            $infoExchanges = ExchangeRate::where('period', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if(count($infoExchanges) > 0){

                foreach ($infoExchanges as $infoExchanges);

                $Exchange = $infoExchanges['rate'];
            }else{

                $Exchange = 0.0000;
            }


            $infoExchangeTos = ExchangeRate::where('period', '=', $chackDayTo)->where('is_deleted', '0')->where('is_active','1')->get();
            if(count($infoExchangeTos) > 0){

                foreach ($infoExchangeTos as $infoExchangeTo);

                $ExchangeTo = $infoExchangeTo['rate'];
            }else{

                $ExchangeTo = 0.0000;
            }

            $checlkExchange = $Exchange - $ExchangeTo;

            if($checlkExchange > 0){ $checktextExchange = 'text-success'; $SumExchange =  '(+'.number_format($checlkExchange, 4, '.', '').')';}else{ $checktextExchange = 'text-danger'; $SumExchange =  '('.number_format($checlkExchange, 4, '.', '').')';  }


            // end Exchange
            $price = [
                ['label' => 'Dubai','s_price' => $DubaiTo,'e_price' => $Dubai,'diff_price' => $SumDubai,'checktext' => $checktextDubai],
                ['label' => 'Brent','s_price' => $BrentTo,'e_price' => $Brent,'diff_price' => $SumBrent,'checktext' => $checktextBrent],
                ['label' => 'WTI','s_price' => $WTITo,'e_price' => $WTI,'diff_price' => $SumWTI,'checktext' => $checktextWTI],
                ['label' => 'Unl 95','s_price' => $Unl95To,'e_price' => $Unl95,'diff_price' => $SumUnl95,'checktext' => $checktextUnl95],
                ['label' => 'Unl 91 (Non-Oxy)','s_price' => $Unl91To,'e_price' => $Unl91,'diff_price' => $SumUnl91,'checktext' => $checktextUnl91],
                ['label' => 'Gasoil 0.05','s_price' => $Gasoil005To,'e_price' => $Gasoil005,'diff_price' => $SumGasoil005,'checktext' => $checktextGasoil005],
                ['label' => 'Gasoil 0.00001','s_price' => $Gasoil001To,'e_price' => $Gasoil001,'diff_price' => $SumGasoil001,'checktext' => $checktextGasoil001],
                ['label' => 'LPG','s_price' => $LGPTo,'e_price' => $LGP,'diff_price' => $SumLPG,'checktext' => $checktextLPG],
                ['label' => 'Exchange','s_price' => $ExchangeTo,'e_price' => $Exchange,'diff_price' => $SumExchange ,'checktext' => $checktextExchange]
            ]; 

            $price_end = [
                ['label' => 'Dubai','s_price' => $DubaiToMax,'e_price' => $DubaiMax,'diff_price' => $SumDubaiMax,'checktext' => $checktextDubaiMax],
                ['label' => 'Brent','s_price' => $BrentToMax,'e_price' => '','diff_price' => '','checktext' => ''],
                ['label' => 'WTI','s_price' => $WTIToMax,'e_price' => '','diff_price' => '','checktext' => ''],
                ['label' => 'Unl 95','s_price' => $Unl95MaxTo,'e_price' => $Unl95Max,'diff_price' => $SumUnl95Max,'checktext' => $checktextUnl95Max],
                ['label' => 'Unl 91 (Non-Oxy)','s_price' => $Unl91MaxTo,'e_price' => $Unl91Max,'diff_price' => $SumUnl91Max,'checktext' => $checktextUnl91Max],
                ['label' => 'Gasoil 0.05','s_price' => $Gasoil005MaxTo,'e_price' => $Gasoil005Max,'diff_price' => $SumGasoil005Max,'checktext' => $checktextGasoil005Max],
                ['label' => 'Gasoil 0.00001','s_price' => $Gasoil001MaxTo,'e_price' => $Gasoil001Max,'diff_price' => $SumGasoil001Max,'checktext' => $checktextGasoil001Max],
                ['label' => 'LPG','s_price' => $LGPTo,'e_price' => $LGP,'diff_price' => $SumLPG,'checktext' => $checktextLPG],
                ['label' => 'Exchange','s_price' => $ExchangeTo,'e_price' => $Exchange,'diff_price' => $SumExchange,'checktext' => $checktextExchange]
            ];

            # code...
            $data = ['auth_status', 'auth_info', 'meeting_lists','price','price_end' , 'chackDay' , 't' , 'pr'];

        }elseif($pr == 2){

            $chackDay = isset($Day) ? $Day : date('Y').'-'.date('m').'-01';

            $dayNum = 0;
            $date_end =date("Y-m-d", strtotime("+1 month",strtotime($chackDay)));

            while($chackDay<$date_end)
            {
            $chackDay =date("Y-m-d", strtotime("+1 day",strtotime($chackDay)));
            $dayNum++;
            }
            

            $infos = OilPrice::where('oil_price_type', '5')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infos) > 0){

                foreach ($infos as $info);

                $infoDs = OilPriceDetail::where('oil_price_id', $info['id'])->where('is_deleted', '0')->where('is_active','1')->get();
                if (!empty($infoDs)){
                    foreach ($infoDs as $infoD){

                        if($infoD['oil_type'] == '387'){

                            $info1 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '389'){

                            $info2 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '388'){

                            $info3 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '390'){

                            $info4 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '391'){

                            $info5 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '394'){

                            $info6 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '397'){

                            $info7 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '399'){

                            $info8 = $infoD['oil_min'];
                        }elseif($infoD['oil_type'] == '385'){

                            $info9 = $infoD['oil_min'];
                        }

                    }

                }


            }else{

                $info1 = 0.0000;
                $info2 = 0.0000;
                $info3 = 0.0000;
                $info4 = 0.0000;
                $info5 = 0.0000;
                $info6 = 0.0000;
                $info7 = 0.0000;
                $info8 = 0.0000;
                $info9 = 0.0000;
            }

            $infoOils = OilPrice::where('oil_price_type', '8')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoOils) > 0){

                foreach ($infoOils as $infoOil);
                $infoDs2 = OilPriceDetail::where('oil_price_id', $infoOil['id'])->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();
                if (!empty($infoDs2)){
                    foreach ($infoDs2 as $infoD2){

                        if($infoD2['oil_type'] == '468'){

                            $infoOils1 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '469'){

                            $infoOils2 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '470'){

                            $infoOils3 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '471'){

                            $infoOils4 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '472'){

                            $infoOils5 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '473'){

                            $infoOils6 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '474'){

                            $infoOils7 = $infoD2['oil_min'];
                        }elseif($infoD2['oil_type'] == '475'){

                            $infoOils8 = $infoD2['oil_min'];
                        }

                    }

                }else{

                    $infoOils1 = 0.0000;
                    $infoOils2 = 0.0000;
                    $infoOils3 = 0.0000;
                    $infoOils4 = 0.0000;
                    $infoOils5 = 0.0000;
                    $infoOils6 = 0.0000;
                    $infoOils7 = 0.0000;
                    $infoOils8 = 0.0000;
                    
                }


            }else{


                $infoOils1 = 0.0000;
                $infoOils2 = 0.0000;
                $infoOils3 = 0.0000;
                $infoOils4 = 0.0000;
                $infoOils5 = 0.0000;
                $infoOils6 = 0.0000;
                $infoOils7 = 0.0000;
                $infoOils8 = 0.0000;

            }



            $infoLPGs= OilPrice::where('oil_price_type', '6')->where('oil_price_date', '=', $chackDay)->where('is_deleted', '0')->where('is_active','1')->get();
            if (count($infoLPGs) > 0){

                foreach ($infoLPGs as $infoLPG);
                $infoLPGDs = OilPriceDetail::where('oil_price_id', $infoLPG['id'])->where('is_deleted', '0')->where('is_active','1')->orderBy('oil_type', 'ASC')->get();
                if (!empty($infoLPGDs)){
                    foreach ($infoLPGDs as $infoLPGD){

                        if($infoLPGD['oil_type'] == '468'){

                            $infoLPG1 = ($infoLPGD['oil_min'] / 1000) / $dayNum;
                        }elseif($infoLPGD['oil_type'] == '469'){

                            $infoLPG2 = ($infoLPGD['oil_min'] / 1000) / $dayNum;
                        }elseif($infoLPGD['oil_type'] == '470'){

                            $infoLPG3 = ($infoLPGD['oil_min'] / 1000 ) / $dayNum;
                        }elseif($infoLPGD['oil_type'] == '471'){

                            $infoLPG4 = $infoLPGD['oil_min'] / $dayNum;
                        }

                    }

                }else{

                    $infoLPG1 = 5.8907;
                    $infoLPG2 = 0.0049;
                    $infoLPG3 = 0.1947;
                    $infoLPG4 = 9.0110;
                    
                }


            }else{


                $infoLPG1 = 5.8907;
                $infoLPG2 = 0.0049;
                $infoLPG3 = 0.1947;
                $infoLPG4 = 9.0110;

            }



            $price_oil = [
                ['label' => 'เบนซิน','s_price' => $info1,'e_price' => $infoOils1,'d_price' => '3.72','f_price' => '112'],
                ['label' => 'แก๊สโซฮอล 95 (E10)','s_price' => $info2,'e_price' => $infoOils2,'d_price' => '7.89','f_price' => '237'],
                ['label' => 'แก๊สโซฮอล 91 (E10)','s_price' => $info3,'e_price' => $infoOils3,'d_price' => '3.64','f_price' => '109'],
                ['label' => 'แก๊สโซฮอล 95 (E20)','s_price' => $info4,'e_price' => $infoOils4,'d_price' => '-10.42','f_price' => '-313'],
                ['label' => 'แก๊สโซฮอล 95 (E85)','s_price' => $info5,'e_price' => $infoOils5,'d_price' => '-4.50','f_price' => '-135'],
            ];

            $price_oil2 = [
                ['label' => 'ดีเซลหมุนเร็ว B7','s_price' => $info6,'e_price' => $infoOils6,'d_price' => '28.58','f_price' => '857'],
                ['label' => 'ดีเซลหมุนเร็ว','s_price' => $info7,'e_price' => $infoOils7,'d_price' => '-50.50','f_price' => '-1,515'],
                ['label' => 'ดีเซลหมุนเร็ว B20','s_price' => $info8,'e_price' => $infoOils8,'d_price' => '-4.16','f_price' => '-125'],
            ];

            $price_oil3 = [
                ['label' => 'เตา','s_price' => $info9,'e_price' => $info9,'d_price' => '0.30','f_price' => '9'],
            ];

            $price_oil4 = [
                ['label' => 'LPG โรงแยกก๊าซฯ ขายเชื้อเพลิง','s_price' => $infoLPG1,'e_price' => '71.6900','d_price' => '57.92','f_price' => '1,738'],
                ['label' => 'LPG UAC','s_price' => $infoLPG2,'e_price' => '','d_price' => '0.04','f_price' => '1'],
                ['label' => 'LPG ปตท.สผ. ','s_price' => $infoLPG3,'e_price' => '','d_price' => '-0.02','f_price' => '-1'],
            ];


            $price_oil5 = [
                ['label' => 'LPG ที่ใช้เป็นเชื้อเพลิง','s_price' => $infoLPG4,'e_price' => '71.6900','d_price' => '-103.27','f_price' => '-3,098'],
            ];
            
            # code...
            $data = ['auth_status', 'auth_info', 'meeting_lists','price_oil','price_oil2' , 'price_oil3', 'price_oil4' , 'price_oil5' , 't' , 'pr' , 'chackDay'];


        }elseif($pr == 3){

            $sum = 0.0000;
            $chackDay = isset($Day) ? getInputDateToDB($Day) : date('Y-m-d');
            $chackDayTo = date ("Y-m-d", strtotime("-6 day", strtotime($chackDay)));

            // $startTime = strtotime($chackDayTo);
            // $endTime = strtotime($chackDay);

            // // Loop between timestamps, 24 hours at a time
            // for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
            //  echo $thisDate = date( 'D', $i ); echo '<br>'; // 2010-05-01, 2010-05-02, etc
            // }

            // exit();

            # code...
            $data = ['chackDay' , 'chackDayTo' , 't' , 'pr'];
        }elseif($pr == 4){

            $sum = 0.0000;
            $chackDay = isset($Day) ? getInputDateToDB($Day) : date('Y-m-d');
            $chackDayTo = date ("Y-m-d", strtotime("-1 day", strtotime($chackDay)));

            # code...
            $data = ['chackDay' , 't' , 'pr'];
        }else{

            $sum = 0.0000;
            $chackDay = isset($Day) ? getInputDateToDB($Day) : date('Y-m-d');
            $chackDayTo = date ("Y-m-d", strtotime("-1 day", strtotime($chackDay)));

            # code...
            $data = ['chackDay' , 't' , 'pr'];
        }

        return view('default.dashboard.strategy.index-report'.$pr, compact($data))->render();
    }


    /**
     * index
     *
     * @return void
     */
    public function strategyload(Request $request)
    {
        $pr = $request->input('pr');

        if($pr == 1){

            $chackDay = $request->input('chackDay');

            $resp = ['chackDay' => $chackDay]; 

        }elseif($pr == 2){

            $chackDay = $request->input('chackDay');

            $chackDayNum = $request->input('chackDayNum');

            $day = $chackDayNum.'-'.$chackDay.'-01';

            $resp = ['chackDay' => $day]; 

        }else{
            $chackDay = $request->input('chackDay');

            $resp = ['chackDay' => $chackDay]; 

        }

        return response()->json($resp, 200);
    }
}
