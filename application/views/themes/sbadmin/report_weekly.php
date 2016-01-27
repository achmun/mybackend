<?php $counter = 1;

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
								 if($message != ''){
									echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>".$message.
									"</div>";
								 }
							?>
							<?php echo form_open("", array('id'=>'form_inst', 'role'=>'form', 'class'=> 'form-horizontal'));?>
			            		<div class="form-group">
									<label for="kategori" class="col-sm-3 control-label">Start Date *</label>
									<div class="col-sm-9">
										<?php echo form_input(array('name'=>'startdate', 'type'=>'date', 'value'=> isset($_POST['startdate']) ? $_POST['startdate'] : set_value('startdate'), 'class'=>'form-control'))?>
									</div>
								</div>
								<div class="form-group">
									<label for="kategori" class="col-sm-3 control-label">End Date *</label>
									<div class="col-sm-9">
										<?php echo form_input(array('name'=>'enddate', 'type'=>'date', 'value'=> isset($_POST['enddate']) ? $_POST['enddate'] : set_value('enddate'), 'class'=>'form-control'))?>
									</div>
								</div>
								<div class="form-group">
									<label for="kategori" class="col-sm-3 control-label">Month *</label>
									<div class="col-sm-3">
										<?php echo form_dropdown('month', get_month(), isset($_POST['month']) ? $_POST['month'] : set_value('month'), 'class="form-control col-md-3"')?>
									</div>
									<div class="col-sm-3">
										<?php echo form_dropdown('year', array('2014'=>'2014', '2015'=>'2015'), isset($_POST['year']) ? $_POST['year'] : set_value('year'), 'class="form-control col-md-3"')?>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Parent Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Tahun *</label>
									<div class="col-sm-9">
										<?php echo form_dropdown('year', array('2014'=>'2014', '2015'=>'2015'), set_value('year'), 'class="form-control col-md-12"')?>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">&nbsp;</label>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary">Generate Report</button>
										<button type="button" class="btn btn-default" onclick="window.location='<?php echo base_url('report/pageviews')?>'">Clear</button>
									</div>
								</div>
							<?php echo form_close();?>
							<?php if (!empty($list)){ ?>
							<?php //print_r($list); ?>
							<div class="table-responsive">
			            	<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center">No</th>
										<th class="text-center">Publisher Name</th>
										<th class="text-center">PV</th>
										<th class="text-center">UV</th>
									</tr>
								</thead>
								<tbody>
									<tr class="">
										<td colspan="4">Internal</td>
									</tr>
								<?php foreach ($list['Internal'] as $val){ ?>
								<?php //$dataParent = $this->sub_kategori_model->get_single_data(array("ID_KATEGORI"=>$val->ID_PARENT))?>
									<tr class="">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><?php echo $val['publisher_name']; ?></td>
										<td><?php echo number_format($val['pageviews'], 0, ",", "."); ?></td>
										<td><?php echo number_format($val['users'], 0, ",", "."); ?></td>
										
									</tr>
								<?php } ?>
								<tr class="">
										<td colspan="4">External</td>
									</tr>
								<?php foreach ($list['External'] as $val){ ?>
									<tr class="">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><?php echo $val['publisher_name']; ?></td>
										<td><?php echo number_format($val['pageviews'], 0, ",", "."); ?></td>
										<td><?php echo number_format($val['users'], 0, ",", "."); ?></td>
										
									</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>
							<?php } ?>
				
                        </div>
                    </div>
                </div>
			</div>

