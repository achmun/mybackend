<?php
$counter = 1;
$sources = array(
		'3'=>'Google Analytics',
		'2'=>'Metranet Analytics',
		'1'=>'Manual',
);
?>

			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <i class="fa fa-table"></i> <?php echo $panel_title?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <a href="<?php echo base_url('article/add')?>" class="btn btn-success btn-xs tip" title="Add New"><i class="fa fa-plus"></i></a>
                                    
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
										<th width="5%" class="text-center">#</th>
										<th width="30%" class="text-center">Title</th>
										<th width="15%" class="text-center">Subitle</th>
										<th width="35%" class="text-center">Image Url</th>
										<th width="5%" class="text-center">Published</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($list as $val){ ?>
								<?php //$dataParent = $this->sub_kategori_model->get_single_data(array("ID_KATEGORI"=>$val->ID_PARENT))?>
									<tr class="odd gradeX">
										<td class="text-center"><?php echo $counter++; ?></td>
										<td><?php echo $val->title; ?></td>
										<td><?php echo $val->subtitle; ?></td>
										<!-- <td><?php echo $val->content == "" ? "" : substr(htmlentities($val->content), 0,100)."..."; ?></td> -->
										<td><?php echo substr($val->image, 0,50)."..."; ?></td>
										<td class="text-center"><?php echo $val->published == 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'; ?></td>
										<td class="text-center">
											<a href="<?php echo base_url('article/edit/'.$val->id)?>" class="btn btn-xs btn-primary tip" title="Edit"><i class="fa fa-pencil"></i></a>
											<a href="javascript:void(0)" onclick="del('<?php echo base_url('article/delete/'.$val->id)?>','<?php echo $val->title?>')" class="btn btn-xs btn-danger tip" title="Delete"><i class="fa fa-trash-o"></i></a>
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

