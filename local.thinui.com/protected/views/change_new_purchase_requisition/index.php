<style>
	.table th:nth-child(-n+10),
	.table td:nth-child(-n+10) {

		display: table-cell;
	}
</style>

<?php
global $rfc, $fce;
$sales_org = "";
$sold_to = "";
$sel = "";
$distr_chan = "";
$doc_type = "";
$division = "";
$btn = "";

if (isset($_REQUEST['IV_PR_NUMBER'])) {
	$IV_PR_NUMBER = $_REQUEST['IV_PR_NUMBER'];

	$IV_PR_NUMBER_length = count($IV_PR_NUMBER);
	if ($IV_PR_NUMBER_length < 10 && $IV_PR_NUMBER != "") {
		$IV_PR_NUMBER = str_pad($IV_PR_NUMBER, 10, 0, STR_PAD_LEFT);
	} else {
		$IV_PR_NUMBER = substr($IV_PR_NUMBER, -10);
	}

	$options = ['rtrim' => true];

	$res = $fce->invoke(["IV_PR_NUMBER" => $IV_PR_NUMBER], $options);

	$ES_PR_HEADER = $res['ES_PR_HEADER'];
	$PR_TYPE = $ES_PR_HEADER['PR_TYPE'];
	$HEADER_NOTE = $ES_PR_HEADER['HEADER_NOTE'];

	$ET_PR_ITEM = $res['ET_PR_ITEM'];

	foreach ($ET_PR_ITEM as $keys) {
		$vas[] = array(
			'PREQ_ITEM' => $keys['PREQ_ITEM'],
			// 'ACCTASSCAT' => $keys['ACCTASSCAT'],
			'MATERIAL' => $keys['MATERIAL'],
			'SHORT_TEXT' => $keys['SHORT_TEXT'],
			'QUANTITY' => $keys['QUANTITY'],
			// 'UNIT' => $keys['UNIT'],
			'DELIV_DATE' => $keys['DELIV_DATE'],
			'PLANT' => $keys['PLANT'],
			// 'STORE_LOC' => $keys['STORE_LOC'],
			// 'PUR_GROUP' => $keys['PUR_GROUP'],
			'PREQ_PRICE' => $keys['PREQ_PRICE'],
			'PRICE_UNIT' => $keys['PRICE_UNIT'],
			// 'CURRENCY' => $keys['CURRENCY'],
			'COSTCENTER' => $keys['COSTCENTER'],
			// 'GL_ACCOUNT' => $keys['GL_ACCOUNT']
		);

		$dd = substr($sel, -2);
		$mm = substr($sel, -4, 2);
		$year = substr($sel, -8, 4);
		$date_formate = $mm . "/" . $dd . "/" . $year;
	}
	$btn = "btn-primary";
}

$this->renderPartial('smarttable');
$customize = $model;
?>
<style>
	.bb {
		background: #cecece !important;
	}

	.bb:hover {
		background: #cecece !important;
	}

	.check {
		display: none !important;
	}

	@media all and (min-width: 751px) {

		#add_row_table .table th:nth-child(-n+15),
		#add_row_table .table td:nth-child(-n+15) {
			display: table-cell;

			.check {
				display: none !important;
			}
		}
	}
</style>
<section id='utopia-wizard-form' class="utopia-widget utopia-form-box">
	<div class="row-fluid">
		<div class="utopia-widget-content">

			<form id="validation3" action="javascript:submit_form('validation3')" class="form-horizontal">

				<div class="form-horizontal">

					<div class="span5 utopia-form-freeSpace">

						<fieldset>
							<div class="control-group">

								<label class="control-label cutz" for="input01" alt='Purchase Requisition Number'><?php Controller::customize_label(_PURCHASEREQUISITIONNUMBER); ?><span> *</span>:&nbsp;</label>
								<input type="hidden" name='page' value="bapi">
								<input type="hidden" name="url" value="change_new_purchase_requisition" />
								<input type="hidden" name="key" value="search_new_purchase_requisition" />
								<input type="hidden" name="jum" value="/KYK/SERPSLS_GENDOC_FLAGS_STS" />
								<input type="hidden" name="values" value="/KYK/SERPSLS_GENDOC_FLAGS_STS" />

								<div class="controls">
									<input style='min-width:170px;' id='IV_PR_NUMBER' class="input-fluid validate[required,custom[integer]]" type="text" name='IV_PR_NUMBER' value="<?php echo $IV_PR_NUMBER; ?>">
								</div>

							</div>
						</fieldset>
					</div>
					<?php
					if (!isset($_REQUEST['titl'])) {
					?>
						<div>
							<button class="span2 btn btn-primary back_b iphone_sales_disp <?php echo $btn; ?>" type="submit" id='submit' style='margin-left:100px;margin-top:20px'><?php Controller::customize_label(_SUBMIT); ?></button>
						</div>
					<?php
					}
					?>
				</div>
			</form>
		</div>
	</div>
</section>

