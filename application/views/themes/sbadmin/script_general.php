
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/admin/js/bootstrap.min.js')?>"></script>
   <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/admin/js/plugins/metisMenu/metisMenu.min.js')?>"></script>
	
    <!-- DataTables JavaScript -->
<script src="<?php echo base_url('assets/admin/js/plugins/dataTables/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('assets/admin/js/plugins/dataTables/dataTables.bootstrap.js')?>"></script>
    
    <!-- SELECT2 -->
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/select2/select2.min.js')?>"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url('assets/bootstrap/extend/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
	
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/ckeditor/ckeditor.js')?>"></script>
    
    <!-- BOOTBOX -->
	<script type="text/javascript" src="<?php echo base_url('assets/admin/js/plugins/bootbox/bootbox.min.js')?>"></script>
    <!-- Custom Theme JavaScript -->

   <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/admin/js/sb-admin-2.js')?>"></script>
    
	
<!-- Tables - Use for all grid table  -->
<script>
   	$(document).ready(function() {
   	   	//var selected = [];
   	   	$('#gridtable').dataTable({
        	"aoColumnDefs": [{"bSortable": false, "aTargets": [-1, -2,-3,-4,-5]}],
          //"scrollX" : true,
        	sDom: "<'row'<'dataTables_header clearfix'<'col-md-6'l><'col-md-6'Tf>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>",
        });
        $('.input-daterange input').datepicker({
        	//$(this).datepicker({
        		format: "M yyyy",
                startView: 1,
                minViewMode: 1,
                autoclose: true
        	//});
        });
        /*$('.input-daterange .monthly').each(function (){
        	$(this).datepicker({
        		format: "M yyyy",
                startView: 1,
                minViewMode: 1,
                autoclose: true
        	});
        });*/
    });
    
   	function del(url, title){
   	   	item = title == null ? "ini" : "'"+title+"'";
   	   	//Anda akan menghapus data ini. Semua data constraint (yang saling terkait) terhadap data ini juga akan terhapus. Anda yakin akan melanjutkan?
   		bootbox.confirm("Anda yakin akan menghapus data "+item+"?", function(result){
   			if (result) window.location = url;
   		});
   	}
   	function confirmation(url, msg){
   	   	bootbox.confirm(msg, function(result){
   			if (result) window.location = url;
   		});
   	}
</script>
