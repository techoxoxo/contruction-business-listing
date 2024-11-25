<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if(file_exists('config/user_authentication.php'))
{
    include('config/user_authentication.php');
}

if(file_exists('config/info.php'))
{
    include('config/info.php');
}

if(isset($_GET['enq_id'])){

    $enquiry_id = $_GET['enq_id'];

    $default = 0;

    $path = $_GET['path'];

    if(isset($_GET['imp'])) {

        $important = $_GET['imp'];

        $event_qry = "UPDATE  " . TBL . "enquiries SET important = '" . $important . "', favourite = '" . $default . "' where enquiry_id='" . $enquiry_id . "'";

        $event_res = mysqli_query($conn, $event_qry);

        if ($event_res) {

            $_SESSION['status_msg'] = $BIZBOOK['ENQUIRY_IMPORTANT_SUCCESS_MESSAGE'];

            header('Location: db-enquiry#'.$path);
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

            header('Location: db-enquiry#'.$path);
        }
    }

        if(isset($_GET['fav'])) {

            $favourite = $_GET['fav'];

            $event_qry = "UPDATE  " . TBL . "enquiries SET favourite = '" . $favourite . "', important = '" . $default . "' where enquiry_id='" . $enquiry_id . "'";

            $event_res = mysqli_query($conn, $event_qry);

            if ($event_res) {

                $_SESSION['status_msg'] = $BIZBOOK['ENQUIRY_FAVOURITE_SUCCESS_MESSAGE'];

                header('Location: db-enquiry#'.$path);
            } else {

                $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

                header('Location: db-enquiry#'.$path);
            }
        }
    if(isset($_GET['main'])) {

        $main = $_GET['main'];

        $event_qry = "UPDATE  " . TBL . "enquiries SET important = '" . $default . "', favourite = '" . $default . "' where enquiry_id='" . $enquiry_id . "'";

        $event_res = mysqli_query($conn, $event_qry);

        if ($event_res) {

            $_SESSION['status_msg'] = $BIZBOOK['ENQUIRY_ALL_LEADS_SUCCESS_MESSAGE'];

            header('Location: db-enquiry#'.$path);
        } else {

            $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

            header('Location: db-enquiry#'.$path);
        }
    }

}else {

    $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

    header('Location: db-enquiry#'.$path);
}