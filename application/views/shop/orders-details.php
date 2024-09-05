<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Orders Details</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="orders">Orders</a></li>
                            <li class="breadcrumb-item active">#<?php echo $orderData[0]['id'];?></li>
                        </ol>
                    </div><!--
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            <div class="">
                                <button class="right-side-toggle waves-effect waves-light btn-success btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                            </div>
                        </div>
                    </div>-->
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    
                     <div id="add-flavour" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog  modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <b>Add Courier Details</b>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form  class="needs-validation" action="<?php echo base_url('orders/addCourier'); ?>" method="post">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Company Name</label>
                                                                                <input type="text" class="form-control" name="name">
                                                                            </div>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                     <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label class="control-label">Tracking Code</label>
                                                                                <input type="text" class="form-control" name="code">
                                                                                <input type="hidden"  value="<?=$orderData[0]['id']?>" name="id" />
                                                                            </div>
                                                                        </div>
                                                                       
                                                                    </div>
                                                                
                                                           
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-danger waves-light" type="submit" value="CREATE">
                                                            </div>
                                                            </form>
                                                        </div>
                                                        </div>
                                                    </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ORDER SUMMARY: <strong>#<?php echo $orderData[0]['orderid'];?></strong></h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td style="border-top: none !important; padding: .75rem; vertical-align: bottom; border-bottom: 1px solid #dee2e6;">Order Date</td>
                                                <td style="border-top: none !important; padding: .75rem; vertical-align: bottom; border-bottom: 1px solid #dee2e6;"><?php echo $orderData[0]['added']; ?> </td>
                                            </tr>    
                                            <?php 
                                              if($orderItems[0]['is_cancel']=='1'){
                                             $oneitemtax =  number_format((float)$orderItems[0]['tax_value']/$orderItems[0]['qty'], 2, '.', ''); }else{ $oneitemtax=0; }?>
                                            <?php 
                                            if($orderItems[0]['is_cancel']=='1'){
                                             $oneitemsaving =  number_format((float)($orderItems[0]['mrp']-$orderItems[0]['price_per_unit']), 2, '.', '');}else{ $oneitemsaving=0; }?>
                                            <tr>
                                                <th>Total items</th>
                                                <th><?php if($orderItems!==FALSE){echo count($orderItems);}else{echo '0';}?></th>
                                            </tr>
                                            <tr>
                                                <th>Total Cancel Items Amount </th>
                                                <th><?= $shop_currency; ?> <?php echo number_format((float)$orderData[0]['total_cancel']-$oneitemtax, 2, '.', '');  ?></th>
                                            </tr>
                                            <tr>
                                                <th>Total Before Tax</th>
                                                <th><?= $shop_currency; ?> <?php  echo number_format((float)($orderData[0]['total_value']- $orderData[0]['tax'])-($orderData[0]['total_cancel']-$oneitemtax), 2, '.', ''); ?></th>
                                            </tr>
                                          
                                            <tr>
                                                <th>Tax</th>
                                                <th><?= $shop_currency; ?> <?php echo number_format((float)$orderData[0]['tax']-$oneitemtax, 2, '.', ''); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Total</th>
                                                <th style="font-size: 1.2rem;"><?= $shop_currency; ?> <?php echo  number_format((float)$orderData[0]['total_value']-$orderData[0]['total_cancel'], 2, '.', '');  ?></th>
                                            </tr>
                                            <tr>
                                                <th>Total Savings</th>
                                                <th><?= $shop_currency; ?> <?php echo number_format((float)$orderData[0]['total_savings']-$oneitemsaving, 2, '.', ''); ?></th>
                                            </tr>
                                            <tr>
                                                <td>Remarks</td>
                                                <td><?php echo $orderData[0]['remark']; ?></td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Order Details</strong></h4>
                                <div class="table-responsive">
                                    <table class="table m-t-30  contact-list no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Customer Name</th>
                                                <th><?php  if($orderData[0]['booking_name']==''){echo  "N/A";}else{echo $orderData[0]['booking_name']; }; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Email Address</th>
                                                <th><?php  if($orderData[0]['email']==''){echo  "N/A";}else{echo $orderData[0]['email']; }; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Contact Number</th>
                                                <th><?php  if($orderData[0]['booking_contact']==''){echo  "N/A";}else{echo $orderData[0]['booking_contact']; }; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Alternate Number</th>
                                                <th><?php  if($orderData[0]['alternate_mobile']==''){echo  "N/A";}else{echo $orderData[0]['alternate_mobile']; }; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Shop Name</th>
                                                <th><?php  if($orderData[0]['shop_name']==''){echo  "N/A";}else{echo $orderData[0]['shop_name']; }; ?></th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th>
                                                    <?=$orderData[0]['address']."<br> ".$orderData[0]['floor']." , ".$orderData[0]['apartment_name']." <br> ".$orderData[0]['state'] ." ".$orderData[0]['city']." <br>".$orderData[0]['pincode']?>

                                                    <?php 
                                                       // if($orderData[0]['address_id']===''){
                                                          //  echo $orderData[0]['random_address'];
                                                      //  }else{
                                                          //  echo $customerAddress[0]['house_no'].', '.$customerAddress[0]['apartment_name'].', '.$customerAddress[0]['address'];
                                                       //n }   
                                                    ?>

                                                </th>
                                            </tr>
                                             <tr>
                                                <th>Landmark</th>   
                                                   <th><?php  if($orderData[0]['direction']==''){echo  "N/A";}else{echo $orderData[0]['direction']; }; ?></th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Payment Method</td>
                                                <td><?php  if($orderData[0]['payment_method']==''){echo  "N/A";}else{echo $orderData[0]['payment_method']; }; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Transaction Id</td>
                                                <td><?php  if($orderData[0]['razorpay_payment_id']==''){echo  "N/A";}else{echo $orderData[0]['razorpay_payment_id']; }; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bank Name</td>
                                                <td><?php  if($orderData[0]['bank_name']==''){echo  "N/A";}else{echo $orderData[0]['bank_name']; }; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Courier Company</td>
                                                <td><?php  if($orderData[0]['courier_company']==''){echo  "N/A";}else{echo $orderData[0]['courier_company']; }; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Courier Code</td>
                                                <td><?php  if($orderData[0]['courier_code']==''){echo  "N/A";}else{echo $orderData[0]['courier_code']; }; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><strong>Order Status</strong></h4>
                                <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th>
                                                    <select class="select" id="order-status" style="width: 100%" data-placeholder="Choose" class="form-control">
                                            <?php  $rs=$this->order_status_master_model->getCurrentStatus($orderData[0]['id']);
                                                             
                                                $orderStatusNew=$this->order_status_master_model->getRowsNew($rs->order)?>
                                                        <?php foreach($orderStatusNew as $orstatus):?>
                                                        <option value="<?=$orstatus->id;?>" ><?=$orstatus->name;?></option>
                                                    <?php  endforeach;?>
                                                    <?php

                                                        // if(isset($orderStatus) && $orderStatus!==FALSE){
                                                        //     if($orderData[0]['status']==='4' || $orderData[0]['status']==='6' || $orderData[0]['status']==='1'){
                                                        //         if($orderData[0]['status']==='4'){
                                                        //             echo '<option value="4">Completed</option>';
                                                        //         }else if($orderData[0]['status']==='1') {
                                                        //             echo '<option value="1">Pending Payment</option>';
                                                        //         }else{
                                                        //             echo '<option value="6">Cancelled</option>';
                                                        //         }
                                                        //     }else{
                                                        //         echo '<option value="">Select Order Status</option>';
                                                        //         foreach($orderStatus as $status){
                                                        //             if($status['order'] >= $orderStatusData[0]['order']){
                                                        //                 echo '<option value="'.$status['id'].'" ';
                                                        //                 if($status['id']===$orderData[0]['status']){
                                                        //                     echo 'selected';
                                                        //                 }
                                                        //                 echo '>'.$status['name'].'</option>';
                                                        //             }
                                                        //         }
                                                        //     }
                                                        // }
                                                    ?>
                                                    </select>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="2"><button class="btn btn-danger float-right" id="status-update">Update Status</button></th>
                                            </tr>
                                            <?php
                                            if($orderData[0]['status']=='20' || $orderData[0]['status']=='3'):
                                            ?>
                                             <tr>
                                                <th colspan="2"><button data-toggle="modal" data-target="#add-flavour"  class="btn btn-danger float-right" id="status-update">Enter Courier Details</button></th>
                                            </tr>
                                            <?php
                                            endif;
                                            ?>
                                          
                                        </thead>
