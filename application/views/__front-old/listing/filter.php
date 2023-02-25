<script src="<?=base_url()?>template/front/js/jquery.inputmask.bundle.min.js"></script>
<!--<div class="col-lg-2">-->
<!--    <div class="sidebar">-->
<!--        <div class="">-->
<!--            <div class="card">-->
<!---->
<!--                <div class="card-body">-->
<form class="form-default" id="filter_form" data-toggle="validator" role="form">
<div class="container pl-0" style="padding-bottom: 30px;">
    <div class="outer-search">
        <div class="feature feature--boxed-border feature--bg-1 animated animation-ended s-search"
             data-animation-in="zoomIn" data-animation-delay="400"
             style="padding: 0.7em; background-color: #E91E63; border-color: black; border-width: 2px; box-sizing: content-box;">

            <div class="text-center" style="text-decoration: none;">
                     <div class="row">
                         <div class="col d-default"></div>
                         <div class="col">
                             <h4 class="text-black text-center mb-4 heading heading-sm text-uppercase" style="font-size: 20px !important; text-align: center; text-decoration-style: double;padding-left: 18px;">ADVANCE SEARCH
                             </h4>
                             <form class="form-default" id="filter_form" data-toggle="validator" role="form">
                         </div>
                         <div class="col">
                             <button type="button" class="btn btn-block btn-base-1 mt-2 z-depth-2-bottom" onclick="filter_members('0','search')" style="width: 110px;margin-left: 100px;border-color: black;background-color: black;color: white;margin-bottom: 3%;"><?php echo translate('search')?></button>
                         </div>
                         </h4>
                     </div>
            </div>

                           <div class="row customStyle" style="margin-left:25px;">
                    <div class="col-lg-2 col-sm-12" style="border-color: black; padding-left: 0px;">
                        <div class="form-group has-feedback">

                            <select name="gender" style="border-color: black;width: 100%; padding: 0px !important; height:30px !important" class="form-control-sm">
                                <option value="looking_for" selected><b>LOOKING FOR</b></option>
                                <option  id="groom" value="1">Groom</option>
                                <option   id="bride"value="2">Bride</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-2 col-sm-12" style="padding-left:0px;">
                        <div class="form-group has-feedback">
                            <input type="text" class="form-control form-control-sm" name="member_id" id="filter_member_id" value="<?php if(isset($member_id)){echo $member_id;}?>" style="width: 100%;padding: 0px !important; height:31px !important; line-height: initial !important; " placeholder="MEMBER ID">
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>

                    <style>
                        ::placeholder {
                            padding-left: 15px;
                            color: black !important;
                            margin-top: 5px;
                        }

                        @media screen and (min-width: 320px) and (max-width: 991px) {
                            .d-default{
                                display:none;
                            }
                            .customStyle{
                                margin-left: 0px !important;
                            }
                        }

                    </style>

                    <div class="col-lg-2 col-sm-12" style="padding-left:0px;">
                        <div class="form-group has-feedback">
                            <?= $this->Crud_model->select_html('age_range', 'age_range', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', ''); ?>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-12" style="padding-left:0px;">
                        <div class="form-group has-feedback">
                            <?= $this->Crud_model->select_html('profession', 'profession', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', ''); ?>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-12" style="padding-left:0px;">
                        <div class="form-group has-feedback">
                            <?= $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker', '', '', ''); ?>
                            <div class="help-block with-errors">
                            </div>
                        </div>
                    </div>

                </div>

                        <div class="row">

                            <div class="col-sm-12">
                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'spiritual_and_social_background'))->row()->value == "yes") {
                                    ?>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('religion')?></label>
                                        <?= $this->Crud_model->select_html('religion', 'religion', 'name', 'edit', 'form-control form-control-sm selectpicker s_religion', $home_religion, '', '', ''); ?>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('caste_/_sect')?></label>

                                        <select class="form-control form-control-sm selectpicker s_caste" name="caste" >
                                            <option value="<?= $home_caste ?>"><?php echo translate('choose_a_religion_first')?></option>
                                        </select>

                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback" id="">
                                        <label for="" class="text-uppercase"><?php echo translate('sub_caste')?></label>

                                        <select class="form-control form-control-sm selectpicker s_sub_caste" name="sub_caste">
                                            <option value="<?= $home_sub_caste ?>"><?php echo translate('choose_a_caste_first')?></option>
                                        </select>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'language'))->row()->value == "yes") {
                                    ?>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('mother_tongue')?></label>
                                        <?= $this->Crud_model->select_html('language', 'language', 'name', 'edit', 'form-control form-control-sm selectpicker', $home_language, '', '', ''); ?>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <?php
                                if ($this->db->get_where('frontend_settings', array('type' => 'present_address'))->row()->value == "yes") {
                                    ?>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('country')?></label>
                                        <?= $this->Crud_model->select_html('country', 'country', 'name', 'edit', 'form-control form-control-sm selectpicker s_country', '', '', '', ''); ?>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('state')?></label>

                                        <select class="form-control form-control-sm selectpicker s_state" name="state">
                                            <option value=""><?php echo translate('choose_a_country_first')?></option>
                                        </select>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="" class="text-uppercase"><?php echo translate('city')?></label>
                                        <select class="form-control form-control-sm selectpicker s_city" name="city">
                                            <option value=""><?php echo translate('choose_a_state_first')?></option>
                                        </select>
                                        <div class="help-block with-errors">
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        /*if ($this->db->get_where('frontend_settings', array('type' => 'physical_attributes'))->row()->value == "yes") {
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase"><?php echo translate('min_height_(Feet)')?></label>
                                    <input type="text" class="form-control form-control-sm height_mask" name="min_height" id="min_height" value="<?php if($min_height != ""){echo $min_height;}else{echo '0.00';}?>">
                                    <div class="help-block with-errors">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group has-feedback">
                                    <label for="" class="text-uppercase"><?php echo translate('max_height_(Feet)')?></label>
                                    <input type="text" class="form-control form-control-sm height_mask" name="max_height" id="max_height" value="<?php if($max_height != ""){echo $max_height;}else{echo '8.00';}?>">
                                </div>
                                <div class="help-block with-errors">
                                </div>
                            </div>
                        </div>
                        <?php
                        }*/
                        ?>
                        <div class="pt-0" hidden >
                            <div class="card-title b-xs-bottom">
                                <h3 class="heading heading-sm text-uppercase"><?php echo translate('member_type')?></h3>
                            </div>
                            <div class="card-body">
                                <div class="filter-radio">
                                    <div class="radio radio-primary">
                                        <input type="radio" name="search_member_type" id="s_all_members" value="all" <?php if(!empty($search_member_type=="all")){?>checked<?php }?>>
                                        <label for="s_all_members"><?php echo translate('all_members')?></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input type="radio" name="search_member_type" id="s_premium_members" value="premium_members" <?php if(!empty($search_member_type=="premium_members")){?>checked<?php }?>>
                                        <label for="s_premium_members"><?php echo translate('premium_members')?></label>
                                    </div>
                                    <div class="radio radio-primary">
                                        <input type="radio" name="search_member_type" id="s_free_members" value="free_members" <?php if(!empty($search_member_type=="free_members")){?>checked<?php }?>>
                                        <label for="s_free_members"><?php echo translate('free_members')?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <button type="button" class="btn btn-block btn-base-1 mt-2 z-depth-2-bottom" onclick="filter_members('0','search')">--><?php //echo translate('search')?><!--</button>-->

            </div>
            </div>
        </div>
</form>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="col-lg-4 size-sm-btn mb-4">-->
<!--    <button type="button" class="btn btn-block btn-base-1 mt-2 z-depth-2-bottom" onclick="adv_search()"><?php echo translate('advanced_search')?></button>-->
<!--</div>-->