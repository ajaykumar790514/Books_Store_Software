<style>
.fa {
  margin-left: -12px;
  margin-right: 8px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $(".needs-validation").validate({
        rules: {
            dpco:"required",
            brand_id:"required",
            parent_id:"required",
            parent_cat_id:"required",
            unit_value:"required",
            unit_type:"required",
            description:"required",                 
            unit_type_id:"required",     
            tax_id:"required",     
            expiry_date:"required",                                                     
            mfg_date:"required", 
            business:"required",
            shop_id:"required",                                                                                            
            name: {
                required:true,
            },
            product_code: {
                required:true,
                remote:"<?=$remote?>null/product_code"
            },
            sku:{
                required:true,
                remote:"<?=$remote?>null/sku"
            },
            isbn_no:{
                remote:"<?=$remote?>null/isbn_no"
            },
           
        },
        messages: {
            name: {
                required : "Please enter name!",
            },
            product_code: {
                required : "Please enter product code!",
                remote : "Product code already exists!"
            },
            sku: {
                required : "Please enter Hsn/Sac Code!",
                remote : "Hsn/Sac Code already exists!"
            },
            isbn_no:{
                remote:"Code No. already exists!"
            },
        }
    }); 
});
</script>
<form class="ajaxsubmit needs-validation reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">        
    <div class="row">
        <!-- <div class="col-4">
            <div class="form-group">
            <label class="control-label">Parent Categories:</label>
            <select class="form-control select2" style="width:100%;" name="parent_id" onchange="fetch_sub_categories(this.value)">
            <option value="">Select</option>
            <?php //foreach ($parent_cat as $parent) { ?>
            <option value="<?php //echo $parent->id; ?>">
                <?php //echo $parent->name; ?>
            </option>
            <?php //} ?>
            </select>
            </div>
        </div> -->

        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Categories:</label>
                <!-- <select class="form-control parent_cat_id" style="width:100%;" name="parent_cat_id" id="parent_cat_id" onchange="fetch_category(this.value)">
                                                                            
                </select> -->
                <div class="parent_cat_id" id="parent_cat_id" style="height: 250px;overflow: scroll;">
                    <?php 
                        foreach($parent_cat as $row){
                            //echo $row->name;
                    ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="<?= $row->id; ?>" name="cat_id[]" id="defaultCheck<?= $row->id; ?>">
                        <label class="form-check-label" for="defaultCheck<?= $row->id; ?>"><?= $row->name; ?></label>
                    </div>
                    <?php
                        foreach($categories as $row2){
                            if ($row->id == $row2->is_parent) {
                                //echo $row2->name;
                                
                    ?>
                    <div class="form-check ml-4">
                        <input class="form-check-input" type="checkbox" value="<?= $row2->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>)" id="defaultCheck<?= $row2->id; ?>">
                        <label class="form-check-label" for="defaultCheck<?= $row2->id; ?>"><?= $row2->name; ?></label>
                    </div>
                    <?php
                            
                            foreach($categories as $row3){
                                if ($row2->id == $row3->is_parent) {
                                    //echo $row3->name;
                                    
                    ?>
                    <div class="form-check ml-5">
                        <input class="form-check-input" type="checkbox" value="<?= $row3->id; ?>" name="cat_id[]" onclick="select_parent_cat(this, <?= $row->id; ?>, <?= $row2->id; ?>)" id="defaultCheck<?= $row3->id; ?>" >
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
                <label class="control-label">Categories:</label>
                <select class="form-control" style="width:100%;" name="cat_id" id="level-third-cat">
                                                                            
                </select>
                <div id="level-third-cat">
                    
                </div>                
            </div>
            
        </div> -->
    </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Business:</label>
                    <select class="form-control" style="width:100%;" name="business" id="business_id" onchange="fetch_shop(this.value)">
                    <option value="">Select Business</option>
                    <?php foreach ($business as $busi) { ?>
                    <option value="<?php echo $busi->id; ?>">
                        <?php echo $busi->title; ?>(<?php echo $busi->owner_name; ?>)
                    </option>
                    <?php } ?>
                    </select>
                </div>                         
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Shop:</label>
                    <select class="form-control shop_id" style="width:100%;" name="shop_id" id="shop_id">
                    
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Product Name:</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Product Image:</label>
                    <input type="file" name="img[]" class="form-control" size="55550" accept=".png, .jpg, .jpeg, .gif" multiple="">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Search Keyword:</label>
                    <input type="text" class="form-control" name="search_keywords">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Product Code/SKU:</label>
                    <input type="text" class="form-control" name="product_code" >
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                <label class="control-label">Publisher:</label>
                <input type="text" class="form-control" name="publisher" autocomplete="off">
                <ul id="publisher-list" style="list-style: none;padding: 4px 10px;position: absolute;background: #fff;z-index: 1;border: 1px solid #ddd;width: 91%;max-height: 150px;overflow-y: scroll;display: none;">
                    
                </ul>
                    
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                <label class="control-label">Author:</label>
                <input type="text" class="form-control" name="author" autocomplete="off">
                <ul id="author-list" style="list-style: none;padding: 4px 10px;position: absolute;background: #fff;z-index: 1;border: 1px solid #ddd;width: 91%;max-height: 150px;overflow-y: scroll;display: none;">
                    
                </ul>
                    
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                <label class="control-label">Select Option:</label>
                    <select class="form-control select2" style="width:100%;" name="isbn" required>
                        <option value="">Select</option>
                        <option value="EAN">EAN</option>                    
                        <option value="GCID">GCID</option>                    
                        <option value="GTIN">GTIN</option>                    
                        <option value="UPC">UPC</option>                    
                        <option value="ASIN">ASIN</option>                    
                        <option value="ISBN">ISBN</option>                    
                    </select>
                </div>
            </div>

            <div class="col-6 isbn-box" style="display:none;">
                <div class="form-group">
                    <label class="control-label isbn-label"></label>
                    <input type="text" class="form-control" name="isbn_no" >
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Edition:</label>
                    <input type="text" class="form-control" name="addition" >
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Session:</label>
                    <input type="text" class="form-control" name="session" >
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                <label class="control-label">Board:</label>
                    <select class="form-control select2" style="width:100%;" name="board">
                    <option value="">Select Board</option>
                    <?php foreach ($board as $row) { ?>
                    <option value="<?php echo $row->id; ?>">
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
                    <option value="">Select Board</option>
                    <?php foreach ($class as $row) { ?>
                    <option value="<?php echo $row->id; ?>">
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
                    <option value="">Select Board</option>
                    <?php foreach ($subject as $row) { ?>
                    <option value="<?php echo $row->id; ?>">
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
                    <option value="">Select Board</option>
                    <?php foreach ($binding as $row) { ?>
                    <option value="<?php echo $row->id; ?>">
                        <?php echo $row->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Book Condition:</label>
                    <select class="form-control select2" style="width:100%;" name="book_condition">
                    <option value="">Select Board</option>
                    <?php foreach ($book_condition as $row) { ?>
                    <option value="<?php echo $row->id; ?>">
                        <?php echo $row->name; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <!-- <div class="col-6">
                <div class="form-group">
                <label class="control-label">Company Name:</label>
                    <select class="form-control select2" style="width:100%;" name="brand_id">
                    <option value="">Select Company</option>
                    <?php //foreach ($brands as $brand) { ?>
                    <option value="<?php //echo $brand->id; ?>,<?php //echo $brand->name; ?>">
                        <?php //echo $brand->name; ?>
                    </option>
                    <?php //} ?>
                    </select>
                </div>
            </div> -->

            <!-- <div class="col-6">
                <div class="form-group">
                <label class="control-label">Select Ingredients:</label>
                    <select class="form-control select2" style="width:100%;" name="ingredient_id">
                    <option value="">Select Ingredients</option>
                    <?php //foreach ($ingredients as $ingredient) { ?>
                    <option value="<?php //echo $ingredient->id; ?>,<?php //echo $ingredient->title; ?>">
                        <?php //echo $ingredient->title; ?>
                    </option>
                    <?php //} ?>
                    </select>
                </div>
            </div> -->
        
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Product Quantity:</label>
                    <input type="number" class="form-control" name="unit_value">
                </div>
            </div>
            <div class="col-6">
            <div class="form-group">
            <label class="control-label">Quantity Type:</label>
            <select class="form-control select2" style="width:100%;" name="unit_type_id">
            <option value="">Select Quantity Type</option>
            <?php foreach ($unit_type as $unit) { ?>
            <option value="<?php echo $unit->id; ?>,<?php echo $unit->name; ?>">
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
                    <?php foreach ($tax_slabs as $value) { ?>
                    <option value="<?php echo $value->id; ?>,<?php echo $value->slab; ?>">
                        <?php echo $value->slab; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <!-- <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Hsn/Sac Code:</label>`
                    <input type="text" class="form-control" name="sku" >
                </div>
            </div>
             <div class="col-6">
                <div class="form-group">
                <label class="control-label">DPCO / Non DPCO:</label>
                    <select class="form-control select2" style="width:100%;" name="dpco">
                    <option value="">Select Category</option>
                        
                    <?php //foreach ($dpco as $item) { ?>
                    <option value="<?php //echo $item->id; ?>,<?php //echo $item->title; ?>" >
                        <?php //echo $item->title; ?>
                    </option>
                    <?php //} ?>
                    </select>
                </div>
            </div> -->

             <!-- <div class="col-6">
                <div class="form-group">
                <input type='checkbox' name='is_return' id="is_return" />
                <label for="is_return">Return Available</label>
                </div>
            </div> -->
<!--
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Application</label>
                    <input type="file" class="form-control" name="application">
                </div>
            </div>
-->
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Description:</label>
                    <textarea id="mytextarea" cols="92" rows="5" class="form-control" name="description"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="recipient-name" class="control-label">Vendors:</label>
                <select class="form-control select2" name="s_vendor" id="vendor_list_add_new" style="width:100%;">
                <option value="">Select Vendor</option>
                </select>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Quantity:</label>
                    <input type="number" class="form-control" name="s_qty" min="0" id="recipient-qty" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">MRP:</label>
                    <input type="number" class="form-control" name="s_mrp" onkeyup="sellingrate_calc(this)"  id="recipient-mrp" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Purchase Rate:</label>
                    <input type="number" class="form-control" name="purchase_rate"  id="recipient-pr" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Discount in %:</label>
                    <input type="number" class="form-control" name="selling_rate_pc" id="selling_rate_pc" onkeyup="sellingrate_calc(this)" required>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Selling Rate Total:</label>
                    <input type="number" class="form-control" name="selling_rate" id="recipient-sr" onkeyup="perrate_calc(this)" >
                </div>
            </div>
            
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Invoice No:</label>
                    <input type="text" class="form-control" name="invoice_no" id="invoice_no">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="recipient-name" class="control-label">Invoice Date:</label>
                    <input type="date" class="form-control" name="invoice_date" id="invoice_date">
                </div>
            </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
    <!-- <input type="submit" class="btn btn-danger waves-light" type="submit" value="ADD" /> -->
</div>

</form>

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
  $(document).on('change', '[name=isbn]', function(){
    let value = $(this).val();
    $('.isbn-box').show();
    $('.isbn-label').text(value+' No.');
  })


    
</script>


            

