<?php
/**
 * IndexForm class.
 * IndexForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 **/
class Create_new_purchase_requisitionForm extends CFormModel
{
    public $username;
    public $password;
    public $rememberMe;

    /**
    * Declares the validation rules.
    * The rules state that username and password are required,
    * and password needs to be authenticated.
    **/
    
    public function rules()
    {
        return array(
        );
    }
    
    public function _actionSubmit($doc, $screen, $fce)
    {
        global $rfc;
        $HEADER_NOTE = $_REQUEST['HEADER_NOTE'];
        $PR_TYPE     = $_REQUEST['PR_TYPE'];
        $PREQ_ITEM   = $_REQUEST['PREQ_ITEM'];
        $PUR_GROUP   = $_REQUEST['PUR_GROUP'];
        $MATERIAL    = $_REQUEST['material'];
        $SHORT_TEXT  = $_REQUEST['SHORT_TEXT'];
        $PLANT       = $_REQUEST['PLANT'];
        $STORE_LOC   = $_REQUEST['STORE_LOC'];
        $QUANTITY    = $_REQUEST['QUANTITY'];
        // $ACCTASSCAT  = $_REQUEST['ACCTASSCAT'];
        $DELIV_DATE  = $_REQUEST['DELIV_DATE'];
        $PREQ_PRICE  = $_REQUEST['PREQ_PRICE'];
        // $GL_ACCOUNT  = $_REQUEST['GL_ACCOUNT'];
        $COSTCENTER  = $_REQUEST['COSTCENTER'];
        $UNIT        = $_REQUEST['UNIT'];
        $PRICE_UNIT  = $_REQUEST['PRICE_UNIT'];
        $CURRENCY    = $_REQUEST['CURRENCY'];

        $HEADER = array("PR_TYPE"=>$PR_TYPE, "HEADER_NOTE"=>$HEADER_NOTE);

		$options = ['rtrim'=>true];                          
        $itemsTable = array();
        
        foreach($PREQ_ITEM as $keys=>$vals){

            if (is_numeric($MATERIAL[$keys])) {
                $materialLenth  = count($MATERIAL[$keys]);
                if ($materialLenth < 18) {
                    $MATERIAL[$keys] = str_pad($MATERIAL[$keys], 18, 0, STR_PAD_LEFT);
                } else {
                    $MATERIAL[$keys] = substr($MATERIAL[$keys], -18);
                }
            }

            list($month, $day, $year) = explode('/', str_replace(".","/",str_replace("-", "/", $DELIV_DATE[$keys])));
    		$date = $year.$month.$day;

            // $gl_account = $GL_ACCOUNT[$keys];
            $costcenter = $COSTCENTER[$keys];
            $pur_group = $PUR_GROUP[$keys];

            // if (strlen($gl_account) < 10) {
            //     $gl_account = str_pad($GL_ACCOUNT[$keys], 10, '0', STR_PAD_LEFT);
            // }

            if (strlen($costcenter) < 10) {
                $costcenter = str_pad($COSTCENTER[$keys], 10, '0', STR_PAD_LEFT);
            }

            if (strlen($pur_group) < 3) {
                $pur_group = str_pad($PUR_GROUP[$keys], 3, '0', STR_PAD_LEFT);
            }
            
            $item  = array("PREQ_ITEM"=>$vals,
                            // "PUR_GROUP"=>strtoupper($pur_group),
                            "MATERIAL"=> strtoupper($MATERIAL[$keys]),
                            "SHORT_TEXT"=>strtoupper($SHORT_TEXT[$keys]),
                            "PLANT"=>strtoupper($PLANT[$keys]),
                            // "STORE_LOC"=>strtoupper($STORE_LOC[$keys]),
                            "QUANTITY"=>floatval($QUANTITY[$keys]),
                            "ACCTASSCAT"=>'K',
                            "DELIV_DATE"=>strtoupper($date),
                            "PREQ_PRICE"=>floatval($PREQ_PRICE[$keys]),
                            // "GL_ACCOUNT"=>strtoupper($GL_ACCOUNT[$keys]),
                            // "GL_ACCOUNT"=>strtoupper('6500000'),
                            "COSTCENTER"=>strtoupper($costcenter),
                            // "UNIT"=>strtoupper($UNIT[$keys]),
                            "PRICE_UNIT"=>floatval($PRICE_UNIT[$keys]),
                            "CURRENCY"=>strtoupper('USD')
                        );
            array_push($itemsTable, $item);
        }

        // var_dump($HEADER);
        // var_dump($itemsTable);

        $res = $fce->invoke(["IS_PR_HEADER"=> $HEADER,
                            "IT_PR_ITEM"=> $itemsTable],
                            $options);
        
        // var_dump($res);

        $EV_PR_NUMBER = $res['EV_PR_NUMBER'];
        if(!empty($EV_PR_NUMBER)) {
            echo Controller::customize_label(_PRNUMBER) . ': ' . $EV_PR_NUMBER . "<br>";
            echo Controller::customize_label(_CREATEDSUCCESS);
            echo "@S@";
        } else {            
            $messages=$res['ET_MESSAGES'];
            foreach($messages as $msg) {
                echo $msg['MESSAGE']."<br>";
                $type=$msg['TYPE'];
            }
            echo "@".$type;
        }
        //GEZG 06/22/2018
        //Changing SAPRFC methods
        $fce = $rfc->getFunction('BAPI_TRANSACTION_COMMIT');
        $fce->invoke();
    }
}