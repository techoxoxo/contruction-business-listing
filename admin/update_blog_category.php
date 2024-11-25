<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['category_submit'])) {

        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $category_image_old = $_POST['category_image_old'];
        $category_status = "Active";


//************ Category Name Already Exist Check Starts ***************


        $category_name_exist_check = mysqli_query($conn, "SELECT * FROM " . TBL . "blog_categories  WHERE category_name='" . $category_name . "' AND category_id != $category_id ");

        if (mysqli_num_rows($category_name_exist_check) > 0) {


            $_SESSION['status_msg'] = "The Given Category name is Already Exist Try Other!!!";

            header('Location: admin-blog-category-edit.php?row=' . $category_id);
            exit;


        }

//************ Category Name Already Exist Check Ends ***************


        $_FILES['category_image']['name'];

        if (!empty($_FILES['category_image']['name'])) {
            $file = rand(1000, 100000) . $_FILES['category_image']['name'];
            $file_loc = $_FILES['category_image']['tmp_name'];
            $file_size = $_FILES['category_image']['size'];
            $file_type = $_FILES['category_image']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/services/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $blog_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $blog_image);
                $category_image = compressImage($blog_image, $file_loc, $folder, $new_size);
            } else {
                $category_image = $category_image_old;
            }
        } else {
            $category_image = $category_image_old;
        }

        function checkBlogttCategorySlug($link, $category_id, $counter = 1)
        {
            global $conn;
            $newLink = $link;
            do {
                $checkLink = mysqli_query($conn, "SELECT category_id FROM " . TBL . "blog_categories WHERE category_slug = '$newLink' AND category_id != '$category_id'");
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
        $category_slug = checkBlogttCategorySlug($category_name1, $category_id);

        $sql = mysqli_query($conn, "UPDATE  " . TBL . "blog_categories SET category_name='" . $category_name . "', category_status='" . $category_status . "'
     , category_image='" . $category_image . "', category_slug='" . $category_slug . "'
     where category_id='" . $category_id . "'");

        if ($sql) {

            $_SESSION['status_msg'] = "Category has been Updated Successfully!!!";


            header('Location: admin-all-blog-category.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-blog-category-edit.php?row=' . $category_id);
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-all-blog-category.php');
    exit;
}
?>