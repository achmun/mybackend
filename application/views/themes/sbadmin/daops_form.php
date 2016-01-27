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
						<div class="span2">
							<label for="inputTitle">Nama Daops/Non Daops *</label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'nama_daops', 'class'=>'span12', 'value'=>isset($_POST['nama_daops']) ? set_value('nama_daops') : $datas['nama_daops']))?>
						</div>
						<div class="span2">
							<label for="inputTitle">Jenis * <?php //echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span4">
							<?php //echo form_input(array('name' => 'nama_kadaops', 'class'=>'span12', 'value'=>isset($_POST['nama_kadaops']) ? set_value('nama_kadaops') : $datas['nama_kadaops']))?>
							<?php echo form_radio('jenis', '1', ($datas['non_daops'] == 1 ? true : false))?> Daops &nbsp;&nbsp;&nbsp;&nbsp;
							<?php echo form_radio('jenis', '0', ($datas['non_daops'] == 0 ? true : false))?> Non Daops
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Provinsi *</label>
						</div>
						<div class="span4">
							<?php echo form_dropdown('provinsi', get_select_provinsi('Pilih Provinsi'), isset($_POST['provinsi']) ? set_value('provinsi') : $datas['provinsi'], 'class="span12"')?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Nama Kepala <?php //echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span6">
							<?php echo form_input(array('name' => 'nama_kadaops', 'class'=>'span12', 'value'=>isset($_POST['nama_kadaops']) ? set_value('nama_kadaops') : $datas['nama_kadaops']))?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Email <?php //echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'email', 'class'=>'span12', 'value'=>isset($_POST['email']) ? set_value('email') : $datas['email']))?>
						</div>
						<div class="span2">
							<label for="inputTitle">No Telp/HP </label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'telp', 'class'=>'span12', 'value'=>isset($_POST['telp']) ? set_value('telp') : $datas['telp']))?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Alamat <?php //echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span9">
							<?php echo form_input(array('name' => 'alamat', 'class'=>'span10', 'value'=>isset($_POST['alamat']) ? set_value('alamat') : $datas['alamat']))?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Bandara</label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'bandara', 'class'=>'span12', 'value'=>isset($_POST['bandara']) ? set_value('bandara') : $datas['bandara']))?>
						</div>
						<div class="span2">
							<label for="inputTitle">Jarak Tempuh Darat</label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'jarak_tempuh', 'class'=>'span6', 'value'=>isset($_POST['jarak_tempuh']) ? set_value('jarak_tempuh') : $datas['jarak_tempuh']))?>
							<span class="help-inline">KM</span>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
						</div>
						<div class="span4">
						</div>
						<div class="span2">
							<label for="inputTitle">Waktu Tempuh</label>
						</div>
						<div class="span2">
							<?php echo form_input(array('name' => 'waktu_tempuh', 'class'=>'span6', 'value'=>isset($_POST['waktu_tempuh']) ? set_value('waktu_tempuh') : ($datas['waktu_tempuh'] == 0 ? "" : $datas['waktu_tempuh'])))?>
							<span class="help-inline">Jam</span>
						</div>
						<div class="span2">
							<?php echo form_input(array('name' => 'wt_menit', 'class'=>'span6', 'value'=>isset($_POST['wt_menit']) ? set_value('wt_menit') : ($datas['wt_menit'] == 0 ? "" : $datas['wt_menit'])))?>
							<span class="help-inline">Menit</span>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Koordinat Lokasi</label>
						</div>
						<div class="span1">
							<label for="inputTitle">Longitude</label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'long', 'class'=>'span9', 'value'=>isset($_POST['long']) ? set_value('long') : $datas['longitude']))?>
						</div>
						<div class="span1">
							<label for="inputTitle">Latitude</label>
						</div>
						<div class="span4">
							<?php echo form_input(array('name' => 'lat', 'class'=>'span9', 'value'=>isset($_POST['lat']) ? set_value('lat') : $datas['latitude']))?>
						</div>
					</div>
					<?php if ($action == "edit"){?>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Admin Daops *</label>
						</div>
						<div class="span4">
							<?php echo form_dropdown('admin', get_select_user(2, 'Pilih User Admin'), isset($_POST['admin']) ? set_value('admin') : $datas['admin'], 'class="span12"')?>
						</div>
					</div><?php }?>
					<hr class="separator">
					<div>
						<button type="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i>Save</button>
						<button type="button" class="btn btn-icon btn-default glyphicons circle_remove" onclick="window.location='<?php echo base_url('daops')?>'"><i></i>Cancel</button>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
	<!-- // Row END -->

</div>
