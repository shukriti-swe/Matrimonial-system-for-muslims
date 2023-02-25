<sup class="badge bg-base-1 noti_badge msg_counter" style="display: none;">
        <!-- Counts Messages with JavaScript  --> </sup>
<div class="dropdown-menu dropdown-menu-right dropdown-scale" style="max-height: 300px;overflow: auto;">    
    <div id="msg_body_here" style="margin-left: -15px"></div> 
</div>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function() {
            $.ajax({
                url: "<?php echo base_url()?>home/countmessage_body",
                success: function(result){
                    $('#msg_body_here').html(result);
                }
            });
        }, 5000);
    })
</script>