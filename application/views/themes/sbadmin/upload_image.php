<link href="<?php echo base_url()?>assets/bootstrap/extend/jasny-fileupload/css/fileupload.css" rel="stylesheet">
<script src="<?php echo base_url()?>assets/bootstrap/extend/jasny-fileupload/js/bootstrap-fileupload.js"></script>
<div class="container-960 innerTB">

	<h3 class="margin-none"><?php echo $page_title?></h3>

	<p class="separator text-center">
		<i class="icon-ellipsis-horizontal icon-3x"></i>
	</p>

	<!-- Row -->
	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-body collapse in">
					<?php
					if (validation_errors() != '' || $message != '') {
						echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>" . validation_errors() . $message . "</div>";
					}
					echo form_open_multipart("", array(
						'id' => 'myform',
						'role' => 'form'
					));
					?>
					<!-- <div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Jenis Foto</label>
						</div>
						<div class="span9">
							<?php echo form_dropdown('jenis', array('1'=>'Blueprint', '2'=>'Foto Bangunan'), $jenis, 'class="span6" disabled')?>
						</div>
					</div>
					<div class="separator-bottom"></div> -->
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Judul Foto *</label>
						</div>
						<div class="span9">
							<?php echo form_input(array('name' => 'judul', 'class'=>'span6', 'value'=>isset($_POST['judul']) ? set_value('judul') : $datas['title']))?>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Foto File</label>
						</div>
						<div class="span9">
							<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
								<input type="hidden">
								<div class="input-append">
									<div class="uneditable-input span3">
										<i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
									</div>
									<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input
										type="file" name="photo" class="margin-none"></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
								</div>
							</div>
							<!-- <input type="file" name="photo" class="margin-none" /> -->
							<p class="help">File yang diperbolehkan : *.jpg; *.png; *.gif (Max. 2Mb)</p>
						</div>
					</div>
					<hr class="separator">
					<div>
						<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok">
							<i></i>Save
						</button>
						<button type="button" class="btn btn-icon btn-default glyphicons circle_remove" onclick="window.location='<?php echo base_url('daops/view/'.$id_daops)?>'">
							<i></i>Cancel
						</button>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
	<!-- // Row END -->

</div>
