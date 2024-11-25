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
    $category_image = "";
    $category_status = "Active";


//************ Category Name Already Exist Check Starts ***************

    $category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "ad_post_categories WHERE category_name='" . $category_name . "' AND category_id != $category_id ");

    if (mysqli_num_rows($category_name_exist_check) > 0) {


        //   $_SESSION['status_msg'] = "The Given Category name is Already Exist Try Other!!!";

        echo 1;
        exit;


    }

//************ Category Name Already Exist Check Ends ***************

    function checkListinggCategorySlug($link, $category_id, $counter = 1)
    {
        global $conn;
        $newLink = $link;
        do {
            $checkLink = mysqli_query($conn, "SELECT category_id FROM " . TBL . "ad_post_categories WHERE category_slug = '$newLink' AND category_id != '$category_id'");
            if (mysqli_num_rows($checkLink) > 0) {
                $newLink = $link . '' . $counter;
                $counter++;
            } else {
                break;
            }
        } while (1);

        return $newLink;
    }


    $category_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $category_name));
    $category_slug = checkListinggCategorySlug($category_name1, $category_id);


    $sql = mysqli_query($conn, "UPDATE  " . TBL . "ad_post_categories SET category_name='" . $category_name . "', category_status='" . $category_status . "'
     , category_image='" . $category_image . "', category_slug='" . $category_slug . "'
     where category_id='" . $category_id . "'");


    //****************************************************************************************************************************


    $sql = "SELECT * FROM " . TBL . "ad_post_sub_categories where category_id='".$category_id."'";
    $rs = mysqli_query($conn, $sql);

    foreach ($rs as $sub_category_row) {

        $sub_category_id = $sub_category_row['sub_category_id'];

        $sub_category_name = $_POST['sub_category_id'.$sub_category_id];

        if($sub_category_name == NULL || empty($sub_category_name)) {

            $upqry = mysqli_query($conn, "DELETE FROM  " . TBL . "ad_post_sub_categories WHERE sub_category_id = $sub_category_id");


            //Deleting from Highlights table

            $upqry45 = mysqli_query($conn, "DELETE FROM  " . TBL . "ad_post_highlights WHERE sub_category_id = $sub_category_id AND category_id='".$category_id."'");


        }else{
            $upqry = mysqli_query($conn, "UPDATE " . TBL . "ad_post_sub_categories
					  SET sub_category_name = '$sub_category_name'
					  WHERE sub_category_id = $sub_category_id");
        }

    }


    if ($_POST['sub_category_name'] != NULL) {

//Delete existing sub categories starts

//        $sub_category_qry = " DELETE FROM  " . TBL . "ad_post_sub_categories  WHERE category_id='" . $category_id . "'";
//
//        $sub_category_res = mysqli_query($conn, $sub_category_qry);

//Delete existing sub categories ends

        $cnt = count($_POST['sub_category_name']);


        for ($i = 0; $i < $cnt; $i++) {

            $sub_category_name = $_POST['sub_category_name'][$i];

            $sub_category_status = "Active";


            $sub_category_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $sub_category_name));
            // $sub_category_slug = checkListingSubCategorySlug($sub_category_name1);

            $counter = 1;
            $checkLink = mysqli_query($conn, "SELECT sub_category_id FROM " . TBL . "ad_post_sub_categories WHERE sub_category_slug = '$sub_category_name1'");
            if (mysqli_num_rows($checkLink) > 0) {
                $sub_category_slug = $sub_category_name1 . '' . $counter;
            } else {
                $sub_category_slug = $sub_category_name1;
            }


            $sql = mysqli_query($conn, "INSERT INTO  " . TBL . "ad_post_sub_categories (sub_category_name,sub_category_status, sub_category_slug,category_id,sub_category_cdt)
VALUES ('$sub_category_name','$sub_category_status', '$sub_category_slug','$category_id','$curDate')");

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

            $CATID = 'SUB_CAT' . $LID;

            $upqry = mysqli_query($conn, "UPDATE " . TBL . "ad_post_sub_categories
					  SET sub_category_code = '$CATID'
					  WHERE sub_category_id = $lastID");

        }
    }

    //****************************************************************************************************************************

    if ($sql) {

        // $_SESSION['status_msg'] = "Sub Category has been Updated Successfully!!!";


        echo 3;
        exit;

    } else {

        // $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

        echo 4;
        exit;
    }

} else {

    // $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    echo 4;
    exit;
}
?>