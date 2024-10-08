<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            parent_cat_id:"required",
            parent_id:"required",
            unit_value:"required",
            unit_type:"required",
            description:"required",                                   
            unit_type_id:"required",                                     
            name:"required",           
            tax_id:"required",
            expiry_date:"required",
            mfg_date:"required", 
            product_code: {
                required:true,
                remote:"<?=$remote?>null/product_code"
            },
            sku: {
                required:true,
                remote:"<?=$remote?>null/sku"
            },
        },
        messages: {
            product_code: {
                required : "Please enter product code!",
                remote : "Product code already exists!"
            },
            sku: {
                required : "Please enter Hsn/Sac Code!",
                remote : "Hsn/Sac Code already exists!"
            },
        }
    }); 
});
</script>
<form class="ajaxsubmit needs-validation reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>

    <div class="row">
        <!-- <div class="col-4">
            <div class="form-group">
            <label class="control-label">Parent Categories:</label>
            <select class="form-control select2" style="width:100%;" name="parent_id" onchange="fetch_sub_categories(this.value)" required>
            <option value="">Select</option>
            <?php foreach ($parent_cat as $parent) { ?>
            <option value="<?php echo $parent->id; ?>" <?php if($parent->id == $value->is_parent){echo "selected";} ?>>
                <?php echo $parent->name; ?>
            </option>
            <?php } ?>
            </select>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
            <label class="control-label">Sub Categories:</label>
                <select class="form-control select2 parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" onchange="fetch_update_category(this.value)" required>
                    <option value="<?php echo $value->cat_id; ?>">
                        <?php echo $value->cat_name; ?>
                    </option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
            <label class="control-label">Categories:</label>
                <select class="form-control select2 update_cat_id" style="width:100%;" name="cat_id" id="cat_id">
                    <option value="<?php echo $value->main_cat_id; ?>">
                        <?php echo $value->main_cat_name; ?>
                    </option>
                </select>
            </div>
        </div> -->

        <div class="col-4">
            <div class="form-group">
            <label class="control-label">Categories:</label>
                <!-- <select class="form-control select2 parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" onchange="fetch_update_category(this.value)">
                    <option value="<?php echo $value->cat_id; ?>">
                        <?php echo $value->cat_name; ?>
                    </option>
                </select> -->
                <div class="parent_cat_id" id="parent_cat_id" style="height: 250px;overflow: scroll;">
                    <?php 
                        foreach($parent_cat as $row){
                            //echo $row->name;
                            $checked1 = '';
                            foreach($cat_pro_map as $row_cat_id){ 
                                if ($row_cat_id->cat_id == $row->id) {
                                    $checked1 = 'checked';
                                }
                            }
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->id; ?>" name="cat_id[]" id="defaultCheck<?= $row->id; ?>" <?=$checked1;?>>
                        <label class="form-check-label" for="defaultCheck<?= $row->id; ?>"><?= $row->name; ?></label>
                    </div>
                    <?php
                        foreach($categories as $row2){
                            if ($row->id == $row2->is_parent) {
                                //echo $row2->name;
                                $checked2 = '';
                                foreach($cat_pro_map as $row_cat_id){ 
                                    if ($row_cat_id->cat_id == $row2->id) {
                                        $checked2 = 'checked';
                                    }
                                }
                    ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row2->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>)" id="defaultCheck<?= $row2->id; ?>" <?=$checked2;?>>
                        <label class="form-check-label" for="defaultCheck<?= $row2->id; ?>"><?= $row2->name; ?></label>
                    </div>
                    <?php
                            
                            foreach($categories as $row3){
                                if ($row2->id == $row3->is_parent) {
                                    //echo $row3->name;
                                    $checked = '';
                                    foreach($cat_pro_map as $row_cat_id){ 
                                        if ($row_cat_id->cat_id == $row3->id) {
                                            $checked = 'checked';
                                        }
                                    }
                    ?>
                    <div class="form-check ml-5">
                        <input class="form-check-input" type="checkbox" value="<?= $row3->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>, <?= $row2->id; ?>)" id="defaultCheck<?= $row3->id; ?>" <?=$checked;?>>
                        <label class="form-check-label" for="defaultCheck<?= $row3->id; ?>"><?= $row3->name; ?></label>
                    </div>
                    <?php
                                
                                }
                            }

                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Product Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $value->name; ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Product Image:</label>
                <input type="file" name="img[]" class="form-control" size="55550" accept=".png, .jpg, .jpeg, .gif" multiple="" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Search Keyword:</label>
                <input type="text" class="form-control" name="search_keywords" value="<?php echo $value->search_keywords; ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Product Code:</label>
                <input type="text" class="form-control" name="product_code" value="<?php echo $value->product_code; ?>">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Publisher:</label>
            <input type="text" class="form-control" name="publisher" value="<?=@$publisher?>" autocomplete="off">
                <ul id="publisher-list" style="list-style: none;padding: 4px 10px;position: absolute;background: #fff;z-index: 1;border: 1px solid #ddd;width: 91%;max-height: 150px;overflow-y: scroll;display: none;">
                    
                </ul>
                <!-- <select class="form-control select2" style="width:100%;" name="publisher">
                <option value="">Select Publisher</option>
                <?php foreach ($publisher as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->publisher_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select> -->
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Author:</label>
            <input type="text" class="form-control" name="author" value="<?=@$author?>" autocomplete="off">
                <ul id="author-list" style="list-style: none;padding: 4px 10px;position: absolute;background: #fff;z-index: 1;border: 1px solid #ddd;width: 91%;max-height: 150px;overflow-y: scroll;display: none;">
                    
                </ul>
                <!-- <select class="form-control select2" style="width:100%;" name="author">
                <option value="">Select Author</option>
                <?php foreach ($author as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->author_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select> -->
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="control-label">ISBN:</label>
                <input type="text" class="form-control" name="isbn" value="<?php echo $value->isbn; ?>">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Addition:</label>
                <input type="text" class="form-control" name="addition" value="<?php echo $value->addition; ?>">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Session:</label>
                <input type="text" class="form-control" name="session" value="<?php echo $value->session; ?>">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Board:</label>
                <select class="form-control select2" style="width:100%;" name="board">
                <option value="">Select Board</option>
                <?php foreach ($board as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->board_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Class:</label>
                <select class="form-control select2" style="width:100%;" name="board">
                <option value="">Select Board</option>
                <?php foreach ($board as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->board_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Subject:</label>
                <select class="form-control select2" style="width:100%;" name="subject">
                <option value="">Select Subject</option>
                <?php foreach ($subject as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->subject_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
            <label class="control-label">Binding:</label>
                <select class="form-control select2" style="width:100%;" name="binding">
                <option value="">Select Binding</option>
                <?php foreach ($binding as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->binding_id){echo "selected";} ?>>
                    <?php echo $row->name; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Product Quantity:</label>
                <input type="number" class="form-control" name="unit_value" value="<?php echo $value->unit_value; ?>">
            </div>
        </div>
        <div class="col-6">
        <div class="form-group">
        <label class="control-label">Quantity Type:</label>
        <select class="form-control select2" style="width:100%;" name="unit_type_id">
        <option value="">Select Quantity Type</option>
        <?php foreach ($unit_type as $unit) { ?>
        <option value="<?php echo $unit->id; ?>,<?php echo $unit->name; ?>" <?php if($unit->id == $value->unit_type_id){echo "selected";} ?>>
            <?php echo $unit->name; ?>
        </option>
        <?php } ?>
        </select>
    </div>
        </div>
       
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Tax Slab:</label>
                    <select class="form-control select2" style="width:100%;" name="tax_id">
                    <option value="">Select Tax Slab</option>
                    <?php foreach ($tax_slabs as $slab) { ?>
                    <option value="<?php echo $slab->id; ?>,<?php echo $slab->slab; ?>" <?php if($slab->id == $value->tax_id){echo "selected";} ?>>
                        <?php echo $slab->slab; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <!-- <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Hsn/Sac Code:</label>
                    <input type="text" class="form-control" name="sku" value="<?php echo $value->sku; ?>">
                </div>
            </div> -->
            <!-- <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Application</label>
                    <input type="file" name="application" class="form-control">
                </div>
                <?php if(!empty($value->application)) { ?>
                    <img src="<?php echo IMGS_URL.$value->application;?>" alt="<?php echo $value->name; ?>" height="50">
                <?php } ?> 
            </div> -->
            
            <!-- <div class="col-12">
                <div class="form-group">
                <label class="control-label">Brand Name:</label>
                    <select class="form-control select2" style="width:100%;" name="brand_id">
                    <option value="">Select Brand</option>
                    <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand->id; ?>,<?php echo $brand->name; ?>" <?php if($brand->id == $value->brand_id){echo "selected";} ?>>
                        <?php echo $brand->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div> -->
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Description:</label>
                <textarea id="mytextarea" cols="92" rows="5" name="description"><?=$value->description?></textarea>
            </div>
        </div>
    </div>

<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-primary waves-light" ><i id="loader" class=""></i>Create</button>
    <!-- <input id="btnsubmit" type="submit" class="btn btn-primary waves-light" type="submit" value="UPDATE"> -->
</div>

</form>
<script type="text/javascript">
   function fetch_category(parent_id)
   {
    //    alert(business_id);
    $.ajax({
        url: "<?php echo base_url('master-data/fetch_category'); ?>",
        method: "POST",
        data: {
            parent_id:parent_id
        },
        success: function(data){
            $(".parent_cat_id").html(data);
        },
    });
   }
</script>
<script src="<?=base_url()?>/public/assets/plugins/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).on('keyup', '[name=publisher]', function(){
        let value = $(this).val();
        $.ajax({
            url:'<?=base_url()?>master-data/products/find_publisher',
            method:'POST',
            dataType:"JSON",
            data:{
                publisher:value
            },
            success:function(data){
                //console.log(data);
                if (data!='') {
                    let ele = '';
                    $.each(data, function(index,elem){
                        ele += `<li onclick="publisher_click(this)">${elem.name}</li>`;
                    });

                    $("#publisher-list").html(ele);
                    $("#publisher-list").show();
                }else{
                    $("#publisher-list").hide();
                }                
            }
        });
    });

    function publisher_click(btn){
        let value = $(btn).text();
        $('[name=publisher]').val(value);
        $("#publisher-list").hide();
    }

    $(document).on('keyup', '[name=author]', function(){
        let value = $(this).val();
        $.ajax({
            url:'<?=base_url()?>master-data/products/find_author',
            method:'POST',
            dataType:"JSON",
            data:{
                author:value
            },
            success:function(data){
                //console.log(data);
                if (data!='') {
                    let ele = '';
                    $.each(data, function(index,elem){
                        ele += `<li onclick="author_click(this)">${elem.name}</li>`;
                    });

                    $("#author-list").html(ele);
                    $("#author-list").show();
                }else{
                    $("#author-list").hide();
                }                
            }
        });
    });

    function author_click(btn){
        let value = $(btn).text();
        $('[name=author]').val(value);
        $("#author-list").hide();
    }
    
  tinymce.init({
    selector: '#mytextarea'
  });
</script>