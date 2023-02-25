<?php 
    $education_and_career = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'education_and_career');
    $education_and_career_data = json_decode($education_and_career, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_education_and_career">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                EDUCATION AND CAREER
            </h3>
            <div class="pull-right">
               
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('education_and_career')">
                <i class="ion-edit"></i>
				<span class="tooltiptext">Edit</span>
                </button>               
            </div>
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
                                <span><?php echo translate('annual_income')?></span>
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
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $education_and_career_data[0]['self_employed'])?>
                            </td>
							<td class="td-label">
                                <span>Annual Income</span>
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

    <div id="edit_education_and_career" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                EDUCATION AND CAREER
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('education_and_career')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('education_and_career')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_education_and_career" class="form-default" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="highest_education" class="text-uppercase c-gray-light">Education</label>
                         <?php 
                            echo $this->Crud_model->select_html('education', 'highest_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['highest_education'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="i_am_employed" class="text-uppercase c-gray-light">I am Employed</label>
                        <input type="text" class="form-control no-resize" name="i_am_employed" value="<?=$education_and_career_data[0]['i_am_employed']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="my_job_title" class="text-uppercase c-gray-light">My Job Title</label>
                        <input type="text" class="form-control no-resize" name="my_job_title" value="<?=$education_and_career_data[0]['my_job_title']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
			<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="my_company_name" class="text-uppercase c-gray-light">My Company's Name</label>
                        <input type="text" class="form-control no-resize" name="my_company_name" value="<?=$education_and_career_data[0]['my_company_name']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="annual_income" class="text-uppercase c-gray-light"><?php echo translate('annual_income')?> </label>

                         <?php 
                            echo $this->Crud_model->select_html('annual_income', 'annual_income', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['annual_income'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="years_worked" class="text-uppercase c-gray-light">Years Worked</label>
						<?php 
                            echo $this->Crud_model->select_html('years', 'years_worked', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['years_worked'], '', '', '');
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
                            echo $this->Crud_model->select_html('yes_no', 'self_employed', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['self_employed'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="annual_income_self" class="text-uppercase c-gray-light">Anmual Income </label>
						 <?php 
                            echo $this->Crud_model->select_html('annual_income', 'annual_income_self', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['annual_income_self'], '', '', '');
                        ?>
                        
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="years_owned" class="text-uppercase c-gray-light">Years Owned</label>
						<?php 
                            echo $this->Crud_model->select_html('years', 'years_owned', 'name', 'edit', 'form-control form-control-sm selectpicker', $education_and_career_data[0]['years_owned'], '', '', '');
                        ?>
                        
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				
            </div>
        </form>
    </div>
</div>