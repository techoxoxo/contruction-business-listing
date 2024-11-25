<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

include "config/info.php";
//if (isset($_POST['category_submit'])) {

$category_name = $_POST['category_name'];

$category_status = "Active";

$category_filter_pos_id = 1;

$category_image = "";


//************ Category Name Already Exist Check Starts ***************


$category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "ad_post_categories  WHERE category_name='" . $category_name . "' ");

if (mysqli_num_rows($category_name_exist_check) > 0) {


    //   $_SESSION['status_msg'] = "The Given Category name $category_name is Already Exist Try Other!!!";

    echo 1;
    exit;


}

//************ Category Name Already Exist Check Ends ***************


$category_name1 = trim(preg_replace('/[^A-Za-z0-9]/', ' ', $category_name));

$counter = 1;
$checkLink = mysqli_query($conn, "SELECT category_id FROM " . TBL . "ad_post_categories WHERE category_slug = '$category_name1'");
if (mysqli_num_rows($checkLink) > 0) {
    $category_slug = $category_name1 . '' . $counter;
} else {
    $category_slug = $category_name1;
}

$sql = mysqli_query($conn, "INSERT INTO  " . TBL . "ad_post_categories (category_name,category_status,category_image,category_filter_pos_id,category_slug,category_cdt)
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

$upqry1 = mysqli_query($conn, "UPDATE " . TBL . "ad_post_categories
					  SET category_code = '$CATID' 
					  WHERE category_id = $lastID");


//****************************************************************************************************************************


if ($_POST['sub_category_name'] != NULL) {

    $cnt = count($_POST['sub_category_name']);


    $category_id = $lastID;


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


if ($upqry) {

    //$_SESSION['status_msg'] = "Category(s) has been Added Successfully!!!";


    echo 3;
    exit;

} else {

    //$_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    echo 4;
    exit;
}

//}
?>