<div class="card-title" style="background-color: #E91E63;">
    <center>
        <h3 class="heading heading-6 strong-500">
            <b style="font-size: 25px !important;">MY PACKAGE</b></h3>
    </center>
</div>
<div class="card-body">
    <section class="sct-color-1 pricing-plans pricing-plans--style-1">
        <div class="container">
            <span class="clearfix"></span>
            <div class="row">
                <div class="col-md-6">
                    <div class="block" style="margin-top: 0 !important;">
                        <?php
                        $package_info = $this->db->get_where('member', array('member_id' => $this->session->userdata('member_id')))->row()->package_info;
                        $package_info = json_decode($package_info, true);
                        ?>
                        <h2 class="plan-title text-uppercase strong-600"><?php echo translate('your_current_package')?></h2>
                        <div class="text-center">
                            <div class="px-2 py-2 text-left">
                                <table class="table table-condensed table-bordered">
                                    <tbody>
                                    <tr>
                                        <td><?php echo translate('user_package:')?></td>
                                        <td>Platinum *TOP SELLER*</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('price:')?></td>
                                        <td><?=currency($package_info[0]['package_price'])?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('time_period:')?></td>
                                        <td>1 year</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('coupon:')?></td>
                                        <td>None</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block" style="margin-top: 0 !important;">
                        <h2 class="plan-title text-uppercase strong-600"><?php echo translate('remaining_package')?></h2>
                        <div class="text-left">
                            <div class="px-2 py-2">
                                <table class="table table-condensed table-bordered">
                                    <tbody>
                                    <tr>
                                        <td><?php echo translate('remaining_interests:')?></td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('instant_messages:')?></td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('emoticons:')?></td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo translate('prime_photo_display:')?></td>
                                        <td>Unlimited</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="block">
                        <h2 class="plan-title text-uppercase strong-600 pt-2"><?php echo translate('buy_packages')?></h2>
                        <div class="text-center pt-2 pb-4">
                            <a href="<?=base_url()?>home/plans" class="btn btn-styled btn-sm btn-base-1 z-depth-2-bottom" style="width: 50%; font-size: 15px !important;">Upgrade Package</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>