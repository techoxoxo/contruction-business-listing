<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $category_qry = " DELETE FROM  " . TBL . "ad_post_categories WHERE category_id='" . $category_id . "'";

        $category_res = mysqli_query($conn,$category_qry);


        $sub_category_qry = " DELETE FROM  " . TBL . "ad_post_sub_categories WHERE category_id='" . $category_id . "'";


        $sub_category_res = mysqli_query($conn,$sub_category_qry);


        if ($category_res) {

            //$_SESSION['status_msg'] = "Category has been Permanently Deleted!!!";

            echo 3;
            exit();

        } else {

           // $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            echo 4;
            exit();
        }

        //    Listing Update Part Ends

} else {

    //$_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    echo 4;
    exit();
}