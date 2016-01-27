<?php //echo get_last_insertid('images');?>
<div class="container-960 innerTB">

	<h3 class="margin-none"><?php echo $page_title?></h3>

	<p class="separator text-center">
		<i class="icon-ellipsis-horizontal icon-3x"></i>
	</p>

	<!-- Row -->
	<div class="row-fluid">
		<div class="span6">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons more_items">
						<i></i>Informasi
					</h4>
				</div>
				<div class="widget-body collapse in">
					<div class="row-fluid">
						<div class="span4">
							<label for="inputTitle">Nama Daops :</label>
						</div>
						<div class="span8">
							<?php echo $datas['nama_daops'] == "" ? "-" : $datas['nama_daops'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span4">
							<label for="inputTitle">Provinsi :</label>
						</div>
						<div class="span8">
							<?php echo $datas['provinsi'] == "0" ? "-" : get_nama_provinsi($datas['provinsi']);?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span4">
							<label for="inputTitle">Bandara :</label>
						</div>
						<div class="span8">
							<?php echo $datas['bandara'] == "" ? "-" : $datas['bandara'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span4">
							<label for="inputTitle">Jarak Tempuh Darat :</label>
						</div>
						<div class="span8">
							<?php echo $datas['jarak_tempuh'] == "0" ? "-" : $datas['jarak_tempuh'].' KM';?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span4">
							<label for="inputTitle">Waktu Tempuh :</label>
						</div>
						<div class="span8">
							<?php echo $datas['waktu_tempuh'] == "0" ? "" : $datas['waktu_tempuh']. ' Jam';?>
							<?php echo $datas['wt_menit'] == "0" ? "" : $datas['wt_menit']. ' Menit';?>
							<?php echo $datas['waktu_tempuh'] == 0 && $datas['wt_menit'] == 0 ? "-" : ""?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="span6">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons more_items">
						<i></i>Profil
					</h4>
				</div>
				<div class="widget-body collapse in">
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Nama Kadaops :</label>
						</div>
						<div class="span9">
							<?php echo $datas['nama_kadaops'] == "" ? "-" : $datas['nama_kadaops'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Email :</label>
						</div>
						<div class="span9">
							<?php echo $datas['email'] == "" ? "-" : $datas['email'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">No Telp/HP :</label>
						</div>
						<div class="span9">
							<?php echo $datas['telp'] == "" ? "-" : $datas['telp'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Alamat :<?php //echo $action == "add" ? "*" : "";?></label>
						</div>
						<div class="span9">
							<?php echo $datas['alamat'] == "" ? "-" : $datas['alamat'];?>
						</div>
					</div>
					<div class="separator bottom"></div>
					<div class="row-fluid">
						<div class="span3">
							<label for="inputTitle">Jenis Daops :</label>
						</div>
						<div class="span9">
							<?php echo jenis_daops($datas['non_daops']);?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons more_items">
						<i></i>Koordinat Lokasi
					</h4>
				</div>
				<div class="widget-body collapse in">
					<div class="row-fluid">
						<div class="span2">
							<label for="inputTitle">Longitude :</label>
						</div>
						<div class="span4">
							<?php echo $datas['longitude'] == "" ? "-" : $datas['longitude'];?>
						</div>
						<div class="span2">
							<label for="inputTitle">Latitude :</label>
						</div>
						<div class="span4">
							<?php echo $datas['latitude'] == "" ? "-" : $datas['latitude'];?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons more_items">
						<i></i>Blueprint
					</h4>
					<?php if ($this->session->userdata('idlevel') != "3"){?><a href="<?php echo base_url('upload/blueprint/'.$datas['id_daops'])?>" class="btn btn-mini btn-primary pull-right" title="Upload Picture"><i class="icon-picture"></i>&nbsp; Upload Blueprint</a><?php }?>
				</div>
				<div class="widget-body collapse in">
					<div class="row-fluid">
						<?php if (count($blueprint) > 0){?>
						<ul class="thumbnails center">
						<?php foreach ($blueprint as $val){ //echo $settings['media_basedir'] . $settings['media_blueprint'] . '/' . $val->img_file;?>
							<li class="span2">
							<?php if ($this->session->userdata('idlevel') != "3"){?><a href="javascript:del('<?php echo base_url('daops/delete_images/'.$val->id)?>','<?php echo $val->img_name?>')">Hapus</a><?php }?>
							<?php if (file_exists($settings['media_basedir'] . $settings['media_blueprint'] . '/' . $val->img_file)){?>
								<a href="<?php echo base_url('media/blueprint/'.$val->img_file)?>" class="thumbnail" target="_blank"><img src="<?php echo base_url('media/blueprint/'.$val->img_file)?>" alt="<?php echo $val->img_name?>" /></a>
							<?php } else { ?>
								<a href="#" class="thumbnail"><img data-src="holder.js/100%x120" alt="<?php echo $val->img_name?>" /></a>
							<?php } ?>
							</li>
						<?php } ?>
						</ul>
						<?php } else { ?>
						<p class="center">- Tidak ada gambar Blueprint -</p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons more_items">
						<i></i>Foto Bangunan 
					</h4>
					<?php if ($this->session->userdata('idlevel') != "3"){?><a href="<?php echo base_url('upload/bangunan/'.$datas['id_daops'])?>" class="btn btn-mini btn-primary pull-right" title="Upload Picture"><i class="icon-picture"></i>&nbsp; Upload Foto</a><?php }?>
				</div>
				<div class="widget-body collapse in">
					<div class="row-fluid">
						<?php if (count($bangunan) > 0){?>
						<ul class="thumbnails center">
						<?php foreach ($bangunan as $val){ //echo $settings['media_basedir'] . $settings['media_blueprint'] . '/' . $val->img_file;?>
							<li class="span2">
							<?php if ($this->session->userdata('idlevel') != "3"){?><a href="javascript:del('<?php echo base_url('daops/delete_images/'.$val->id)?>','<?php echo $val->img_name?>')">Hapus</a><?php }?>
							<?php if (file_exists($settings['media_basedir'] . $settings['media_photo'] . '/' . $val->img_file)){?>
								<a href="<?php echo base_url($settings['media_photo'].'/'.$val->img_file)?>" class="thumbnail" target="_blank"><img src="<?php echo base_url($settings['media_photo'].'/'.$val->img_file)?>" alt="<?php echo $val->img_name?>" /></a>
							<?php } else { ?>
								<a href="#" class="thumbnail"><img data-src="holder.js/100%x120" alt="<?php echo $val->img_name?>" /></a>
							<?php } ?>
							</li>
						<?php } ?>
						</ul>
						<?php } else { ?>
						<p class="center">- Tidak ada gambar Foto Bangunan -</p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // Row END -->

</div>
