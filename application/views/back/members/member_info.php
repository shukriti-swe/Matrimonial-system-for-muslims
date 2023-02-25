<div class="fluid">
	<div class="fixed-fluid">
		<div class="fluid">
			<div class="panel">
				<div class="panel-body">
					<!--Dark Panel-->
			        <!--===================================================-->
			        <div class="pull-right">
						<a href="<?=base_url()?>admin/members/<?=$parameter?>/edit_member/<?=$value->member_id?>" class="btn btn-primary btn-sm btn-labeled fa fa-edit" type="button"><?php echo translate('edit')?></a>
					</div>

			        <div class="text-left">
			        	<h4>Member ID - <?=$value->display_member?></h4>
			        </div>
			       
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title">INTRODUCTION</h3>
			            </div>
			            <div class="panel-body">
			                <p><?=$value->introduction?></p>
			            </div>
			        </div>			
			        		
			        <div class="panel panel-dark">
			            <div class="panel-heading">
			                <h3 class="panel-title">PROFILE</h3>
			            </div>
			            <div class="panel-body">
			                <table class="table table-condenced">
							     <tbody>
						<tr>
                            <td class="td-label">
                                <span><?php echo translate('age')?></span>
                            </td>
                            <td>
                                <?php
                                    $calculated_age = (date('Y') - date('Y', $value->date_of_birth));
                                    echo $calculated_age;
                                ?>
                            </td>
							
							<td class="td-label">
                                <span>Profession</span>
                            </td>
                            <td>
                               <?=$this->Crud_model->get_type_name_by_id('profession', $basic_info[0]['profession'])?>
                            </td>
                            
                        </tr>
						<tr>
							
							<td class="td-label">
                                <span><?php echo translate('gender')?></span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('gender', $value->gender)?>
                            </td>
														<td class="td-label">
                                <span>Residence</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('country', $basic_info[0]['residence'])?>
                            </td>
                           
                        </tr>
						<tr>
							<td class="td-label">
                                <span>Resident Status</span>
                            </td>
                            <td>
                                 <?=$this->Crud_model->get_type_name_by_id('resident_status', $basic_info[0]['resident_status'])?>
                            </td>
                           
							<td class="td-label">
                                <span>Profile Made</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('on_behalf', $basic_info[0]['profile_made'])?>
                            </td>
                        </tr>
						<tr>							
							<td class="td-label">
                                <span>My Sect</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('sect', $basic_info[0]['my_sect'])?>                               
                            </td>
							<td class="td-label">
                                <span>Like To Marry</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('like_to_marry', $basic_info[0]['like_to_marry'])?> 
                            </td>
                           
                        </tr>
						<tr>							
							<td class="td-label">
                                <span>Grew Up</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('state', $basic_info[0]['grew_up']);?>
                            </td>
							<td class="td-label">
                                <span>1st Language</span>
                            </td>
                            <td>
                               	<?=$this->Crud_model->get_type_name_by_id('language', $basic_info[0]['first_language'])?> 
                            </td>
                           
                        </tr>
						<tr>					
							<td class="td-label">
                                <span><?php echo translate('marital_status')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('marital_status', $basic_info[0]['marital_status'])?>
                            </td>
							<td class="td-label">
                                <span>Disabilities</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('dissablities', $basic_info[0]['Disabilities'])?>
                            </td>
                           
                        </tr>
						<tr>							
							<td class="td-label">
                                <span>Living With</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('living_with', $basic_info[0]['living_with'])?>
							</td>
                           <td class="td-label">
                                <span>Email</span>
                            </td>
                            <td>
							<?=$value->email?>
							</td>
                        </tr>
						<tr>							
						
						
                       
                    </tbody>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('country')?></b>
								</td>
								<td>
                            		<?=$this->Crud_model->get_type_name_by_id('country', $present_address[0]['country']);?>
								</td>
								<td>
									<b><?php echo translate('state')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('state', $present_address[0]['state']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('city')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('city', $present_address[0]['city']);?>
								</td>
								<td>
									<b><?php echo translate('postal-Code')?></b>
								</td>
								<td>
									<?=$present_address[0]['postal_code']?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							    <tbody>
                        <tr>
                            <td class="td-label">
                                <span>my height</span>
                            </td>
                            <td>
                                <?=$value->height?>
                            </td>
                            <td class="td-label">
                                <span>I Exercise</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('i_exercise', $physical_attributes[0]['exercise'])?>
                            </td>
							<td class="td-label">
                                <span>My Eye Color</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('eye_color', $physical_attributes[0]['eye_color'])?>
         
                            </td>
                        </tr>
                        <tr>                           
                            <td class="td-label">
                                <span>My Hair Color</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('hair_color', $physical_attributes[0]['hair_color'])?>
                                
                            </td>
							<td class="td-label">
                                <span>My Complexion</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('complexion', $physical_attributes[0]['complexion'])?>
                            </td>
							 <td class="td-label">
                                <span>My Body Type</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('body_type', $physical_attributes[0]['body_type'])?>
                            </td>
                            
                        </tr>
                        
                    </tbody>
							</table>
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
			                <h3 class="panel-title">EDUCATION AND CAREER</h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							 <tbody>
                        <tr>
                            <td class="td-label">
                                <span>Education</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('education', $education_and_career[0]['highest_education'])?>
         
                            </td>
							<td class="td-label">
                                <span>I am Employed</span>
                            </td>
                            <td>
                                 <?=$education_and_career[0]['i_am_employed']?>
                            </td>
                            <td class="td-label">
                                <span>My Job Title</span>
                            </td>
                            <td>
                                 <?=$education_and_career[0]['my_job_title']?>
                            </td>
                        </tr>
                        <tr>
							<td class="td-label">
                                <span>My Company's Name</span>
                            </td>
                            <td>
                                 <?=$education_and_career[0]['my_company_name']?>
                            </td>
							<td class="td-label">
                                <span><?php echo translate('annual_income')?> $</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('annual_income', $education_and_career[0]['annual_income'])?>
                            </td>
							<td class="td-label">
                                <span>Years Worked</span>
                            </td>
                            <td>
                                <?=$education_and_career[0]['years_worked']?>
                            </td>
                                                       
                        </tr>
						 <tr>
							<td class="td-label">
                                <span>I am Self Employed</span>
                            </td>
                            <td>
                                 <?=$education_and_career[0]['self_employed']?>
                            </td>
							<td class="td-label">
                                <span>Annual Income $</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('annual_income', $education_and_career[0]['annual_income_self'])?>

                            </td>
							<td class="td-label">
                                <span>Years Owned</span>
                            </td>
                            <td>
                                 <?=$education_and_career[0]['years_owned']?>
                            </td>
							                  
                        </tr>
                    </tbody>
							</table>
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
			                <table class="table">
							<tbody>
                        <tr>
                            <td class="td-label">
                                As a Muslim, I am?</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('muslim_i_am', $astronomic_information[0]['muslim_i_am'])?>
                                
                            </td>
                            <td class="td-label">
                                <span>I am a Revert</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['revert'])?>
                             
                            </td>
							 <td class="td-label">
                                <span>I am a Convert</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['convert'])?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span>Do I Keep Fast</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['do_i_fast'])?>
                               
                            </td>
                            <td class="td-label">
                                <span>Do I Pray</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['do_i_pray'])?>
                               
                            </td>
							 <td class="td-label">
                                <span>Do I Eat Halal</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['do_i_eat_halal'])?>
                               
                            </td>
                        </tr>
						  <tr>
                            <td class="td-label">
                                <span>For Women Only:<br/> Do I Wear Hiijab</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information[0]['women_only'])?>
                               
                            </td>
                            <td class="td-label">
                                <span>For Men Only:<br/> I Prefer My Wife To Wear</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('wife_wear', $astronomic_information[0]['wife_wear'])?>
                               
                            </td>
							 
                        </tr>
                    </tbody>
							</table>
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
			                <table class="table">
							<tbody>
                        <tr>
                            <td class="td-label">
                                <span>I Was Born At</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('country', $additional_personal_details[0]['born_at']);?>
                      
                            </td>
                            <td class="td-label">
                                <span>I Want Children</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details[0]['want_children'])?>
                        
                            </td>
							<td class="td-label">
                                <span>Do I Smoke</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no_seldom', $additional_personal_details[0]['do_i_smoke'])?>
                               
                            </td>
                        </tr>
                        <tr>
                            
                            <tr>
                            <td class="td-label">
                                <span>I Grew Up In</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('country', $additional_personal_details[0]['grew_up_in'])?>
                          
                            </td>
                            <td class="td-label">
                                <span>I Have Children</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details[0]['have_children'])?>
                            </td>
							<td class="td-label">
                                <span>Do I Drink</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no_seldom', $additional_personal_details[0]['do_i_drink'])?>
                            </td>
                        </tr>
                              
                            <tr>
                            <td class="td-label">
                                <span>My Hobbies</span>
                            </td>
                            <td>
							
                               <?=$additional_personal_details[0]['my_hobbies']?>
                            </td>
                            <td class="td-label">
                                <span>I Believe In Polygamy</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details[0]['believe_in_polygamy'])?>
                            </td>
							
                        </tr>
                    </tbody>
							</table>
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
			                <h3 class="panel-title"><?php echo translate('partner_expectation')?></h3>
			            </div>
			            <div class="panel-body">
			                <table class="table">
							<tbody>
                        <tr>
						 <td class="td-label">
                                <span>Sect</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('sect', $partner_expectation[0]['partner_caste'])?> 
                              
                            </td>
							 <td class="td-label">
                                <span><?php echo translate('age')?></span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('age_range', $partner_expectation[0]['partner_age'])?> 

                            </td>
							  <td class="td-label">
                                <span><?php echo translate('height')?></span>
                            </td>
                            <td>
                                <?=$partner_expectation[0]['partner_height']?>
                            </td>
							 
                           
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('marital_status')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation[0]['partner_marital_status'])?>
                            </td>
							 <td class="td-label">
                                <span><?php echo translate('profession')?></span>
                            </td>
                            <td>
							 <?=$this->Crud_model->get_type_name_by_id('profession', $partner_expectation[0]['partner_profession'])?>
                        
                            </td>
							<td class="td-label">
                                <span><?php echo translate('education')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('education', $partner_expectation[0]['partner_education'])?>
                            </td>
                            
                        </tr>
                     
                        <tr>
							<td class="td-label">
                                <span>Nationality</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('country', $partner_expectation[0]['partner_nationality'])?>
                             
                            </td>
                            <td class="td-label">
                                <span>Residence</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('country', $partner_expectation[0]['partner_country_of_residence'])?>
                            </td>
                            <td class="td-label">
                                <span>Resident Status</span>
                            </td>
                            <td>
                               <?= $this->Crud_model->get_type_name_by_id('resident_status', $partner_expectation[0]['partner_resident_status'])?>
                            </td>
							 
                           
                        </tr>
                        <tr>
							<td class="td-label">
                                <span>Disabilities</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('dissablities', $partner_expectation[0]['partner_any_disability'])?>
                            </td>
                            <td class="td-label">
                                <span>Have Children</span>
                            </td>
                            <td>
                                 <?=$this->Crud_model->get_type_name_by_id('yes_no', $partner_expectation[0]['partner_have_children'])?>
                            </td>
                            <td class="td-label">
                                <span>If Yes, How Many</span>
                            </td>
                            <td>
                              <?=$partner_expectation[0]['partner_children_how_many']?>
                            </td>
							 
                           
                        </tr>
						<tr>
							<td class="td-label">
                                <span><?php echo translate('body_type')?></span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('body_type', $partner_expectation[0]['partner_body_type'])?>
                            </td>
							<td class="td-label">
                                <span>Born At</span>
                            </td>
                            <td>
