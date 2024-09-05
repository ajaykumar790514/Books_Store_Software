
<form class="ajaxsubmit reload-page" action="<?=$action_url?>" method="post">

<div class="modal-body">
    
    <div class="row">
    <div class="col-12">
                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="Pending" <?php if($value->status=='Pending'){echo 'selected';} ;?> >Pending</option>
                        <option value="Replied" <?php if($value->status=='Replied'){echo 'selected';} ;?>  >Replied</option>
                    </select>
                </div>
            </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-primary waves-light" ><i id="loader" class=""></i>Update</button>
</div>

</form>