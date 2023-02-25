<div id="info_basic_info">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            PROFILE
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-striped table-bordered table-slick">
                    <tbody>

						<tr>
                            <td class="td-label">
                                <span><?php echo translate('age')?></span>
                            </td>
                            <td>
                                <?php
                                    $calculated_age = (date('Y') - date('Y', $get_member[0]->date_of_birth));
                                    echo $calculated_age;
                                ?>
                            </td>
								<td class="td-label">
                                <span>Profile Made</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('on_behalf', $basic_info_data[0]['profile_made'])?>
                            </td>


                        </tr>
						<tr>

							<td class="td-label">
                                <span><?php echo translate('gender')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('gender', $get_member[0]->gender)?>
                            </td>
							<td class="td-label">
                                <span>Profession</span>
                            </td>
                            <td>
                               <?=$this->Crud_model->get_type_name_by_id('profession', $basic_info_data[0]['profession'])?>
                            </td>

                        </tr>
						<tr>
						<!--	<td class="td-label">
                                <span>Date of birth</span>
                            </td>
                            <td>
                                <?=date('d/m/Y', $get_member[0]->date_of_birth)?>
                            </td>-->
                            <td class="td-label">
                                <span>Disabilities</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('disabilities', $basic_info_data[0]['Disabilities'])?>
                            </td>
							<td class="td-label">
                                <span>Residence</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['residence'])?>

                            </td>

                        </tr>
						<tr>
							<td class="td-label">
                                <span>My Sect</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('sect', $basic_info_data[0]['my_sect'])?>
                            </td>
							<td class="td-label">
                                <span>Resident Status</span>
                            </td>
                            <td>
                                 <?=$this->Crud_model->get_type_name_by_id('resident_status', $basic_info_data[0]['resident_status'])?>
                            </td>

                        </tr>
						<tr>
							<td class="td-label">
                                <span>Grew Up</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('country', $basic_info_data[0]['grew_up']);?>
                            </td>
							<td class="td-label">
                                <span>Like To Marry</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('like_to_marry', $basic_info_data[0]['like_to_marry'])?>
                            </td>

                        </tr>
						<tr>
							<td class="td-label">
                                <span>Living With</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('living_with', $basic_info_data[0]['living_with'])?>
							</td>
							<td class="td-label">
                                <span>1st Language</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('language', $basic_info_data[0]['first_language'])?>

                            </td>

                        </tr>
						<tr>
							<td class="td-label">
                                <span><?php echo translate('marital_status')?></span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('marital_status', $basic_info_data[0]['marital_status'])?>
                            </td>


                        </tr>



                    </tbody>
                </table>
        </div>
    </div>
</div>