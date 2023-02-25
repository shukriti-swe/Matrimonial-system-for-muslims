<div class="fluid">
	<div class="fixed-fluid">
		<div class="fluid">
			<?php if (!empty(validation_errors())): ?>
                <div class="widget" id="profile_error">
                    <div style="border-bottom: 1px solid #e6e6e6;">
                        <div class="card-title" style="padding: 0.5rem 1.5rem; color: #fcfcfc; background-color: #de1b1b; border-top-right-radius:0.25rem; border-top-left-radius:0.25rem;">You <b>Must Provide</b> the Information(s) bellow</div>
                        <div class="card-body" style="padding: 0.5rem 1.5rem; background: rgba(222, 27, 27, 0.10);">
                            <style>
                                #profile_error p {
                                    color: #DE1B1B !important; margin: 0px !important; font-size: 12px !important;
                                }
                            </style>
                            <?= validation_errors();?>
                        </div>
                    </div>
                </div>
            <?php
                endif;
            ?>
			<form id="edit_profile_form" class="form-default" role="form" action="<?=base_url()?>admin/members/update_member/<?=$value->member_id?>/<?=$parameter?>" method="POST">
				<div class="panel">
					<div class="panel-body">
						<!--Dark Panel-->
				        <!--===================================================-->
				        <div class="pull-right">
							<button class="btn btn-primary btn-sm btn-labeled fa fa-floppy-o" type="submit"><?php echo translate('update')?></button>
						</div>

				        <div class="text-left">
				        	<h4>Member ID - <?=$value->display_member?></h4>
				        </div>

				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('introduction')?></h3>
				            </div>
				            <div class="panel-body">
				            	<textarea name="introduction" class="form-control no-resize" rows="6"><?php if(!empty($form_contents)){echo $form_contents['introduction'];} else{echo $value->introduction;}?></textarea>
				            </div>
				        </div>

				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">PROFILE</h3>
				            </div>
				            <div class="panel-body">
				            	<div class='clearfix'>
	                            </div>
				               <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('first_name')?></label>
                        <input type="text" class="form-control no-resize" name="first_name" value="<?php if(!empty($form_contents)){echo $form_contents['first_name'];} else{echo $value->first_name;}?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="last_name" class="text-uppercase c-gray-light"><?php echo translate('last_name')?></label>
                        <input type="text" class="form-control no-resize" name="last_name" value="<?php if(!empty($form_contents)){echo $form_contents['last_name'];} else{echo $value->last_name;}?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="age" class="text-uppercase c-gray-light">Age (Auto calculated from date of birth)</label>
                        <input disabled type="text" class="form-control no-resize" name="age" value="<?=(date('Y') - date('Y', $value->date_of_birth))?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="email" class="text-uppercase c-gray-light"><?php echo translate('email')?></label>
                        <input type="hidden" name="old_email" value="">
                        <input type="email" class="form-control no-resize" name="email" value="<?php if(!empty($form_contents)){echo $form_contents['email'];} else{echo $value->email;}?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
			<div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_name" class="text-uppercase c-gray-light"><?php echo translate('gender')?></label>
                          <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['gender'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('gender', 'gender', 'name', 'edit', 'form-control form-control-sm selectpicker', $value->gender, '', '', '');
	                                            }
	                                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="profession" class="text-uppercase c-gray-light">Profession</label>
						<?php
                            echo $this->Crud_model->select_html('profession', 'profession', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['profession'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="date_of_birth" class="text-uppercase c-gray-light">Born </label>
                        <input type="date" class="form-control no-resize" name="date_of_birth" value="<?php if(!empty($form_contents)){echo $form_contents['date_of_birth'];} else{echo date('Y-m-d', $value->date_of_birth);}?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
               <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="residence" class="text-uppercase c-gray-light">Residence</label>
						<?php

                                echo $this->Crud_model->select_html('country', 'residence', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $basic_info[0]['residence'], '', '', '');

                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="my_sect" class="text-uppercase c-gray-light">My Sect</label>
                         <?php
                            echo $this->Crud_model->select_html('sect', 'my_sect', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['my_sect'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="resident_status" class="text-uppercase c-gray-light">Resident Status</label>
                        <?php
                            echo $this->Crud_model->select_html('resident_status', 'resident_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['resident_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="grew_up" class="text-uppercase c-gray-light">Grew Up</label>
                        <?php

                                echo $this->Crud_model->select_html('country', 'grew_up', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $basic_info[0]['grew_up'], '', '', '');

                            ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="like_to_marry" class="text-uppercase c-gray-light">Like To Marry</label>
                        <?php
                            echo $this->Crud_model->select_html('like_to_marry', 'like_to_marry', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['like_to_marry'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
			 <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="mobile" class="text-uppercase c-gray-light">Phone</label>
                        <input type="hidden" name="old_mobile" value="<?=$value->mobile?>">
                        <input type="text" class="form-control no-resize phone_mask" aria-describedby="text-feet" name="mobile" value="<?=$value->mobile?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="first_language" class="text-uppercase c-gray-light">1st Language</label>
                        <?php
                            echo $this->Crud_model->select_html('language', 'first_language', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['first_language'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
			<div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="marital_status" class="text-uppercase c-gray-light">Marital Status</label>
                        <?php
                            echo $this->Crud_model->select_html('marital_status', 'marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['marital_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="Disabilities" class="text-uppercase c-gray-light">Disabilities</label>
                        <?php
                            echo $this->Crud_model->select_html('dissablities', 'Disabilities', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['Disabilities'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
			<div class="row">
                 <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="living_with" class="text-uppercase c-gray-light">Living With</label>
                        <?php
                            echo $this->Crud_model->select_html('living_with', 'living_with', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['living_with'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                        <label for="profile_made" class="text-uppercase c-gray-light">Profile Made</label>
						<?php
                            echo $this->Crud_model->select_html('on_behalf', 'profile_made', 'name', 'edit', 'form-control form-control-sm selectpicker', $basic_info[0]['profile_made'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
				            </div>
				        </div>
				        <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('present_address')?></h3>
				            </div>
				            <div class="panel-body">
				            	<div class='clearfix'>
	                            </div>
				                <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="country" class="text-uppercase c-gray-light"><?php echo translate('country')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $form_contents['country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker present_country_f_edit', $present_address[0]['country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="state" class="text-uppercase c-gray-light"><?php echo translate('state')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($present_address[0]['country'])) {
	                                                if (!empty($present_address[0]['state'])) {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', $present_address[0]['state'], 'country_id', $present_address[0]['country'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', '', 'country_id', $present_address[0]['country'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['country'])){
	                                                if (!empty($form_contents['state'])) {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', $form_contents['state'], 'country_id', $form_contents['country'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'state', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_f_edit', '', 'country_id', $form_contents['country'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker present_state_f_edit" name="state">
	                                                    <option value=""><?php echo translate('choose_a_country_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
	                                        <?php
	                                            if (!empty($present_address[0]['state'])) {
	                                                if (!empty($present_address[0]['city'])) {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', $present_address[0]['city'], 'state_id', $present_address[0]['state'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', '', 'state_id', $present_address[0]['state'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['state'])){
	                                                if (!empty($form_contents['city'])) {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', $form_contents['city'], 'state_id', $form_contents['state'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('city', 'city', 'name', 'edit', 'form-control form-control-sm selectpicker present_city_f_edit', '', 'state_id', $form_contents['state'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker present_city_f_edit" name="city">
	                                                    <option value=""><?php echo translate('choose_a_state_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="postal_code" class="text-uppercase c-gray-light"><?php echo translate('postal-Code')?></label>
	                                        <input type="text" class="form-control no-resize" name="postal_code" value="<?php if(!empty($form_contents)){echo $form_contents['postal_code'];} else{echo $present_address[0]['postal_code'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'education_and_career'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">  EDUCATION AND CAREER</h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="highest_education" class="text-uppercase c-gray-light">Education</label>
                         <?php
                            echo $this->Crud_model->select_html('education', 'highest_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['highest_education'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="i_am_employed" class="text-uppercase c-gray-light">I am Employed</label>
                        <input type="text" class="form-control no-resize" name="i_am_employed" value="<?=$education_and_career[0]['i_am_employed']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="my_job_title" class="text-uppercase c-gray-light">My Job Title</label>
                        <input type="text" class="form-control no-resize" name="my_job_title" value="<?=$education_and_career[0]['my_job_title']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
			<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="my_company_name" class="text-uppercase c-gray-light">My Company's Name</label>
                        <input type="text" class="form-control no-resize" name="my_company_name" value="<?=$education_and_career[0]['my_company_name']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo translate('annual_income')?> </label>

                         <?php
                            echo $this->Crud_model->select_html('annual_income', 'annual_income', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['annual_income'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="years_worked" class="text-uppercase c-gray-light">Years Worked</label>
						<?php
                            echo $this->Crud_model->select_html('years', 'years_worked', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['years_worked'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
			    <div class="row">
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="self_employed" class="text-uppercase c-gray-light">I am Self Employed</label>
						<?php
                            echo $this->Crud_model->select_html('yes_no', 'self_employed', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['self_employed'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="annual_income_self" class="text-uppercase c-gray-light">Anmual Income </label>
						 <?php
                            echo $this->Crud_model->select_html('annual_income', 'annual_income_self', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['annual_income_self'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="years_owned" class="text-uppercase c-gray-light">Years Owned</label>
						<?php
                            echo $this->Crud_model->select_html('years', 'years_owned', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career[0]['years_owned'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">HOW I LOOK</h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                             <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>
                        <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="height" value="<?php if(!empty($form_contents)){echo $form_contents['height'];} else{echo $value->height;}?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="exercise" class="text-uppercase c-gray-light">I EXERCISE</label>
                        <?php
                            echo $this->Crud_model->select_html('i_exercise', 'exercise', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes[0]['exercise'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color')?></label>
                         <?php
                            echo $this->Crud_model->select_html('eye_color', 'eye_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes[0]['eye_color'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="hair_color" class="text-uppercase c-gray-light"><?php echo translate('hair_color')?></label>
                        <?php
                            echo $this->Crud_model->select_html('hair_color', 'hair_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes[0]['hair_color'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				 <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion')?></label>
                        <?php
                            echo $this->Crud_model->select_html('complexion', 'complexion', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes[0]['complexion'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
                        <?php
                            echo $this->Crud_model->select_html('body_type', 'body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes[0]['body_type'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('language')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother_tongue" class="text-uppercase c-gray-light"><?php echo translate('mother_tongue')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('language', 'mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['mother_tongue'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('language', 'mother_tongue', 'name', 'edit', 'form-control form-control-sm selectpicker', $language[0]['mother_tongue'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="language" class="text-uppercase c-gray-light"><?php echo translate('language')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['language'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $language[0]['language'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="speak" class="text-uppercase c-gray-light"><?php echo translate('speak')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('language', 'speak', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['speak'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('language', 'speak', 'name', 'edit', 'form-control form-control-sm selectpicker', $language[0]['speak'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="read" class="text-uppercase c-gray-light"><?php echo translate('read')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('language', 'read', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['read'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('language', 'read', 'name', 'edit', 'form-control form-control-sm selectpicker', $language[0]['read'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'hobbies_and_interests'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('hobbies_&_interest')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="hobby" class="text-uppercase c-gray-light"><?php echo translate('hobby')?></label>
	                                        <input type="text" class="form-control no-resize" name="hobby" value="<?php if(!empty($form_contents)){echo $form_contents['hobby'];} else{echo $hobbies_and_interest[0]['hobby'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="interest" class="text-uppercase c-gray-light"><?php echo translate('interest')?></label>
	                                        <input type="text" class="form-control no-resize" name="interest" value="<?php if(!empty($form_contents)){echo $form_contents['interest'];} else{echo $hobbies_and_interest[0]['interest'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="music" class="text-uppercase c-gray-light"><?php echo translate('music')?></label>
	                                        <input type="text" class="form-control no-resize" name="music" value="<?php if(!empty($form_contents)){echo $form_contents['music'];} else{echo $hobbies_and_interest[0]['music'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="books" class="text-uppercase c-gray-light"><?php echo translate('books')?></label>
	                                        <input type="text" class="form-control no-resize" name="books" value="<?php if(!empty($form_contents)){echo $form_contents['books'];} else{echo $hobbies_and_interest[0]['books'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="movie" class="text-uppercase c-gray-light"><?php echo translate('movie')?></label>
	                                        <input type="text" class="form-control no-resize" name="movie" value="<?php if(!empty($form_contents)){echo $form_contents['movie'];} else{echo $hobbies_and_interest[0]['movie'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="tv_show" class="text-uppercase c-gray-light"><?php echo translate('TV_show')?></label>
	                                        <input type="text" class="form-control no-resize" name="tv_show" value="<?php if(!empty($form_contents)){echo $form_contents['tv_show'];} else{echo $hobbies_and_interest[0]['tv_show'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="sports_show" class="text-uppercase c-gray-light"><?php echo translate('sports_show')?></label>
	                                        <input type="text" class="form-control no-resize" name="sports_show" value="<?php if(!empty($form_contents)){echo $form_contents['sports_show'];} else{echo $hobbies_and_interest[0]['sports_show'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="fitness_activity" class="text-uppercase c-gray-light"><?php echo translate('fitness_activity')?></label>
	                                        <input type="text" class="form-control no-resize" name="fitness_activity" value="<?php if(!empty($form_contents)){echo $form_contents['fitness_activity'];} else{echo $hobbies_and_interest[0]['fitness_activity'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="cuisine" class="text-uppercase c-gray-light"><?php echo translate('cuisine')?></label>
	                                        <input type="text" class="form-control no-resize" name="cuisine" value="<?php if(!empty($form_contents)){echo $form_contents['cuisine'];} else{echo $hobbies_and_interest[0]['cuisine'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="dress_style" class="text-uppercase c-gray-light"><?php echo translate('dress_style')?></label>
	                                        <input type="text" class="form-control no-resize" name="dress_style" value="<?php if(!empty($form_contents)){echo $form_contents['dress_style'];} else{echo $hobbies_and_interest[0]['dress_style'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'personal_attitude_and_behavior'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('personal_attitude_&_behavior')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="affection" class="text-uppercase c-gray-light"><?php echo translate('affection')?></label>
	                                        <input type="text" class="form-control no-resize" name="affection" value="<?php if(!empty($form_contents)){echo $form_contents['affection'];} else{echo $personal_attitude_and_behavior[0]['affection'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="humor" class="text-uppercase c-gray-light"><?php echo translate('humor')?></label>
	                                        <input type="text" class="form-control no-resize" name="humor" value="<?php if(!empty($form_contents)){echo $form_contents['humor'];} else{echo $personal_attitude_and_behavior[0]['humor'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="political_view" class="text-uppercase c-gray-light"><?php echo translate('political_view')?></label>
	                                        <input type="text" class="form-control no-resize" name="political_view" value="<?php if(!empty($form_contents)){echo $form_contents['political_view'];} else{echo $personal_attitude_and_behavior[0]['political_view'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="religious_service" class="text-uppercase c-gray-light"><?php echo translate('religious_service')?></label>
	                                        <input type="text" class="form-control no-resize" name="religious_service" value="<?php if(!empty($form_contents)){echo $form_contents['religious_service'];} else{echo $personal_attitude_and_behavior[0]['religious_service'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'residency_information'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('residency_information')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="birth_country" class="text-uppercase c-gray-light"><?php echo translate('birth_country')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'birth_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['birth_country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'birth_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information[0]['birth_country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="residency_country" class="text-uppercase c-gray-light"><?php echo translate('residency_country')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'residency_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['residency_country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'residency_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information[0]['residency_country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="citizenship_country" class="text-uppercase c-gray-light"><?php echo translate('citizenship_country')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'citizenship_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['citizenship_country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'citizenship_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information[0]['citizenship_country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="grow_up_country" class="text-uppercase c-gray-light"><?php echo translate('grow_up_country')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'grow_up_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['grow_up_country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'grow_up_country', 'name', 'edit', 'form-control form-control-sm selectpicker', $residency_information[0]['grow_up_country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="immigration_status" class="text-uppercase c-gray-light"><?php echo translate('immigration_status')?></label>
	                                        <input type="text" class="form-control no-resize" name="immigration_status" value="<?php if(!empty($form_contents)){echo $form_contents['immigration_status'];} else{echo $residency_information[0]['immigration_status'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('spiritual_&_social_background')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="religion" class="text-uppercase c-gray-light"><?php echo translate('religion')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker present_religion_f_edit', $form_contents['religion'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker present_religion_f_edit', $spiritual_and_social_background[0]['religion'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="caste" class="text-uppercase c-gray-light"><?php echo translate('caste')?></label>
	                                        <?php
	                                            if (!empty($spiritual_and_social_background[0]['religion'])) {
	                                                if (!empty($spiritual_and_social_background[0]['caste'])) {
	                                                    echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', $spiritual_and_social_background[0]['caste'], 'religion_id', $spiritual_and_social_background[0]['religion'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', '', 'religion_id', $spiritual_and_social_background[0]['religion'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['religion'])){
	                                                if (!empty($form_contents['caste'])) {
	                                                    echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', $form_contents['caste'], 'religion_id', $form_contents['religion'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('caste', 'caste', 'caste_name', 'edit', 'form-control form-control-sm selectpicker present_caste_f_edit', '', 'religion_id', $form_contents['religion'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker present_caste_f_edit" name="caste">
	                                                    <option value=""><?php echo translate('choose_a_religion_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6" id="">
	                                    <div class="form-group has-feedback">
	                                        <label for="sub_caste" class="text-uppercase c-gray-light"><?php echo translate('sub_caste')?></label>
	                                        <?php
	                                            if (!empty($spiritual_and_social_background[0]['caste'])) {
	                                                if (!empty($spiritual_and_social_background[0]['sub_caste'])) {
	                                                    echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', $spiritual_and_social_background[0]['sub_caste'], 'caste_id', $spiritual_and_social_background[0]['caste'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', '', 'caste_id', $spiritual_and_social_background[0]['caste'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['caste'])){
	                                                if (!empty($form_contents['sub_caste'])) {
	                                                    echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', $form_contents['sub_caste'], 'caste_id', $form_contents['caste'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('sub_caste', 'sub_caste', 'sub_caste_name', 'edit', 'form-control form-control-sm selectpicker present_sub_caste_f_edit', '', 'caste_id', $form_contents['caste'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker present_sub_caste_f_edit" name="sub_caste">
	                                                    <option value=""><?php echo translate('choose_a_caste_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="ethnicity" class="text-uppercase c-gray-light"><?php echo translate('ethnicity')?></label>
	                                        <input type="text" class="form-control no-resize" name="ethnicity" value="<?php if(!empty($form_contents)){echo $form_contents['ethnicity'];} else{echo $spiritual_and_social_background[0]['ethnicity'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="personal_value" class="text-uppercase c-gray-light"><?php echo translate('personal_value')?></label>
	                                        <input type="text" class="form-control no-resize" name="personal_value" value="<?php if(!empty($form_contents)){echo $form_contents['personal_value'];} else{echo $spiritual_and_social_background[0]['personal_value'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="family_value" class="text-uppercase c-gray-light"><?php echo translate('family_value')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_value_f_edit', $form_contents['family_value'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('family_value', 'family_value', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_value_f_edit', $spiritual_and_social_background[0]['family_value'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="community_value" class="text-uppercase c-gray-light"><?php echo translate('community_value')?></label>
	                                        <input type="text" class="form-control no-resize" name="community_value" value="<?php if(!empty($form_contents)){echo $form_contents['community_value'];} else{echo $spiritual_and_social_background[0]['community_value'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="family_status" class="text-uppercase c-gray-light"><?php echo translate('family_status')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_status_f_edit', $form_contents['family_status'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('family_status', 'family_status', 'name', 'edit', 'form-control form-control-sm selectpicker present_family_status_f_edit', $spiritual_and_social_background[0]['family_status'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="u_manglik" class="text-uppercase c-gray-light"><?php echo translate('manglik')?></label>

	                                        <select name="u_manglik" class="form-control form-control-sm selectpicker" data-placeholder="Choose a manglik" tabindex="2" data-hide-disabled="true">
	                                            <option value="">Choose one</option>
	                                            <option value="1" <?php if($u_manglik==1){ echo 'selected';} ?>>Yes</option>
	                                            <option value="2" <?php if($u_manglik==2){ echo 'selected';} ?>>No</option>
	                                            <option value="3" <?php if($u_manglik==3){ echo 'selected';} ?>>I don't know</option>
	                                        </select>
	                                        <!-- <?php
	                                            echo $this->Crud_model->select_html('decision', 'manglik', 'name', 'edit', 'form-control form-control-sm selectpicker', $spiritual_and_social_background[0]['manglik'], '', '', '');
	                                        ?> -->
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors"></div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
				        <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'life_style'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('life_style')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="diet" class="text-uppercase c-gray-light"><?php echo translate('diet')?></label>
	                                        <input type="text" class="form-control no-resize" name="diet" value="<?php if(!empty($form_contents)){echo $form_contents['diet'];} else{echo $life_style[0]['diet'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="drink" class="text-uppercase c-gray-light"><?php echo translate('drink')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('decision', 'drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['drink'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('decision', 'drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style[0]['drink'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="smoke" class="text-uppercase c-gray-light"><?php echo translate('smoke')?></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('decision', 'smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $form_contents['smoke'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('decision', 'smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $life_style[0]['smoke'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="living_with" class="text-uppercase c-gray-light"><?php echo translate('living_with')?></label>
	                                        <input type="text" class="form-control no-resize" name="living_with" value="<?php if(!empty($form_contents)){echo $form_contents['living_with'];} else{echo $life_style[0]['living_with'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'astronomic_information'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">MY RELIGION</h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                             <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="muslim_i_am" class="text-uppercase c-gray-light">As a Muslim, I am?</label>
						<?php
                            echo $this->Crud_model->select_html('muslim_i_am', 'muslim_i_am', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['muslim_i_am'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="revert" class="text-uppercase c-gray-light">I am a Revert</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'revert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['revert'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				  <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="convert" class="text-uppercase c-gray-light">I am a Convert</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'convert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['convert'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_fast" class="text-uppercase c-gray-light">Do I Keep Fast?</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'do_i_fast', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['do_i_fast'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_pray" class="text-uppercase c-gray-light">Do I Pray?</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'do_i_pray', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['do_i_pray'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_eat_halal" class="text-uppercase c-gray-light">Do I Eat Halal?</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'do_i_eat_halal', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['do_i_eat_halal'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
			 <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="women_only" class="text-uppercase c-gray-light">For Women Only: Do I Wear Hiijab</label>
						 <?php
                            echo $this->Crud_model->select_html('yes_no', 'women_only', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['women_only'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="wife_wear" class="text-uppercase c-gray-light">For Men Only: I Prefer My Wife To Wear</label>
                        <?php
                            echo $this->Crud_model->select_html('wife_wear', 'wife_wear', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information[0]['wife_wear'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>


            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'permanent_address'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('permanent_address')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="permanent_country" class="text-uppercase c-gray-light"><?php echo translate('country')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($form_contents)) {
	                                                echo $this->Crud_model->select_html('country', 'permanent_country', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_country_f_edit', $form_contents['permanent_country'], '', '', '');
	                                            }
	                                            else {
	                                                echo $this->Crud_model->select_html('country', 'permanent_country', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_country_f_edit', $permanent_address[0]['permanent_country'], '', '', '');
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="permanent_state" class="text-uppercase c-gray-light"><?php echo translate('state')?><span class="text-danger">*</span></label>
	                                        <?php
	                                            if (!empty($permanent_address[0]['permanent_country'])) {
	                                                if (!empty($permanent_address[0]['permanent_state'])) {
	                                                    echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', $permanent_address[0]['permanent_state'], 'country_id', $permanent_address[0]['permanent_country'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', '', 'country_id', $permanent_address[0]['permanent_country'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['permanent_country'])){
	                                                if (!empty($form_contents['permanent_state'])) {
	                                                    echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', $form_contents['permanent_state'], 'country_id', $form_contents['permanent_country'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('state', 'permanent_state', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_state_f_edit', '', 'country_id', $form_contents['permanent_country'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker permanent_state_f_edit" name="permanent_state">
	                                                    <option value=""><?php echo translate('choose_a_country_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="permanent_city" class="text-uppercase c-gray-light"><?php echo translate('city')?></label>
	                                        <?php
	                                            if (!empty($permanent_address[0]['permanent_state'])) {
	                                                if (!empty($permanent_address[0]['permanent_city'])) {
	                                                    echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', $permanent_address[0]['permanent_city'], 'state_id', $permanent_address[0]['permanent_state'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', '', 'state_id', $permanent_address[0]['permanent_state'], '');
	                                                }
	                                            }
	                                            elseif (!empty($form_contents['permanent_state'])){
	                                                if (!empty($form_contents['permanent_city'])) {
	                                                    echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', $form_contents['permanent_city'], 'state_id', $form_contents['permanent_state'], '');
	                                                } else {
	                                                    echo $this->Crud_model->select_html('city', 'permanent_city', 'name', 'edit', 'form-control form-control-sm selectpicker permanent_city_f_edit', '', 'state_id', $form_contents['permanent_state'], '');
	                                                }
	                                            }
	                                            else {
	                                            ?>
	                                                <select class="form-control form-control-sm selectpicker permanent_city_f_edit" name="permanent_city">
	                                                    <option value=""><?php echo translate('choose_a_state_first')?></option>
	                                                </select>
	                                            <?php
	                                            }
	                                        ?>
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="permanent_postal_code" class="text-uppercase c-gray-light"><?php echo translate('postal-Code')?></label>
	                                        <input type="text" class="form-control no-resize" name="permanent_postal_code" value="<?php if(!empty($form_contents)){echo $form_contents['permanent_postal_code'];} else{echo $permanent_address[0]['permanent_postal_code'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'family_information'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title"><?php echo translate('family_information')?></h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="father" class="text-uppercase c-gray-light"><?php echo translate('father')?></label>
	                                        <input type="text" class="form-control no-resize" name="father" value="<?php if(!empty($form_contents)){echo $form_contents['father'];} else{echo $family_info[0]['father'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="mother" class="text-uppercase c-gray-light"><?php echo translate('mother')?></label>
	                                        <input type="text" class="form-control no-resize" name="mother" value="<?php if(!empty($form_contents)){echo $form_contents['mother'];} else{echo $family_info[0]['mother'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row">
	                                <div class="col-md-6">
	                                    <div class="form-group has-feedback">
	                                        <label for="brother_sister" class="text-uppercase c-gray-light"><?php echo translate('brother_/_sister')?></label>
	                                        <input type="text" class="form-control no-resize" name="brother_sister" value="<?php if(!empty($form_contents)){echo $form_contents['brother_sister'];} else{echo $family_info[0]['brother_sister'];}?>">
	                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	                                        <div class="help-block with-errors">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'additional_personal_details'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">A LITTLE ABOUT ME</h3>
				            </div>
				            <div class="panel-body">
				                <div class='clearfix'>
	                            </div>
	                              <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="born_at" class="text-uppercase c-gray-light">I Was Born At</label>
							<?php

                                echo $this->Crud_model->select_html('country', 'born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $additional_personal_details[0]['born_at'], '', '', '');

                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="want_children" class="text-uppercase c-gray-light">I Want Children</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'want_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['want_children'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_smoke" class="text-uppercase c-gray-light">Do I Smoke</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no_seldom', 'do_i_smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['do_i_smoke'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="grew_up_in" class="text-uppercase c-gray-light">I Grew Up In</label>
                        <?php
                            echo $this->Crud_model->select_html('country', 'grew_up_in', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['grew_up_in'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="have_children" class="text-uppercase c-gray-light">I Have Children</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['have_children'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_drink" class="text-uppercase c-gray-light">Do I Drink</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no_seldom', 'do_i_drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['do_i_drink'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="my_hobbies" class="text-uppercase c-gray-light">My Hobbies</label>
                        <input type="text" class="form-control no-resize" name="my_hobbies" value="<?=$additional_personal_details[0]['my_hobbies']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="believe_in_polygamy" class="text-uppercase c-gray-light">I Believe In Polygamy</label>
                         <?php
                            echo $this->Crud_model->select_html('yes_no', 'believe_in_polygamy', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details[0]['believe_in_polygamy'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <?php
	                        if ($this->db->get_where('frontend_settings', array('type' => 'partner_expectation'))->row()->value == "yes") {
	                    ?>
				        <div class="panel panel-dark">
				            <div class="panel-heading">
				                <h3 class="panel-title">PARTNER EXPECTATION</h3>
				            </div>
				            <div class="panel-body">
				               <div class='clearfix'>
	                            </div>
	                           <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_caste" class="text-uppercase c-gray-light">Sect</label>
						 <?php
                            echo $this->Crud_model->select_html('sect', 'partner_caste', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_caste'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age')?></label>
						 <?php
                            echo $this->Crud_model->select_html('age_range', 'partner_age', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_age'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>
                        <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="partner_height" value="<?=$partner_expectation[0]['partner_height']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_marital_status" class="text-uppercase c-gray-light"><?php echo translate('marital_status')?></label>
                        <?php
                            echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_marital_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
				</div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession')?></label>
						<?php
                            echo $this->Crud_model->select_html('profession', 'partner_profession', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_profession'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_education" class="text-uppercase c-gray-light"><?php echo translate('education')?></label>
						<?php
                            echo $this->Crud_model->select_html('education', 'partner_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_education'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_nationality" class="text-uppercase c-gray-light">Nationality</label>
						<?php

                                echo $this->Crud_model->select_html('country', 'partner_nationality', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation[0]['partner_nationality'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
				</div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_country_of_residence" class="text-uppercase c-gray-light"><?php echo translate('country_of_residence')?></label>
                        <?php
                            echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_country_of_residence'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_resident_status" class="text-uppercase c-gray-light">Resident Status</label>
                        <?php
                            echo $this->Crud_model->select_html('resident_status', 'partner_resident_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_resident_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>

			<div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_any_disability" class="text-uppercase c-gray-light"><?php echo translate('any_disability')?></label>
						<?php
                            echo $this->Crud_model->select_html('dissablities', 'partner_any_disability', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_any_disability'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_have_children" class="text-uppercase c-gray-light">Have Children</label>
						<?php
                            echo $this->Crud_model->select_html('yes_no', 'partner_have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_have_children'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_children_how_many" class="text-uppercase c-gray-light">If Yes, How Many</label>
                        <input type="text" class="form-control no-resize" name="partner_children_how_many" value="<?=$partner_expectation[0]['partner_children_how_many']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
			<div class="row">
               <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
						<?php
                            echo $this->Crud_model->select_html('body_type', 'partner_body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation[0]['partner_body_type'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_born_at" class="text-uppercase c-gray-light">Born At</label>
<?php

                                echo $this->Crud_model->select_html('country', 'partner_born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation[0]['partner_born_at'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_1_language" class="text-uppercase c-gray-light">1st Language</label>
						<?php

                                echo $this->Crud_model->select_html('language', 'partner_1_language', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation[0]['partner_1_language'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
				            </div>
				        </div>
				        <?php
	                        }
	                    ?>
	                    <div class="panel-footer text-center">
							<button class="btn btn-primary btn-sm btn-labeled fa fa-floppy-o" type="submit"><?php echo translate('update')?></button>
						</div>
					</div>
				</div>
			</form>
		</div><script>
    $(document).ready(function(){
        $(".height_mask").inputmask({
            mask: "9'9\"",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>
	</div>
</div>