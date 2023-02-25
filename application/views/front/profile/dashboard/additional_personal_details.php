<?php
    $additional_personal_details = $this->Crud_model->get_type_name_by_id('member', $this->session->userdata['member_id'], 'additional_personal_details');
    $additional_personal_details_data = json_decode($additional_personal_details, true);
?>
<div class="feature feature--boxed-border feature--bg-1 pt-3 pb-0 pl-3 pr-3 mb-3 border_top2x">
    <div id="info_additional_personal_details">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
                A LITTLE ABOUT ME
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-base-1 btn-sm btn-icon-only btn-shadow mb-1" onclick="edit_section('additional_personal_details')">
                <i class="ion-edit"></i>
                <span class="tooltiptext">Edit</span>
                </button>
            </div>
        </div>
        <div class="table-full-width">
            <div class="table-full-width">
                <table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
                    <tbody>
                        <tr>
                            <td class="td-label">
                                <span>I Was Born At</span>
                            </td>
                            <td>
                                <?= $this->Crud_model->get_type_name_by_id('country', $additional_personal_details_data[0]['born_at']); ?>
                            </td>
                            <td class="td-label">
                                <span>I Want Children</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['want_children'])?>

                            </td>
                            <td class="td-label">
                                <span>Do I Smoke</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('yes_no_sometime', $additional_personal_details_data[0]['do_i_smoke'])?>

                            </td>
                        </tr>
                        <tr>

                            <tr>
                            <td class="td-label">
                                <span>I Grew Up In</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('country', $additional_personal_details_data[0]['grew_up_in'])?>

                            </td>
                            <td class="td-label">
                                <span>I Have Children</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['have_children'])?>
                            </td>
                            <td class="td-label">
                                <span>Do I Drink</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('yes_no_sometime', $additional_personal_details_data[0]['do_i_drink'])?>
                            </td>
                        </tr>

                        <tr>
                            <td class="td-label">
                                <span>My Hobbies</span>
                            </td>
                            <td>

                               <?=$additional_personal_details_data[0]['my_hobbies']?>
                            </td>

                            <td class="td-label">
                                <span>My Personality</span>
                            </td>
                            <td>
                                <?=$this->Crud_model->get_type_name_by_id('my_personalities', $additional_personal_details_data[0]['my_personalities'])?>
                            </td>

                            <td class="td-label">
                                <span>I Believe In Polygamy</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('yes_no', $additional_personal_details_data[0]['believe_in_polygamy'])?>
                            </td>
                        </tr>
                        <tr>
                            <!-- <td class="td-label">
                                <span>Disabilities</span>
                            </td>
                            <td>

                               <?=$this->Crud_model->get_type_name_by_id('disabilities', $additional_personal_details_data[0]['disabilities'])?>
                            </td> -->
                            <td class="td-label">
                                <span>Willing to Relocate</span>
                            </td>
                            <td>
                            <?=$this->Crud_model->get_type_name_by_id('relocate', $additional_personal_details_data[0]['relocate'])?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit_additional_personal_details" style="display: none;">
        <div class="card-inner-title-wrapper pt-0">
            <h3 class="card-inner-title pull-left">
               A LITTLE ABOUT ME
            </h3>
            <div class="pull-right">
                <button type="button" class="btn btn-success btn-sm btn-icon-only btn-shadow" onclick="save_section('additional_personal_details')"><i class="ion-checkmark"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-icon-only btn-shadow" onclick="load_section('additional_personal_details')"><i class="ion-close"></i></button>
            </div>
        </div>

        <div class='clearfix'></div>
        <form id="form_additional_personal_details" class="form-default" role="form">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="born_at" class="text-uppercase c-gray-light">I Was Born At</label>
                            <?php
                                echo $this->Crud_model->select_html('country', 'born_at', 'name', 'edit', 'form-control form-control-sm selectpicker present_state_edit', $additional_personal_details_data[0]['born_at'], '', '', '');
                            ?>


                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="want_children" class="text-uppercase c-gray-light">I Want Children</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'want_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['want_children'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_smoke" class="text-uppercase c-gray-light">Do I Smoke</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no_sometime', 'do_i_smoke', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['do_i_smoke'], '', '', '');
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
                            echo $this->Crud_model->select_html('country', 'grew_up_in', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['grew_up_in'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="have_children" class="text-uppercase c-gray-light">I Have Children</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no', 'have_children', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['have_children'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="do_i_drink" class="text-uppercase c-gray-light">Do I Drink</label>
                        <?php
                            echo $this->Crud_model->select_html('yes_no_sometime', 'do_i_drink', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['do_i_drink'], '', '', '');
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
                        <input type="text" class="form-control no-resize" name="my_hobbies" value="<?=$additional_personal_details_data[0]['my_hobbies']?>">
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="believe_in_polygamy" class="text-uppercase c-gray-light">My Personality</label>
                         <?php
                            echo $this->Crud_model->select_html('my_personalities', 'my_personalities', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['my_personalities'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="believe_in_polygamy" class="text-uppercase c-gray-light">I Believe In Polygamy</label>
                         <?php
                            echo $this->Crud_model->select_html('yes_no', 'believe_in_polygamy', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['believe_in_polygamy'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="believe_in_polygamy" class="text-uppercase c-gray-light">Disabilities</label>
                         <?php
                            echo $this->Crud_model->select_html('disabilities', 'disabilities', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['disabilities'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div> -->
                <div class="col-md-4">
                    <div class="form-group has-feedback">
                        <label for="believe_in_polygamy" class="text-uppercase c-gray-light">Willing to Relocate</label>
                         <?php
                            echo $this->Crud_model->select_html('relocate', 'relocate', 'name', 'edit', 'form-control form-control-sm selectpicker', $additional_personal_details_data[0]['relocate'], '', '', '');
                        ?>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>
