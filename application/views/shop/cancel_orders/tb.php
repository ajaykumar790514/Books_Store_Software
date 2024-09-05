<style>
    .modal-body {
  overflow-x: auto;
}
</style>
<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($rows)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
       
        <div class="col-md-8 text-right" style="float: left;">
            <?=$links?>
        </div>
    </div>
</div>

<div id="datatable">
    <div id="grid_table">
        <table class="jsgrid-table">
            <tr class="jsgrid-header-row">
                <th class="jsgrid-header-cell jsgrid-align-center">ID</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Order ID</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Customer Name</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Cancel & Replace Date</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Total Value</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Cancellation Replace Status</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Cancellation Replace Type</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Order Status</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Payment Status</th>
                <th class="jsgrid-header-cell jsgrid-align-center">Action</th>
            </tr>
            
            <?php $i=$page; foreach($rows as $value){ ?>
            <tr class="jsgrid-filter-row">
                <th class="jsgrid-cell jsgrid-align-center"><?=++$i?></th>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->orderid;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->booking_name;?><p>( <?=$value->booking_contact;?> )</p></td>
                <td class="jsgrid-cell jsgrid-align-center"><?php echo _date($value->added);?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->total;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->status_name;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->type;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->order_status;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><?=$value->payment_status;?></td>
                <td class="jsgrid-cell jsgrid-align-center"><a target="_blank" href="<?=base_url('cancellation-exchange-orders/details/'.$value->id);?>" class="btn btn-sm btn-primary">View Details</a></td>
            </tr> 
   
            <?php } ?>    
        </table>

            
    </div>
</div>
<div class="row">
    <div class="col-md-6 text-left">
        <span>Showing <?=$page+1?> to <?=$page+count($rows)?> of <?=$total_rows?> entries</span>
    </div>
    <div class="col-md-6 text-right">
        <?=$links?>
    </div>
</div>

