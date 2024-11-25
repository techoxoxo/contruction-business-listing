<?php
/**
 * Created by Vignesh.
 * User: Vignesh
 */

if (file_exists('config/info.php')) {
    include('config/info.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['slider_submit'])) {


        $slider_link = addslashes($_POST["slider_link"]);


        $_FILES['slider_photo']['name'];

        if (!empty($_FILES['slider_photo']['name'])) {
            $file = rand(1000, 100000) . $_FILES['slider_photo']['name'];
            $file_loc = $_FILES['slider_photo']['tmp_name'];
            $file_size = $_FILES['slider_photo']['size'];
            $file_type = $_FILES['slider_photo']['type'];
            $allowed = array("image/jpeg", "image/pjpeg", "image/png", "image/gif", "image/webp", "image/svg", "application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.openxmlformats-officedocument.wordprocessingml.template");
            if (in_array($file_type, $allowed)) {
                $folder = "../images/slider/";
                $new_size = $file_size / 1024;
                $new_file_name = strtolower($file);
                $event_image = str_replace(' ', '-', $new_file_name);
                //move_uploaded_file($file_loc, $folder . $event_image);
                $slider_photo = compressImage($event_image, $file_loc, $folder, $new_size);
            } else {
                $slider_photo = '';
            }
        }


        $qry = "INSERT INTO " . TBL . "slider
					(slider_photo, slider_link, slider_cdt) 
					VALUES ('$slider_photo' , '$slider_link', '$curDate')";

        $res = mysqli_query($conn, $qry);

        if ($res) {

            $_SESSION['status_msg'] = "New slider photo has been created Successfully!!!";


            header('Location: admin-slider-all.php');
            exit;

        } else {

            $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

            header('Location: admin-slider-create.php');
            exit;
        }

    }
} else {

    $_SESSION['status_msg'] = "Oops!! Something Went Wrong Try Later!!!";

    header('Location: admin-ads-request.php');
    exit;
}
?>