<?php

//Get All Sub Categories
function getAllAdPostHighlights()
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_highlights ORDER BY sub_category_id DESC";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get All Sub Category with given Category Id
function getCategoryAdPostHighlights($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_highlights where category_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Get particular Category using category id
function getAdPostHighlightsHighlightId($arg,$arg1)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post_highlights where highlight_id='".$arg."' and ad_post_id='".$arg1."'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($rs);
    return $row;

}

function getAdPostHighlightsAdPostId($arg)
{
    global $conn;

    $sql = "SELECT * FROM  " . TBL . "ad_post_highlights where ad_post_id='".$arg."'";
    $rs = mysqli_query($conn, $sql);
    return $rs;

}

//Sub Category Count using Category Id
function getCountAdPostHighlightsCategory($arg)
{
    global $conn;

    $sql = "SELECT * FROM " . TBL . "ad_post_highlights WHERE category_id = '$arg'";
    $rs = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($rs);
    return $row;

}