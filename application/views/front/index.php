<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <?php include_once 'includes/top/' . $top; ?>

        <!-- Google Analytics -->
        <script>
                <?php $g_set = $this->db->get_where('third_party_settings', array('type' => 'google_analytics_set'))->row()->value;
                if ($g_set == "yes") {
                        $g_key = $this->db->get_where('third_party_settings', array('type' => 'google_analytics_key'))->row()->value;
                } else {
                        $g_key = " ";
                }
                ?>
                        (function(i, s, o, g, r, a, m) {
                                i['GoogleAnalyticsObject'] = r;
                                i[r] = i[r] || function() {
                                        (i[r].q = i[r].q || []).push(arguments)
                                }, i[r].l = 1 * new Date();
                                a = s.createElement(o),
                                        m = s.getElementsByTagName(o)[0];
                                a.async = 1;
                                a.src = g;
                                m.parentNode.insertBefore(a, m)
                        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

                ga('create', "<?php echo $g_key; ?>", 'auto');
                ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->
        <!-- Favicon -->
        <?php
        $favicon = $this->db->get_where('frontend_settings', array('type' => 'favicon'))->row()->value;
        $favicon = json_decode($favicon, true);
        if (!empty($favicon) && file_exists('uploads/favicon/' . $favicon[0]['image'])) {
        ?>
                <link href="<?= base_url() ?>uploads/favicon/<?= $favicon[0]['image'] ?>" rel="icon" type="image/png">
        <?php
        } else {
        ?>
                <link href="<?= base_url() ?>uploads/favicon/default_image.png" rel="icon" type="image/png">
        <?php
        }
        ?>
        <title>Single Matrimonial Site - Match Made In Jannah</title>
</head>

<body>
        <!-- <script src="https://www.paypal.com/sdk/js?client-id=AflXtWjxn6xNAO4iY142UOM2ugEXK-gajajOqHWrI3EYJ--HMCaS9pJ-y-uFgOPo80IcA_0dmVOjbHjQ&vault=true&intent=subscription"></script> -->
        <script src="https://www.paypal.com/sdk/js?client-id=ASbQ1VTrf1a3-6qDakIR0k_8M6_b_BR40Y5sUM9KGyVl4HYXW8dR02qrywxzNIv5DYFmhdwbKziCop6O&vault=true&debug=true&intent=subscription"></script>



        <?php include 'preloader.php'; ?>
        <div class="container">
                <div class="row">
                        <!-- Alerts for Member actions -->
                        <div class="col-lg-3 col-md-4" id="success_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                                <div class="alert alert-success fade show" role="alert">
                                        <!-- Success Alert Content -->
                                </div>
                        </div>
                        <div class="col-lg-3 col-md-4" id="danger_alert" style="display: none; position: fixed; top: 15px; right: 0; z-index: 9999">
                                <div class="alert alert-danger fade show" role="alert">
                                        <!-- Danger Alert Content -->
                                </div>
                        </div>
                        <!-- Alerts for Member actions -->
                </div>
        </div>
        <?php
        include_once 'header/header.php';
        include_once $page . '/index.php';
        include_once 'footer/footer.php';
        include_once 'includes/bottom/' . $bottom;
        ?>
        <a href="#" class="btn-shadow back-to-top btn-back-to-top"></a>
        <button class="open_modal" style="display: none"><?php echo translate('open') ?></button>


<!-- Bootstrap Modal -->
<div class="modal fade" id="active_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" style="max-width: 400px; margin-top: 30vh;">
                <div class="modal-content">
                        <div class="modal-header text-center" style="display: block; border-bottom: 1px solid transparent">
                                <span class="modal-title" id="modal_header"><?php echo translate('title') ?></span>
                                <button type="button" class="close" id="modal_close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body text-center" id="modal_body">
                                <div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i>
                                        <p><?php echo translate('please_wait_...') ?></p>
                                </div>
                        </div>
                        <div class="text-center" id="modal_buttons">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><?php echo translate('close') ?></button>
                        </div>
                </div>
        </div>
</div>
<div id="test"></div>

 <script type="text/javascript">
        $(document).ready(function() {
                $('.top_bar_right').load('<?php echo base_url(); ?>home/top_bar_right');

        });
</script>
<!-- Bootstrap Modal -->

<script>
        var isloggedin = "<?= $this->session->userdata('member_id') ?>";

        var right_click = "<?= $this->db->get_where('general_settings', array('type' => 'right_click_option'))->row()->value ?>"
        if (right_click == "on") {
                $('body').on('contextmenu', function(e) {
                        return false;
                });
        }


        function confirm_accept(id) {
                if (isloggedin == "") {
                        $("#active_modal").modal("toggle");
                        $("#modal_header").html("Please Login");
                        $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_accept_this_request') ?></p>");
                        $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'>Log In</a>");
                } else {
                        $("#active_modal").modal("toggle");
                        $("#modal_header").html("Confirm Accept Request");
                        $("#modal_body").html("<p class='text-center'><?php echo translate('are_you_sure_that_you_want_to_accept_this_request') ?>?</p>");
                        $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'>Close</button> <a href='#' id='confirm_accept' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_accept(" + id + ")' style='width:25%'>Confirm</a>");
                }
        }

        function do_accept(id) {
                $("#confirm_accept").removeAttr("onclick");
                $("#confirm_accept").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
                setTimeout(function() {
                        $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>home/accept_interest/" + id,
                                cache: false,
                                success: function(response) {
                                        $("#active_modal .close").click();
                                        $(".text_" + id).html("<small class='sml_txt'><i class='fa fa-check-circle'></i> <?php echo translate('you_have_accepted_the_interest') ?></small>");
                                        $(".text_" + id).attr('class', 'text-center text-success text_' + id);
                                        $("#success_alert").show();
                                        $(".alert-success").html("<?php echo translate('you_have_accepted_the_request') ?>!");
                                        $('#danger_alert').fadeOut('fast');
                                        setTimeout(function() {
                                                $('#success_alert').fadeOut('fast');
                                        }, 5000); // <-- time in milliseconds
                                },
                                fail: function(error) {
                                        debugger
                                        alert(error);
                                }
                        });
                }, 500); // <-- time in milliseconds
        }

        function confirm_reject(id) {
                if (isloggedin == "") {
                        $("#active_modal").modal("toggle");
                        $("#modal_header").html("<?php echo translate('please_log_in') ?>");
                        $("#modal_body").html("<p class='text-center'><?php echo translate('please_log_in_to_reject_this_request') ?></p>");
                        $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close') ?></button> <a href='<?= base_url() ?>home/login' class='btn btn-sm btn-base-1 btn-shadow' style='width:25%'><?php echo translate('log_in') ?></a>");
                } else {
                        $("#active_modal").modal("toggle");
                        $("#modal_header").html("<?php echo translate('confirm_reject_request') ?>");
                        $("#modal_body").html("<p class='text-center'<?php echo translate('are_you_sure_that_you_want_to_reject_this_request?') ?>>");
                        $("#modal_buttons").html("<button type='button' class='btn btn-danger btn-sm btn-shadow' data-dismiss='modal' style='width:25%'><?php echo translate('close') ?></button> <a href='#' id='confirm_reject' class='btn btn-sm btn-base-1 btn-shadow' onclick='return do_reject(" + id + ")' style='width:25%'><?php echo translate('confirm') ?></a>");
                }
        }

        function do_reject(id) {
                $("#confirm_reject").removeAttr("onclick");
                $("#confirm_reject").html("<i class='fa fa-refresh fa-spin'></i> <?php echo translate('processing') ?>..");
                setTimeout(function() {
                        $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>home/reject_interest/" + id,
                                cache: false,
                                success: function(response) {
                                        $("#active_modal .close").click();
                                        $(".text_" + id).html("<small class='sml_txt'><i class='fa fa-times-circle'></i><?php echo translate('you_have_rejected_the_interest') ?></small>");
                                        $(".text_" + id).attr('class', 'text-center text-danger text_' + id);
                                        $("#danger_alert").show();
                                        $(".alert-danger").html("<?php echo translate('you_have_rejected_this_request!') ?>");
                                        $('#success_alert').fadeOut('fast');
                                        setTimeout(function() {
                                                $('#danger_alert').fadeOut('fast');
                                        }, 5000); // <-- time in milliseconds
                                },
                                fail: function(error) {
                                        alert(error);
                                }
                        });
                }, 500); // <-- time in milliseconds
        }
