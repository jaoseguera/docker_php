<div id='loading'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader.gif"></div>
<img src='<?php echo Yii::app()->request->baseUrl; ?>/images/ajax-loader2.gif' style="display:none">

<?php
$this->renderPartial('smarttable', array('count' => $count));
$customize = $model;
$table_th = "";
$table_td = "";
$th_example = '';
?>

<section id='utopia-wizard-form' class="utopia-widget utopia-form-box" style="padding-bottom:18px;">
    <div class="row-fluid">
        <div class="utopia-widget-content" style="z-index:100;">
            <form id="validation" action="javascript: check_val();" method="post" class="form-horizontal">
                <input type="hidden" name='page' value="bapi">
                <input type="hidden" name="url" value="search_new_purchase_requisition" />
                <input type="hidden" class="tbName_example" value="BAPINEWPURCHASEREQ" />

                <fieldset class="span6 iphone_sales_textBox">
                    <div class="span12 utopia-form-freeSpace">
                        <fieldset>
                            <label style="text-align: left;" class="control-label cutz" alt="Purchase Requisition Number" for="input01"><?php Controller::customize_label(_PURCHASEREQUISITIONNUMBER); ?>:</label>
                            <input alt="Purchase Req. Number" class="input-fluid radius validate[required,custom[integer]]" type="text" name='IV_PR_NUMBER' value="<?php echo $IV_PR_NUMBER; ?>" maxlength='10' autocomplete="off" id="IV_PR_NUMBER">
                        </fieldset>
                    </div>
                </fieldset>
                <div class="span3 utopia-form-freeSpace" style="margin-bottom:10px; float:right; padding-left:33px;">
                    <button class="btn btn-primary span1 bbt back_b" type="submit" id='submit' style='min-width:80px;'><?php Controller::customize_label(_SUBMIT); ?></button>
                </div>
            </form>
        </div>
    </div>
</section>
<div id="body-container" style="display:none;">
    <div class="row-fluid edge2">
        <div class="span12">
            <div id="tab-content" class="tab-content">
                <div class="labl pos_pop">
                    <div class='pos_center'></div>
                    <button class="cancel btn" style="width:60px;float:right;margin-right:10px; margin-top:5px;" onClick='cancel_pop()'><?php Controller::customize_label(_CANCEL); ?></button>
                    <button class="btn" id="p_ch" onclick="p_ch()" style="width:60px; float:right; margin-top:5px;margin-right:15px;"><?php Controller::customize_label(_SUBMIT); ?></button>
                </div>
                <div id="exp_pop" style="display:none;" class="labl">
                    <div style='padding:1px;'>
                        <h4 style="color:#333333"><?php Controller::customize_label(_EXPORTALL); ?></h4>
                    </div>
                    <div class='csv_link exp_link tab_lit' onClick="csv('example_table')" style='padding:1px 1px 1px 10px;'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/csv.png">&nbsp;Csv</div>
                    <div class='excel_link exp_link tab_lit' onClick="excel('example_table')" style='padding:1px 1px 1px 10px;'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/excel.png">&nbsp;Excel</div>
                    <div class='pdf_link exp_link' style='padding:1px 1px 1px 10px;'><a href="<?php echo Yii::app()->createAbsoluteUrl("common/pdf"); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pdf.png">&nbsp;Pdf</a></div>
                    <div style='padding:1px;'>
                        <h4 style="color:#333333"><?php Controller::customize_label(_EXPORTVIEW); ?></h4>
                    </div>
                    <div class='csv_link csv_view exp_link tab_lit' onClick="csv_view('example_table')" style='padding:1px 1px 1px 10px;'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/csv.png">&nbsp;Csv</div>
                    <div class='excel_link excel_view exp_link tab_lit' onClick="excel_view('example_table')" style='padding:1px 1px 1px 10px;'><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/excel.png">&nbsp;Excel</div>
                    <div class='pdf_link exp_link' style='padding:1px 1px 1px 10px;'><a href="<?php echo Yii::app()->createAbsoluteUrl("common/pdfview"); ?>" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/pdf.png">&nbsp;Pdf</a></div>
                </div>
                <div class='row-fluid' style="padding-bottom:15px;">
                    <div class="icons"><span id='post' tip="Table columns" class="yellow" onClick="table_cells('example')"></span>
                        <table cellpadding='0px' cellspacing='0px' class="table_head">
                            <tr>
                                <td><span id='mailto' tip="Send as Mail" class="yellow" onClick="mailto('example_table')"></span></td>
                                <td><span id='tech' tip='Technical Names' class="yellow" onClick="tech('example')"></span></td>
                                <td><span id='sumr' tip="Sum of Netvalues" class="yellow" onClick="ssum('example')"></span></td>
                                <td class="tab_lit"><span id='sort' tip='Multi Sort' class="yellow" onClick="sorte('example')"></span></td>
                                <td><span id='excel' tip=" &nbsp;Export " class="yellow" onClick="eporte('example_table')"></span></td>
                                <td><span id='filtes1' tip='&nbsp; Filters ' class="yellow" onClick="filtes1('example')"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id='table_today'></div>
                <div class='testr table_today' onClick='getBapitable("table_today","BAPINEWPURCHASEREQ","example","S","nones@<?php echo $s_wid; ?>","Search_purchase_requisition","show_more")'><?php Controller::customize_label(_SHOWMORE); ?></div>
                <div id='example_num' style="display:none;">10</div>
            </div>

        </div>
    </div>
</div>
<div id='export_table' style="display:none"></div>
<div id='export_table_view_pdf' style="display:none"></div>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validationEngine-en.js"></script>
<script>
    $(document).ready(function() {
        jQuery("#validation").validationEngine();

    });

    function check_val() {
        $('#table_today').html('');
        getBapitable("table_today", "BAPINEWPURCHASEREQ", "example", "L", "nones@<?php echo $s_wid; ?>", "Search_new_purchase_requisition", "submit");
        $('#body-container').show();
    }

    $(document).ready(function(e) {
        $(".testr").text('');
        $('.search_int').keyup(function() {
            sear($(this).attr('alt'), $(this).val(), $(this).attr('name'))
        })
        data_table('example');
        $('#example').each(function() {
            $(this).dragtable({
                placeholder: 'dragtable-col-placeholder test3',
                items: 'thead th div:not( .notdraggable ):not( :has( .dragtable-drag-handle ) ), .dragtable-drag-handle',
                appendTarget: $(this).parent(),
                tableId: 'example',
                tableSess: 'table_today',
                scroll: true
            });
        })
        var wids = $('.table').width();
        $('.head_icons').css({
            width: wids + 'px'
        });
    });
</script>