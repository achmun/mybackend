<?php $counter = 1;?>
			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i> <?php echo $panel_title?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('zones/add')?>" class="btn btn-success btn-xs tip" title="Add New"><i class="fa fa-plus"></i></a>
                                    
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
							<div class="table-responsive">
			            	<table class="table table-striped table-bordered table-hover" id="gridtable">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Website</th>
										<th class="text-center">Device</th>
										<th class="text-center">Layout</th>
										<th class="text-center">CPC</th>
										<th class="text-center">CPM</th>
										<th class="text-center">CPA</th>
										<th class="text-center">Discount</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($list as $val){ ?>
								<?php //$dataParent = $this->sub_kategori_model->get_single_data(array("ID_KATEGORI"=>$val->ID_PARENT))?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><?php echo $val->website; ?></td>
										<td><?php echo $val->device; ?></td>
										<td><?php echo $val->layout_name.' ('.$val->layout_width.' x '.$val->layout_height.')'; ?></td>
										<td><?php echo $val->cpm_rate; ?></td>
										<td><?php echo $val->cpc_rate; ?></td>
										<td><?php echo $val->cpa_rate; ?></td>
										<td><?php echo $val->discount; ?></td>
										<td class="text-center">
											<a href="<?php echo base_url('zones/edit/'.$val->id_pub)?>" class="btn btn-xs btn-primary tip" title="Edit"><i class="fa fa-pencil"></i></a>
											<a href="javascript:void(0)" onclick="del('<?php echo base_url('zones/delete/'.$val->id_pub)?>','<?php echo $val->website?>')" class="btn btn-xs btn-danger tip" title="Delete"><i class="fa fa-trash-o"></i></a>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
							</div>
				
                        </div>
                    </div>
                </div>
			</div>

