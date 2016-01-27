<?php $counter = 1;?>
<div class="container-960 innerTB">

	<h3 class="margin-none"><?php echo $page_title?></h3>

	<p class="separator text-center"><i class="icon-ellipsis-horizontal icon-3x"></i></p>

	<!-- Row -->
	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons <?php echo $action == "add" ? "circle_plus" : "edit";?>">
						<i></i><?php echo $panel_title?>
					</h4>
				</div>
				<div class="widget-body collapse in">
					<?php
					if (validation_errors() != '') {
						echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>" . validation_errors() . $message . "</div>";
					}
					echo form_open("", array(
						'id' => 'myform',
						'role' => 'form'
					));
					?>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Nama Lengkap *</label>
						</div>
						<div class="span9">
							<?php echo form_input(array('name' => 'name', 'class'=>'span6', 'value'=>isset($_POST['name']) ? set_value('name') : $datas['name']))?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Username *</label>
						</div>
						<div class="span9">
							<?php
							$attributes = array('name' => 'username', 'class'=>'span6', 'value'=>isset($_POST['username']) ? set_value('username') : $datas['username']);
							if ($action == "edit") $attributes['readonly'] = 'readonly';
							echo form_input($attributes);
							?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Password <?php echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span9">
							<?php echo form_password(array('name' => 'password', 'class'=>'span6', 'value'=>set_value('password')))?>
							<span class="help-inline">Kosongkan jika tidak ingin merubah password</span>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Konfirmasi Password <?php echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span9">
							<?php echo form_password(array('name' => 'password2', 'class'=>'span6', 'value'=>set_value('password2')))?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Level *</label>
						</div>
						<div class="span9">
							<?php //echo form_input(array('name' => 'level', 'class'=>'span6', 'value'=>isset($_POST['provinsi']) ? set_value('provinsi') : $datas['nama_provinsi']))?>
							<?php echo form_dropdown('level', get_level_name(null, 'Pilih Level'), isset($_POST['level']) ? set_value('level') : $datas['level'], 'class="span6"')?>
						</div>
					</div>
					<hr class="separator">
					<div>
						<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
						<button type="button" class="btn btn-icon btn-default glyphicons circle_remove" onclick="window.location='<?php echo base_url('user')?>'"><i></i>Cancel</button>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
	<!-- // Row END -->

</div>