<?=$this->Crud_model->get_type_name_by_id('country', $partner_expectation[0]['partner_born_at']);?>
       
                            </td>
							<td class="td-label">
                                <span>1st Language</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('language', $partner_expectation[0]['partner_1_language']);?>
                            </td>
						</tr>
                        
                        
                    </tbody>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('mother_tongue')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('language', $language[0]['mother_tongue']);?>
								</td>
								<td>
									<b><?php echo translate('language')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('language', $language[0]['language']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('speak')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('language', $language[0]['speak']);?>
								</td>
								<td>
									<b><?php echo translate('read')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('language', $language[0]['read']);?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('hobby')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['hobby']?>
								</td>
								<td>
									<b><?php echo translate('interest')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['interest']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('music')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['music']?>
								</td>
								<td>
									<b><?php echo translate('books')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['books']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('movie')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['movie']?>
								</td>
								<td>
									<b><?php echo translate('TV_show')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['tv_show']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('sports_show')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['sports_show']?>
								</td>
								<td>
									<b><?php echo translate('fitness_activity')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['fitness_activity']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('cuisine')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['cuisine']?> 
								</td>
								<td>
									<b><?php echo translate('dress_style')?></b>
								</td>
								<td>
									<?=$hobbies_and_interest[0]['dress_style']?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('affection')?></b>
								</td>
								<td>
									<?=$personal_attitude_and_behavior[0]['affection']?>
								</td>
								<td>
									<b><?php echo translate('humor')?></b>
								</td>
								<td>
									<?=$personal_attitude_and_behavior[0]['humor']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('political_view')?></b>
								</td>
								<td>
									<?=$personal_attitude_and_behavior[0]['political_view']?>
								</td>
								<td>
									<b><?php echo translate('religious_service')?></b>
								</td>
								<td>
									<?=$personal_attitude_and_behavior[0]['religious_service']?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('birth_country')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('country', $residency_information[0]['birth_country']);?>
								</td>
								<td>
									<b><?php echo translate('residency_country')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('country', $residency_information[0]['residency_country']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('citizenship_country')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('country', $residency_information[0]['citizenship_country']);?>
								</td>
								<td>
									<b><?php echo translate('grow_up_country')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('country', $residency_information[0]['grow_up_country']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('immigration_status')?></b>
								</td>
								<td>
									<?=$residency_information[0]['immigration_status']?>
								</td>
								<td>
									<b></b>
								</td>
								<td>
									
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('religion')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('religion', $spiritual_and_social_background[0]['religion']);?>
								</td>
								<td>
									<b><?php echo translate('caste_/_sect')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('caste', $spiritual_and_social_background[0]['caste'], 'caste_name');?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('sub-Caste')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('sub_caste', $spiritual_and_social_background[0]['sub_caste'], 'sub_caste_name');?>
								</td>
								<td>
									<b><?php echo translate('ethnicity')?></b>
								</td>
								<td>
									<?=$spiritual_and_social_background[0]['ethnicity']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('personal_value')?></b>
								</td>
								<td>
									<?=$spiritual_and_social_background[0]['personal_value']?>
								</td>
								<td>
									<b><?php echo translate('family_value')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('family_value', $spiritual_and_social_background[0]['family_value']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('community_value')?></b>
								</td>
								<td>
									<?=$spiritual_and_social_background[0]['community_value']?>
								</td>
								<td>
									<b><?php echo translate('family_status')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('family_status', $spiritual_and_social_background[0]['family_status']);?>
								</td>
							</tr>
							<tr>	
								<td>
									<b><?php echo translate('manglik')?></b>
								</td>
								<td>
									<?php $u_manglik=$spiritual_and_social_background[0]['u_manglik'];
	                                    if($u_manglik == 1){
	                                        echo "Yes";
	                                    }elseif($u_manglik == 2){
	                                        echo "No";
	                                    }
	                                    elseif($u_manglik == 3){
	                                        echo "I don't know";
	                                    }else{
	                                        echo " ";
	                                    }
	                                ?>
								</td>
								<td>
									<b></b>
								</td>
								<td>
									
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('diet')?></b>
								</td>
								<td>
									<?=$life_style[0]['diet']?>
								</td>
								<td>
									<b><?php echo translate('drink')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('decision', $life_style[0]['drink'])?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('smoke')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('decision', $life_style[0]['smoke'])?>
								</td>
								<td>
									<b><?php echo translate('living_with')?></b>
								</td>
								<td>
									<?=$life_style[0]['living_with']?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('country')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('country', $permanent_address[0]['permanent_country']);?>
								</td>
								<td>
									<b><?php echo translate('state')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('state', $permanent_address[0]['permanent_state']);?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('city')?></b>
								</td>
								<td>
									<?=$this->Crud_model->get_type_name_by_id('city', $permanent_address[0]['permanent_city']);?>
								</td>
								<td>
									<b><?php echo translate('postal-Code')?></b>
								</td>
								<td>
									<?=$permanent_address[0]['permanent_postal_code']?>
								</td>
							</tr>
							</table>
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
			                <table class="table">
							<tr>
								<td>
									<b><?php echo translate('father')?></b>
								</td>
								<td>
									<?=$family_info[0]['father']?>
								</td>
								<td>
									<b><?php echo translate('mother')?></b>
								</td>
								<td>
									<?=$family_info[0]['mother']?>
								</td>
							</tr>
							<tr>
								<td>
									<b><?php echo translate('brother_/_sister')?></b>
								</td>
								<td>
									<?=$family_info[0]['brother_sister']?>
								</td>
								<td>
									<b></b>
								</td>
								<td>
									
								</td>
							</tr>
							</table>
			            </div>
			        </div>			
			        <?php
                        }
                    ?>
                    
                   
				</div>
			</div>
		</div>
	</div>
</div>