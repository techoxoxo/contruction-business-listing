<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ad_post_submit'])) {

// Common ad_post Details
        $ad_post_id = $_POST["ad_post_id"];
        $ad_post_code = $_POST["ad_post_code"];

        $gallery_image_old = $_POST["gallery_image_old"];

        $sub_category_id_old = $_POST["sub_category_id_old"];

        $user_id = $_POST['user_id']; //User Id

        $ad_post_name = $_POST["ad_post_name"];
        $ad_post_price = $_POST["ad_post_price"];

        $ad_post_locality = $_POST["ad_post_locality"];
        $ad_post_address = $_POST["ad_post_address"];
        $ad_post_contact_name = $_POST["ad_post_contact_name"];
        $ad_post_contact_mobile = $_POST["ad_post_contact_mobile"];
        $ad_post_contact_email = $_POST["ad_post_contact_email"];

        $country_id = $_POST["country_id"];

        $city_id1 = $_POST["city_id"];

        $prefix = $fruitList = '';
        foreach ($city_id1 as $fruit) {
            $city_id .= $prefix . $fruit;
            $prefix = ',';
        }

        $ad_post_description = addslashes($_POST["ad_post_description"]);

        $category_id = $_POST["category_id"];

//ad_post Specifications

        $ad_post_sub_categories = mysqli_query($conn, "SELECT * FROM  " . TBL . "ad_post_sub_categories where category_id='" . $category_id . "'");

        $prefix1 = $fruitList = '';

        foreach ($ad_post_sub_categories as $ad_post_sub_categories_row) {
            $sub_category_id .= $prefix1 . $ad_post_sub_categories_row['sub_category_id'];   //Sub-category List from db
            $prefix1 = ',';
        }

        $ad_post_sub_cat_value_arr = [];
        $prefix1 = $prefix2 = '';

        foreach ($ad_post_sub_categories as $fruit1) {

            $sub_cat_id = $fruit1['sub_category_id'];
            $ad_post_sub_cat_value_arr = $_POST["ad_post_sub_cat_" . $sub_cat_id];
            $sub_category_id_values .= $prefix1 . $ad_post_sub_cat_value_arr;
            $prefix1 = ',';

            $ad_post_highlights_qry = "INSERT INTO " . TBL . "ad_post_highlights 
					( category_id, sub_category_id, sub_category_value, ad_post_id, highlight_cdt) 
					VALUES 
					('$category_id', '$sub_cat_id', '$ad_post_sub_cat_value_arr', '$ad_post_id' ,'$curDate')";


            $ad_post_highlights_res = mysqli_query($conn, $ad_post_highlights_qry);
            $ad_post_highlightsID = mysqli_insert_id($conn);
            $highlight_id .= $prefix2 . $ad_post_highlightsID;
            $prefix2 = ',';

        }


        $ad_post_status = "Active";
        $payment_status = "Pending";

//To delete old sub category values from highlights table starts

        $sub_category_idArray = explode(',', $sub_category_id_old);
        foreach ($sub_category_idArray as $cit_Array) {

            $ad_post_qry1 = " DELETE FROM  " . TBL . "ad_post_highlights WHERE highlight_id='" . $cit_Array . "'";

            $ad_post_res = mysqli_query($conn,$ad_post_qry1);

        }
//To delete old sub category values from highlights table ends


// ************************  Gallery Image Upload starts  **************************

        $all_gallery_image = $_FILES['gallery_image'];
        if (count(array_filter($_FILES['gallery_image']['name'])) <= 0) {
            $gallery_image = $gallery_image_old;
        } else {

            for ($k = 0; $k < count($all_gallery_image); $k++) {


                if (!empty($all_gallery_image['name'][$k])) {
                    $file1 = rand(1000, 100000) . $all_gallery_image['name'][$k];
                    $file_loc1 = $all_gallery_image['tmp_name'][$k];
                    $file_size1 = $all_gallery_image['size'][$k];
                    $file_type1 = $all_gallery_image['type'][$k];
                    $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
                    if (in_array($file_type1, $allowed)) {
                        $folder1 = "../ads/images/";
                        $new_size = $file_size1 / 1024;
                        $new_file_name1 = strtolower($file1);
                        $event_image1 = str_replace(' ', '-', $new_file_name1);
                        //move_uploaded_file($file_loc1, $folder1 . $event_image1);
                        $gallery_image1[] = compressImage($event_image1, $file_loc1, $folder1, $new_size);
                    } else {
                        $gallery_image1[] = '';
                    }
                }
                $gallery_image = implode(",", $gallery_image1);
            }
        }

// ************************  Gallery Image Upload ends  **************************

        function checkAdPostSlug($link, $ad_post_id, $counter = 1)
        {
            global $conn;
            $newLink = $link;
            do {
                $checkLink = mysqli_query($conn, "SELECT ad_post_id FROM " . TBL . "ad_post WHERE ad_post_slug = '$newLink' AND ad_post_id != '$ad_post_id'");
                if (mysqli_num_rows($checkLink) > 0) {
                    $newLink = $link . '' . $counter;
                    $counter++;
                } else {
                    break;
                }
            } while (1);

            return $newLink;
        }


        $ad_post_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $ad_post_name));
        $ad_post_slug = checkAdPostSlug($ad_post_name1, $ad_post_id);

