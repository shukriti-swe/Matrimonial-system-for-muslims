<?php
    $partner_expectation = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'partner_expectation');
    $partner_expectation_data = json_decode($partner_expectation, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_partner_expectation">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                PARTNER EXPECTATION
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('partner_expectation')">
                <i class="ion-edit"></i> Edit
                </button>
            </div>
        </div>
        <div class="table-full-width">
            <div class="table-full-width">
                <table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
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
							<?php if($partner_expectation_data[0]['partner_education'] == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('education', $partner_expectation_data[0]['partner_education']);}?>

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
                                <span>Ethnic Background</span>
                            </td>
                            <td>
                                <?= $this->Crud_model->get_type_name_by_id('ethnicities', $partner_expectation_data[0]['partner_any_disability'])?>
                            </td>
                            <td class="td-label">
                                <span>Have Children</span>
                            </td>
                            <td>
                                 <?= $this->Crud_model->get_type_name_by_id('yes_no', $partner_expectation_data[0]['partner_have_children'])?>
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
							<?php if($this->Crud_model->get_type_name_by_id('body_type', $partner_expectation_data[0]['partner_body_type']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('body_type', $partner_expectation_data[0]['partner_body_type']);}?>
                            </td>
							<td class="td-label">
                                <span>Born At</span>
                            </td>
                            <td>
                                <?php if($this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_born_at']) == ""){echo "I Dont Care";}else{echo $this->Crud_model->get_type_name_by_id('country', $partner_expectation_data[0]['partner_born_at']);}?>
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

    <div id="edit_partner_expectation" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                PARTNER EXPECTATION
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('partner_expectation')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('partner_expectation')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_partner_expectation" class="form-default" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_caste" class="text-uppercase c-gray-light">Sect</label>
						 <?php
                            echo $this->Crud_model->select_html('sect', 'partner_caste', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_caste'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_age" class="text-uppercase c-gray-light"><?php echo translate('age')?></label>
						 <?php
                            echo $this->Crud_model->select_html('age_range', 'partner_age', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_age'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>
                        <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="partner_height" value="<?=$partner_expectation_data[0]['partner_height']?>">
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
                            echo $this->Crud_model->select_html('marital_status', 'partner_marital_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_marital_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
				</div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_profession" class="text-uppercase c-gray-light"><?php echo translate('profession')?></label>
						<?php
                            echo $this->Crud_model->select_html('profession', 'partner_profession', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_profession'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_education" class="text-uppercase c-gray-light"><?php echo translate('education')?></label>
						<?php
                            echo $this->Crud_model->select_html('education', 'partner_education', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_education'], '', '', '');
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

                                echo $this->Crud_model->select_html('country', 'partner_nationality', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_nationality'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
				</div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_country_of_residence" class="text-uppercase c-gray-light"><?php echo translate('country_of_residence')?></label>
                        <?php
                            echo $this->Crud_model->select_html('country', 'partner_country_of_residence', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_country_of_residence'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_resident_status" class="text-uppercase c-gray-light">Resident Status</label>
                        <?php
                            echo $this->Crud_model->select_html('resident_status', 'partner_resident_status', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_resident_status'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>

			<div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_any_disability" class="text-uppercase c-gray-light"><?php echo translate('ethnic_background')?></label>
						<?php
                            echo $this->Crud_model->select_html('ethnicities', 'partner_any_disability', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_any_disability'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_have_children" class="text-uppercase c-gray-light">Have Children</label>
						<?php
                            echo $this->Crud_model->select_html('yes_no', 'partner_have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_have_children'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_children_how_many" class="text-uppercase c-gray-light">If Yes, How Many</label>
                        <input type="text" class="form-control no-resize" name="partner_children_how_many" value="<?=$partner_expectation_data[0]['partner_children_how_many']?>">
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
                            echo $this->Crud_model->select_html('body_type', 'partner_body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $partner_expectation_data[0]['partner_body_type'], '', '', '');
                        ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_born_at" class="text-uppercase c-gray-light">Born At</label>
                            <?php
                                echo $this->Crud_model->select_html('country', 'partner_born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_born_at'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="partner_1_language" class="text-uppercase c-gray-light">1st Language</label>
						<?php

                                echo $this->Crud_model->select_html('language', 'partner_1_language', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $partner_expectation_data[0]['partner_1_language'], '', '', '');
                            ?>

                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(".prefered_country_edit").change(function(){
        var country_id = $(".prefered_country_edit").val();
        if (country_id == "") {
            $(".prefered_state_edit").html("<option value=''><?php echo translate('choose_a_country_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id/state/country_id/"+country_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_state_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_religion_edit").change(function(){
        var religion_id = $(".prefered_religion_edit").val();
        if (religion_id == "") {
            $(".prefered_caste_edit").html("<option value=''><?php echo translate('choose_a_religion_first')?></option>");
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/caste/religion_id/"+religion_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_caste_edit").html(data);
                    $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
    $(".prefered_caste_edit").change(function(){
        var caste_id = $(".prefered_caste_edit").val();
        if (caste_id == "") {
            $(".prefered_sub_caste_edit").html("<option value=''><?php echo translate('choose_a_caste_first')?></option>");
        } else {
            $.ajax({
                url: "<?=base_url()?>home/get_dropdown_by_id_caste/sub_caste/caste_id/"+caste_id, // form action url
                type: 'POST', // form submit method get/post
                dataType: 'html', // request type html/json/xml
                cache       : false,
                contentType : false,
                processData : false,
                success: function(data) {
                    $(".prefered_sub_caste_edit").html(data);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        }
    });
</script>
