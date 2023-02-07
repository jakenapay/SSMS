<?php

// view users account
if (isset($_POST['check_view'])) {

    // get the technology supply id
    $user_id = $_POST['user_id'];

    include 'config.inc.php';

    $result = $conn->query("SELECT u.user_id, u.user_firstname, u.user_lastname, u.user_email, , CONCAT(us.user_firstname, ' ', us.user_lastname) as modified_by FROM ssms.users u INNER JOIN ssms.users us ON u.modified_by=us.modified_by WHERE user_id ='$user_id'");
    // Check if the query was successful
    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Process each row and generate the HTML content
            $user_id = $row['user_id'];
            $fn = $row['user_firstname'];
            $ln = $row['user_lastname'];
            $em = $row['user_email'];
            $old_img = $row['user_img'];
            $cat = $row['user_category'];
            $stat = $row['user_status'];
            $date = $row['user_date'];
            $dlm = $row['date_last_modified'];
            $by = $row['modified_by'];

            echo $return = '
                <div class="row">
                    <div class="col-md-12 pt-4 pb-5 d-flex justify-content-center">
                        <img src="userProfile/' . $old_img . '" alt="" class="img-fluid" style="width: 300px;">
                    </div>
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_id">User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" value="' . $user_id . '" >
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="' . $user_id . '">
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_firstname">First Name</label>
                        <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="' . $fn . '" >
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_lastname">Last Name</label>
                        <input type="text" class="form-control" id="user_lastname" name="user_lastname" value="' . $ln . '" >
                    </div>  
                    <div class="col-md-6 pt-1 pb-1">
                        <label for="user_email">Email</label>
                        <input type="text" class="form-control" id="user_email" name="user_email" value="' . $em . '" >
                    </div>  
                    <div class="col-md-6 pt-3 pb-1">
                        <label for="user_category">Category</label>
                        <select class="user_category" id="user_category">
                            <option value="admin"' . ($cat == 'admin' ? "selected" : "") . '>Admin</option>
                            <option value="user"' . ($cat == 'user' ? "selected" : "") . '>User</option>
                        </select>
                    </div> 
                    <div class="col-md-6 pt-3 pb-1">
                        <label for="user_status">Status</label>
                        <select class="user_status" id="user_status">
                            <option value="active"' . ($cat == 'active' ? "selected" : "") . '>Active</option>
                            <option value="inactive"' . ($cat == 'inactive' ? "selected" : "") . '>Inactive</option>
                        </select>
                    </div>

                    <div class="w-100 my-2">
                        <hr
                    </div>
                      <div class="col-md-12 pt-1 pb-1">
                        <label for="user_date">Date Created</label>
                        <input type="text" class="form-control" id="user_date" name="user_date" value="' . $date . '" disabled>
                    </div>
                      <div class="col-md-12 pt-1 pb-1">
                        <label for="date_last_modified">Last Modified</label>
                        <input type="text" class="form-control" id="date_last_modified" name="date_last_modified" value="' . $dlm . '" disabled>
                    </div>  
                      <div class="col-md-12 pt-1 pb-1">
                        <label for="modified_by">Modified By</label>
                        <input type="text" class="form-control" id="modified_by" name="modified_by" value="' . $by . '" disabled>
                    </div>  
                </div>

                
            ';
        }
    } else {
        echo '<h5>' . $conn->error . '</h5>';
    }
}
