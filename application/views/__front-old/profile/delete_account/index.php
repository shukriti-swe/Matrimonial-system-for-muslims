<div class="card-title" style="text-align: center; background-color: #E91E63; margin-bottom: 10px;">
    <h3 class="heading heading-6 strong-500" style="padding: 0.7em">
        <b style="font-size: 25px !important;">
            DELETE MY ACCOUNT
        </b>
    </h3>
</div>
<div class="card-body">

    <div id="main_view">
        <form class="form-default text-center" id="validate_password" data-toggle="validator" role="form">
            <div class="card-body">
                <form class="form-default col-12" method="post" role="form">
                    <div class="row">
                        <div class="col-md-10 ml-auto mr-auto"
                             style="padding-top: 12px; text-align: left; font-size: 12px">
                            <div class="form-group has-feedback">
                                <label for="current_password" class="control-label" style="color: black; font-size: 14px"><b>CURRENT
                                        PASSWORD:</b></label>
                                <input type="password" class="form-control" name="current_password"
                                       id="current_password" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"
                                      style="color: red; float:right">* Required</span>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="col-md-10 ml-auto mr-auto filter-radio"
                             style="padding-top: 12px; text-align: left; font-size: 12px">
                            <label for="reason_for_leaving" class="control-label"
                                   style="color: black; text-align:center; font-size: 14px"><b>REASON FOR LEAVING:</b></label><br>
                          <div style="margin-left: 140px;">
                                <input type="checkbox" data-id="1" class="reason" name="thank">
                                <label for="thanks" style="font-size: 14px;">I found someone</label><br>
                                <input type="checkbox" data-id="2" class="reason" name="busy">
                                <label for="busy" style="font-size: 14px;">Too busy to look</label><br>
                                <input type="checkbox" data-id="3" class="reason" name="interested">
                                <label for="not" style="font-size: 14px;">Not interested</label><br>
                                <input type="checkbox" data-id="4" class="reason" name="personal">
                                <label for="personal" style="font-size: 14px;">Personal reasons</label><br>
                                <input type="checkbox" data-id="5" class="reason" name="back">
                                <label for="back" style="font-size: 14px;">In a relationship</label>
                            </div>

                            <div>
                                <input type="checkbox" data-id="6" class="reason" name="delete">
                                <label for="delete" style="font-size: 14px;">Delete Account</label>
                            </div>

                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-10 ml-auto mr-auto" style="text-align: center; padding-bottom: 50px;">

                <!--                email msg should be sent here-->

                <button type="button" class="btn btn-base-1 btn-sm mt-2 btn-shadow float-right deleteAccount onSubmit"
                        style="text-align: center;     width: 100px;
    background-color: #E91E63;
    color: white;" id="confirm_btn"
                        data-id=<?= $this->session->userdata('member_id') ?>>SAVE
                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $(".onSubmit").on('click', function () {
            // var current_pass = "";
            // current_pass = $("#current_password").val();
            // console.log(current_pass);
            // if (current_pass == '') {
            //     alert('Current password field must not be empty!');
            // }
            // console.log($('#validate_password').serialize());

            //Save Reason For Deleting Account
            $.ajax({
                method: 'post',
                url: "<?=base_url()?>home/reason",
                data: $('#validate_password').serialize(),
                cache: false,
                success: function (msg) {
                    alert(msg);
                },
                error: function () {
                    console.log("AJAX error");
                }
            });
        }); //
    });


    //Delete Account feature
    $(document).ready(function () {
        $(document).on('click', '.deleteAccount', function () {
            // var token = $('meta[name="csrf-token"]').attr('content');
            var member = $(this).data('id');
            console.log(member);

            $.ajax({
                method: 'post',
                url: "<?=base_url()?>admin/member_delete/" + member,
                data: {
                    member: member,
                    // _token: token
                },
                cache: false,
                success: function (result) {

                    return location.reload();

                },
                error: function () {
                    console.log("AJAX error");
                }
            });
        });
    });

</script>