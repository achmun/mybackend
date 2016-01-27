<?php 
$settings = $this->config->item('site_settings');
$path_view = $settings['path_view'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->load->view($path_view.'/head')?>
</head>
<body>
	<?php if ($this->session->userdata('uid') == ""){?>
	<?php echo $this->load->view($path_view.'/login')?>
	<?php } else {?>
	<div id="wrapper">
		<?php echo $this->load->view($path_view.'/header')?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{CONTENT_TITLE}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            {CONTENT}
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php } ?>
	<?php echo $this->load->view($path_view.'/script_general')?>
	<?=$JS_SCRIPT;?>	
</body>
</html>
