<?php //echo get_last_insertid('images');?>
<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> Profile Of <?php echo $datas['pub_name'];?> <?php //echo $datas['JUDUL_PAPER'];?>
                            <div class="pull-right">
                                <!-- <div class="btn-group btn-group-xs"></div> -->
                                    <a href="javascript:history.back()<?php //echo $this->input->server('HTTP_REFERER')?>" class="btn btn-default btn-xs tip" title="Kembali"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
			            <div class="panel-body">
			            	<div class="alert alert-block alert-success">
								<h4><b>General Information</b></h4> 
								<p>&nbsp;</p>
								<div class="form-horizontal">
									<div class="form-group">
										<div class="col-sm-3"><strong>Publisher Name</strong></div>
										<div class="col-sm-9">: <?php echo $datas['pub_name'] == "" ? "-" : $datas['pub_name'];?></div>
									</div>					
									<div class="form-group">
										<div class="col-sm-3"><strong>Characteristics</strong></div>
										<div class="col-sm-9">: <?php echo $datas['pub_profile'] == "" ? "-" : str_replace(",", "<br>", $datas['pub_profile']);?></div>
									</div>
								</div>
							</div>
			            	<div class="alert alert-block alert-info" style="min-height: 390px">
								<h4><b>Page Views</b></h4> 
								<p>&nbsp;</p>
								<div class="form-horizontal">
									<div class="form-group">
										<div class="col-sm-3"><strong>DOI</strong></div>
										<div class="col-sm-9">: <?php echo $datas['DOI'] == "" ? "-" : $datas['DOI'];?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Judul Paper</strong></div>
										<div class="col-sm-9">: <?php echo $datas['JUDUL_PAPER'] == "" ? "-" : $datas['JUDUL_PAPER'];?></div>
									</div>					
									<div class="form-group">
										<div class="col-sm-3"><strong>Penulis</strong></div>
										<div class="col-sm-9">
											<?php
											//echo count($authors);
											if (empty($authors)) {
												echo "-- Penulis belum terdaftar --";
											} else {
												echo '<ul style="padding-left: 15px">';
												foreach ($authors as $id => $val){
													echo '<li>'.$val.' &nbsp;&nbsp;&nbsp; 
														<a href="javascript:void(0)" onclick="del(\''. base_url('panel/authorship/delete/'.$id) .'\',\''. $val .'\')" class="tip-right" title="Hapus"><span class="fa fa-trash-o"></span></a></li>';
												}
												echo '</ul>';
											}
											?>
											<span class="help-block"><a href="#" data-toggle="modal" data-target="#authorModal">Tambah Penulis</a></span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Keyword</strong></div>
										<div class="col-sm-9">: <?php echo empty($str_keywords) ? "-" : implode(", ", $str_keywords);?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Harga</strong></div>
										<div class="col-sm-9">: <?php echo $datas['HARGA'] == 0 ? "-" : $datas['HARGA'];?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Halaman</strong></div>
										<div class="col-sm-9">: <?php echo $datas['HALAMAN'] == "" ? "-" : $datas['HALAMAN'];?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>File Paper</strong></div>
										<?php 
										$upButton = '<button type="button" onclick="window.location=\''.base_url('panel/paper/upload/'.$datas['ID_PAPER']).'\'" class="btn btn-xs btn-warning"><i class="fa fa-upload"></i> Upload New File</button>';
										?>
										<div class="col-sm-9">: <?php echo $datas['FILE_PAPER'] == "" ? $upButton : $datas['FILE_PAPER']."<br>".$upButton;?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Upload Paper Date</strong></div>
										<div class="col-sm-9">: <?php echo $datas['TANGGAL_UPLOAD'] == "0000-00-00" ? "" : date("d-m-Y", strtotime($datas['TANGGAL_UPLOAD']));?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Created Date </strong></div>
										<div class="col-sm-9">: <?php echo date("d-m-Y H:i:s", strtotime($datas['CREATED_DATE']));?></div>
									</div>
									<div class="form-group">
										<div class="col-sm-3"><strong>Published</strong></div>
										<div class="col-sm-9">: <?php echo $datas['PUBLISHED'] == "Y" ? "Yes" : "No";?></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="alert alert-block alert-warning">
										<h4><u>Abstrak Id</u></h4> 
										<p>&nbsp;</p>
										<?php echo $datas['ABSTRAK_ID'] == "" ? "-No Abstrak-" : $datas['ABSTRAK_ID'];?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="alert alert-block alert-warning">
										<h4><u>Abstrak En</u></h4> 
										<p>&nbsp;</p>
										<?php echo $datas['ABSTRAK_EN'] == "" ? "-No Abstrak-" : $datas['ABSTRAK_EN'];?>
									</div>
								</div>
							</div>
                        </div>
						<div class="panel-footer text-center">
							<!-- <button type="button" class="btn btn-primary" onclick="$('#form_inst').submit();">Simpan</button>
							<button type="button" class="btn btn-primary" onclick="alert($('#keyword').val());">Val</button> -->
							<button type="button" class="btn btn-default" onclick="history.back()">Kembali</button>
						</div>
					</div>
                </div>
			</div>
