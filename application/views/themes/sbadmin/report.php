<?php $counter = 1;?>
			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i> <?php echo $panel_title?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('publisher/add')?>" class="btn btn-success btn-xs tip" title="Add New"><i class="fa fa-plus"></i></a>
                                    
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
										<th class="text-center">Publisher Name</th>
										<th class="text-center">Characteristics</th>
										<th class="text-center">Analytics Source</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($list as $val){ ?>
								<?php //$dataParent = $this->sub_kategori_model->get_single_data(array("ID_KATEGORI"=>$val->ID_PARENT))?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><a href="<?php echo base_url('publisher/view/'.$val->id);?>"><?php echo $val->name; ?></a></td>
										<td><?php echo $val->category; ?></td>
										<td><?php echo $val->analytic_source; ?></td>
										<td class="text-center">
											<a href="<?php echo base_url('publisher/edit/'.$val->id)?>" class="btn btn-xs btn-primary tip" title="Edit"><i class="fa fa-pencil"></i></a>
											<a href="javascript:void(0)" onclick="del('<?php echo base_url('publisher/delete/'.$val->id)?>','<?php echo $val->pub_name?>')" class="btn btn-xs btn-danger tip" title="Delete"><i class="fa fa-trash-o"></i></a>
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

