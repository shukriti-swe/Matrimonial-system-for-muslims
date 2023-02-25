<?php 
    $astronomic_information = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'astronomic_information');
    $astronomic_information_data = json_decode($astronomic_information, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_astronomic_information">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                MY RELIGION
            </h3>
            <div class="pull-right">
                	
				<button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1 " onclick="edit_section('astronomic_information')">
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
                                As a Muslim, I am?</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('muslim_i_am', $astronomic_information_data[0]['muslim_i_am'])?>
                                
                            </td>
                            <td class="td-label">
                                <span>I am a Revert</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['revert'])?>
                             
                            </td>
							 <td class="td-label">
                                <span>I am a Convert</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['convert'])?>
                                
                            </td>
                        </tr>
                        <tr>
                            <td class="td-label">
                                <span>Do I Keep Fast</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_fast'])?>
                               
                            </td>
                            <td class="td-label">
                                <span>Do I Pray</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_pray'])?>
                               
                            </td>
							 <td class="td-label">
                                <span>Do I Eat Halal</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['do_i_eat_halal'])?>
                               
                            </td>
                        </tr>
						  <tr>
                            <td class="td-label">
                                <span>For Women Only:<br/> Do I Wear Hiijab</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('yes_no', $astronomic_information_data[0]['women_only'])?>
                               
                            </td>
                            <td class="td-label">
                                <span>For Men Only:<br/> I Prefer My Wife To Wear</span>
                            </td>
                            <td>
							<?=$this->Crud_model->get_type_name_by_id('wife_wear', $astronomic_information_data[0]['wife_wear'])?>
                               
                            </td>
							 
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_astronomic_information" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                 MY RELIGION
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('astronomic_information')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('astronomic_information')"><i class="ion-close"></i></button>
            </div>
        </div>
        
        <div class='clearfix'></div>
        <form id="form_astronomic_information" class="form-default" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="muslim_i_am" class="text-uppercase c-gray-light">As a Muslim, I am?</label>
						<?php 
                            echo $this->Crud_model->select_html('muslim_i_am', 'muslim_i_am', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['muslim_i_am'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="revert" class="text-uppercase c-gray-light">I am a Revert</label>
                        <?php 
                            echo $this->Crud_model->select_html('yes_no', 'revert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['revert'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				  <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="convert" class="text-uppercase c-gray-light">I am a Convert</label>
                        <?php 
                            echo $this->Crud_model->select_html('yes_no', 'convert', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['convert'], '', '', '');
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
                            echo $this->Crud_model->select_html('yes_no', 'do_i_fast', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_fast'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_pray" class="text-uppercase c-gray-light">Do I Pray?</label>
                        <?php 
                            echo $this->Crud_model->select_html('yes_no', 'do_i_pray', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_pray'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_eat_halal" class="text-uppercase c-gray-light">Do I Eat Halal?</label>
                        <?php 
                            echo $this->Crud_model->select_html('yes_no', 'do_i_eat_halal', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['do_i_eat_halal'], '', '', '');
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
                            echo $this->Crud_model->select_html('yes_no', 'women_only', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['women_only'], '', '', '');
                        ?>
                    
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				<div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="wife_wear" class="text-uppercase c-gray-light">For Men Only: I Prefer My Wife To Wear</label>
                        <?php 
                            echo $this->Crud_model->select_html('wife_wear', 'wife_wear', 'name', 'edit', 'form-control form-control-sm selectpicker', $astronomic_information_data[0]['wife_wear'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
				
               
            </div>
        </form>
    </div>
</div>