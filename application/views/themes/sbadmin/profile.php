<?php
$id         = $profile['ID_USER'];
$email      = $profile['EMAIL_USER'];
$firstName  = $profile['NAME_FIRST'];
$midName    = $profile['NAME_MID'];
$lastName   = $profile['NAME_LAST'];
$nohp       = $profile['NOHP_USER'];
$pekerjaan  = $profile['PEKERJAAN'];
$bidangKeahlian = $profile['BIDANG_KEAHLIAN'];
$webUser    = $profile['WEB_USER'];

$fieldFName = ($mode=='v') ? $firstName : form_input(array('name' => 'firstName', 'class'=>'form-control', 'value'=>$firstName));
?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">            
            <div class="panel-body" style="padding-top: 25px;">
                <form id="formProfil" role="form" class="" method="post" action="">
                <?php
                    if(validation_errors()!='' || $error){
                           echo "<div class='alert alert-danger'><a class='close' data-dismiss='alert' 
                           href='#' aria-hidden='true'>&times;</a>".validation_errors().$message.
                           "</div>";
                    }
                ?>
                <?php if($success) : ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?=$message?>
                    </div>
                <?php endif; ?>
                <?php //echo form_hidden('id',$id);?>
                    <div class="col-sm-12">
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                                <label for="firstName" class="col-sm-3 control-label">Full Name</label>
                                <div class="col-sm-8">
                                        <div class="col-xs-4" style="padding-left: 0px;"><?=$field['NAME_FIRST']?></div>
                                        <div class="col-xs-4" style="padding-left: 0px;"><?=$field['NAME_MID']?></div>
                                        <div class="col-xs-4" style="padding-left: 0px;"><?=$field['NAME_LAST']?></div>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Phone Number</label>
                                <div class="col-sm-8"><?=$field['NOHP_USER']?></div>
                        </div>
                        <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Occupation</label>
                                <div class="col-sm-8"><?=$field['PEKERJAAN']?></div>
                        </div>
                        <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Expertise</label>
                                <div class="col-sm-8"><?=$field['BIDANG_KEAHLIAN']?>
                                        <span class="help-block">If more than one, separate them with a semicolon ";" </span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Personal Website</label>
                                <div class="col-sm-8"><?=$field['WEB_USER']?></div>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
<!--                    <div class="col-lg-6">
                            <div class="form-group">
                                    <label for="lastName" class="col-sm-4 control-label">Institusi</label>
                                    <div class="col-sm-8">
                                            <?php echo form_input(array('name' => 'institusi', 'class'=>'form-control', 'value'=>NamaInstitusi($profile['ID_INSTITUSI']), 'readonly'=>'readonly'))?>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="firstName" class="col-sm-4 control-label">Level Pengguna</label>
                                    <div class="col-sm-8">
                                            <?php echo form_input(array('name' => 'level', 'class'=>'form-control', 'value'=>$this->session->userdata('level_name'), 'disabled'=>'disabled'))?>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="firstName" class="col-sm-4 control-label">Email</label>
                                    <div class="col-sm-8">
                                            <?php echo form_input(array('name' => 'email', 'class'=>'form-control', 'value'=>$email, 'disabled'=>'disabled'))?>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="middleName" class="col-sm-4 control-label">Password Lama</label>
                                    <div class="col-sm-8">
                                            <?php echo form_password(array('name' => 'oldPassword', 'class'=>'form-control'))?>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="lastName" class="col-sm-4 control-label">Password Baru</label>
                                    <div class="col-sm-8">
                                            <?php echo form_password(array('name' => 'newPassword', 'class'=>'form-control'))?>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="lastName" class="col-sm-4 control-label">Ulang Password Baru</label>
                                    <div class="col-sm-8">
                                            <?php echo form_password(array('name' => 'confNewPassword', 'class'=>'form-control'))?>
                                    </div>
                            </div>
                    </div>-->
                </form>
                                <!-- <div id="flip-scroll">
                                        <table class="table">
                                                <tr>
                                                        <td>Email</td>
                                                        <td>:</td>
                                                        <td><?php echo $email?></td>
                                                </tr>
                                                <tr>
                                                        <td>Nama Lengkap</td>
                                                        <td>:</td>
                                                        <td><?php echo $firstName?> <?php echo $midName?> <?php echo $lastName?></td>
                                                </tr>
                                                <tr>
                                                        <td>No. HP</td>
                                                        <td>:</td>
                                                        <td><?php echo $nohp?></td>
                                                </tr>
                                                <tr>
                                                        <td>Pekerjaan</td>
                                                        <td>:</td>
                                                        <td><?php echo $pekerjaan?></td>
                                                </tr>
                                                <tr>
                                                        <td>Bidang Keahlian</td>
                                                        <td>:</td>
                                                        <td><?php echo $bidangKeahlian?></td>
                                                </tr>
                                                <tr>
                                                        <td>Website Personal</td>
                                                        <td>:</td>
                                                        <td><?php echo $webUser?></td>
                                                </tr>
                                        </table>
                                </div> -->

                                <!-- Modal -->
                <div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Profil</h4>
                            </div>
                            <div class="modal-body">

                                                                    </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
            <div class="panel-footer">
                <button class="btn btn-primary" onclick="$('#formProfil').submit();">Save Change</button>
            </div>
        </div>
    </div>
</div>

			