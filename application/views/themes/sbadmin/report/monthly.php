<?php $counter = 1;?>
<style>
.table-responsive {width:100%; overflow:auto;}
</style>
			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i> <?php echo $panel_title?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <!--<a href="<?php echo base_url('publisher/add')?>" class="btn btn-success btn-xs tip" title="Add New"><i class="fa fa-plus"></i></a>-->
                                    
                                </div>
                            </div>
                        </div>
			            <div class="panel-body">
			            	<?php
								 if(validation_errors()!=''){
									echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>".validation_errors().$message.
									"</div>";
								 }
							?>
							<?php echo form_open("", array('id'=>'form_inst', 'role'=>'form', 'class'=> 'form-inline'));?>
			            		<div class="form-group" id="periode">
									<label for="kategori">Periode *</label>
									<div class="input-daterange input-group" id="datepicker">
										    <input type="text" class="input-sm form-control monthly" name="start" value="<?php echo set_value('start');?>" />
										    <span class="input-group-addon">to</span>
										    <input type="text" class="input-sm form-control monthly" name="end" value="<?php echo set_value('end');?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="kategori">Publisher</label>
									<?php echo form_dropdown('publisher', $select_publisher, set_value('publisher'), 'class="publisher" style="width:200px"')?>
								</div>
								<div class="form-group">
										<button type="submit" class="btn btn-primary btn-sm">Generate</button>
										<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo base_url('report/monthly');?>'">Clear</button>
								</div>
							<?php echo form_close();?>
							<p style="margin-top: 20px"></p>
							<?php if (!empty($list)){ ?>
							<?php //print_r($statistics); 
							$loop1 = DateTime::createFromFormat("M Y", set_value('start'));
							$date1 = DateTime::createFromFormat("M Y", set_value('start'));
							$startdate = DateTime::createFromFormat("M Y", set_value('start'));
// 							$start = $loop1 = $date1;
// 							echo $start = $date1->format("n");
							$end = $loop2 = $date2 = DateTime::createFromFormat("M Y", set_value('end'));
// 							echo $end = $date2->format("n");
// 							$end = $loop2 = $date2;
							?>
							<?php 
							$datas = array();
							$var_datas = '[';
foreach ($statistics as $k => $v){
	$var_datas .= '{period:"'.$k.'", pv: '.array_sum($v['pv']).', uv: '.array_sum($v['uv']).'},';
	
	$datas[] = array(
			'period' => $k,
			'pv' => array_sum($v['pv']),
			'uv' => array_sum($v['uv']),
			'imp' => array_sum($v['imp']),
			'click' => array_sum($v['click']),
	);
}
$var_datas .= ']';
?>
							<!-- <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div> -->
                            <div id="morris-area-chart"></div>
							<p style="margin-top: 20px"></p>
							<div class="table-responsive">
			            	<table class="table table-striped table-bordered table-hover">
								<thead>
									<!-- <tr>
										<th class="text-center">No</th>
										<th class="text-center">Publisher Name</th>
										<th class="text-center">PV</th>
										<th class="text-center">UV</th>
										<th class="text-center">Impressions</th>
									</tr> -->
									<tr>
										<th class="text-center" rowspan="2">No</th>
										<th class="text-center" rowspan="2">Publisher Name</th>
										<th class="text-center" rowspan="2">Group</th>
										<?php while($date1 <= $date2){ ?>
										<th class="text-center" colspan="3"><?php echo $date1->format('M Y'), PHP_EOL; ?></th>
										<?php $date1 = $date1->add(new DateInterval("P1M")); } ?>
									</tr>
									<tr>
										<?php while($loop1 <= $date2){ ?>
										<th class="text-center">PV</th>
										<th class="text-center">UV</th>
										<th class="text-center">Impressions</th>
										<?php $loop1 = $loop1->add(new DateInterval("P1M")); } ?>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($list as $val){ ?>
								<?php $start = DateTime::createFromFormat("M Y", set_value('start'));?>
									<tr class="">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><?php echo $val['name']; ?></td>
										<td><?php echo $val['group']; ?></td>
										<?php 
										while($start <= $date2){
											 $total_pv[$start->format("n")] += $val['statistics'][$start->format("n")]['pv'];
											 $total_uv[$start->format("n")] += $val['statistics'][$start->format("n")]['uv'];
											 $total_imp[$start->format("n")] += $val['statistics'][$start->format("n")]['imp'];
										?>
										<td class="text-center"><?php echo number_format($val['statistics'][$start->format("n")]['pv'], 0, ",", "."); ?></td>
										<td class="text-center"><?php echo number_format($val['statistics'][$start->format("n")]['uv'], 0, ",", "."); ?></td>
										<td class="text-center"><?php echo number_format($val['statistics'][$start->format("n")]['imp'], 0, ",", "."); ?></td>
										<?php $start = $start->add(new DateInterval("P1M")); } ?>
									</tr>
									
								<?php } ?>
								<tr class="">
										<td class="text-center" colspan="3">Total</td>
										<?php 
										while($startdate <= $date2){
										?>
										<td class="text-center"><?php echo number_format($total_pv[$startdate->format("n")], 0, ",", "."); ?></td>
										<td class="text-center"><?php echo number_format($total_uv[$startdate->format("n")], 0, ",", "."); ?></td>
										<td class="text-center"><?php echo number_format($total_imp[$startdate->format("n")], 0, ",", "."); ?></td>
										<?php $startdate = $startdate->add(new DateInterval("P1M")); } ?>
								</tr>
								</tbody>
							</table>
							</div>
							<?php } ?>
				
                        </div>
                    </div>
                </div>
			</div>

<script>
var urlIssue = '<?php echo base_url().'lookup/issue/'?>';
jQuery(document).ready(function() {
	$('.publisher').select2({
		placeholder : 'Choose Publisher...',
		//allowClear : true,
	});
	$('.device').select2({
		placeholder : 'Choose Devices...',
		//allowClear : true,
	});
});
</script>
<?php if (isset($_POST['start'])){?>
<script>
//var datas = <?php //echo json_encode($datas);?>;
$(function() {
    Morris.Line({
        element: 'morris-area-chart',
        data: <?php echo json_encode($datas);?>,
        xkey: 'period',
        ykeys: ['pv', 'uv', 'imp', 'click'],
        labels: ['Pageview', 'Unique Visitor', 'Impression', 'Click'],
        //pointSize: 0,
        xLabels: 'month',
        hideHover: 'auto',
       	xLabelFormat: function (period) {
            var IndexToMonth = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
            var month = IndexToMonth[ period.getMonth() ];
            var year = period.getFullYear();
            return month + ' ' + year;
        },
        dateFormat: function (x) {
   			var IndexToMonth = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];
            var month = IndexToMonth[ new Date(x).getMonth() ];
            var year = new Date(x).getFullYear();
            return month + ' ' + year;
            //return new Date(x);
        },
        xLabelAngle: 45,
        //xLabelMargin: 50,
   		resize: true
    });

});
</script>
<?php } ?>