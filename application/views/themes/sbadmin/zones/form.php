<?php 
$profiles = array(
		'National News'=>'National News',
		'International News'=>'International News',
		'Technology'=>'Technology',
		'Business & Economy'=>'Business & Economy',
		'Entertainment'=>'Entertainment',
		'Sports'=>'Sports',
		'Automotive'=>'Automotive',
		'Travel'=>'Travel',
		'Property'=>'Property',
		'Culinary'=>'Culinary',
		'E-commerce'=>'E-commerce',
		'Lifestyle'=>'Lifestyle',
		'Youth'=>'Youth'
);

$devices = array(
		''=>'',
		'Desktop' => 'Desktop',
		'Mobile' => 'Mobile',
);
$queryString = $_SERVER['QUERY_STRING'] == "" ? "" : "?".$_SERVER['QUERY_STRING'];
?>
			<div class="row">
				<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-edit"></i> <?php echo $panel_title?>
                            
                        </div>
			            <div class="panel-body">
			            	<?php
								 if(validation_errors()!=''){
									echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>".validation_errors().$message.
									"</div>";
								 }
							?>
			            	<?php echo form_open("", array('id'=>'form_inst', 'role'=>'form', 'class'=> 'form-horizontal'));?>
<!-- 			            		<p class="text-primary">(*) is required.</p> -->
								<div class="form-group">
									<?php //echo form_label('Parent Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Publisher *</label>
									<div class="col-sm-9">
										<?php //echo form_input(array('name' => 'jenis', 'class'=>'form-control', 'value'=>$datas['JENIS_INSTITUSI'] == "" ? set_value('jenis') : $datas['JENIS_INSTITUSI']))?>
										<?php echo form_dropdown('publisher', $select_publisher, $datas['id_pub'], 'class="publisher col-md-12"');?>
									</div>
								</div>
								
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Zone Name *</label>
									<div class="col-xs-9">
										<?php echo form_input(array('name' => 'layout_name', 'class'=>'form-control', 'value'=>isset($_POST['layout_name']) ? set_value('layout_name') : $datas['layout_name']))?>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Layout Size *</label>
									<div class="col-xs-2">
										<div class="input-group">
											<?php echo form_input(array('name' => 'width', 'class'=>'form-control', 'placeholder'=>'Width', 'value'=>isset($_POST['width']) ? set_value('width') : $datas['layout_width']))?>
											<span class="input-group-addon" id="basic-addon2">px</span> 
										</div>
									</div>
									<div class="col-xs-2">
										<div class="input-group">
											<?php echo form_input(array('name' => 'height', 'class'=>'form-control', 'placeholder'=>'Height', 'value'=>isset($_POST['height']) ? set_value('height') : $datas['layout_height']))?>
											<span class="input-group-addon" id="basic-addon2">px</span> 
										</div>
									</div>
								</div>
								<?php if ($action == "edit"){ ?>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Adserver Zone ID *</label>
									<div class="col-xs-9">
										<?php echo form_dropdown('ox_zone', $select_zone, $datas['ox_zone_id'], 'class="ox_zone col-md-12"')?>
									</div>
								</div>
								<?php } ?>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Targeted Device *</label>
									<div class="col-xs-3">
										<?php echo form_dropdown('device', $devices, $datas['device'], 'class="device col-md-12"')?>
									</div>
								</div>
								
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Standart Banner</label>
									<div class="col-sm-6">
										<?php echo form_textarea(array('name' => 'standart', 'class'=>'form-control', 'rows'=>'2', 'value'=>isset($_POST['standart']) ? set_value('standart') : $datas['standart']))?>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Price CPM *</label>
									<div class="col-xs-3">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Rp.</span> 
											<?php echo form_input(array('name' => 'cpm', 'class'=>'form-control uang', 'value'=>isset($_POST['cpm']) ? set_value('cpm') : $datas['cpm_rate']))?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Price CPC *</label>
									<div class="col-xs-3">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Rp.</span> 
											<?php echo form_input(array('name' => 'cpc', 'class'=>'form-control uang', 'value'=>isset($_POST['cpc']) ? set_value('cpc') : $datas['cpc_rate']))?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Price CPA *</label>
									<div class="col-xs-3">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Rp.</span> 
											<?php echo form_input(array('name' => 'cpa', 'class'=>'form-control uang', 'value'=>isset($_POST['cpa']) ? set_value('cpa') : $datas['cpa_rate']))?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Max Discount *</label>
									<div class="col-xs-3">
										<div class="input-group">
											<?php echo form_input(array('name' => 'discount', 'class'=>'form-control', 'value'=>isset($_POST['discount']) ? set_value('discount') : $datas['discount']))?>
											<span class="input-group-addon" id="basic-addon1">%</span> 
										</div>
									</div>
								</div>
								<!-- <div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Terbitkan</label>
									<div class="col-sm-9">
										<label class="radio-inline"><?php echo form_radio('published', "Y", ($datas['PUBLISHED'] == "Y" || $datas['PUBLISHED'] == "" ? TRUE : FALSE));?> Ya</label>
										<label class="radio-inline"><?php echo form_radio('published', "N", ($datas['PUBLISHED'] == "N" ? TRUE : FALSE));?> Tidak</label>
									</div>
								</div> -->
								
								<?php /*?><div class="form-group">
									<?php //echo form_label('Nama Sub Kategori', 'sub_kategori', array('class'=>"col-sm-3 control-label"))?>
									<label for="kategori" class="col-sm-3 control-label">Institusi/Kampus</label>
									<div class="col-sm-9">
										<?php echo form_input(array('name' => 'institusi', 'class'=>'form-control', 'readonly'=>'readonly', 'value'=>$datas['ID_INSTITUSI'] == "" ? set_value('kodepos') : NamaInstitusi($datas['ID_INSTITUSI'])))?>
									</div>
								</div><?php */?>
							<?php echo form_close();?>
				
                        </div>
						<div class="panel-footer text-center">
							<button type="button" class="btn btn-primary" onclick="$('#form_inst').submit();">Save</button>
							<button type="button" class="btn btn-default" onclick="window.location='<?php echo base_url('zones').$queryString;?>'">Cancel</button>
						</div>
					</div>
                </div>
			</div>

<script>
var urlIssue = '<?php echo base_url().'lookup/issue/'?>';
jQuery(document).ready(function() {
	$('.publisher').select2({
		placeholder : 'All Publisher...',
		//allowClear : true,
	});
	$('.device').select2({
		placeholder : 'Choose Devices...',
		//allowClear : true,
	});
	$('.ox_zone').select2({
		placeholder : 'Choose Devices...',
		//allowClear : true,
	}).prop('disabled', true);
	<?php if ($action == "edit"){ ?>
	// $('.publisher').prop('readonly', true);
	$('.publisher').on('select2-open', function(e) {
    	e.preventDefault();
    	$(this).select2('close');
	});
	<?php } ?>
});
</script>