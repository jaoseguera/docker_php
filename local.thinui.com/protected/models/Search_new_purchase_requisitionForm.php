<?php

/**
 * IndexForm class.
 * IndexForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 **/
class Search_new_purchase_requisitionForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;

    public function _actionSubmit($doc, $screen, $fce)
    {
        $IV_PR_NUMBER = strtoupper($_REQUEST['IV_PR_NUMBER']);

        if(strlen($IV_PR_NUMBER) < 10) {
        	$IV_PR_NUMBER = str_pad($IV_PR_NUMBER, 10, '0', STR_PAD_LEFT);
        }

        $options = ['rtrim'=>true];

        $res = $fce->invoke(["IV_PR_NUMBER"=> $IV_PR_NUMBER],$options);

        $ET_PR_ITEM = $res['ET_PR_ITEM'];
        $_SESSION['table_today'] = $ET_PR_ITEM;

        //////////////////////////////////////////////////////////////////////////////////	
        $sd = 0;
        // $table_inf  = "PREQ_ITEM,ACCTASSCAT,MATERIAL,SHORT_TEXT,QUANTITY,UNIT,DELIV_DATE,PLANT,STORE_LOC,PUR_GROUP,PREQ_PRICE,PRICE_UNIT,CURRENCY,COSTCENTER,GL_ACCOUNT";
        $labels_inf = "PREQ_ITEM,ACCTASSCAT,MATERIAL,SHORT_TEXT,QUANTITY,UNIT,DELIV_DATE,PLANT,STORE_LOC,PUR_GROUP,PREQ_PRICE,PRICE_UNIT,CURRENCY,COSTCENTER,GL_ACCOUNT";
        // $labels_inf = "PREQ_ITEM,MATERIAL,SHORT_TEXT,QUANTITY,DELIV_DATE,PLANT,PREQ_PRICE,PRICE_UNIT,CURRENCY,COSTCENTER";

        // $exps1 = explode(',', $table_inf);
        $exp = explode(',', $labels_inf);
        $_SESSION['table_today_count'] = count($exp) - 5;

        // $tableField1 = $screen . '_Search_new_purchase_requisition';

        // if (isset($doc->customize->$tableField1->Table_order)) {
        //     $labels_inf = $doc->customize->$tableField1->Table_order;
        // }
        
        // $exps1 = explode(',', $table_inf);
        // $exp = explode(',', $labels_inf);
        // if (count($exp) > 0)
        //     $_SESSION['table_today_count'] = count($exp) - 1;
        // else
        //     $_SESSION['table_today_count'] = 11;
        
        // if (count($exp) < 11) {
        //     for ($j = count($exp) - 1; $j < count($exps1); $j++) {
        //         $exp[$j] = $exps1[$j];
        //     }
        // }

        foreach ($ET_PR_ITEM as $val_t => $retur) {
            $order_t = array(
                $exp[0] => $retur[$exp[0]], 
                // $exp[1] => $retur[$exp[1]], 
                $exp[2] => $retur[$exp[2]], 
                $exp[3] => $retur[$exp[3]], 
                $exp[4] => $retur[$exp[4]], 
                // $exp[5] => $retur[$exp[5]], 
                $exp[6] => $retur[$exp[6]], 
                $exp[7] => $retur[$exp[7]], 
                // $exp[8] => $retur[$exp[8]], 
                // $exp[9] => $retur[$exp[9]], 
                $exp[10] => $retur[$exp[10]], 
                $exp[11] => $retur[$exp[11]], 
                $exp[12] => $retur[$exp[12]], 
                $exp[13] => $retur[$exp[13]], 
                // $exp[14] => $retur[$exp[14]]
            );
            unset($retur[$exp[0]], 
                // $retur[$exp[1]], 
                $retur[$exp[2]], 
                $retur[$exp[3]], 
                $retur[$exp[4]], 
                // $retur[$exp[5]], 
                $retur[$exp[6]], 
                $retur[$exp[7]], 
                // $retur[$exp[8]], 
                // $retur[$exp[9]], 
                $retur[$exp[10]], 
                $retur[$exp[11]], 
                $retur[$exp[12]], 
                $retur[$exp[13]] 
                // $retur[$exp[14]]
                );
            
            $today = $retur;
            $ET_PR_ITEM[$sd] = array_merge((array) $order_t, (array) $today);
            $sd++;
        }
        $_SESSION['table_today'] = $ET_PR_ITEM;
    }

    public function _actionColumncount($doc, $screen)
    {
        $table_inf  = "PREQ_ITEM,ACCTASSCAT,MATERIAL,SHORT_TEXT,QUANTITY,UNIT,DELIV_DATE,PLANT,STORE_LOC,PUR_GROUP,PREQ_PRICE,PRICE_UNIT,CURRENCY,COSTCENTER,GL_ACCOUNT";
        $labels_inf = "PREQ_ITEM,ACCTASSCAT,MATERIAL,SHORT_TEXT,QUANTITY,UNIT,DELIV_DATE,PLANT,STORE_LOC,PUR_GROUP,PREQ_PRICE,PRICE_UNIT,CURRENCY,COSTCENTER,GL_ACCOUNT";
        $tableField1  = $screen . '_Search_new_purchase_requisition';
        if (isset($doc->customize->$tableField1->Table_order)) {
            $labels_inf = $doc->customize->$tableField1->Table_order;
        }
        $exps1 = explode(',', $table_inf);
        $exp = explode(',', $labels_inf);
        if (count($exp) > 0)
            $c_c = count($exp) - 1;
        else
            $c_c = 10;
        $_SESSION['table_today_count'] = $c_c;
        return $c_c;
    }
}
