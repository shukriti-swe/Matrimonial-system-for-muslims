<div id="info_physical_attributes">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            How I Look
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
           <table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
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