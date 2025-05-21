<?php
include("php/dbconnect.php");
include("php/db.php");
include("check_login.php");
global $siteName;
$siteName = " WIN - CLINIC ";

setlocale(LC_TIME, "fr_FR");

?>


    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $siteName ?></title>

    <!--All modukes'Links-->
    <?php
    include("php/mainlinks.php");
    ?>

    <!--Functions-->
    <?php
    //    Function for date delais
    function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps
        $diff = strtotime($start_date) - strtotime($end_date);

        $start_y = date("Y", strtotime($start_date));
        $start_m = date("m", strtotime($start_date));
        $start_d = date("d", strtotime($start_date));

        $end_y = date("Y", strtotime($end_date));
        $end_m = date("m", strtotime($end_date));
        $end_d = date("d", strtotime($end_date));

        if ($start_y == $end_y and $start_m == $end_m and $start_d > $end_d) {
            return -1;
        }
        if ($start_y == $end_y and $start_m > $end_m) {
            return -1;
        }
        if ($start_y > $end_y) {
            return -1;
        }

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return ceil(abs($diff / 86400));
    }

    //    Function which converts date from English to French

    function dateToFrench($date, $format)
    {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
    }

    //  Password generator
    function password_generate($chars)
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($data), 0, $chars);
    }


    ?>


</head>

<style>
    /*.accord {*/
    /*    background-color: gray;*/
    /*    color: white;*/
    /*    cursor: pointer;*/
    /*    padding: 18px;*/
    /*    width: 100%;*/
    /*    border: none;*/
    /*    text-align: left;*/
    /*    outline: none;*/
    /*    font-size: 15px;*/
    /*    transition: 0.4s;*/
    /*}*/

    /*.activ, .accord:hover {*/
    /*    background-color: blue;*/
    /*}*/

    /*.accord:after {*/
    /*    content: '\002B';*/
    /*    color: white;*/
    /*    font-weight: bold;*/
    /*    float: right;*/
    /*    margin-left: 5px;*/
    /*}*/

    /*.activ:after {*/
    /*    content: "\2212";*/
    /*}*/

    /*.panelle {*/
    /*    padding: 0 18px;*/
    /*    background-color: white;*/
    /*    max-height: 0;*/
    /*    overflow: hidden;*/
    /*    transition: max-height 0.2s ease-out;*/
    /*}*/
</style>
<style>
    .accord {
      background-color: gray;
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
    }
    
    .activ, .accord:hover {
      background-color: tan;
    }
    
    .accord:after {
      content: '\002B';
      color: white;
      font-weight: bold;
      float: right;
      margin-left: 5px;
    }
    
    .activ:after {
      content: "\2212";
    }
    
    .panelle {
      padding: 0 18px;
      background-color: white;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.2s ease-out;
    }
    </style>
    <style>
    .accord {
      background-color: gray;
      color: white;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
    }
    
    .activ, .accord:hover {
      background-color: blue;
    }
    
    .accord:after {
      content: '\002B';
      color: white;
      font-weight: bold;
      float: right;
      margin-left: 5px;
    }
    
    .activ:after {
      content: "\2212";
    }
    
    .panelle {
      padding: 0 18px;
      background-color: white;
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.2s ease-out;
    }
    
    /*------------------------------- css/dashboard ---------------------------*/
    
    .dash-widget {
        background-color: #fff;
        border-radius: 4px;
        margin-bottom: 30px;
        padding: 20px;
        position: relative;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    }
    
    .dash-widget-bg1 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #009efb;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-bg2 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #55ce63;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-bg3 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #7a92a3;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-bg4 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #ffbc35;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-bg5 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #9A616A;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-bg6 {
        width: 65px;
        float: left;
        color: #fff;
        display: block;
        font-size: 50px;
        text-align: center;
        line-height: 65px;
        background: #DE7D16;
        border-radius: 50%;
        font-size: 40px;
        height: 65px;
    }
    
    .dash-widget-info > h3 {
        font-size: 24px;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    
    .dash-widget-info span i {
        width: 16px;
        background: #fff;
        border-radius: 50%;
        color: #666666;
        font-size: 9px;
        height: 16px;
        line-height: 16px;
        text-align: center;
        margin-left: 5px;
    }
    
    .dash-widget-info > span.widget-title1 {
        background: #009efb;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    
    .dash-widget-info > span.widget-title2 {
        background: #55ce63;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    
    .dash-widget-info > span.widget-title3 {
        background: #7a92a3;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    
    .dash-widget-info > span.widget-title4 {
        background: #ffbc35;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    .dash-widget-info > span.widget-title5 {
        background: #9A616A;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }
    .dash-widget-info > span.widget-title6 {
        background: #DE7D16;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 13px;
    }

</style>

<?php
include('php/main_top_navbar.php');
?>