</script>

<?php if (!empty($this->session->userdata['member_id'])) { ?>

        <!-- <a href="#" class="openChat" onclick="OpenChatBox()"></a> -->

        <div class="ChatterBoxWrap">
             <div id="newChatterBox">
             </div>
        </div>
        <style>
                .ChatterBoxWrap {
                        position: fixed;
                        top: 0;
                        left: 100%;
                        z-index: 9999;
                        background: #e91e634f;
                        width: 100%;
                        height: 100vh;
                        overflow: hidden;
                        padding: 10px 30px;
                        transition: left 0.8s ease-out;
                }

                .ChatterBoxWrap.opened {
                        left: 0% !important;
                }

                a.closeChat i {
                        font-size: 19px;
                        color: #e91e63;
                }

                div#newChatterBox {
                        background: #fff;
                        border-radius: 10px;
                        height: 100%;
                }

                div#messaging_member_list {
                        max-height: calc(100vh - 78px);
                        overflow-y: scroll;
                }

                .direct-chat-messages,
                div.direct-chat-messages {
                        height: calc(100vh - 179px);
                }

                a.openChat {
                        height: 34px;
                        width: 80px;
                        position: fixed;
                        top: 40px;
                        right: -23px;
                        text-align: center;
                        line-height: 34px;
                        background: #E91E63;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
                        white-space: nowrap;
                        font-size: 40px;
                        transform: rotate(-90deg);
                        color: #fff;
                        z-index: 7;
                }

                a.openChat:before {
                        content: "\f422";
                        font-family: "Ionicons";
                        -webkit-font-smoothing: antialiased;
                }

                a.openChat:after {
                        content: "";
                        height: 15px;
                        width: 15px;
                        background: #e91e63;
                        position: absolute;
                        transform: rotate(45deg);
                        top: -7px;
                }

                a.closeChat {}
        </style>
        <script>
                var page = 'messaging';
                if (typeof message_interval !== 'undefined') {
                        clearInterval(message_interval);
                }

                function initChat(openIt, sp, now) {

                    <?php $listed_messaging_members = $this->Crud_model->get_listed_messaging_members($this->session->userdata('member_id'));                      if(count($listed_messaging_members)){?>
				
                    var php_var = "<?php echo $listed_messaging_members[0]['member_id']; ?>";
                         var url = "<?= base_url() ?>home/profile/" + page;
                        $.ajax({
                                url: url,
                                success: function(response) {
                                        $("#newChatterBox").html(response);
                                        if (typeof sp != "undefined") {
                                                open_message_box(sp, now)
                                        }else if (openIt) {
                                          window.location.href = "<?=base_url()?>home/chat/"+php_var;
                                         //  $('.ChatterBoxWrap').addClass('opened');
                                        }
                                }
                        });
					<?php 	}?>
                }
                initChat(false);

                function OpenChatBox() {
                        page = 'messaging';
                        initChat(true);
                }

                function closeChatBox() {
                        $('.ChatterBoxWrap').removeClass('opened');
                }

                function open_message_box(thread_id, now, displaynumber) {

                   //    $(".sidebar").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
                   //      $("#msg_body").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
                   //       $("#msg_box_header").html("<a class='c-base-1' target='_blank' ></a> CHAT ROOM  ");
                      //  $("#msg_refresh").html("<a onclick='refresh_msg(" + thread_id + ")'><i class='fa fa-refresh'></i> <?= translate('refresh') ?></a>");


                        if($(now).find('.contacts-list-name').data('member') == "undefined")
                            return true;
                    if($(now).find('.contacts-list-name').data('member') !== undefined) {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url() ?>home/get_user_profile/" + $(now).find('.contacts-list-name').data('member'),
                            cache: false,
                            success: function (response) {

                                $("#mysidebar").html(response);

                                //   $('.ChatterBoxWrap').addClass('opened');
                            }
                        });
                    }
                    $("#msg_body").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
                    $("#msg_box_header").html("<a class='c-base-1' target='_blank' ></a> CHAT ROOM");
                    $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>home/get_messages/" + thread_id,
                                cache: false,
                                success: function(response) {
                                        $("#msg_body").removeAttr("style");
                                        $("#message_text").removeAttr('disabled');
                                        $("#message_text").val('');
                                        $("#msg_body").html(response);
                                     //   $('.ChatterBoxWrap').addClass('opened');
                                }
                        });

                }

                function refresh_msg(thread_id) {
                        $(".contacts-list").find("#thread_" + thread_id).click();
                }

                function load_all_msg(thread_id) {
                        $("#msg_body").html("<div class='text-center' id='payment_loader'><i class='fa fa-refresh fa-5x fa-spin'></i></div>");
                        // $("#message_text").attr('disabled', true);
                        // $("#msg_send_btn").attr('disabled', true);
                        $.ajax({
                                type: "POST",
                                url: "<?= base_url() ?>home/get_messages/" + thread_id + "/all_msg",
                                cache: false,
                                success: function(response) {
                                        // $("#message_text").removeAttr('disabled');
                                        // $("#msg_send_btn").removeAttr('disabled');
                                        $("#msg_body").html(response);
                                }
                        });
                }

                function msg_send(thread, from, to) {
                        if ($("#message_text").val().length != 0) {
                                var form_data = $("#message_form").serialize();
                                $("#msg_send_btn").html("<i class='fa fa-refresh fa-spin'></i>");
                                // console.log(form_data);
                                $.ajax({
                                        type: "POST",
                                        url: "<?= base_url() ?>home/send_message/" + thread + "/" + from + "/" + to,
                                        data: form_data,
                                        success: function(response) {
                                                $("#message_text").val('');
                                                $("#msg_send_btn").html("<?php echo translate('send') ?>");
                                                $.ajax({
                                                        type: "POST",
                                                        url: "<?= base_url() ?>home/get_messages/" + thread,
                                                        cache: false,
                                                        success: function(response) {
                                                            $("#msg_body").html(response);
                                                        }
                                                });
                                        }
                                });
                        }
                }
        </script>
<?php } ?>
</body>
</html>