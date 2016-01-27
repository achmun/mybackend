<?php 
$counter = 1;
$queryString = $_SERVER['QUERY_STRING'] == "" ? "" : "?".$_SERVER['QUERY_STRING'];
?>

			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i> <?php echo $panel_title?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('zones/add').$queryString;?>" class="btn btn-success btn-xs tip" title="Add New"><i class="fa fa-plus"></i></a>
                                    
                                </div>
                            </div>
                        </div>
			            <div class="panel-body">
			            	<?php
								 if($message != ''){
									echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>".$message.
									"</div>";
								 }
							?>
							<?php echo form_open("", array('id'=>'myForm', 'role'=>'form', 'class'=> 'form-inline', 'method'=>'get'));?>
								<div class="form-group">
									<label for="kategori">Publisher</label>
									<?php echo form_dropdown('publisher', $select_publisher, $_REQUEST['publisher'], 'class="publisher" style="width:300px"')?>
								</div>
								<!-- <div class="form-group">
										<button type="submit" class="btn btn-primary btn-sm">View</button>
										<button type="button" class="btn btn-default btn-sm" onclick="window.location='<?php echo base_url('report/monthly');?>'">Clear</button>
								</div> -->
							<?php echo form_close();?>
							<br style="margin-bottom: 20px">
							<?php if (isset($_REQUEST['publisher'])) { ?>
							<div class="table-responsive">
			            	<table class="table table-striped table-bordered table-hover" id="gridtable">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<!-- <th class="text-center">Website</th> -->
										<th class="text-center">Zone Name</th>
										<th class="text-center">Layout</th>
										<th class="text-center">Device</th>
										<th class="text-center">CPC</th>
										<th class="text-center">CPM</th>
										<th class="text-center">CPA</th>
										<th class="text-center">Discount</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php //print_r($list);?>
								<?php if (count($list) > 0){
									foreach ($list as $val){ ?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $counter++; ?></td>
										<!-- <td><?php echo $val->website; ?></td> -->
										<td><?php echo $val->layout_name; ?></td>
										<td><?php echo $val->layout_width.' x '.$val->layout_height; ?></td>
										<td><?php echo $val->device; ?></td>
										<td><?php echo $val->cpm_rate; ?></td>
										<td><?php echo $val->cpc_rate; ?></td>
										<td><?php echo $val->cpa_rate; ?></td>
										<td><?php echo $val->discount; ?></td>
										<td class="text-center">
											<a href="<?php echo base_url('zones/edit/'.$val->id_zone).$queryString;?>" class="btn btn-xs btn-primary tip" title="Edit"><i class="fa fa-pencil"></i></a>
											<a href="javascript:void(0)" onclick="del('<?php echo base_url('zones/delete/'.$val->id_zone).$queryString;?>','<?php echo $val->layout_name;?>')" class="btn btn-xs btn-danger tip" title="Delete"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr>
								<?php } } ?>
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
	$('.publisher').on("select2-selected", function(e) {
		$('#myForm').submit();
	});
	$('.device').select2({
		placeholder : 'Choose Devices...',
		//allowClear : true,
	});
});
</script>
