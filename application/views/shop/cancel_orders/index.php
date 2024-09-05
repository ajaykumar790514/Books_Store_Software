
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Dashboard</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin-dashboard'); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('coupons-offers'); ?>">Cancellation and Replace </a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap">
                            <div class="float-left col-md-2 col-lg-2 col-sm-2">
                                <h3 class="card-title" id="test">Orders Data</h3>
                                <h6 class="card-subtitle"></h6>
                            </div>
    <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" method="POST" enctype="multipart/form-data" tagret-tb="#tb">
                                             <div class="row justify-content-center">
                                            <div class="form-group col-md-2">
                                                <label>From date:</label>
                                                <input type="date" class="form-control input-sm" name="start_date">
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label>To date:</label>
                                                <input type="date" class="form-control input-sm" name="end_date">
                                            </div>
                                           

                                            <div class="col-md-2">
                                                <div class="form-group mb-0">
                                                    <label for="name">Search</label>
                                                    <input type="text" class="form-control input-sm" name="tb-search" id="tb-search" value="<?php if($search!='null'){echo $search;}?>" placeholder="Search..." />
                                                </div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Cancellation Replace Status :</label>
                                                <select class="form-control input-sm" name="status" >
                                                <option value="">Select</option>
                                                <?php foreach($status as $s){?>
                                                <option value="<?=$s->id;?>"><?=$s->name;?></option> 
                                                <?php } ;?>                       
                                             </select>
                                            </div>
                                             <div class="form-group col-md-2">
                                                <label>Payment Status :</label>
                                                <select class="form-control input-sm" name="payment_status" >
                                                <option value="">Select</option>
                                                <?php foreach($payment_status as $s){?>
                                                <option value="<?=$s->id;?>"><?=$s->name;?></option> 
                                                <?php } ;?>                       
                                             </select>
                                            </div>

                                            <div class="col-auto mt-4" >
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary mt-2 mr-1"> Filter</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </form>
      

                            
                        </div>
                    </div>

                    <div class="col-12" id="tb">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->

<!-- //###### ANKIT MAIN CONTENT  ######// -->
<input type="hidden" name="tb" value="<?=$tb_url?>">
<div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
$('#showModal-xl').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal-xl .modal-title').text(recipient)
    $('#showModal-xl .modal-body').load(data_url);
})

$('#showModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal .modal-title').text(recipient)
    $('#showModal .modal-body').load(data_url);
})

$(document).on('click','[data-dismiss="modal"]', function(event) {
    $('#showModal .modal-body').html('');
    $('#showModal .modal-body').text('');
})

function loadtb(url=null){
    if (url!=null) {
        var tbUrl = url;
    }
    else{
        var tbUrl = $('[name="tb"]').val();
    }

    if (tbUrl!='') {
        $('#tb').load(tbUrl);
    }
}

loadtb();

$(document).on('click', '.pag-link', function(event){
    document.body.scrollTop = 0; 
    document.documentElement.scrollTop = 0;
    var search = $('#tb-search').val();
    $.post($(this).attr('href'),{search:search})
    .done(function(data){
        $('#tb').html(data);
    })
    return false;
})

$(document).on("submit", '.ajaxsubmit', function(event) {
    event.preventDefault(); 
    $this = $(this);

    if ($this.hasClass("needs-validation")) {
        if (!$this.valid()) {
            return false;
        }
    }
    
    
    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){
        console.log(data);
        // return false;

        data = JSON.parse(data);
        
        if (data.res=='success') {
            if(!$this.hasClass("update-form")) {
                $('[type="reset"]').click();
            }
            
            if ($this.hasClass("reload-tb")) {
                loadtb();
            }

            if ($this.hasClass("reload-page")) {
                setTimeout(function() {
                    window.location.reload();
                }, 1000); 
            }

            if ($this.hasClass("btn-click")) {
                setTimeout(function() {
                    var btn_target = $this.attr("btn-target");
                    $(btn_target).click();
                }, 1000); 
            }
        }
        alert(data.msg);
        // alert_toastr(data.res,data.msg);
      }
    })
    return false;
})
</script>
<!-- //###### AJAY KUMAR MAIN CONTENT  ######// -->


<script type="text/javascript">
            $(document).on('click', '.pag-link', function(event){
            document.body.scrollTop = 0; 
            document.documentElement.scrollTop = 0;
            // var search = $('#tb-search').val();
            var FormData = $('.dynamic-tb-search').serialize();
            $.post($(this).attr('href'),FormData)
            .done(function(data){
                $('#tb').html(data);
            })
            return false;
        })
        

        var timer;
        var timeout = 800;
        $(document).on('keyup', '#tb-search', function(event){
            clearTimeout(timer);
            timer = setTimeout(function(){
                var search  = $('#tb-search').val();
                // console.log(search);
                var tbUrl = $('[name="tb"]').val();
                $.post(tbUrl,{search:search})
                .done(function(data){
                    $('#tb').html(data);
                })
            }, timeout);

            return false;
        })
$(document).on('change input','.dynamic-tb-search',function(event) {
    $(this).submit();
});

$(document).on('click','.dynamic-tb-search [type=reset]',function(event) {
    $('.dynamic-tb-search')[0].reset();
    setTimeout(function() {
        $('.dynamic-tb-search').submit();
    }, 100);
    
});

$(document).on('submit','.dynamic-tb-search',function(event) {
    $this = $(this);

    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      processData: false,
      contentType: false,
      success: function(data){
        // console.log(data);
        // return false;
        // data = JSON.parse(data);
        $($this.attr("tagret-tb")).html(data);
        
        // alert_toastr(data.res,data.msg);
      }
    })
    return false;
})
</script>
