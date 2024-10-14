<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal_Success -->
<div class="modal fade" id="successarlert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="mb-3 text-center">
            <img src="asset/image/arlert-success.gif" class="img-thumbnail border-0 clear-shardow resizer-logo150px" alt="" srcset="">
          </div>
          <div class="mb-3">
              <?php echo $text_success;?>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- Modal_NoSuccess -->
<div class="modal fade" id="nullalert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="mb-3 text-center">
            <img src="asset/image/warning-icon.gif" class="img-thumbnail border-0 clear-shardow resizer-logo150px" alt="" srcset="">
          </div>
          <div class="mb-3">
              <?php 
                      
                      if(@$_SESSION['custom_alert'] != ""){
                        echo @$_SESSION['custom_alert'];
                      }
                      else{
                        echo $alert_nullData;
                      }
              ?>
          </div>
        </div>
      </div>
  </div>
</div>
<!-- Modal_duplicate -->
<div class="modal fade" id="duplicatealert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="mb-3 text-center">
            <img src="asset/image/warning-icon.gif" class="img-thumbnail border-0 clear-shardow resizer-logo150px" alt="" srcset="">
          </div>
          <div class="mb-3">
              <?php echo $alert_duplicate;?>
          </div>
        </div>
      </div>
  </div>
</div>