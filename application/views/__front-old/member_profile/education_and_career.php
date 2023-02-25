<div id="info_education_and_career">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            <?php echo translate('education_&_career')?>
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
            <table class="table table-profile table-responsive table-striped table-bordered table-slick">
                           <tbody>
                        <tr>
                            <td class="td-label">
                                <span>Education</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('education', $education_and_career_data[0]['highest_education'])?>
         
                            </td>
							<td class="td-label">
                                <span>I am Employed</span>
                            </td>
                            <td>
                                 <?=$education_and_career_data[0]['i_am_employed']?>
                            </td>
                            <td class="td-label">
                                <span>My Job Title</span>
                            </td>
                            <td>
                                 <?=$education_and_career_data[0]['my_job_title']?>
                            </td>
                        </tr>
                        <tr>
							<td class="td-label">
                                <span>My Company's Name</span>
                            </td>
                            <td>
                                 <?=$education_and_career_data[0]['my_company_name']?>
                            </td>
							<td class="td-label">
                                <span><?php echo translate('annual_income')?> $</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('annual_income', $education_and_career_data[0]['annual_income_self'])?>
                            </td>
							<td class="td-label">
                                <span>Years Worked</span>
                            </td>
                            <td>
                                <?=$education_and_career_data[0]['years_worked']?>
                            </td>
                                                       
                        </tr>
						 <tr>
							<td class="td-label">
                                <span>I am Self Employed</span>
                            </td>
                            <td>
                                 <?=$education_and_career_data[0]['self_employed']?>
                            </td>
							<td class="td-label">
                                <span>Annual Income $</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('annual_income', $education_and_career_data[0]['annual_income_self'])?>

                            </td>
							<td class="td-label">
                                <span>Years Owned</span>
                            </td>
                            <td>
                                 <?=$education_and_career_data[0]['years_owned']?>
                            </td>
							                  
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
</div>