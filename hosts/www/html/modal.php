
<?php
include "nav.php";
?>

<br><br><br>

<!-- BEGIN MODAL ADD FIELDS -->

    <div class="btn-group" role="group" aria-label="">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</button>
    </div>
        <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <div class="modal-body">
        <form action="submit.php" method="POST">
                <!-- SET -->
              <input name="option" value="optionname" hidden>
                <table>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                  <tr><td>Field Name</td><td><input class="form-control" name="fieldname" required></td></tr>
                </table>
              </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
    </div>
    </div>
    </div>
  

<!-- END MODAL ADD FIELDS -->