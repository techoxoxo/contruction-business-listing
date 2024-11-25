<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('ads-config-info.php')) {
    include "ads-config-info.php";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ad_post_submit'])) {

        $ad_post_id = $_POST["ad_post_id"];

        $ad_post_code = $_POST['_code'];

        $gallery_image_old = $_POST["gallery_image_old"];

        $ad_post_qry =
            " DELETE FROM  " . TBL . "ad_post WHERE ad_post_id='" . $ad_post_id . "'";


        $ad_post_res = mysqli_query($conn,$ad_post_qry);


        if ($ad_post_res) {

            $gallery_image_array = explode(',', $gallery_image_old);
            foreach ($gallery_image_array as $tuple) {
                unlink('../ads/images/' . $tuple);  //Delete all the gallery image(s)
            }


            //Query to delete the page view starts

            $page_view_qry = "DELETE FROM  " . TBL . "page_views where ad_post_id='" . $ad_post_id . "'";

            $page_view_res = mysqli_query($conn,$page_view_qry);

            //Query to delete the page view ends

            //Query to delete the highlights ad post starts

            $ad_post_highlights_qry = "DELETE FROM  " . TBL . "ad_post_highlights where ad_post_id='" . $ad_post_id . "'";

            $ad_post_highlights_res = mysqli_query($conn,$ad_post_highlights_qry);

            //Query to delete the highlights ad post ends


            $_SESSION['status_msg'] = $BIZBOOK['ADS_DELETE_SUCCESS_MESSAGE'];

            header('Location: db-ad-posts');

        } else {

            $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

            header('Location: admin-delete-ad-posts.php?code=' . $ad_post_code);
        }

        //    Listing Update Part Ends

    }
} else {

    $_SESSION['status_msg'] = $BIZBOOK['OOPS_SOMETHING_WENT_WRONG'];

    header('Location: db-ad-posts');
}