<?php if (isset($_REQUEST['IV_PR_NUMBER']) && $ET_PR_ITEM != NULL) {
?>
	<form action="javascript:orders();" method="post" id='validation7' class="form-horizontal" enctype="multipart/form-data" autocomplete="on">
		<input type="hidden" name="bapiName" id="bapiName" value="ZEMG_MM_THIN_UI_PR_CHANGE" />
		<input type="hidden" name="IV_PR_NUMBER" id="IV_PR_NUMBER" value="<?php echo $IV_PR_NUMBER; ?>" />

		<div id="form_edit_values" class="utopia-widget-content myspace inval35 spaceing row-fluid" style="margin-top:11px;">
			<div class="span5 utopia-form-freeSpace myspace">
				<fieldset>
					<div class="control-group">
						<label class="control-label cutz in_custz" alt="PR Type" for="input01"><?php Controller::customize_label(_PRTYPE); ?><span>*</span>:</label>
						<div class="controls">
							<input alt="PR Type" type="text" name='PR_TYPE' id='PR_TYPE' class="validate[required,maxSize[3],minSize[3]] getval radius" value='<?php echo $PR_TYPE; ?>' onKeyUp="jspt('PR_TYPE',this.value,event)" autocomplete="off" />
						</div>
					</div>
				</fieldset>
			</div>
			<div class="span5 utopia-form-freeSpace">
				<fieldset>
					<div class="control-group">
						<label class="control-label cutz" for="input01" style='width:150px;' alt='Header Note'><?php Controller::customize_label(_HEADERNOTE); ?>:</label>
						<div class="controls">
							<textarea alt="Header Note" type="text" name='HEADER_NOTE' id='HEADER_NOTE' class="getval radius" value='<?php echo $HEADER_NOTE; ?>' onKeyUp="jspt('HEADER_NOTE',this.value,event)" autocomplete="off" style='height: 90px;'><?php echo $HEADER_NOTE; ?></textarea>
						</div>
					</div>
				</fieldset>
			</div>
		</div>

		<span id="add_row_table" style="display:block;">
			<div class="row-fluid">
				<div class="span12">
					<section class="utopia-widget spaceing max_width" style="margin-bottom:0px;">
						<div class="utopia-widget-title">
							<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icons/paragraph_justify.png" class="utopia-widget-icon">
							<span class='cutz sub_titles' alt='Items'><?php Controller::customize_label(_ITEMS); ?></span>
						</div>
						<div class="utopia-widget-content items">
							<div style='display:none'>
								<span class="btn" id="addRow" onclick="addRow('dataTable','A')"><?php Controller::customize_label(_ADDITEM); ?></span>
								<span class="btn" id="deleteRow" onclick="deleteRow('dataTable')">
									<i class="icon-trash icon-white"></i><?php Controller::customize_label(_DELETEITEM); ?>
								</span>
							</div>
							<br>
							<!--<table class="table  table-bordered iph" id="dataTable" >-->
							<div style="border:1px solid #FAFAFA;overflow-y:scroll;overflow-x:scroll;">
								<table class="table table-bordered" id="dataTable">
									<thead>
										<tr>
											<th class='cutz' style='min-width: 100px;' alt='Requisn Item'><?php Controller::customize_label(_REQITEM); ?></th>
											<!-- <th class='cutz' style='min-width: 100px;' alt='Acct Assgt Cat.'><?php //Controller::customize_label(_ACCASSCAT); 
																													?></th> -->
											<th class='cutz' style='min-width: 150px;' alt='Material'><?php Controller::customize_label(_MATERIAL); ?></th>
											<th class='cutz' style='min-width: 150px;' alt='Short Text'><?php Controller::customize_label(_DESCRIPTION); ?></th>
											<th class='cutz' style='min-width: 100px;' alt='Quantity'><?php Controller::customize_label(_QUANTITY); ?></th>
											<!-- <th class='cutz' style='min-width: 100px;' alt='Unit'><?php //Controller::customize_label(_UOM); 
																										?></th> -->
											<th class='cutz' style='min-width: 100px;' alt='Delivery Date'><?php Controller::customize_label(_DELIVDATE); ?></th>
											<th class='cutz' style='min-width: 100px;' alt='Plant'><?php Controller::customize_label(_PLANT); ?></th>
											<!-- <th class='cutz' style='min-width: 100px;' alt='Stor. Location'><?php //Controller::customize_label(_STORELOC); 
																													?></th>
											<th class='cutz' style='min-width: 100px;' alt='Purch. Group'><?php //Controller::customize_label(_PURGROUP); 
																											?></th> -->
											<th class='cutz' style='min-width: 100px;' alt='Requisn Price'><?php Controller::customize_label(_REQPRICE); ?></th>
											<th class='cutz' style='min-width: 100px;' alt='Price Unit'><?php Controller::customize_label(_PRICEUNIT); ?></th>
											<!-- <th class='cutz' style='min-width: 100px;' alt='Currency'><?php //Controller::customize_label(_CURRENCY); 
																											?></th> -->
											<th class='cutz' style='min-width: 100px;' alt='Cost Center'><?php Controller::customize_label(_COSTCENTER); ?></th>
											<!-- <th class='cutz' style='min-width: 100px;' alt='GL Account'><?php //Controller::customize_label(_GLACCOUNT); 
																												?></th> -->
										</tr>
									</thead>
									<tbody>
										<tr onClick="select_row('ids_0')" class="ids_0 nudf">
											<td>
												<input class="chkbox check" type="checkbox" name="checkbox[]" title="che" id="chedk" value="U">
												<input type="text" name='item[]' <?php if (!isset($IV_PR_NUMBERNo)) { ?>value="10" <?php } else { ?>value="" <?php } ?> title="item" class='input-fluid validate[required,custom[number]] flgs' style="width:90%;" alt="Items" id="PREQ_ITEM" readonly="readonly" />
											</td>
											<!-- <td>
												<input type="text" id='ACCTASSCAT' style="width:90%;" class="input-fluid getval" name='acctasscat[]' alt="ACCTASSCAT" onKeyUp="jspt('ACCTASSCAT',this.value,event)" autocomplete="off" value='<?php //echo $acctasscat; 
																																																												?>' />
											</td> -->
											<td>
												<input type="text" id='MATERIAL' name='material[]' class="input-fluid validate[required] getval radiu" title="MATERIAL" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('MATERIAL',this.value,event)" autocomplete="off" value='<?php echo $material; ?>' onchange="getMatDescBOM('MATERIAL',this, this.event,'dataTable')" />
												<div class='minws1' id="table_lookup" onclick="lookup('Material', 'MATERIAL', 'material_purch_req')">&nbsp;</div>
											</td>
											<td>
												<input type="text" id='SHORT_TEXT' style="width:90%;" class="input-fluid validate[required] getval" name='short_key[]' alt="SHORT_TEXT" onKeyUp="jspt('SHORT_TEXT',this.value,event)" autocomplete="off" value='<?php echo $short_key; ?>' />
											</td>
											<td>
												<input type="text" id='QUANTITY' style="width:90%;" class="input-fluid validate[required,custom[number]] getval" name='quantity[]' alt="QUANTITY" onKeyUp="jspt('QUANTITY',this.value,event)" autocomplete="off" value='<?php echo $quantity; ?>' />
											</td>
											<!-- <td>
												<input type="text" id='UNIT' name='unit[]' class="input-fluid validate[required] getval radiu" title="UNIT" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('UNIT',this.value,event)" autocomplete="off" value='<?php //echo $unit; 
																																																																		?>' onchange="jspt_new('UNIT',this.value,event)" />
												<div class='minws1' id="table_lookup" onclick="lookup('Unit', 'UNIT', 'uom')">&nbsp;</div>
											</td> -->
											<td>
												<input type="text" id='DELIV_DATE' class="input-fluid validate[required] getval" name='deliv_date[]' title="DELIV_DATE" onKeyUp="jspt('DELIV_DATE',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $deliv_date; ?>" />
											</td>
											<td>
												<input type="text" id='PLANT' name='plant[]' class="input-fluid validate[required,custom[integer],minSize[4],maxSize[4]] getval radiu" title="PLANT" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('PLANT',this.value,event)" autocomplete="off" value='<?php echo $plant; ?>' onchange="jspt_new('PLANT',this.value,event)" />
												<div class='minws1' id="table_lookup" onclick="lookup('Plant', 'PLANT', 'plant')">&nbsp;</div>
											</td>
											<!-- <td>
												<input type="text" id='STORE_LOC' name='store_loc[]' class="input-fluid validate[required] getval radiu" title="STORE_LOC" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('STORE_LOC',this.value,event)" autocomplete="off" value='<?php //echo $store_loc; 
																																																																							?>' onchange="jspt_new('STORE_LOC',this.value,event)" />
												<div class='minws1' id="table_lookup" onclick="lookup('Storage Location', 'STORE_LOC', 'storage_loc')">&nbsp;</div>
											</td>
											<td>
												<input type="text" id='PUR_GROUP' name='pur_group[]' class="input-fluid validate[required] getval radiu" title="PUR_GROUP" alt="MULTI" style="width:55% !important;" onKeyUp="jspt_new('PUR_GROUP',this.value,event)" autocomplete="off" value="<?php //echo $purch_group; 
																																																																								?>" onchange="jspt('PUR_GROUP',this.value,event)" />
												<div class='minws1' id="table_lookup" onclick="lookup('Purchasing Group', 'PUR_GROUP', 'purch_group')">&nbsp;</div>
											</td> -->
											<td>
												<input type="text" id='PREQ_PRICE' style="width:90%;" title="PREQ_PRICE" class="input-fluid validate[required,custom[number]] getval" name='preq_price[]' alt="PREQ_PRICE" onKeyUp="jspt('PREQ_PRICE',this.value,event)" autocomplete="off" value='<?php echo $preq_price; ?>' />
											</td>
											<td>
												<input type="text" id='PRICE_UNIT' title="PRICE_UNIT" style="width:90%;" class="input-fluid validate[required,custom[number]] getval" name='price_unit[]' alt="PRICE_UNIT" onKeyUp="jspt('PRICE_UNIT',this.value,event)" autocomplete="off" value='<?php echo $price_unit; ?>' readonly />
											</td>
											<!-- <td>
												<input type="text" id='CURRENCY' name='currency[]' class="input-fluid validate[required] getval radiu" title="CURRENCY" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('CURRENCY',this.value,event)" autocomplete="off" value='<?php //echo $currency; 
																																																																						?>' onchange="jspt_new('CURRENCY',this.value,event)" readonly />
												<div class='minws1' id="table_lookup" onclick="lookup('Currency', 'CURRENCY', 'currency')">&nbsp;</div>
											</td> -->
											<td>
												<input type="text" id='COSTCENTER' name='costcenter[]' class="input-fluid validate[required] getval radiu" title="COSTCENTER" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('COSTCENTER',this.value,event)" autocomplete="off" value='<?php echo $costcenter; ?>' onchange="jspt_new('COSTCENTER',this.value,event)" />
												<div class='minws1' id="table_lookup" onclick="lookup('Cost Center', 'COSTCENTER', 'cost_center')">&nbsp;</div>
											</td>
											<!-- <td>
												<input type="text" id='gl_account' class="input-fluid validate[required] getval" name='gl_account[]' title="gl_account" onKeyUp="jspt('gl_account',this.value,event)" autocomplete="off" alt="MULTI" value="<?php //echo $gl_account; 
																																																															?>" />
												<div class='minws' onclick="lookup('GL Accounts', 'gl_account', 'gl_accounts')">&nbsp;</div>
											</td> -->
										</tr>
									</tbody>
								</table>
							</div>
							<input type="hidden" name="flag" id="flag" />
							<input type="hidden" name="flag_d" id="flag_d" />
							<table width="100%">
								<tr>
									<td>
										<span onclick="pre()" id="pre" class="btn" style="display:none"><?php Controller::customize_label(_PREVIOUS); ?></span>
										<span id="pre1" class="btn" style="display:none"><?php Controller::customize_label(_PREVIOUS); ?></span>
									</td>
									<td>
										<span onclick="nxt()" id="nxt" class="btn" style="float:right;display:none"><?php Controller::customize_label(_NEXT); ?></span>
										<span id="nxt1" class="btn" style="float:right;display:none"><?php Controller::customize_label(_NEXT); ?></span>
									</td>
								</tr>
							</table>
						</div>
					</section>
				</div>
			</div>
		</span>
		<div class="tab-content tab-con">
			<h3><?php Controller::customize_label(_ITEMS); ?></h3>
			<?php
			if ($ET_PR_ITEM != NULL) {
			?>
				<div class="labl pos_pop">
					<div class='pos_center'></div>
					<button class="cancel btn" style="width:60px;float:right;margin-right:10px; margin-top:5px;" onClick='cancel_pop()'><?php Controller::customize_label(_CANCEL); ?></button>
					<button class="btn" id="p_ch" onclick="p_ch()" style="width:60px; float:right; margin-top:5px;margin-right:15px;"><?php Controller::customize_label(_SUBMIT); ?></button>
				</div>
				<div class="head_icons">
					<span id='post' tip="Table columns" class="yellow post_col" onClick="table_cells('example7')"></span>
				</div>
			<?php
			}
			?>
			<div id='example7_today'>
				<?php
				if ($ET_PR_ITEM != NULL) {
				?>
					<div class="display_sales_header"></div>
					<input type="hidden" id="tableordersaveUrl" value="<?php echo Yii::app()->createAbsoluteUrl("common/tableorder") ?>" />
					<div style="border:1px solid #FAFAFA;overflow-y:scroll;overflow-x:scroll;">
						<table class="table table-striped table-bordered" id="example7" alt="change_new_purchase_requisition">
							<?php
							$technical = $model;
							$tec_name = 'BAPINEWPURCHASEREQ';
							$t_headers = Controller::technical_names($tec_name);
							$r = "";

							for ($i = 0; $i < count($vas); $i++) {
								$SalesOrders = $vas[$i];
								if ($i == 0) {
							?>
									<thead>
										<tr>
											<?php
											foreach ($SalesOrders as $keys => $vales) {
											?>
												<th>
													<div class="truncated example7_<?php echo $keys; ?> cutz" title="<?php echo $t_headers[$keys]; ?>" alt='<?php echo $t_headers[$keys]; ?>'><?php Controller::customize_label($t_headers[$keys]); ?></div>
													<div class="example7_th example7_<?php echo $keys; ?>_hid" style="display:none;" name="<?php echo $keys; ?>"><?php echo $t_headers[$keys]; ?></div>
													<div class="example7_tech" style="display:none;"><?php echo $keys . "@" . $t_headers[$keys]; ?></div>
												</th>
											<?php
											}
											?>
										</tr>
										<tr style="display:none;" class="example7_filter">
											<?php
											$j = 1;
											foreach ($SalesOrders as $keys => $vales) {
											?>
												<th><input type="text" class="search_int" value="" alt='<?php echo $j; ?>' name="table_today@example7"></th>
											<?php
												$j++;
											}
											?>
										</tr>
									</thead>
									<tbody id='example7_tbody'>
									<?php
								}
									?>
									<tr id="<?php echo $r; ?>">
										<?php
										$col = 0;
										foreach ($SalesOrders as $keys => $vales) {
											$jon = urlencode(json_encode($SalesOrders));

											$date = Controller::dateValue($t_headers, $keys, $vales);
											if ($date != false)
												$vales = $date;
											else {
												if ($keys != 'PUR_GROUP') {
													$num = Controller::numberFormat($t_headers, $keys, $vales);
													if ($num != false)
														$vales = $num;
												}
											}
											$id = $vales;
										?>
											<td class="example7_cl<?php echo $col; ?>">
												<?php
												if ($keys == "DOC_NUMBER") {
												?>
													<div id="<?php echo trim($id . '_' . $col); ?>" style="cursor:pointer;color:#00AFF0;">
														<div onClick="show_menu('<?php echo trim($id . '_' . $col); ?>','<?php echo $jon; ?>','/KYK/SERPSLS_GENDOC_FLAGS_STS','sales_workbench')"><?php echo $vales; ?></div>
													</div>
												<?php
												} elseif ($keys == 'MATERIAL') {
													$plant = $SalesOrders['PLANT'];
													$vals = preg_replace("/[^A-Za-z0-9]/", "", $vales);
												?>
													<div id="<?php echo $i . '_' . trim($vals); ?>" style="cursor:pointer;color:#00AFF0;">
														<div onClick="show_prod('<?php echo $i . '_' . $vals; ?>','<?php echo $plant; ?>','product_availability');" title=""><?php echo $vales; ?></div>
													</div>
												<?php
												} else {
													echo $vales;
												}

												if (is_numeric(trim($vales)) && $keys != 'MATERIAL') {
													echo '<input type="hidden" ids="' . $keys . $r . '" id="' . $keys . '" name="' . $keys . '" value="' . round(trim($vales), 2) . '" alt="true">';
												} else {
													echo '<input type="hidden" ids="' . $keys . $r . '" id="' . $keys . '" name="' . $keys . '" value="' . $vales . '" alt="true">';
												}
												?>
											</td>
										<?php
											$col++;
										}
										?>
									</tr>
								<?php
								if ($r == "") {
									$r = 0;
								}
								$r = $r + 10;
							}
								?>
									</tbody>
						</table>
					</div>
				<?php
				} else {
					echo Controller::customize_label(_NOITEMFOUND);
				}
				?>
			</div>
		</div>
		<br />
		<div class="controls" style="margin-left:0px;">
			<input type="button" name="edit_salesorder" id="edit_salesorder" value="<?php Controller::customize_label(_EDIT) ?>" class="btn btn-primary iphone_sales_disp" />
			<input type="button" name="save_salesorder" id="save_salesorder" value="<?php Controller::customize_label(_SAVE) ?>" onClick="save_order()" style="display:none;" class="btn btn-primary iphone_sales_disp" />
			<input type="button" name="cancel_salesorder" id="cancel_salesorder" value="<?php Controller::customize_label(_CANCEL) ?>" style="display:none;" class="btn iphone_sales_disp" />
		</div>
		</div>
	</form>
<?php
}
if (isset($_REQUEST['titl'])) {
?>
	<script>
		$(document).ready(function() {
			parent.titl('<?php echo $_REQUEST["titl"]; ?>');
			parent.subtu('<?php echo $_REQUEST["tabs"]; ?>');
		})
	</script>
<?php
} elseif (isset($_REQUEST['IV_PR_NUMBER']) && $ET_PR_ITEM == NULL) {
?>
	<div class="tab-content tab-con"><?php Controller::customize_label(_PRNOTEXISTS); ?></div>
<?php
}
?>
<!-- javascript placed at the end of the document so the pages load faster -->
<div class="material_pop"></div>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine-en.js"></script>
<script type="text/javascript">
	var backupRows = [];

	function orders() {
		$('#save_salesorder').click();
	}

	$(document).ready(function() {
		var flgs = '';
		$('.flgs').each(function(index, element) {
			flgs += $(this).val() + 'G1SU,';
		});

		$('#flag').val(flgs);
		$('.getval').attr('readonly', 'readonly');
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth() + 1; //January is 0!
		var yyyy = today.getFullYear();
		if (dd < 10) {
			dd = '0' + dd
		}
		if (mm < 10) {
			mm = '0' + mm
		}
		var today = mm + '/' + dd + '/' + yyyy;

		jQuery("#validation3").validationEngine();
	});

	$(document).ready(function(e) {
		$("#copy_form_data").click(function() {
			var str = '';
			$("#form_edit_values").find(":input").each(function() {
				id = $(this).attr('id');
				name = $(this).attr('name');
				val = $(this).attr('value');

				if (id != undefined && name != undefined && val != undefined && id != "bapiName" && id != "NET_VAL_HD" && id != "copy_form_data")
					str = str + name + '=' + val + '&';
			});
			$("#example7_today").find(":input").each(function() {
				id = $(this).attr('id');
				name = $(this).attr('name');
				val = $(this).attr('value');

				if (id != undefined && name != undefined && val != undefined && id != "bapiName")
					str = str + id + '=' + val + '&';
			});
			$.cookie("formdata", str);
			window.location.href = '#create_sales_order';
		});
	});

	$(document).ready(function(e) {
		if ($(document).width() < 100) {
			$('#nxt1').css({
				color: '#cecece'
			});
			var gd = 0;
			$('.iph').find('thead th').each(function(index, element) {
				gd = gd + 1;
				var text = $(this).text();
				$('.iph').find('tbody td:nth-child(' + gd + ')').children('input').before('<label class="sda">' + text + '<span> *</span>:</label>');
				//$('.iph').find('tbody td:nth-child('+gd+')').children('input').after('<br><br>');
			});
		}

		$("#dataTable").on('click', 'img', function() {
			var val = $(this).closest("td").find("input").val();
			$sales_org = $("#SALES_ORG").val();
			if (val != "")
				show_prod_avail(val, $sales_org, 'product_availability');
			else
				jAlert("You Have to Select Material First");
		});
	});

	$(document).ready(function(e) {
		var header_note = $('#HEADER_NOTE').val();
		var pr_type = $('#PR_TYPE').val();

		$("#add_row_table").css("display", "none");

		$("#edit_salesorder").click(function() {
			backupRows = $('#dataTable tbody tr').each(function() {
				backupRows.push(this);
			});

			$('#head_tittle').html("<?php Controller::customize_label(_CHANGENEWPURCHASEREQUISITION) ?>");
			var tblexample7Len = $('#example7 >tbody >tr').length;
			var tbldataTableLen = $('#dataTable >tbody >tr').length;

			$("#edit_salesorder").hide();
			$("#save_salesorder").show();
			$("#cancel_salesorder").show();

			$("#copy_form_data").hide();
			$("#NET_VAL_HD_hide").hide();

			$('#HEADER_NOTE').removeAttr("readonly");
			$('#PR_TYPE').removeAttr("readonly");

			$("#add_row_table").css("display", "block");
			$(".tab-con").css("display", "none");

			if (tbldataTableLen < tblexample7Len) {
				rowlen = tblexample7Len - tbldataTableLen;
				for (l = 0; l < rowlen; l++) {
					addRow('dataTable', 'U');
				}
			}

			$("#dataTable tbody tr").each(function(rind) {
				$(this).find("input[type=text]").each(function(tindex) {
					if (tindex > 0)
						$(this).attr("readonly", false);
				});
			});

			var str = '';
			$("#example7_tbody").find("input[type=hidden]").each(function() {
				id = $(this).attr('ids');
				val = $(this).attr('value');

				if (id != undefined)
					str = str + id + '=' + val + '&';
			});

			var values = str.split("&");
			$("#dataTable input[type=text], #CURRENCY").each(function() {
				var id = $(this).attr('id');
				for (var j = 0; j < values.length; j++) {
					var value = values[j].split("=");
					if (id == value[0]) {
						$(this).val(value[1]);
					}
				}
			});
			$("#dataTable [id^='DELIV_DATE']").each(function() {
				$(this).datepicker({
					format: 'mm/dd/yyyy',
					weekStart: '0',
					autoclose: true
				}).on('changeDate', function() {
					$('.datepickerformError').hide();
				});
			});

			$("#dataTable [id^='PRICE_UNIT']").each(function() {
				$(this).attr("readonly", true);
			});

			// var rowCount = $('#example7 tbody tr').length;
			// for (var i = 0; i < rowCount; i++) {
			// 	$('#dataTable tbody tr')[i].children[14].children[0].value = $('.example7_cl14 input')[i].value;
			// 	$('#dataTable tbody tr')[i].children[9].children[0].value = pad($('#dataTable tbody tr')[i].children[9].children[0].value, 3);
			// 	$('#dataTable tbody tr')[i].children[7].children[0].attributes['readonly'] = true;
			// }
		});

		function pad(str, max) {
			str = str.toString();
			return str.length < max ? pad("0" + str, max) : str;
		}

		$("#cancel_salesorder").click(function() {
			document.getElementById('dataTable').tBodies[0].innerHTML = '';
			document.getElementById('dataTable').tBodies[0].appendChild(backupRows[0]);
			$('#head_tittle').html("<?php Controller::customize_label(_DISPLAYPURCHASEORDER) ?>");
			$("#edit_salesorder").show();
			$("#save_salesorder").hide();
			$("#cancel_salesorder").hide();

			$("#copy_form_data").show();
			$("#NET_VAL_HD_hide").show();

			$("#add_row_table").css("display", "none");
			$(".tab-con").css("display", "block");

			$('#HEADER_NOTE').val(header_note);
			$('#PR_TYPE').val(pr_type);

			$("#validation7 input[type=text]").each(function() {
				$(this).attr("readonly", true);
				//$(".minw").css("display","none");
			});
		});

		jQuery("#validation7").validationEngine();
	});

	var delete_val = '';
	var inc = 0;
	var nut = 0;

	function addRow(tableID, t) {
		if ($(document).width() < 100) {
			$('#pre').show();
			$('#nxt1').show();
			$('.sda').remove();
			$('.nudf').hide();
			$('#pre1').hide();
		}
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);
		inc = (rowCount - 1);
		if (t == 'A') {
			var itm = table.rows[inc].cells[0].lastElementChild;
			in_vals = ($('#' + itm.id).val() / 10);
		} else
			in_vals = inc;

		nut = 10 * (in_vals)
		row.setAttribute('onclick', 'select_row("ids_' + in_vals + '")');
		row.setAttribute('class', 'ids_' + in_vals + ' nudf');
		var colCount = table.rows[1].cells.length;
		for (var i = 0; i < colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[1].cells[i].innerHTML;
			var ind = newcell.getElementsByTagName('input');

			if (t != "U")
				ind[0].removeAttribute('readonly');

			var ids = ind[0].id;
			ind[0].id = ids + nut;

			ind[0].setAttribute("onKeyUp", "jspt('" + ids + nut + "',this.value,event)");

			if (ind[0].title == 'MATERIAL') {
				ind[0].setAttribute("onchange", "getMatDescBOM('" + ids + nut + "',this, this.event,'dataTable')");
				var re = newcell.getElementsByTagName('div');
				var met = 'MATERIAL' + nut;
				re[0].style.display = '';
				re[0].setAttribute("onclick", "lookup('Material', '" + met + "', 'material_purch_req');");

			} else if (ind[0].title == 'COSTCENTER') {
				ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
				var re = newcell.getElementsByTagName('div');
				var met = 'COSTCENTER' + nut;
				re[0].style.display = '';
				re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_COSTCENTER) ?>', '" + met + "', 'cost_center');");
			} else if (ind[0].title == 'PLANT') {
				ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
				var re = newcell.getElementsByTagName('div');
				var met = 'PLANT' + nut;
				re[0].style.display = '';
				re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_PLANT) ?>', '" + met + "', 'plant');");
			// }
			// else if (ind[0].title == 'STORE_LOC') {
			// 	ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
			// 	var re = newcell.getElementsByTagName('div');
			// 	var met = 'STORE_LOC' + nut;
			// 	re[0].style.display = '';
			// 	re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_STORELOC) 
															?>', '" + met + "', 'storage_loc');");
			// } else if (ind[0].title == 'PUR_GROUP') {
			// 	ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
			// 	var re = newcell.getElementsByTagName('div');
			// 	var met = 'PUR_GROUP' + nut;
			// 	re[0].style.display = '';
			// 	re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_PURGROUP) 
															?>', '" + met + "', 'purch_group');");
			// } else if (ind[0].title == 'gl_account') {
			// 	ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
			// 	var re = newcell.getElementsByTagName('div');
			// 	var met = 'gl_account' + nut;
			// 	re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_GLACCOUNT) 
															?>', '" + met + "', 'gl_accounts')");
			// } 
			// else if (ind[0].title == 'CURRENCY') {
			// 	ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
			// 	var re = newcell.getElementsByTagName('div');
			// 	var met = 'CURRENCY' + nut;
			// 	re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_CURRENCY) 
															?>', '" + met + "', 'currency')");
			// } 
			} else if (ind[0].title == 'UNIT') {
				ind[0].setAttribute("onchange", "jspt_new('" + ids + nut + "',this.value,event)");
				var re = newcell.getElementsByTagName('div');
				var met = 'UNIT' + nut;
				re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_UOM) ?>', '" + met + "', 'uom')");
			} else if (ind[0].title == 'DELIV_DATE') {
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth() + 1; //January is 0!
				var yyyy = today.getFullYear();
				if (dd < 10) {
					dd = '0' + dd
				}
				if (mm < 10) {
					mm = '0' + mm
				}
				var today = mm + '/' + dd + '/' + yyyy;
				var id = ind[0].id;
				$('#' + id).val(today);
				$('#' + id).datepicker({
					format: 'mm/dd/yyyy',
					weekStart: '0',
					autoclose: true
				}).on('changeDate', function() {
					$('.datepickerformError').hide();
				});
			}
			if (ind[(ind.length - 1)].title == 'item') {
				var numb = newcell.childNodes[0].value;
				var ids = ind[(ind.length - 1)].id;
				ind[(ind.length - 1)].id = ids + nut;
				ind[(ind.length - 1)].value = (nut + 10);
				ind[(ind.length - 1)].setAttribute("readonly", true);
				var vflag = document.getElementById('flag').value;
				document.getElementById('flag').value = vflag + (nut + 10) + 'G1S' + t + ',';
			}
			if (ind[0].title == 'PRICE_UNIT') {
				ind[0].setAttribute("readonly", true);
				ind[0].value = "1";
			}
			// else {
			// 	ind[0].value = "";
			// }
			if ($(document).width() < 100) {

				var test = $('.iph').find('thead th:nth-child(' + (i + 1) + ')').text();
				$('#' + ids + nut).before('<label class="labls">' + test + '<span> *</span>:</label>');
			}
			$('.ids_' + inc + ' .minw9').show();
		}
	}

	function deleteRow(tableID) {
		if ($(document).width() < 100) {
			var num = 0;
			$('.nudf').each(function(index, element) {
				$(this).attr('id', 'ids_' + num);
				num++;
			});

			$('.nudf').each(function(index, element) {
				var lenft = $('.nudf').length;
				var nur = 1;
				if ($(this).css('display') == 'table-row') {
					if (lenft == nur) {
						$('#nxt').hide();
						$('#nxt1').show();
					}
					var ids = $(this).attr('id');
					if (ids == 'ids_0') {
						jAlert('<?php Controller::customize_label(_ONEITEMREQUIRED) ?>', 'Message');
						return false;
					}
					var sio = ids.split('_');
					$(this).remove();
					var cll = $('#ids_' + (sio[1] - 1)).attr('class');

					if (cll == 'ids_0 nudf') {
						$('#pre').hide();
						$('#pre1').show();
						var gd = 0;
						$('.iph').find('thead th').each(function(index, element) {
							gd = gd + 1;
							var text = $(this).text();
							$('.iph').find('tbody td:nth-child(' + gd + ')').children('input').before('<label class="sda">' + text + '<span> *</span>:</label>');
						});
					}
					$('#ids_' + (sio[1] - 1)).show();
				}
				nur++;
			});
		} else {
			try {
				var cunt = 0;
				var table = document.getElementById(tableID);
				var rowCount = table.tBodies[0].rows.length;
				var strs = '';
				for (var i = 0; i < rowCount; i++) {
					var row = table.tBodies[0].rows[i];
					var chkbox = row.cells[0].firstElementChild;
					if (chkbox.id != 'head') {
						if (chkbox.checked) {
							if (chkbox.title == 'che') {
								var vflag = document.getElementById('flag').value;
								var str = vflag.split(',');
								var laststr = str[i];
								var sde = laststr.split('G1S');
								if (sde[1] == 'U') {
									var lst = document.getElementById('flag_d').value;
									$(table.tBodies[0].rows[i]).find(":input").each(function() {
										id = $(this).attr('id');
										val = $('#' + id).val();
										id_vals = id.match(/(\d+|[^\d]+)/g);
										name = $(this).attr('name');
										if (id != undefined && name != undefined && id != "bapiName") {
											if (delete_val == '')
												delete_val = id_vals[0] + '=' + val;
											else
												delete_val = delete_val + '&' + id_vals[0] + '=' + val;
										}
									});
								}
								if (strs == '')
									strs = vflag.replace(str[i - 1] + ',', '');
								else
									strs = strs.replace(str[i - 1] + ',', '');

							}
							cunt = cunt + 1;
						}
					}
				}
				if (rowCount == cunt) {
					jAlert('<?php Controller::customize_label(_ONEITEMREQUIRED) ?>', 'Message');
				} else {
					for (var i = 0; i < rowCount; i++) {
						var row = table.tBodies[0].rows[i];
						var chkbox = row.cells[0].firstElementChild;
						//alert(row.cells[0].getElementsByTagName('input'));
						if (chkbox.id != 'head') {
							if (null != chkbox && true == chkbox.checked) {
								table.deleteRow(i + 1);
								rowCount--;
								i--;
							}
						}
					}
				}
				if (delete_val != '') {
					$.cookie("deldata", delete_val);
				}
				if (strs != '')
					document.getElementById('flag').value = strs;
			} catch (e) {}
		}
		var num = 0;
	}


	function number(num) {
		if (num != "") {
			var str = '' + num;
			while (str.length < 10) {
				str = '0' + str;
			}
			return str;
		}
	}

	function select_row(ids) {
		if ($('.' + ids).hasClass('bb')) {
			$('.' + ids).removeClass('bb');
			$('.' + ids).find('input:checkbox').prop('checked', false);
		} else {
			$('.' + ids).addClass('bb');
			$('.' + ids).find('input:checkbox').prop('checked', true);
		}
	}

	function pre() {
		var lenft = $('.nudf').length;
		$('#nxt').css({
			color: '#000'
		});
		$('#nxt1').hide();
		$('#nxt').show();
		var num = 0;
		$('.nudf').each(function(index, element) {
			$(this).attr('id', 'ids_' + num);
			num++;
		});

		$('.nudf').each(function(index, element) {
			if ($(this).css('display') == 'table-row') {
				var ids = $(this).attr('id');
				var sio = ids.split('_');
				$(this).hide();
				$('#ids_' + (sio[1] - 1)).show();
				if (sio[1] - 1 == 0) {
					$('#pre1').css({
						color: '#cecece'
					});
					$('#pre1').show();
					$('#pre').hide();
					var gd = 0;
					$('.iph').find('thead th').each(function(index, element) {
						gd = gd + 1;
						var text = $(this).text();
						$('.iph').find('tbody td:nth-child(' + gd + ')').children('input[type!="hidden"]').before('<label class="sda">' + text + '<span> *</span>:</label>');
					});
				}
				return false;
			}
		});
	}

	function nxt() {
		$('.sda').remove();
		var lenft = $('.nudf').length;
		$('#pre').css({
			color: '#000'
		});
		$('#pre').show();
		$('#pre1').hide();
		var num = 0;
		$('.nudf').each(function(index, element) {
			$(this).attr('id', 'ids_' + num);
			num++;
		});
		$('.nudf').each(function(index, element) {
			if ($(this).css('display') == 'table-row') {
				var ids = $(this).attr('id');
				var sio = ids.split('_');
				$(this).hide();
				var inid = sio[1];
				inid++;

				$('#ids_' + (inid)).show();
				if (inid == lenft - 1) {
					$('#nxt1').css({
						color: '#cecece'
					});
					$('#nxt').hide();
					$('#nxt1').show();
				}
				return false;
			}
		});
	}

	function save_order() {
		if ($('#validation7').validationEngine('validate')) {
			$('#loading').show();
			$("body").css("opacity", "0.4");
			$("body").css("filter", "alpha(opacity=40)");
			$.ajax({
				type: 'POST',
				data: $('#validation7').serialize(),
				url: 'change_new_purchase_requisition/save_purchase_requisition',
				success: function(response) {
					$('#loading').hide();
					$("body").css("opacity", "1");
					var spt = response.split("@");

					var n = spt[0].indexOf("System error");
					var type = spt[1];
					if (type != "E") {
						jConfirm('<b><?php Controller::customize_label(_SAPSYSTEMMESSAGE) ?>: </b><br>' + spt[0], 'Purchase Requisition Change', function(r) {
							if (r) {
								$('#loading').show();
								$("body").css("opacity", "0.4");
								$("body").css("filter", "alpha(opacity=40)");
								$.ajax({
									type: 'POST',
									data: $('#validation7').serialize(),
									url: 'change_new_purchase_requisition/commit',
									success: function(response) {
										if ($.cookie("deldata")) {
											$.cookie("deldata", null);
										}
										$('#loading').hide();
										$("body").css("opacity", "1");
										$("#cancel_salesorder").trigger("click");
										jAlert('<b><?php Controller::customize_label(_SAPSYSTEMMESSAGE) ?>: </b><br> <?php Controller::customize_label(_SAPSYSTEMMESSAGECS) ?>', 'Purchase Requisition Change');
									}
								});
							}
						});
						$("#popup_ok").val('Click to Confirm');
						$("#popup_ok").on('click', function(e) {
							$('#submit').click();
						});
					} else
						jAlert('<b><?php Controller::customize_label(_SAPSYSTEMMESSAGE) ?>: </b><br>' + spt[0], 'Purchase Requisition Change');
				}
			});
		} else {
			console.log('Not working #validation7.');
		}
	}
</script>