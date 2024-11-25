<?php

//Get All AdPosts
function getAllAdPost()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Trash Deleted AdPosts
function getAllActiveAdPost()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE ad_post_status= 'Active' ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular AdPost Using AdPost Code
function getAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_code='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular AdPost Using AdPost Slug
function getSlugAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_slug='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular AdPost Using AdPost Code
function getIdAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_id='" . $arg . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All AdPost with given User Id
function getAllAdPostUser($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post  WHERE user_id= '$arg' ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All AdPost with given Category Id
function getAllAdPostCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE category_id= '$arg' ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All AdPost with given Category Id
function getAllAdPostCategoryLimitOne($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE category_id= '$arg' ORDER BY ad_post_id DESC LIMIT 1";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All AdPost with given User Id and AdPost Id
function getAllAdPostUserAdPost($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post  WHERE user_id= '$arg' AND ad_post_id = '$arg1'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All AdPost with given User Id and AdPost Id
function getAllAdPostAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post  WHERE ad_post_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get All AdPost Count
function getCountAdPost()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//AdPost Count using User Id
function getCountUserAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post  WHERE user_id= '$arg' ORDER BY ad_post_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//AdPost Count using Category Id
function getCountCategoryAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//AdPost Count using Country Id
function getCountCountryAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE country_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//AdPost Count using City Id
function getCountCityAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE city_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//AdPost Count using Category Id
function getCountSubCategoryAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post WHERE sub_category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All AdPosts except given event id
function getExceptAdPost($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_status= 'Active' AND ad_post_id !='" . $arg . "' LIMIT 12";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All AdPosts except given event id
function getExceptAdPostCategory($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_status= 'Active' AND ad_post_id !='" . $arg . "' AND category_id = '" . $arg1 . "'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All AdPosts except given event id
function getCountExceptAdPostCategory($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post WHERE ad_post_status= 'Active' AND ad_post_id !='" . $arg . "' AND category_id = '" . $arg1 . "'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Get All Listing with given User Id and Listing Id
function getAllAdPostCities()
{
    global $conn;

    $sql = "SELECT GROUP_CONCAT(city_id) as city_id FROM  " . TBL . "ad_post WHERE ad_post_status= 'Active' AND city_id != 0 ORDER BY city_id ASC";

    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $rs;

}

//Get All Most viewed Ad Post limit 10
function getAllTopViewsPremiumActiveAdPost()
{
    global $conn;

    $sql = "SELECT t1.*, COUNT(*) AS total_count FROM " . TBL . "ad_post AS t1 INNER JOIN `" . TBL . "page_views` AS t2  ON t1.ad_post_id = t2.ad_post_id WHERE t1.ad_post_status= 'Active' GROUP BY t1.ad_post_id ORDER BY COUNT(*) DESC LIMIT 12";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Most viewed Ad Post except first 12 rows limit 10
function getAllTopViewsPremiumActiveExcept12AdPost()
{
    global $conn;

    $sql = "SELECT t1.*, COUNT(*) AS total_count FROM " . TBL . "ad_post AS t1 INNER JOIN `" . TBL . "page_views` AS t2  ON t1.ad_post_id = t2.ad_post_id WHERE t1.ad_post_status= 'Active' GROUP BY t1.ad_post_id ORDER BY COUNT(*) DESC LIMIT 12,18446744073709551615";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All last 3 days added Most viewed Ad Post
function getAllTopViewsTodayDatedAdPost()
{
    global $conn;

    $sql = "SELECT t1.*, COUNT(*) AS total_count FROM " . TBL . "ad_post AS t1 INNER JOIN `" . TBL . "page_views` AS t2  ON t1.ad_post_id = t2.ad_post_id WHERE t1.ad_post_status= 'Active' AND t1.ad_post_cdt >= ( CURDATE() - INTERVAL 3 DAY ) GROUP BY t1.ad_post_id ORDER BY COUNT(*) DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular AdPost SEO Score using ad_post id
function getAdPostSeoScore($arg)
{
    global $conn;

    $sql = "select ( case seo_title when '' then 0 else 1 end +
        case seo_description when '' then 0 else 1 end +
        case seo_keywords when '' then 0 else 1 end ) 
        * 100 / 3 as complete FROM " . TBL . "ad_post WHERE ad_post_id = $arg";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];
}
?>