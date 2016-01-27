
			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> {panel_title}
                            
                        </div>
			            <div class="panel-body">
			            	<?php
								 if(validation_errors()!=''||$message!=''){
									echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>".validation_errors().$message.
									"</div>";
								 }
							?>
			            	<?php echo form_open_multipart("", array('id'=>'form_inst', 'role'=>'form', 'class'=> 'form-horizontal'));?>
			            		<p class="text-primary">Semua field yang bertanda bintang (*) harus diisi.</p>
			            		<div class="form-group">
									<label class="col-sm-3 control-label">Title <span class="required">*</span></label>
									<div class="col-sm-9">
										<input type="text" name="title" class="form-control" placeholder="Type title..." value="<?php echo isset($_POST['title']) ? set_value('title') : $datas['title'];?>" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Subtitle </label>
									<div class="col-sm-9">
										<input type="text" name="subtitle" class="form-control" placeholder="Type subtitle..." value="<?php echo isset($_POST['subtitle']) ? set_value('subtitle') : $datas['subtitle'];?>" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Content <span class="required">*</span></label>
									<div class="col-sm-9">
										<!--<textarea name="desc" rows="3" class="form-control" placeholder="Type full content..."><?php echo isset($_POST['title']) ? set_value('title') : $datas['title'];?></textarea>-->
										<textarea name="content" class="ckeditor" required><?php echo isset($_POST['content']) ? set_value('content') : $datas['content'];?></textarea>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Content Image <span class="required">*</span></label>
									<div class="col-sm-9">
										<?php if ($action == "edit") { ?>
										<img src="<?php echo $datas['image'];?>" width="500" /><br><br>
										<button type="button" class="btn btn-warning btn-sm" onclick="$('#choice').toggle('fadein')">Change</button>
										<?php } ?><?php //echo set_radio('source_img', "upload");?>
										<div id="choice"<?php echo ($action == "edit") ? " style='display:none;'" : "";?>  >
											<label class="radio-inline"><?php echo form_radio('source_img', "url", set_radio('source_img', "url"), "id='url'");?> URL</label>
											<label class="radio-inline"><?php echo form_radio('source_img', "upload", set_radio('source_img', "upload"), "id='upload'");?> Upload</label>
										</div>
									</div>
								</div>
								<div class="form-group" id="upload-img">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<input type="file" name="img_upload" class="form-control" />
									</div>
								</div>
								<div class="form-group" id="url-img">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<input type="text" name="img_url" class="form-control" placeholder="Type URL Image with http:// or https://..." value="<?php echo isset($_POST['img_url']) ? set_value('img_url') : $datas['imgage'];?>" />
									</div>
								</div>
								<?php if ($action == "edit") { ?>
								<div class="form-group" id="url-img">
									<label class="col-sm-3 control-label">Published</label>
									<div class="col-sm-9">
										<label class="radio-inline"><?php echo form_radio('published', "1", ($datas['published'] == "1" ? TRUE : FALSE));?> Yes</label>
										<label class="radio-inline"><?php echo form_radio('published', "0", ($datas['published'] == "0" ? TRUE : FALSE));?> No</label>
									</div>
								</div>
								<?php } ?>

							<?php echo form_close();?>
				
                        </div>
						<div class="panel-footer text-center">
							<button type="button" class="btn btn-primary" onclick="$('#form_inst').submit();">Save</button>
							<button type="button" class="btn btn-default" onclick="window.location='<?php echo base_url('article')?>'">Cancel</button>
						</div>
					</div>
                </div>
			</div>

<script>
var urlIssue = '<?php echo base_url().'lookup/issue/'?>';
jQuery(document).ready(function() {
	$('.category').select2({
		placeholder : 'Choose Characteristics...',
		allowClear : true,
	});
	$('.adserver').select2({
		placeholder : 'Choose Affiliate Name...',
		allowClear : true,
	});
	// console.log ($('input[name=source_img]:radio').prop('checked'));
	// if ($('input[name=source_img]:radio').val() == 'url') 
	// 	$('#url-img').show(); 
	// else 
	// 	$('#url-img').hide();
	// if ($('input[name=source_img]:radio').val() == 'upload') 
	// 	$('#upload-img').show();
	// else 
	// 	$('#upload-img').hide();
	$('#url-img').hide();
	$('#upload-img').hide();
	$('input[name=source_img]:radio').on('change', function(){
		// console.log('source_img :'+$(this).val());
		if ($(this).val() == 'url') {
			$('#url-img').show('fadein');
			$('#upload-img').hide('fadeout');
		} else {
			$('#upload-img').show('fadein');
			$('#url-img').hide('fadeout');
		}
	});

});
</script>