<!--
                                    
                                        <tbody>
                                        <tr>
                                                <td>Assign Delivery Man</td>
                                                <td>
                                                    <?php 
                                                    $disabled = "disabled";
                                                    if(in_array($orderData[0]['status'], ['17','2','3','20'])  ){
                                                        $disabled = "";
                                                    } ?>
                                                    <select id="delivery_boy" class="select" <?=$disabled?>>
                                                        <option value=""> -- Select --</option>
                                                        <?php 
                                                        foreach ($delivery_boys as $dbvalue) {

                                                            $dbselected ='';
                                                            if (@$orderAssign[0]['delivery_boy_id']==$dbvalue->id) {
                                                                $dbselected = 'selected';
                                                            }
                                                            echo "<option value='".$dbvalue->id."' $dbselected >";
                                                            echo $dbvalue->full_name.' ('.$dbvalue->contact_number.')';
                                                            echo "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button class="btn btn-warning float-right assign-delivery" <?=$disabled?>  >Assign</button></td>
                                            </tr>
                                        </tbody>
-->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
//                         $('#order-status').change(function(e){
//                             e.preventDefault();
//                             if($('#order-status option:selected').val() === '20'){
//                                 Swal.fire({
//                                   title: 'Please enter the Invoice number for this order',
//                                   input: 'text',
//                                   inputAttributes: {
//                                     autocapitalize: 'off'
//                                   }, 
//                                   confirmButtonText: 'Update',
//                                   showLoaderOnConfirm: true,
//                                   preConfirm: (login) => {
//                                     return $.ajax({
//                                             type:"POST",
//                                             url: "orders/updateOrderBillNo",
//                                             data: {id: "<?php echo $orderData[0]['id'];?>",bill_no:login},
//                                         });
//                                   },
//                                   allowOutsideClick: () => !Swal.isLoading()
//                                 }).then((result) => {
//                                   if (result.isConfirmed) {
//                                     Swal.fire({
//                                       title: 'Invoice number updated',
//                                     })
//                                   }
//                                 })
//                             }
//                         });
                        $('#status-update').click(function(e){
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: true
                                })

                                swalWithBootstrapButtons.fire({
                                    title: 'Are you sure to update the status to '+$('#order-status option:selected').text()+' ?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, please!',
                                    cancelButtonText: 'No, cancel!',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        return $.ajax({
                                            type:"POST",
                                            url: "orders/updateOrderStatus",
                                            data: {item:{id: "<?php echo $orderData[0]['id'];?>",status:$('#order-status option:selected').val()}},
                                            'success': function (data) {

                                                swalWithBootstrapButtons.fire(
                                                    'Success!',
                                                    'Status has been updated.',
                                                    'success',
                                                ).then((result) => {
                                                    //$("#grid_table").jsGrid("loadData");
                                                    location.reload();
                                                })
                                            }
                                        });
                                    } else if (
                                        /* Read more about handling dismissals below */
                                        result.dismiss === Swal.DismissReason.cancel
                                    ) {
                                        swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                        'You\'ve cancelled the transaction',
                                        'error'
                                        )
                                    }
                                })
                            
                        });
                       $('.assign-delivery').click(function(e){
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: true
                                })

                                swalWithBootstrapButtons.fire({
                                    title: 'Are you sure to assign this order to '+$('#delivery_boy option:selected').text()+' ?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, please!',
                                    cancelButtonText: 'No, cancel!',
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        return $.ajax({
                                            type:"POST",
                                            url: "orders/updateDeliveryBoy",
                                            data: {item:{id: "<?php echo $orderData[0]['id'];?>",delivery_boy:$('#delivery_boy option:selected').val()}},
                                            'success': function (data) {
                                                console.log(data);
                                                swalWithBootstrapButtons.fire(
                                                    'Success!',
                                                    'Status has been updated.',
                                                    'success',
                                                ).then((result) => {
                                                    //$("#grid_table").jsGrid("loadData");
                                                    // location.reload();
                                                })
                                            }
                                        });
                                    } else if (
                                        /* Read more about handling dismissals below */
                                        result.dismiss === Swal.DismissReason.cancel
                                    ) {
                                        swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                        'You\'ve cancelled the transaction',
                                        'error'
                                        )
                                    }
                                })
                            
                        });
                      
                        $(document).ready(function() {
                        $(".needs-validation").validate({
                            rules: {
                                name:"required",
                                code:"required"  
                            },
                            messages: {
                                name: {
                                    required : "Please enter name.",
                                   
                                },
                                code: {
                                    required : "Please enter code.",
                                   
                                }
                            }
                        }); 
                    });

                    </script>
        
                    <div class="col-lg-9">
                        <div class="card">
                            <!-- .left-right-aside-column-->
                            <div class="card-body">
                                <h4 class="card-title">Order Items</h4> 
                                <h4 class="card-title float-lrft"><?php if($orderItems[0]['is_cancel']=='1') {?><button class="btn btn-sm btn-danger">Order has been some <?=$ordercancelstatus[0]['status_name'] ?? '';?> item</button><?php }else{echo "";}?></h4>                        
                                <div class="contact-page-aside">
                                    <div class="table-responsive">
                                        <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-paging="true" data-paging-size="7"   >
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th colspan="2" class="text-center">Product Name</th>
                                                    <th>Item Status</th>
                                                    <th>Unit</th>
                                                    <th>Rate</th>
                                                    <th>Qty</th>
                                                    <th>Amount</th>
                                                    <th>Tax</th>
                                                    <th>Offer Applied (if any)</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php  
                                              if($orderItems[0]['is_cancel']=='1'){
                                              $oneitemtax =  number_format((float)$orderItems[0]['tax_value']/$orderItems[0]['qty'], 2, '.', ''); }else {$oneitemtax =0;}?>
                                              
                                                <?php
                                                    $total=0;
                                                    if($orderItems!==FALSE){
                                                        $count=1;
                                                        foreach($orderItems as $items){
                                                   ?>
                                                            <tr>
                                                            <td width="10px"><?=$count;?></td>
                                                            <td>
                                                           <img src="<?=$items['img'];?>" style="width:90px; max-height:90px;"></td>
                                                           
                                                           <td width="500px !important" valign="top"><?=$items['product_name'].' <strong>('.str_pad($items['product_code'], 6, '0', STR_PAD_LEFT).')'?></strong>
                                                            </td>
                                                            
                                                            <td style="color: red;"><?=$items['cancel_qty'];?> <?php if($orderItems[0]['is_cancel']=='1') {?> item has been <?=$ordercancelstatus[0]['status_name'] ?? '';?> <?php }else{echo "";}?></td>
                                                            
                                                            <td  width="200px"><?=$items['unit_value'].' '.$items['unit_type'];?></td>
                                                            
                                                            <td  width="200px"><?=$shop_currency.' '.$items['price_per_unit'];?></td>
                                                            
                                                            <td><?=$items['qty'];?></td>
                                                            
                                                            <td  width="200px"><?=$shop_currency.' '.((float)$items['total_price']-(float)$items['tax_value'])-(float)$items['cancel_amount']+(float)$oneitemtax;?></td>
                                                            
                                                            <td  width="200px"><?=(float)$items['tax_value']-$oneitemtax;?></td>
                                                            
                                                            <td><?=$items['offer_applied'];?></td>
                                                            
                                                            <td style="font-size: 1.1rem;font-weight:500"  width="250px"><?=$shop_currency.' '.number_format((float)$items['total_price']-(float)$items['cancel_amount'], 2, '.', '');?></td>
                                                            
                                                            </tr>
                                                            
                                                          <?php   $count++;
                                                            $total=$total+$items['total_price'];
                                                        }
                                                    }
                                                ?>
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                    <!-- .left-aside-column-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->