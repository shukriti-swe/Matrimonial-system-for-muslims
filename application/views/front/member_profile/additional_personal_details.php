<div id="info_additional_personal_details">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            A Little About Me
        </h3>
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
<?=$this->Crud_model->get_type_name_by_id('country', $additional_personal_details_data[0]['born_at']);?>

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
