
<?php
include "connection.php";


if (isset($_POST['option'])) {
    $option = $_POST['option'];
    print "ooops !";
        if ($option == "filteraction") {
            $collect_id = $_POST['filtervalues'];
            $collect_id = explode(',', $collect_id);

            foreach ($collect_id as $key => $value) {
                $id = $value;
                $formaction = 'form' . $value;          #This retrieves the unique form name/s from the posting form
                $action = $_POST[$formaction];          #This retrieves the unique form name/s from the posting form
                $stmt = $db->query("SELECT * FROM filter WHERE id='$id';");
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     $shortname = $row['shortname'];
                };
                
                 if ($action == "None") {;}
                    else {
                            $stmt = $db->query("INSERT INTO event SET dateset=CURRENT_DATE,timeset=CURRENT_TIME, event='$shortname',value='$action',filterid='$id'");
                            $stmt = $db->query("UPDATE filter SET dateset=CURRENT_DATE WHERE shortname='$shortname'");
             
                        };

            };


            print '<meta http-equiv="refresh" content="1;url=index.php?page=filtration"/>';
        } 

        else {

    $urloption = $_GET['urloption'];
     // If GET is sent process it here    
    };
};



?>
