<style>
    .table th,
    .table td {
        min-width: 110px;
    }

    .bb {
        background: #cecece !important;
    }

    .bb:hover {
        background: #cecece !important;
    }

    .table th,
    .table tbody td {
        display: table-cell;
    }

    .check {
        display: none !important;
    }

    .input-fluid {
        height: 18px;
        width: 60% !important;
    }
</style>
<div id='loading'>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif">
</div>
<?php
$baseUrl = Yii::app()->request->getUrl();
$customize = $model;
$PR_TYPE = 'ZPR';
$PRICE_UNIT = 1;
// $CURRENCY = 'USD';
// $HEADER_NOTE = 'Header note default';
// $ACCTASSCAT = 'K';
// $QUANTITY = 0;
// $UNIT = 'EA';
// $PREQ_PRICE = 0;

// $MATERIAL = '28826';
// $SHORT_TEXT = 'LATEX MEDICAL EXAMINATION GLOVES, SMALL,';
// $COSTCENTER =  '10000';
// $PLANT = '1000';
// $STORE_LOC = '1000';
// $PUR_GROUP = '1000';
// $GL_ACCOUNT = '6100000';
?>
<div style="font-size:14px; color:#900; margin:0px 0px 30px 60px;"></div>
<form id="validation" action="javascript:createPurchaseRequisition()" class="form-horizontal">
    <section id="formElement" class="utopia-widget utopia-form-box section max_width">
        <div class="row-fluid">
            <div class="utopia-widget-content">
                <!-- <h4 class="filter_note"><?php Controller::customize_label(_NONE); ?></h4> -->
                <input type="hidden" name='page' value="bapi">
                <input type="hidden" name="url" value="create_new_purchase_requisition" />
                <div id="form_edit_values" class="utopia-widget-content myspace inval35 spaceing row-fluid" style="margin-top:11px;">
                    <div class="span5 utopia-form-freeSpace myspace">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label cutz in_custz" alt="PR Type" for="input01"><?php Controller::customize_label(_PRTYPE); ?><span>*</span>:</label>
                                <!-- <label class="control-label cutz in_custz" alt="PR Type" for="input01">PR<span>*</span>:</label> -->
                                <div class="controls">
                                    <input alt="PR Type" type="text" name='PR_TYPE' id='PR_TYPE' class="validate[required,maxSize[3],minSize[3]] getval radius" value='<?php echo $PR_TYPE; ?>' onKeyUp="jspt('PR_TYPE',this.value,event)" autocomplete="off" />
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="span5 utopia-form-freeSpace">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label cutz" for="input01" style='width:150px;' alt='Header Note'><?php Controller::customize_label(_HEADERTXT); ?>:</label>
                                <div class="controls">
                                    <textarea alt="Header Note" type="text" name='HEADER_NOTE' id='HEADER_NOTE' class="getval radius" value='<?php echo $HEADER_NOTE; ?>' onKeyUp="jspt('HEADER_NOTE',this.value,event)" autocomplete="off" style='height: 90px;'><?php echo $HEADER_NOTE; ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="utopia-widget-content spaceing">
                            <div style='display:none'>
                                <a class="btn" href="#" onclick="addRow('dataTable')"><?php Controller::customize_label(_ADDITEM); ?></a>
                                <a class="btn" href="#" onclick="deleteRow('dataTable')"><?php Controller::customize_label(_DELETEITEM); ?></a>
                            </div>
                            <br>
                            <div style="border:1px solid #FAFAFA;overflow-y:hidden;overflow-x:scroll;">
                                <table class="table table-bordered" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="check">
                                                <input class="utopia-check-all" type="checkbox" id="head">
                                            </th>
                                            <th alt="Req. Item">
                                                <?php Controller::customize_label(_REQITEM); ?>
                                            </th>
                                            <!-- <th alt="Acct. Assigt. Cat.">
                                                <?php //Controller::customize_label(_ACCASSCAT); 
                                                ?>
                                            </th> -->
                                            <th alt="Material">
                                                <?php Controller::customize_label(_MATERIAL); ?>
                                            </th>
                                            <th alt="Short Text">
                                                <?php Controller::customize_label(_DESCRIPTION); ?>
                                            </th>
                                            <th alt="Quantity">
                                                <?php Controller::customize_label(_QUANTITY); ?>
                                            </th>
                                            <!-- <th alt="Unit">
                                                <?php //Controller::customize_label(_UOM); 
                                                ?>
                                            </th> -->
                                            <th alt="Delivery Date">
                                                <?php Controller::customize_label(_DELIVDATE); ?>
                                            </th>
                                            <th alt="Plant">
                                                <?php Controller::customize_label(_PLANT); ?>
                                            </th>
                                            <!-- <th alt="Storage Location">
                                                <?php //Controller::customize_label(_STORELOC); 
                                                ?>
                                            </th>
                                            <th alt="Purchasing Group">
                                                <?php //Controller::customize_label(_PURGROUP); 
                                                ?>
                                            </th> -->
                                            <th alt="Req. Price">
                                                <?php Controller::customize_label(_REQPRICE); ?>
                                            </th>
                                            <th alt="Price Unit">
                                                <?php Controller::customize_label(_PRICEUNIT); ?>
                                            </th>
                                            <!-- <th alt="Currency">
                                                <?php //Controller::customize_label(_CURRENCY); 
                                                ?>
                                            </th> -->
                                            <th alt="Cost Center">
                                                <?php Controller::customize_label(_COSTCENTER); ?>
                                            </th>
                                            <!-- <th alt="GL Account">
                                                <?php //Controller::customize_label(_GLACCOUNT); 
                                                ?>
                                            </th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr onClick="select_row('ids_0')" class="ids_0 nudf">
                                            <td class="check">
                                                <input class="chkbox" type="checkbox" name="checkbox[]" title="che" id="che" />
                                            </td>
                                            <td>
                                                <input ype="text" name='PREQ_ITEM[]' value="10" title="item" id='itm' class='input-fluid validate[required,custom[number]]' readonly />
                                            </td>
                                            <!-- <td>
                                                <input type="text" id='ACCTASSCAT' class="input-fluid getval" style='min-width:80%' name='ACCTASSCAT[]' title="ACCTASSCAT" onblur="mand_purch_org(this);" onKeyUp="jspt('ACCTASSCAT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $ACCTASSCAT; ?>" />
                                            </td> -->
                                            <td>
                                                <input type="text" id='MATERIAL' name='material[]' class="input-fluid validate[required] getval radiu" title="Material" onKeyUp="jspt('MATERIAL',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $MATERIAL; ?>" onchange="getMatDescBOM('MATERIAL',this, this.event,'dataTable')" />
                                                <div class='minws' onclick="lookup('Material', 'MATERIAL', 'material_purch_req')">&nbsp;</div>
                                            </td>
                                            <td>
                                                <input type="text" id='SHORT_TEXT' class="input-fluid getval validate[required]" style='min-width:80%' name='SHORT_TEXT[]' title="SHORT_TEXT" onblur="mand_purch_org(this);" onKeyUp="jspt('SHORT_TEXT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $SHORT_TEXT; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="input-fluid validate[required,custom[number]] getval" style='min-width:80%' name='QUANTITY[]' id="QUANTITY" onKeyUp="jspt('QUANTITY',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $QUANTITY; ?>" />
                                            </td>
                                            <!-- <td>
                                                <input type="text" id='UNIT' class="input-fluid validate[required] getval" name='UNIT[]' title="UNIT" onKeyUp="jspt('UNIT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $UNIT; ?>" />
                                                <div class='minws' onclick="lookup('<?php //Controller::customize_label(_UOM); 
                                                                                    ?>', 'UNIT', 'uom')">&nbsp;</div>
                                            </td> -->
                                            <td>
                                                <input type="text" id='DELIV_DATE' class="input-fluid getval validate[required]" style='min-width:80%' name='DELIV_DATE[]' title="DELIV_DATE" onblur="mand_purch_org(this);" onKeyUp="jspt('DELIV_DATE',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $deliv_date; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" id='PLANT' class="input-fluid validate[required,maxSize[4],minSize[4],custom[integer]] getval" name='PLANT[]' title="PLANT" onKeyUp="jspt('PLANT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $PLANT; ?>" />
                                                <div class='minws' onclick="lookup('<?php Controller::customize_label(_PLANT); ?>', 'PLANT', 'plant')">&nbsp;</div>
                                            </td>
                                            <!-- <td>
                                                <input type="text" id='STORE_LOC' name='STORE_LOC[]' class="input-fluid validate[required] getval radiu" title="STORE_LOC" alt="MULTI" style="width:55% !important;" onKeyUp="jspt('STORE_LOC',this.value,event)" autocomplete="off" value='<?php //echo $STORE_LOC; 
                                                                                                                                                                                                                                                                                            ?>' onchange="jspt_new('STORE_LOC',this.value,event)" />
                                                <div class='minws1' id="table_lookup" onclick="lookup('<?php //Controller::customize_label(_STORELOC); 
                                                                                                        ?>', 'STORE_LOC', 'storage_loc')">&nbsp;</div>
                                            </td> -->
                                            <!-- <td>
                                                <input type="text" id='PUR_GROUP' class="input-fluid validate[required] getval radiu" name='PUR_GROUP[]' title="PUR_GROUP" onKeyUp="jspt('PUR_GROUP',this.value,event)" autocomplete="off" alt="MULTI" value="<?php //echo $PUR_GROUP; 
                                                                                                                                                                                                                                                                ?>" />
                                                <div class='minws' onclick="lookup('<?php //Controller::customize_label(_PURGROUP); 
                                                                                    ?>', 'PUR_GROUP', 'purch_group')">&nbsp;
                                                </div>
                                            </td> -->
                                            <td>
                                                <input type="text" id='PREQ_PRICE' class="input-fluid validate[required,custom[number]] getval radiu" name='PREQ_PRICE[]' title="PREQ_PRICE" onKeyUp="jspt('PREQ_PRICE',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $PREQ_PRICE; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" id='PRICE_UNIT' class="input-fluid getval validate[required]" name='PRICE_UNIT[]' title="PRICE_UNIT" onblur="mand_purch_org(this);" onKeyUp="jspt('PRICE_UNIT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $PRICE_UNIT; ?>" readonly />
                                            </td>
                                            <!-- <td>
                                                <input type="text" id='CURRENCY' class="input-fluid getval radiu validate[required]" name='CURRENCY[]' title="CURRENCY" onKeyUp="jspt('CURRENCY',this.value,event)" autocomplete="off" alt="MULTI" value="USD" readonly />
                                                <div class='minws' onclick="lookup('<?php //Controller::customize_label(_CURRENCY); 
                                                                                    ?>', 'CURRENCY', 'currency')">&nbsp;</div>
                                            </td> -->
                                            <td>
                                                <input type="text" id='COSTCENTER' class="input-fluid validate[required] getval" name='COSTCENTER[]' title="COSTCENTER" onKeyUp="jspt('COSTCENTER',this.value,event)" autocomplete="off" alt="MULTI" value="<?php echo $COSTCENTER; ?>" />
                                                <div class='minws' onclick="lookup('<?php Controller::customize_label(_COSTCENTER); ?>', 'COSTCENTER', 'cost_center')">&nbsp;</div>
                                            </td>
                                            <!-- <td>
                                                <input type="text" id='GL_ACCOUNT' class="input-fluid validate[required] getval" name='GL_ACCOUNT[]' title="GL_ACCOUNT" onKeyUp="jspt('GL_ACCOUNT',this.value,event)" autocomplete="off" alt="MULTI" value="<?php //echo $GL_ACCOUNT; 
                                                                                                                                                                                                                                                            ?>" />
                                                <div class='minws' onclick="lookup('<?php //Controller::customize_label(_GLACCOUNT); 
                                                                                    ?>', 'GL_ACCOUNT', 'gl_accounts')">&nbsp;</div>
                                            </td> -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
        <input type="submit" value="<?php Controller::customize_label(_SUBMIT) ?>" class='btn btn-primary bbt' />
    </div>
</form>

<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine-en.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script>
    var defaultRow;

    function orders() {
        $('#save_salesorder').click();
    }

    $(document).ready(function() {
        defaultRow = document.getElementById('dataTable').tBodies[0].rows[0];
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
        $('#DELIV_DATE').val(today);
        $('#DELIV_DATE').datepicker({
            format: 'mm/dd/yyyy',
            weekStart: '0',
            autoclose: true
        }).on('changeDate', function() {
            $('.datepickerformError').hide();
        });
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

        $(document).keypress(
            function(event) {
                if (event.which == '13') {
                    event.preventDefault();
                }
            });
    });

    function createPurchaseRequisition() {
        var de = 0;
        $('#loading').show();
        $("body").css("opacity", "0.4");
        $("body").css("filter", "alpha(opacity=40)");
        $.ajax({
            type: 'POST',
            url: 'create_new_purchase_requisition/create_new_purchase_requisition',
            data: $('#validation').serialize(),
            success: function(response) {
                $('#loading').hide();
                $("body").css("opacity", "1");
                var spt = response.split("@");
                jAlert('<b><?php Controller::customize_label(_SAPSYSTEMMESSAGE) ?>: </b><br>' + spt[0], 'Message', function() {});
                var msg = $.trim(spt[1])
                if (msg == 'S') {
                    //$('.getval').val("");
                    console.log('<?php echo $baseUrl ?>');
                    $('#popup_ok').on("click", function() {
                        window.location.href = 'dashboard#create_new_purchase_requisition';
                        window.location.reload();
                    });
                }
            }
        });
    }

    function mand_purch_org(ctrl) {
        var val = ctrl.value;
        ctrlid = ctrl.id;
        id = ctrlid.replace("VENDOR", "");
        PURCH_ORG = "PURCH_ORG" + id;

        if (val != "")
            $("#" + PURCH_ORG).addClass("validate[required]");
        else {
            $("#" + PURCH_ORG).removeClass("validate[required]");
            $("#" + PURCH_ORG).closest("td").find(".formError").each(function() {
                $(this).remove();
            });
        }
    }

    var nut = 0;
    var inc = 0;

    function addRow(tableID) {
        // inc = inc+1;
        if ($(document).width() < 100) {
            $('#nxt1').show();
            $('#pre').show();
            $('.sda').remove();
            $('.nudf').hide();
            $('#pre1').hide();
        }

        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;

        if (rowCount == 1) {
            var newRow = defaultRow;
            table.tBodies[0].appendChild(newRow);
        } else {
            var row = table.insertRow(rowCount);
            inc = (rowCount - 1);
            row.setAttribute('onclick', 'select_row("ids_' + inc + '")');
            row.setAttribute('class', 'ids_' + inc + ' nudf');
            var colCount = table.rows[1].cells.length;
            nut = 10 * inc;

            for (var i = 0; i < colCount; i++) {
                var newcell = row.insertCell(i);
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                var ind = newcell.getElementsByTagName('input');
                if (ind[0].title == 'che') {
                    newcell.setAttribute('class', 'check');
                }
                var ids = ind[0].id;
                ind[0].id = ids + nut;
                if (ids != "che") {
                    ind[0].setAttribute("onKeyUp", "jspt('" + ids + nut + "',this.value,event)");
                }
                if (ind[0].title == 'Material') {
                    ind[0].setAttribute("onchange", "getMatDescBOM('" + ids + nut + "',this,this.event, 'dataTable')");
                    var re = newcell.getElementsByTagName('div');
                    var met = 'MATERIAL' + nut;
                    re[0].setAttribute("onclick", "lookup('Material', '" + met + "', 'material_purch_req');");
                }
                // if (ind[0].title == 'PUR_GROUP') {
                //     var re = newcell.getElementsByTagName('div');
                //     var su = 'PUR_GROUP' + nut;
                //     re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_PURGROUP) ?>', '" + su + "', 'purch_group')");

                // }
                if (ind[0].title == 'PLANT') {
                    var re = newcell.getElementsByTagName('div');
                    var plant = 'PLANT' + nut;
                    re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_PLANT) ?>', '" + plant + "', 'plant')");
                }
                // if (ind[0].title == 'STORE_LOC') {
                //     var re = newcell.getElementsByTagName('div');
                //     var su = 'STORE_LOC' + nut;
                //     re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_STORELOC) ?>', '" + su + "', 'storage_loc')");
                // }
                if (ind[0].title == 'DELIV_DATE') {
                    var re = newcell.getElementsByTagName('div');
                    var su = 'DELIV_DATE' + nut;

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
                    $('#DELIV_DATE' + nut).val(today);
                    $('#DELIV_DATE' + nut).datepicker({
                        format: 'mm/dd/yyyy',
                        weekStart: '0',
                        autoclose: true
                    }).on('changeDate', function() {
                        $('.datepickerformError').hide();
                    });
                }
                // if (ind[0].title == 'GL_ACCOUNT') {
                //     var re = newcell.getElementsByTagName('div');
                //     var gl_account = 'GL_ACCOUNT' + nut;
                //     re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_GLACCOUNT) ?>', '" + gl_account + "', 'gl_accounts')");
                // }
                if (ind[0].title == 'COSTCENTER') {
                    var re = newcell.getElementsByTagName('div');
                    var costcenter = 'COSTCENTER' + nut;
                    re[0].setAttribute("onclick", "lookup('<?php Controller::customize_label(_COSTCENTER) ?>', '" + costcenter + "', 'cost_center')");
                }
                // if (ind[0].title == 'UNIT') {
                //     var re = newcell.getElementsByTagName('div');
                //     var costcenter = 'UNIT' + nut;
                //     re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_UOM) 
                                                                ?>', '" + costcenter + "', 'uom')");
                // }
                // if (ind[0].title == 'CURRENCY') {
                //     var re = newcell.getElementsByTagName('div');
                //     var currency = 'CURRENCY' + nut;
                //     re[0].setAttribute("onclick", "lookup('<?php //Controller::customize_label(_CURRENCY) 
                                                                ?>', '" + currency + "', 'currency')");
                // }
                if (ind[0].title == 'item') {
                    var numb = newcell.childNodes[0].value;
                    var ids = ind[(ind.length - 1)].id;
                    ind[(ind.length - 1)].id = ids + nut;
                    ind[(ind.length - 1)].value = (nut + 10);
                }
                // else {
                //     ind[0].value = "";
                // }
                if ($(document).width() < 100) {
                    var test = $('.iph').find('thead th:nth-child(' + (i + 1) + ')').text();
                    $('#' + newcell.childNodes[0].id).before('<label class="labls">' + test + '<span> *</span>:</label>');
                }
            }
        }
    }

    function deleteRow(tableID) {
        if ($(document).width() < 100) {
            var num = 0;
            $('.nudf').each(function(index, element) {
                // alert($(this).css('display'));
                $(this).attr('id', 'ids_' + num);
                num++;
            });
            $('.nudf').each(function(index, element) {
                // alert($(this).css('display'));
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
                        })
                    }
                    $('#ids_' + (sio[1] - 1)).show();
                }
                nur++;
            });
        } else {
            try {
                var cunt = 0;
                var table = document.getElementById(tableID);
                var rowCount = table.rows.length;
                for (var i = 0; i < rowCount; i++) {
                    var row = table.rows[i];
                    var chkbox = row.cells[0].childNodes[0];
                    if (chkbox.id != 'head') {
                        if (chkbox.checked) {
                            cunt = cunt + 1;
                        }
                    }
                }
                if (rowCount - 1 == cunt) {
                    jAlert('<?php Controller::customize_label(_ONEITEMREQUIRED) ?>', 'Message');
                } else {
                    for (var i = 0; i < rowCount; i++) {
                        var row = table.rows[i];
                        var chkbox = row.cells[0].childNodes[1];
                        if (chkbox.id != 'head') {
                            if (null != chkbox && true == chkbox.checked) {
                                table.deleteRow(i);
                                rowCount--;
                                i--;
                            }
                        }
                    }
                }
            } catch (e) {}
        }

        var num = 0;
        $('#' + tableID + " tbody tr").each(function(index, element) {
            $(this).attr('class', 'ids_' + num);
            $(this).attr('onclick', 'select_row("ids_' + num + '")');
            var tds = $(this).find('td');

            $(this).find('input').each(function(inpindex, inpelement) {
                var num = (10 * index);
                if (inpindex == 0)
                    $(this).attr('checked', false);
                if (inpindex == 1) {
                    if (index == 0)
                        $(this).val(10);
                    else
                        $(this).val((num + 10));
                }

                var id = $(this).attr("id");
                if (index == 0)
                    var newid = id.replace(/\d+$/, "");
                else
                    var newid = id.replace(/\d+$/, num);
                $(this).attr('id', newid);
                if (inpindex > 1)
                    $(this).attr("onKeyUp", "jspt('" + newid + "',this.value,event)");
                if (inpindex == 2)
                    $(this).attr("onchange", "getMatDescBOM('" + newid + "',this,this.event, 'dataTable')");
            });
            
            $(this).find('div').each(function(divIndex) {
                var num = (10 * index);
                var id = $(this).prev().attr("id");
                if (index == 0)
                    var newid = id.replace(/\d+$/, "");
                else
                    var newid = id.replace(/\d+$/, num);

                if (divIndex == 0)
                    $(this).attr("onclick", "lookup('Material', '" + newid + "', 'material_purch_req');");
                if (divIndex == 1)
                    $(this).attr("onclick", "lookup('Plant', '" + newid + "', 'plant')");
                if (divIndex == 2)
                    $(this).attr("onclick", "lookup('Cost Center', '" + newid + "', 'cost_center')");
            });
            num++;
        });
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
            // alert($(this).css('display'));
            $(this).attr('id', 'ids_' + num);
            num++;
        });
        $('.nudf').each(function(index, element) {
            // alert($(this).css('display'));
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
                        $('.iph').find('tbody td:nth-child(' + gd + ')').children('input').before('<label class="sda">' + text + '<span> *</span>:</label>');
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

    $(document).ready(function() {
        jQuery("#validation").validationEngine();
    });
</script>