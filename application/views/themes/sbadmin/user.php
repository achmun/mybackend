<?php $counter = 1;?>
<div class="container-960 innerTB">

	<h3 class="margin-none"><?php echo $page_title?></h3>

	<p class="separator text-center"><i class="icon-ellipsis-horizontal icon-3x"></i></p>

	<!-- Row -->
	<div class="row-fluid">
		<div class="span12">
			<div class="widget widget-heading-simple widget-body-gray">
				<div class="widget-head">
					<h4 class="heading glyphicons list">
						<i></i><?php echo $panel_title?>
					</h4>
					<a href="<?php echo base_url('user/add')?>" class="btn btn-mini btn-success pull-right" title="Tambah"><i class="icon-plus"></i></a>
				</div>
				<div class="widget-body">
					<?php
					if ($message != '') {
						echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
									href='#' aria-hidden='true'>&times;</a>" . $message . "</div>";
					}
					?>
			         <div class="table-responsive">

						<table class="table table-striped table-bordered table-condensed table-white" id="gridtable">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">Username</th>
									<th class="text-center">Level</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($list as $val){ ?>
								<tr>
									<td class="center"><?php echo $counter++; ?></td>
									<td><?php echo $val->name; ?></td>
									<td><?php echo $val->username; ?></td>
									<td><?php echo get_level_name($val->level); ?></td>
									<td class="center">
										<a href="<?php echo base_url('user/edit/'.$val->uid)?>" class="btn btn-mini btn-primary tip" title="Edit"><i
											class="icon-pencil"></i></a> 
										<a href="javascript:void(0)" onclick="del('<?php echo base_url('user/delete/'.$val->uid)?>','<?php echo $val->name?>')"
										class="btn btn-mini btn-danger tip" title="Hapus"><i class="icon-trash"></i></a></td>
								</tr>
								<?php } ?>
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- // Row END -->

</div>

<script>
$(document).ready(function() {
    $('#gridtable').dataTable({
    	"aoColumnDefs": [{"bSortable": false, "aTargets": [-1]}],
    	//"pagingType": "simple",
    	"sPaginationType": "bootstrap",
    	"iDisplayLength": 25, "aLengthMenu": [10,25,50,100], /* for adjust your display rows */
    	//sDom: "<'row'<'dataTables_header clearfix'<'col-md-6'l><'col-md-6'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>",
    	/*"rowCallback": function( row, data ) {
            if ( $.inArray(data.DT_RowId, selected) !== -1 ) {
                $(row).addClass('selected');
            }
        }*/
    });
});
</script>