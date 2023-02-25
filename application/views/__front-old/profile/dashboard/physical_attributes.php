<?php 
    $physical_attributes = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'physical_attributes');
    $physical_attributes_data = json_decode($physical_attributes, true);
?>
<script src="<?=base_url()?>template/front/js/jquery.inputmask.bundle.min.js"></script>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_physical_attributes">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                HOW I LOOK
            </h3>
            <div class="pull-right">
                
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('physical_attributes')">
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
                                <span>my height</span>
                            </td>
                            <td>
                                <?=$get_member[0]->height?>
                            </td>
                            <td class="td-label">
                                <span>I Exercise</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('i_exercise', $physical_attributes_data[0]['exercise'])?>
                            </td>
							<td class="td-label">
                                <span>My Eye Color</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('eye_color', $physical_attributes_data[0]['eye_color'])?>
         
                            </td>
                        </tr>
                        <tr>                           
                            <td class="td-label">
                                <span>My Hair Color</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('hair_color', $physical_attributes_data[0]['hair_color'])?>
                                
                            </td>
							<td class="td-label">
                                <span>My Complexion</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('complexion', $physical_attributes_data[0]['complexion'])?>
                            </td>
							 <td class="td-label">
                                <span>My Body Type</span>
                            </td>
                            <td>
								<?=$this->Crud_model->get_type_name_by_id('body_type', $physical_attributes_data[0]['body_type'])?>
                            </td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_physical_attributes" style="display: none">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                HOW I LOOK
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('physical_attributes')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('physical_attributes')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_physical_attributes" class="form-default" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="height" class="text-uppercase c-gray-light"><?php echo translate('height')?></label>                       
                        <input type="text" class="form-control no-resize height_mask" aria-describedby="text-feet" name="height" value="<?=$get_member[0]->height?>">                       
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="exercise" class="text-uppercase c-gray-light">I EXERCISE</label>
                        <?php 
                            echo $this->Crud_model->select_html('i_exercise', 'exercise', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['exercise'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="eye_color" class="text-uppercase c-gray-light"><?php echo translate('eye_color')?></label>
                         <?php 
                            echo $this->Crud_model->select_html('eye_color', 'eye_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['eye_color'], '', '', '');
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
                            echo $this->Crud_model->select_html('hair_color', 'hair_color', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['hair_color'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				 <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="complexion" class="text-uppercase c-gray-light"><?php echo translate('complexion')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('complexion', 'complexion', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['complexion'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="body_type" class="text-uppercase c-gray-light"><?php echo translate('body_type')?></label>
                        <?php 
                            echo $this->Crud_model->select_html('body_type', 'body_type', 'name', 'edit', 'form-control form-control-sm selectpicker', $physical_attributes_data[0]['body_type'], '', '', '');
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
      $(document).ready(function(){
        $(".height_mask").inputmask({
            mask: "9'99\"",
            greedy: false,
            definitions: {
                '*': {
                    validator: "[0-9]"
                }
            }
        });
    });
</script>