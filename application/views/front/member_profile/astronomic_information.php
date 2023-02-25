<div id="info_astronomic_information">
    <div class="card-inner-title-wrapper pt-0">
        <h3 class="card-inner-title pull-left">
            My Religion
        </h3>
    </div>
    <div class="table-full-width">
        <div class="table-full-width">
             <table class="table table-xs table-profile table-striped table-bordered table-responsive-sm">
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
                                <span>For Women Only:</span>
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