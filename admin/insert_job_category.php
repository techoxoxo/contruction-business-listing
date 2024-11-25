<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
if (isset($_POST['category_submit'])) {

    if($_POST['category_name'] != NULL){
        $cnt = count($_POST['category_name']);
    }

// *********** if Count of category name is zero means redirect starts ********

    if($cnt == 0){
        header('Location: admin-add-new-job-category.php');
        exit;
    }

// *********** if Count of category name is zero means redirect ends ********

    for ($i = 0; $i < $cnt; $i++) {

        $category_name = $_POST['category_name'][$i];

        $category_status = "Active";

        $category_filter_pos_id = 1;


//************ Category Name Already Exist Check Starts ***************


        $category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "job_categories  WHERE category_name='" . $category_name . "' ");

        if (mysqli_num_rows($category_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given Category name $category_name is Already Exist Try Other!!!";

            header('Location: admin-add-new-job-category.php');
            exit;


        }

//************ Category Name Already Exist Check Ends ***************

        $category_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $category_name));
        // $category_slug = checkListingCategorySlug($category_name1);

        $counter = 1;
        $checkLink = mysqli_query($conn, "SELECT category_id FROM " . TBL . "job_categories WHERE category_slug = '$category_name1'");
        if (mysqli_num_rows($checkLink) > 0) {
            $category_slug = $category_name1 . '' . $counter;
        }else{
            $category_slug = $category_name1;
        }


        $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "job_categories (category_name,category_status,category_image,category_filter_pos_id,category_slug,category_cdt)
VALUES ('$category_name','$category_status','$category_image','$category_filter_pos_id', '$category_slug', '$curDate')");

        $LID = mysqli_insert_id($conn);
        $lastID = $LID;

        switch (strlen($LID)) {
            case 1:
                $LID = '00' . $LID;
                break;
            case 2:
                $LID = '0' . $LID;
                break;
            default:
                $LID = $LID;
                break;
        }

        $CATID = 'CAT' . $LID;

        $upqry = mysqli_query($conn, "UPDATE " . TBL . "job_categories
					  SET category_code = '$CATID'
					  WHERE category_id = $lastID");

    }

    if ($upqry) {

        $_SESSION['status_msg'] = "Job Category(s) has been Added Successfully!!!";


        header('Location: admin-all-job-category.php');
        exit;

    } else {


        $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        header('Location: admin-add-new-job-category.php');
        exit;
    }

}
?>