<div id="info_partner_expectation">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('partner_expectation');?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                    <tbody>
                        <tr>
						 <td class="td-label">
                                <span>Sect</span>
                            </td>
                            <td>
							<?php if($this->Crud_model->get_type_name_by_id('sect', $partner_expectation_data[0]['partner_caste']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('sect', $partner_expectation_data[0]['partner_caste']);}?> 
                              
                            </td>
							 <td class="td-label">
                                <span><?php echo translate('age')?></span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('age_range', $partner_expectation_data[0]['partner_age'])?> 

                            </td>
							  <td class="td-label">
                                <span><?php echo translate('height')?></span>
                            </td>
                            <td>
                                <?=$partner_expectation_data[0]['partner_height']?>
                            </td>
							 
                           
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span><?php echo translate('marital_status')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('marital_status', $partner_expectation_data[0]['partner_marital_status'])?>
                            </td>
							 <td class="td-label">
                                <span><?php echo translate('profession')?></span>
                            </td>
                            <td>
							<?php if($this->Crud_model->get_type_name_by_id('profession', $partner_expectation_data[0]['partner_profession']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('profession', $partner_expectation_data[0]['partner_profession']);}?> 
                        
                            </td>
							<td class="td-label">
                                <span><?php echo translate('education')?></span>
                            </td>
                            <td>
							<?php if($partner_expectation_data[0]['partner_education'] == ""){echo "I Dont Care";}else{echo $partner_expectation_data[0]['partner_education'];}?> 
                      
                            </td>
                            
                        </tr>
                     
                        <tr>
							<td class="td-label">
                                <span>Nationality</span>
                            </td>
                            <td>
							<?php if($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_nationality']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_nationality']);}?>                      
                            </td>
                            <td class="td-label">
                                <span>Residence</span>
                            </td>
                            <td>
							<?php if($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_country_of_residence']);}?> 
                            </td>
                            <td class="td-label">
                                <span>Resident Status</span>
                            </td>
                            <td>
							<?php if($this->Crud_model->get_type_name_by_id('resident_status', $partner_expectation_data[0]['partner_resident_status']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('resident_status', $partner_expectation_data[0]['partner_resident_status']);}?> 

                            </td>
							 
                           
                        </tr>
                        <tr>
							<td class="td-label">
                                <span>Disabilities</span>
                            </td>
                            <td>
                                <?=$partner_expectation_data[0]['partner_any_disability']?>
                            </td>
                            <td class="td-label">
                                <span>Have Children</span>
                            </td>
                            <td>
                                 <?=$partner_expectation_data[0]['partner_have_children']?>
                            </td>
                            <td class="td-label">
                                <span>If Yes, How Many</span>
                            </td>
                            <td>
                              <?=$partner_expectation_data[0]['partner_children_how_many']?>
                            </td>
							 
                           
                        </tr>
						<tr>
							<td class="td-label">
                                <span><?php echo translate('body_type')?></span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('body_type', $partner_expectation_data[0]['partner_body_type'])?>
                            </td>
							<td class="td-label">
                                <span>Born At</span>
                            </td>
                            <td>
<?=$this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_born_at']);?>
       
                            </td>
							<td class="td-label">
                                <span>1st Language</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('language', $partner_expectation_data[0]['partner_1_language']);?>
                            </td>
						</tr>
                        
                        
                    </tbody>
                </table>
        </div>
    </div>
</div>