//    Ad Post Insert Part Starts


        $ad_post_qry =
            "UPDATE  " . TBL . "ad_post  SET user_id='" . $user_id . "', category_id='" . $category_id . "', sub_category_id='" . $highlight_id . "'
            , ad_post_name='" . $ad_post_name . "', ad_post_description ='" . $ad_post_description . "', gallery_image='" . $gallery_image . "', ad_post_price='" . $ad_post_price . "'
            , ad_post_locality='" . $ad_post_locality . "', ad_post_address='" . $ad_post_address . "'
    ,country_id='" . $country_id . "',city_id='" . $city_id . "',ad_post_status='" . $ad_post_status . "', ad_post_contact_name='" . $ad_post_contact_name . "'
    ,ad_post_contact_mobile='" . $ad_post_contact_mobile . "',ad_post_contact_email='" . $ad_post_contact_email . "', payment_status='" . $payment_status . "'
    , ad_post_slug='" . $ad_post_slug . "' where ad_post_id='" . $ad_post_id . "'";


        $ad_post_res = mysqli_query($conn, $ad_post_qry);



        //****************************    Admin Primary email fetch starts    *************************

        $admin_primary_email_fetch = mysqli_query($conn, "SELECT * FROM " . TBL . "footer WHERE footer_id = '1' ");
        $admin_primary_email_fetchrow = mysqli_fetch_array($admin_primary_email_fetch);
        $admin_primary_email = $admin_primary_email_fetchrow['admin_primary_email'];
        $admin_footer_copyright = $admin_primary_email_fetchrow['footer_copyright'];
        $admin_site_name = $admin_primary_email_fetchrow['website_address'];
        $admin_address = $admin_primary_email_fetchrow['footer_address'];

        //****************************    Admin Primary email fetch ends    *************************


        if ($ad_post_res) {

            $admin_email = $admin_primary_email; // Admin Email Id

            //$webpage_full_link_with_login = $webpage_full_link . "login";  //URL Login Link

//****************************    Admin email starts    *************************

//            $to = $admin_email;
//            $subject = "$admin_site_name -New Ad Post has been created";
//
//            $admin_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail WHERE mail_id = 19 "); //User mail template fetch
//            $admin_sql_fetch_row = mysqli_fetch_array($admin_sql_fetch);
//
//            $mail_template_admin = $admin_sql_fetch_row['mail_template'];
//
//            $message1 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_admin));
//
//
//            $headers = "From: " . "$email_id" . "\r\n";
//            $headers .= "Reply-To: " . "$email_id" . "\r\n";
//            $headers .= "MIME-Version: 1.0\r\n";
//            $headers .= "Content-Type: text/html; charset=utf-8\r\n";
//
//
//            mail($to, $subject, $message1, $headers); //admin email


//****************************    Admin email ends    *************************

//****************************    Client email starts    *************************

//            $to1 = $email_id;
//            $subject1 = "$admin_site_name Ad Post Creation Successful";
//
//            $client_sql_fetch = mysqli_query($conn,"SELECT * FROM " . TBL . "mail  WHERE mail_id = 18 "); //User mail template fetch
//            $client_sql_fetch_row = mysqli_fetch_array($client_sql_fetch);
//
//            $mail_template_client = $client_sql_fetch_row['mail_template'];
//
//            $message2 =   stripslashes(str_replace(array('\'.$admin_site_name.\'', '\' . $first_name . \'', '\' . $email_id . \''
//            ,'\' . $mobile_number . \'', '\' . $listing_name . \'', '\' . $listing_email . \'', '\' . $listing_mobile . \'', '\'.$admin_footer_copyright.\'', '\'.$admin_address.\'', '\'.$webpage_full_link.\'','\'.$webpage_full_link_with_login.\'','\'.$admin_primary_email.\''),
//                array(''.$admin_site_name.'', '' . $first_name . '', '' . $email_id . '','' . $mobile_number . '', '' . $listing_name . '', '' . $listing_email . '', '' . $listing_mobile . '', ''.$admin_footer_copyright.'', ''.$admin_address.'', ''.$webpage_full_link.'',''.$webpage_full_link_with_login.'',''.$admin_primary_email.''), $mail_template_client));
//
//
//            $headers1 = "From: " . "$admin_email" . "\r\n";
//            $headers1 .= "Reply-To: " . "$admin_email" . "\r\n";
//            $headers1 .= "MIME-Version: 1.0\r\n";
//            $headers1 .= "Content-Type: text/html; charset=utf-8\r\n";
//
//
//            mail($to1, $subject1, $message2, $headers1); //admin email

//****************************    client email ends    *************************


            $_SESSION['status_msg'] = "Your Ad Post has been Updated Successfully!!!";

            header('Location: admin-ad-post-all.php');
        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-edit-ad-posts.php?code=' . $ad_post_code);
        }

        //    Ad Post Insert Part Ends

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-ad-post-all.php');
}