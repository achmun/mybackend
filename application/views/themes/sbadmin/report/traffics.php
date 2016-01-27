<?php $counter = 1;
$type = $_POST['type'];
?>
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
									<label for="kategori">Type</label>
									<?php echo form_dropdown('type', array('pv'=>'Page Views','uv'=>'Unique View','imp'=>'Impression'), $_POST['type'], 'class="type" style="width:150px"')?>
								</div>
								<div class="form-group">
									<label for="kategori">Group</label>
									<?php echo form_dropdown('group', array('' => '', 'Internal'=>'Internal','External'=>'External'), $_POST['group'], 'class="group" style="width:120px"')?>
								</div>
								<div class="form-group">
										<button type="submit" class="btn btn-primary btn-sm">Generate</button>
										<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo base_url('report/monthly');?>'">Clear</button>
								</div>
							<?php echo form_close();?>
							<p style="margin-top: 20px"></p>
							<?php if (!empty($list)){ ?>
							<?php 
							//print_r($statistics); 
							//print_r($list); 
							$loop1 = DateTime::createFromFormat("M Y", set_value('start'));
							$date1 = DateTime::createFromFormat("M Y", set_value('start'));
							$startdate = DateTime::createFromFormat("M Y", set_value('start'));
// 							$start = $loop1 = $date1;
// 							echo $start = $date1->format("n");
							$end = $loop2 = $date2 = DateTime::createFromFormat("M Y", set_value('end'));
// 							echo $end = $date2->format("n");
// 							$end = $loop2 = $date2;
							foreach ($publisher as $row){
								$yKeys[] = $row->id;
								$yLabel[] = $row->name;
							}
print_r($list);
							$datas = array();
							foreach ($statistics as $k => $v){
								$data = array(
										'period' => $k
								);
								foreach ($publisher as $row){
									$data[$row->id] = $v[$row->name];
								}
								$datas[] = $data;
							}
							?>
							<!-- <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart"></div>
                            </div> -->
                            <?php print_r($datas);?>
                            <div id="morris-area-chart"></div>
						<?php } ?>	
                    </div>
                </div>
			</div>

<script>
var urlIssue = '<?php echo base_url().'lookup/issue/'?>';
jQuery(document).ready(function() {
	$('.publisher').select2({
		placeholder : 'All Publisher...',
		//allowClear : true,
	});
	$('.type').select2({
		placeholder : 'Choose Type...',
		//allowClear : true,
	});
	$('.group').select2({
		placeholder : 'All Group...',
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
        ykeys: ['<?php echo implode("','", $yKeys);?>'],
        labels: ['<?php echo implode("','", $yLabel);?>'],
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