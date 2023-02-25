<input type="hidden" name="refrence" value="<?=$data->id;?>" />
        <div class="form-group">
                <label class="col-sm-3 control-label"><b>Name <span class="text-danger">*</span></b></label>
                <div class="col-sm-8">
                        <input type="text" class="form-control" value="<?=$data->name;?>" name="name" placeholder="Icons Group" required="">
                </div>
                <label class="col-sm-3 control-label"><b>thumbnails <span class="text-danger">*</span></b></label>
                <div class="col-sm-8">
                        <img src="<?=$data->thumbnails;?>" alt="<?=$data->name;?>" class="img-sm">
                        <input type="file" class="form-control imgInp" value="" name="thumbnails"  placeholder="Icons Group" required="">
                        <input type="hidden" value="0" name="thumbnails_edited" />
                </div>
        </div>
<script>
        $(document).ready(function(){
                $('input[name=thumbnails]').change(function(){
                        $('input[name=thumbnails_edited]').val(1);
                });
        });
</script>