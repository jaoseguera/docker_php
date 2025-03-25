<?php
global $rfc, $fce;
$header_note      = strtoupper($_REQUEST['HEADER_NOTE']);	
$pr_type          = strtoupper($_REQUEST['PR_TYPE']);

$IV_PR_NUMBER	= $_REQUEST['IV_PR_NUMBER'];

$item			= $_REQUEST['item'];
// $pur_group		= $_REQUEST['pur_group'];
$material		= $_REQUEST['material'];
$short_key		= $_REQUEST['short_key'];
$plant			= $_REQUEST['plant'];
// $store_loc		= $_REQUEST['store_loc'];
$quantity		= $_REQUEST['quantity'];
// $acctasscat		= $_REQUEST['acctasscat'];
$deliv_date		= $_REQUEST['deliv_date'];
// $gl_account		= $_REQUEST['gl_account'];
$preq_price		= $_REQUEST['preq_price'];
$costcenter		= $_REQUEST['costcenter'];
// $unit			= $_REQUEST['unit'];
$price_unit		= $_REQUEST['price_unit'];
// $currency		= $_REQUEST['currency'];

$flag = explode(',', urldecode($_REQUEST['flag']));

//................................................................................

$options = ['rtrim' => true];
$HEADER = array("PR_TYPE" => $pr_type, "HEADER_NOTE" => $header_note);
$itemsTable = array();

$i = 1;
$j = 0;

foreach ($item as $keys => $vals) {
	if (is_numeric($material[$keys])) {
		$materialLength  = count($material[$keys]);
		if ($materialLength < 18) {
			$material[$keys] = str_pad($material[$keys], 18, 0, STR_PAD_LEFT);
		} else {
			$material[$keys] = substr($material[$keys], -18);
		}
	}

	$fg = explode('G1S', $flag[$j]);

	list($month, $day, $year) = explode('/', str_replace(".", "/", str_replace("-", "/", $deliv_date[$keys])));
	$date = $year . $month . $day;

	// $gl_account_aux = $gl_account[$keys];
	$costcenter_aux = $costcenter[$keys];
	// $pur_group_aux = $pur_group[$keys];

	// if (strlen($gl_account_aux) < 10) {
	// 	$gl_account_aux = str_pad($gl_account_aux, 10, '0', STR_PAD_LEFT);
	// }

	if (strlen($costcenter_aux) < 10) {
		$costcenter_aux = str_pad($costcenter_aux, 10, '0', STR_PAD_LEFT);
	}

	// if (strlen($pur_group_aux) < 3) {
	// 	$pur_group_aux = str_pad($pur_group_aux, 3, '0', STR_PAD_LEFT);
	// }

	$ORDER_ITEMS_IN = array(
		"PREQ_ITEM" 	=> $vals,
		// "PUR_GROUP" 	=> strtoupper($pur_group_aux),
		"MATERIAL" 		=> strtoupper($material[$keys]),
		"SHORT_TEXT" 	=> strtoupper($short_key[$keys]),
		"PLANT" 		=> strtoupper($plant[$keys]),
		// "STORE_LOC" 	=> strtoupper($store_loc[$keys]),
		"QUANTITY" 		=> floatval($quantity[$keys]),
		"ACCTASSCAT" 	=> strtoupper('K'),
		"DELIV_DATE" 	=> strtoupper($date),
		"PREQ_PRICE" 	=> floatval($preq_price[$keys]),
		// "GL_ACCOUNT" 	=> strtoupper($gl_account_aux),
		"COSTCENTER" 	=> strtoupper($costcenter_aux),
		// "UNIT" 			=> strtoupper($unit[$keys]),
		"PRICE_UNIT" 	=> floatval($price_unit[$keys])
		// "CURRENCY" 		=> strtoupper($currency[$keys])
	);

	array_push($itemsTable, $ORDER_ITEMS_IN);
	$j++;
}

// var_dump($IV_PR_NUMBER);
// var_dump($HEADER);
// var_dump($itemsTable);

$res = $fce->invoke([
	"IV_PR_NUMBER" => $IV_PR_NUMBER,
	"IS_PR_HEADER" => $HEADER,
	"IT_PR_ITEM" => $itemsTable
], $options);

// var_dump($res);

$return = $res['ET_MESSAGES'];
$mm = NULL;
$type = array();

foreach ($return as $msg) {
	$type[] = $msg['TYPE'];
	$mm .= $msg['MESSAGE'] . "<br>";
}

if (in_array("E", $type) || in_array("A", $type))
	$msgtype = "E";
else
	$msgtype = "S";

echo $mm . "@" . $msgtype;
