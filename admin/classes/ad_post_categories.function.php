<?php

//Get All Categories
function getAllAdPostCategories()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Categories order by position Id
function getAllAdPostCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_categories ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Active Categories order by position Id
function getAllActiveAdPostCategoriesPos()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_categories WHERE category_filter = 0 ORDER BY category_filter_pos_id ASC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getAdPostCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getNameAdPostCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post_categories where category_name='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category using category name
function getSlugAdPostCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post_categories where category_slug='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

//Get particular Category Name using category id
function getAdPostCategoryName($arg)
{
    global $conn;

    $sql = "SELECT category_name FROM  " . TBL . "ad_post_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get particular Category Name using category id
function getAdPostCategorySlug($arg)
{
    global $conn;

    $sql = "SELECT category_slug FROM  " . TBL . "ad_post_categories where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row[0];

}

//Get All Category Count
function getCountAdPostCategory()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_categories ORDER BY category_id DESC";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}

//Sub Category Count using Category Id
function getCountCategoryAdPostCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_categories WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}