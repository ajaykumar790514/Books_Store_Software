<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            dpco:"required",
            parent_id:"required",
            parent_cat_id:"required",
            unit_value:"required",
            unit_type:"required",
            description:"required",                                   
            unit_type_id:"required",                                     
            name:"required",                                     
            product_code:"required",
            tax_id:"required",                                                       
           // expiry_date:"required",                                                                            // mfg_date:"required", 
        },
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
        <!-- <div class="col-4">
            <div class="form-group">
                <label class="control-label">Selected:</label>
                <select class="form-control select2 update_cat_id" style="width:100%;" name="cat_id" id="cat_id">
                    <option value="<?php echo $value->main_cat_id; ?>">
                        <?php echo $value->main_cat_name; ?>
                    </option>
                </select>
                <div id="level-third-cat">
                    <?php 
                        foreach($cat_pro_map as $row){ 
                            if ($row->flag == 1) {
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->cat_id; ?>" id="defaultCheck<?= $row->cat_id; ?>" checked>
                        <label class="form-check-label" for="defaultCheck<?= $row->cat_id; ?>"><?= $row->name; ?></label>
                    </div>
                <?php }else{ ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row->cat_id; ?>" id="defaultCheck<?= $row->cat_id; ?>" checked>
                        <label class="form-check-label" for="defaultCheck<?= $row->cat_id; ?>"><?= $row->name; ?></label>
                    </div>
                <?php } } ?>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Business:</label>
                <select class="form-control" style="width:100%;" name="business_id" id="business_id" onchange="fetch_shop(this.value)" required>
                <option value="">Select Business</option>
                    <?php foreach ($business as $busi) { ?>
                    <option value="<?php echo $busi->id; ?>" <?php if($busi->id == $shops->business_id) {
                        echo "selected";
                    } ?>>
                        <?php echo $busi->title; ?>
                </option>
                <?php } ?>
                </select>
            </div>
        
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Shop:</label>
                <select class="form-control shop_id" style="width:100%;" name="shop_id" id="shop_id" required>
                    <option value="<?php echo $shops->id; ?>">
                        <?php echo $shops->shop_name; ?>
                    </option>
                </select>
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
                <label class="control-label">Search Keyword:</label>
                <input type="text" class="form-control" name="search_keywords" value="<?php echo $value->search_keywords; ?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Product Code/SKU:</label>
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
            <label class="control-label">Select Option:</label>
                <select class="form-control select2" style="width:100%;" name="isbn" required>
                    <option value="">Select</option>
                    <option value="EAN" <?=$value->isbn == 'EAN' ? 'selected' : '';?>>EAN</option>                    
                    <option value="GCID" <?=$value->isbn == 'GCID' ? 'selected' : '';?>>GCID</option>                    
                    <option value="GTIN" <?=$value->isbn == 'GTIN' ? 'selected' : '';?>>GTIN</option>                    
                    <option value="UPC" <?=$value->isbn == 'UPC' ? 'selected' : '';?>>UPC</option>                    
                    <option value="ASIN" <?=$value->isbn == 'ASIN' ? 'selected' : '';?>>ASIN</option>                    
                    <option value="ISBN" <?=$value->isbn == 'ISBN' ? 'selected' : '';?>>ISBN</option>                    
                </select>
            </div>
        </div>

        <div class="col-6 isbn-box">
            <div class="form-group">
                <label class="control-label isbn-label"></label>
                <input type="text" class="form-control" name="isbn_no" value="<?=$value->isbn_no;?>">
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
                <select class="form-control select2" style="width:100%;" name="class">
                <option value="">Select Class</option>
                <?php foreach ($class as $row) { ?>
                <option value="<?php echo $row->id; ?>" <?php if($row->id == $value->class_id){echo "selected";} ?>>
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
<!--
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Application</label>
                    <input type="file" name="application" class="form-control">
                </div>
                <?php if(!empty($value->application)) { ?>
                    <img src="<?php echo IMGS_URL.$value->application;?>" alt="<?php echo $value->name; ?>" height="50">
                <?php } ?> 
            </div>
-->
            <!-- <div class="col-6">
                <div class="form-group">
                <label class="control-label">Company Name:</label>
                    <select class="form-control select2" style="width:100%;" name="brand_id">
                    <option value="">Select Company</option>
                    <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand->id; ?>,<?php echo $brand->name; ?>" <?php if($brand->id == $value->brand_id){echo "selected";} ?>>
                        <?php echo $brand->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                <label class="control-label">Select Ingredients:</label>
                    <select class="form-control select2" style="width:100%;" name="ingredient_id">
                    <option value="">Select Ingredients</option>
                    <?php foreach ($ingredients as $ingredient) { ?>
                    <option value="<?php echo $ingredient->id; ?>,<?php echo $ingredient->title; ?>" <?php if($ingredient->id == $value->ingredient_id){echo "selected";} ?>>
                        <?php echo $ingredient->title; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                    <div class="form-group">
                    <label class="control-label">DPCO / Non DPCO:</label>
                        <select class="form-control select2" style="width:100%;" name="dpco">
                        <option value="">Select Category</option>
                            
                        <?php foreach ($dpco as $item) { ?>
                        <option value="<?php echo $item->id; ?>,<?php echo $item->title; ?>" <?php if($item->id == $value->dpco){echo "selected";} ?>>
                            <?php echo $item->title; ?>
                        </option>
                        <?php } ?>
                        </select>
                    </div>
                </div>
            <div class="col-6">
                <div class="form-group">
                <input type='checkbox' name='is_return' id="is_return" <?php if($value->is_return == '1' ){echo "checked";}  ?>/>
                <label for="is_return">Return Available</label>
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

    <div class="row">
            <div class="form-group col-6">
                <label for="recipient-name" class="control-label">Vendors:</label>
                <select class="form-control select2" name="s_vendor" id="vendor_list_add_new" style="width:100%;">
                    <option value="">Select Vendor</option>
                    <?php foreach ($vendor as $row) { ?>
                    <option value="<?php echo $row->id; ?>" <?php if($row->id == $shops_inventory->vendor_id){echo "selected";} ?>>
                        <?php echo $row->name; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Quantity:</label>
                    <input type="number" class="form-control" name="s_qty" min="0" id="recipient-qty" value="<?=$shops_inventory->qty?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">MRP:</label>
                    <input type="number" class="form-control" name="s_mrp" onkeyup="sellingrate_calc(this)" step="0.01" min="0.00" id="recipient-mrp" value="<?=$shops_inventory->mrp?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Purchase Rate:</label>
                    <input type="number" class="form-control" name="purchase_rate" step="0.01" min="0.00" id="recipient-pr" value="<?=$shops_inventory->purchase_rate?>" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Discount in %:</label>
                    <input type="number" class="form-control" name="selling_rate_pc" onkeyup="sellingrate_calc(this)" step="0.01" min="0.00">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Selling Rate Total:</label>
                    <input type="number" class="form-control" name="selling_rate" onkeyup="perrate_calc(this)" id="recipient-sr" value="<?=$shops_inventory->selling_rate?>" >
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Invoice No:</label>
                    <input type="text" class="form-control" name="invoice_no" id="invoice_no" value="<?=$shops_inventory->invoice_no?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Invoice Date:</label>
                    <input type="date" class="form-control" name="invoice_date" id="invoice_date" value="<?=$shops_inventory->invoice_date?>">
                </div>
            </div>

            <input type="hidden" name="shop_inventry_id" value="<?=$shops_inventory->id?>">
        </div>

<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-primary waves-light" ><i id="loader" class=""></i>Update</button>
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
    $('body').click(function() {
        $("#publisher-list").hide();
        $("#author-list").hide();
    });
    
  

  function sellingrate_calc(obj){
        
        
        let total=0;
        let value = $('[name=selling_rate_pc]').val();
        if(value>100)
        {
            alert("Discount % cant be greater than 100%");
            $('[name=selling_rate_pc]').val("");
            return;
        }
        let mrp = $('[name=s_mrp]').val();
        if (mrp !='') {
             total = mrp - ((mrp * value) / 100);
            $('[name=selling_rate]').val(Math.round(total));
            
            if(total!='' && obj.name!="selling_rate_pc") {
            let res=100-(total*100/mrp);
            $('[name=selling_rate_pc]').val(res.toFixed(2));
            }
            
        }
            
        else{
            alert('Please Enter MRP');
            $('[name=selling_rate_pc]').val('');
        }
       
        
    }
    
    function perrate_calc()
    {
        
        selling=0;
        selling = $('[name=selling_rate]').val();
        let mrp = $('[name=s_mrp]').val();
        if(selling>mrp)
        {
            alert("Selling rate cant be greater than MRP.");
            $('[name=selling_rate]').val("");
            return;
        }
        if (mrp !='') {
            let res=100-(selling*100/mrp);
            $('[name=selling_rate_pc]').val(res.toFixed(2));
        }
        else
        {
            alert('Please Enter MRP');
            $('[name=selling_rate]').val('');
        }
        
    }


    $(document).on('change', '[name=shop_id]', function(){
        let value = $(this).val();
        $.ajax({
            url: "<?=base_url()?>master-data/products/vendor_list",
            method: "POST",
            dataType:"JSON",
            data: {shop_id:value},
            success: function (data) {
                //console.log(data);
                var ele = document.getElementById('vendor_list_add_new');
                $.each(data, function(index,value){
                    ele.innerHTML = ele.innerHTML + '<option value="' + value.id + '">' + value.name + ' </option>';
                });
            }
        });
    });

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
  <?php if(!empty($value->isbn)): ?>
  $(document).ready(function(){
    $('.isbn-box').show();
    $('.isbn-label').text('<?=$value->isbn?> No.');
  });
<?php endif; ?>
  $(document).on('change', '[name=isbn]', function(){
    let value = $(this).val();
    $('.isbn-box').show();
    $('.isbn-label').text(value+' No.');
  })
</script>