<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['create_ad_submit'])) {


        $user_id = $_POST["user_id"];
        $all_ads_price_id = $_POST["all_ads_price_id"];

        $ad_start_date_old = $_POST["ad_start_date"];
        $timestamp1 = strtotime($ad_start_date_old);
        $ad_start_date = date('Y-m-d H:i:s', $timestamp1);

        $ad_end_date_old = $_POST["ad_end_date"];
        $timestamp = strtotime($ad_end_date_old);
        $ad_end_date = date('Y-m-d H:i:s', $timestamp);

        $ad_total_days = $_POST["ad_total_days"];
        $ad_cost_per_day = $_POST["ad_cost_per_day"];
        $ad_total_cost = $_POST["ad_total_cost"];
        $ad_link = addslashes($_POST["ad_link"]);


        $_FILES['ad_enquiry_photo']['name'];

        if (!empty($_FILES['ad_enquiry_photo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['ad_enquiry_photo']['name'];
            $file_loc = $_FILES['ad_enquiry_photo']['tmp_name'];
            $file_size = $_FILES['ad_enquiry_photo']['size'];
            $file_type = $_FILES['ad_enquiry_photo']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/ads/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $ad_enquiry_photo = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $ad_enquiry_photo = '';
            }
        }

        $ad_enquiry_status = "InActive";


        $qry = "INSERT INTO " . TBL . "all_ads_enquiry 
					(user_id,all_ads_price_id, ad_start_date, ad_end_date, ad_enquiry_photo, ad_link
					,ad_total_days, ad_cost_per_day, ad_total_cost, ad_enquiry_status, ad_enquiry_cdt) 
					VALUES ('$user_id', '$all_ads_price_id', '$ad_start_date', '$ad_end_date', '$ad_enquiry_photo' , '$ad_link'
					, '$ad_total_days', '$ad_cost_per_day', '$ad_total_cost', '$ad_enquiry_status', '$curDate')";

        $res = mysqli_query($conn, $qry);

        if ($res) {

            $_SESSION['status_msg'] = "New Ad Request has been raised Successfully!!!";


            header('Location: admin-ads-request.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-create-ads.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-ads-request.php');
    exit;
}
?>