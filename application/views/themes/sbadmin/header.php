<?php
// 		$levelusers = $this->session->userdata('level');
// 		$userid = $this->session->userdata('uid');
// 		$levels = explode(",", $levels);
		//print_r($levels);
		//$datas = $this->users_model->get_usrlevel(array('ID_USER'=>$userid));
		?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>" style="padding: 10px 15px;">My Backend</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       <!-- <i class="fa fa-user fa-fw"></i> --> <?php echo $this->session->userdata('name'); //. " (".get_level_name($levelusers).")" ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('panel/profil')?>"><i class="fa fa-user fa-fw"></i> User Profile</a></li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <?php /*foreach ($levels as $val){?>
                        <li<?php echo $val == $levelusers ? ' class="active"' : ''; ?>>
                        	<a<?php echo $val == $levelusers ? '': ' href="#" onclick="confirmation(\''.base_url('panel/switch_level/'.url_title(get_level_name($val), '-', TRUE)).'\', \'Anda yakin akan mengganti Level menjadi '.get_level_name($val).'?\')"';?>><i class="fa <?php echo $val == $levelusers ? 'fa-check-square-o' : 'fa-square-o'; ?> fa-fw"></i> <?php echo get_level_name($val);?></a></li>
                        <?php }*/?>
<!--                         <li class="divider"></li> -->
                        <li><a href="<?php echo base_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a <?php echo $menu_a_active == "dashboard" ? 'class="active" ' : '' ?>href="<?php echo base_url()?>"><i class="fa fa-home fa-fw"></i> Home</a><?php //echo $this->session->userdata('level');?>
                        </li>
                        <?php if ($this->session->userdata('idlevel') == 1) {?>
                        <li>
                            <a <?php echo $menu_a_active == "article" ? 'class="active" ' : '' ?>href="<?php echo base_url('article')?>"><i class="fa fa-globe fa-fw"></i> Article</a>
                        </li>
                        <li>
                            <a <?php echo $menu_a_active == "candidate" ? 'class="active" ' : '' ?>href="<?php echo base_url('candidate')?>"><i class="fa fa-globe fa-fw"></i> Candidate</a>
                        </li>
                        <li<?php echo $menu_li_active == "report" ? ' class="active"' : '' ?>>
                            <!-- <a <?php echo $menu_a_active == "report" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/pageviews')?>"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a> -->
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a <?php echo $menu_a_active == "pubrate" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/pubrate')?>">Publisher Rate Card</a></li>
                                <li><a <?php echo $menu_a_active == "publisher" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/publisher')?>">Publisher Traffics</a></li>
                                <li><a <?php echo $menu_a_active == "custom" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/custom')?>">Custom Report</a></li>
                                <li><a <?php echo $menu_a_active == "monthly" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/monthly')?>">Monthly</a></li>
                                <!-- <li><a <?php echo $menu_a_active == "weekly" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/weekly')?>">Weekly</a></li>
                                <li><a <?php echo $menu_a_active == "daily" ? 'class="active" ' : '' ?>href="<?php echo base_url('report/daily')?>">Daily</a></li> -->
                                
                            </ul>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="<?php echo base_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
