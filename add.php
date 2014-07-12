<?php


/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 * @author        Said Alaoui Idriss
 */

?>
<!DOCTYPE html>
<html>
<!--<![endif]-->

<head>

    <title>Evenup</title>

    <meta name="author" content="PressLayer">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript">
            jQuery(function($){

                $('.month').hide();
                var current = 6;
                $('#month'+current).show();
                $('#Month'+current).show();

                    $('#monthPrev').click(function(){
                        if(current > 1){
                            console.log(current)
                            $('#month'+current).hide();
                            $('#Month'+current).hide();
                            current = current - 1;
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }
                        else{
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }
                        
                    });

                    $('#monthNext').click(function(){
                        if(current < 12){
                            $('#month'+current).hide();
                            $('#Month'+current).hide();
                            current = current + 1;
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }else{
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }

                    });
            });
        </script>
        <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>


        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/flexslider.css" />
        <link rel="stylesheet" type="text/css" href="/css/superfish.css" />
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.fancybox-1.3.4.css" />

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jquery.masonry.min.js"></script>
        <script type="text/javascript" src="/js/jquery.imagesloaded.min.js"></script>
        <script type="text/javascript" src="/js/jquery.infinitescroll.min.js"></script>
        <script type="text/javascript" src="/js/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="/js/hoverIntent.js"></script>
        <script type="text/javascript" src="/js/superfish.js"></script>
        <script type="text/javascript" src="/js/jquery.mobilemenu.js"></script>
        <script type="text/javascript" src="/js/jquery.placeholder.min.js"></script>
        <script type="text/javascript" src="/js/jquery.fitvids.js"></script>
        <script type="text/javascript" src="/js/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
</head>
<body>

      <?php
            require('date.php');
            $date = new Date();
            $year = date('Y');
            $month = date('n');
            $day = date('d');
            $dates = $date->getAll($year);
?>  

 <?php

                    if(isset($_GET['$year']) && isset($_GET['month']) && isset($_GET['day'])) 
                    {

                        $qyear = $_GET['$year'];
                        $qmonth = $_GET['month'];
                        $qday = $_GET['day'];
                    }else{
                        $qyear = $year;
                        $qmonth = $month;
                        $qday = $day;
                    }
                ?>



<div id="header">
        <div class="container clearfix">
            <h1 id="logo"><a href="/events"><img src="/images/logo.png" alt="Place" /></a></h1>
        </div>  
    </div>

    <div id="main">
        <div class="container clearfix">
            <div id="leftContent">
                <div class="inner">
                    


                    <div class="post_item post_single white_box">

                    <div class="post_single_inner">

                        <?php

                        require_once('connect.php');

                        

                         // define variables and set to empty values
                        $Error = "";
                        $event_name = $event_description = $event_place = $event_date = $event_time = $file_name = $event_type = $usr_create = "";

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $allowedExts = array("jpeg", "jpg", "png");
                            $temp = explode(".", $_FILES["file"]["name"]);
                            $extension = end($temp);

                            if ((($_FILES["file"]["type"] == "image/jpeg")
                                || ($_FILES["file"]["type"] == "image/jpg")
                                || ($_FILES["file"]["type"] == "image/pjpeg")
                                || ($_FILES["file"]["type"] == "image/x-png")
                                || ($_FILES["file"]["type"] == "image/png"))
                            && in_array($extension, $allowedExts)) 
                            {
                                  if ($_FILES["file"]["error"] > 0) {
                                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                                  } else {
                                    if (file_exists("img/upload/events/" . $_FILES["file"]["name"])) {
                                        $Error = $_FILES["file"]["name"] . " already exists. ";
                                    } else {
                                      move_uploaded_file($_FILES["file"]["tmp_name"],
                                      "img/upload/events/" . $_FILES["file"]["name"]);
                                      $file_name = $_FILES["file"]["name"];
                                    }
                                }
                            }

                            else {
                              $Error = "File is not of the following format {jpeg, jpg, pjpeg,x-png,png}";
                            }

                            function test_input($data) {
                               $data = trim($data);
                               $data = stripslashes($data);
                               $data = htmlspecialchars($data);
                               return $data;
                             }

                              if (empty($_POST["event_name"]) || empty($_POST["event_description"]) || empty($_POST["event_place"]) ) {
                                $Error = "missing fields";
                              } else {
                                $event_name = test_input($_POST["event_name"]);
                                $event_description = test_input($_POST["event_name"]);
                                $event_place = test_input($_POST["event_name"]);
                              }

                              if (!empty($_POST["event_date"]) || !empty($_POST["event_time"]) || !empty($_POST["usr_create"]) || !empty($_POST["event_type"])) {
                                    $event_date = test_input($_POST["event_date"]);
                                    $event_time = test_input($_POST["event_time"]);
                                    $usr_create = test_input($_POST["usr_create"]);
                                    $event_type = test_input($_POST["event_type"]);
                                    $event_cat = test_input($_POST["event_cat"]);
                              }else{
                                    $Error = "missing fields";
                              }

                              $query = $connect->query("

                                    INSERT INTO events
                                    (event_name, event_time, event_date, usr_create, event_place, event_pic, event_description, event_cat, event_type)
                                    VALUES ('$event_name','$event_time','$event_date',$usr_create,'$event_place','$file_name','$event_description',$event_cat,'$event_type')

                                ");

                              header( 'Location: /events.php' ) ;
                          }
                    ?>
                    
                    <div class="post_entry" style="text-align: center">
                        <h1 style="color:#C53434; font-weight:bold;">New Pike?</h1>
                        <p><span style="color:#C53434;"><?php echo $Error;?><span></span><br><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"
                            enctype="multipart/form-data">
                                <input type="text" name="event_name" placeholder="your activity name" value="<?php echo $event_name;?>"><br><br>
                                <input type="date" name="event_date" value="<?php echo $event_date; ?>"> <input type="time" name="event_time" value="<?php echo $event_time ?>"><br><br>
                                <input type="text" name="usr_create" placeholder="user_id" value="<?php echo $usr_create ?>"><br><br>
                                <input type="text" name="event_place" placeholder="where would it be" value="<?php echo $event_place ?>"><br><br>
                                <select name="event_cat">
                                <?php
                                    require_once('connect.php');

                                      $interests_query = $connect->query("
                                          SELECT *
                                          FROM interests
                                          WHERE interest_name LIKE '$q%'
                                          ORDER BY interest_name Asc 
                                    ");
                                    while($interest = $interests_query->fetch()){
                                        ?>
                                
                                        <option value="<?php echo $interest['interest_id'] ?>"><?php echo $interest['interest_name'] ?></option>
                                    <?php } ?>
                                </select><br><br>
                                <textarea name="event_description" placeholder="inform us of what all would be about"><?php echo $event_description; ?></textarea><br><br>
                                <select name="event_type">
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                    <option value="Secret">Secret</option>
                                </select><br><br>
                                <label>select picture of your event</label>
                                <input type="file" name="file" id="file"><br><br><br>
                                <input type="submit" name="submit" value="Submit">
                            </form>
                        </p>

                    </div>
                </div>
            </div>

                
                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("a.fancybox").fancybox();
                    });
                </script>
                
                
            </div>
        </div>


        <div id="sidebar">



        <div id="calendar-2" class="widget widget_calendar white_box">

            <h3 class="widget_title">Calendar</h3>
            <div id="calendar_wrap">
                 <table id="wp-calendar">
                    <caption>
                     <?php foreach ($date->months as $id=>$m): ?>
                            <b href="#" class="month" id="Month<?php echo $id+1; ?>" width="50px" ><?php echo $m; ?></b>
                        <?php endforeach; ?> <?php echo $year; ?>
                    </caption>

                    <thead>
                    <tr>
                        <th scope="col" title="Monday">M</th>
                        <th scope="col" title="Tuesday">T</th>
                        <th scope="col" title="Wednesday">W</th>
                        <th scope="col" title="Thursday">T</th>
                        <th scope="col" title="Friday">F</th>
                        <th scope="col" title="Saturday">S</th>
                        <th scope="col" title="Sunday">S</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="2" id="monthPrev"><a href="#">&laquo;</a></td>
                        <td colspan="3"></td>
                        <td colspan="2" id="monthNext"><a href="#">&raquo;</a></td>
                    </tr>
                    </tfoot>
                <div class="clear"></div>
        

                <?php $dates = current($dates); ?>
                    <?php foreach ($dates as $m => $days): ?>

                <tbody class="month" id="month<?php echo $m; ?>">
                    <tr>
                    <?php $end = end($days); foreach($days as $d=>$w): ?>
                        <?php if($d == 1 && $w-1 > 0): ?>
                            <td colspan="<?php echo $w-1; ?>" class="pad">&nbsp;</td>
                        <?php endif ?>
                        <?php if($d == $qday  && $m == $qmonth): ?>
                            <td style="background-color:#C53434"><a style="color:white" href="/events?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>"><?php echo $d; ?></td></a>
                        <?php else: ?>
                            <td><a href="/events?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>" ><?php echo $d; ?></td></a>
                        <?php endif ?>

                        <?php if($w == 7): ?>
                            </tr><tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tr>
               
                </tbody>
            <?php endforeach; ?>


             </table>
            </div>
        </div>
     

        
        <script type="text/javascript">
        jQuery(document).ready(function($){ 
            $('#tab_wrapper_tab_widget-2').each(function() {
                $(this).find(".tab_content").hide();
                $(this).find("ul.tab_menu li:first").addClass("active").show(); 
                $(this).find(".tab_content:first").show();
            });
            
            $("ul.tab_menu li").click(function(e) {
                $(this).parents('#tab_wrapper_tab_widget-2').find("ul.tab_menu li").removeClass("active"); 
                $(this).addClass("active");
                $(this).parents('#tab_wrapper_tab_widget-2').find(".tab_content").hide();
        
                var activeTab = $(this).find("a").attr("href");
                $(this).parents('#tab_wrapper_tab_widget-2').find(activeTab).fadeIn();
                
                e.preventDefault();
            });
            
            $("ul.tab_menu li a").click(function(e) {
                e.preventDefault();
            })
        });
        </script>
        
        <!-- BEGIN WIDGET -->
        <div class="widget tab_wrapper white_box" id="tab_wrapper_tab_widget-2">
            
            <ul class="tab_menu"><li class="tab_post"><a href="#post_tab">Notifs</a></li><li  class="tab_comment"><a href="#comment_tab">chat</a></li><li class="tab_tag"><a href="#tag_tab">your pikes</a></li></ul>
            <div class="clear"></div>
            <div class="tabs_container">
            <div id="post_tab" class="tab_content recent_posts">
                    <ul>
                        <li>
                         <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                            <img src="images/_small/1.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                        </a>
                        <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=215" title="Donec At Mauris Enim Duis Untis" class="small_thumb"><img src="images/_small/2.jpg" width="50" height="50" alt="Donec At Mauris Enim Duis Untis"></a><a href="http://localhost/GreatBox/?p=215" title="Donec At Mauris Enim Duis Untis" class="title">Donec At Mauris Enim Duis ...</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri elit<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb"><img src="images/_small/3.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips"></a><a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb"><img src="images/_small/4.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips"></a><a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=211" title="Nullam Vitae Nibh Un Odiosters" class="small_thumb"><img src="images/_small/5.jpg" width="50" height="50" alt="Nullam Vitae Nibh Un Odiosters"></a><a href="http://localhost/GreatBox/?p=211" title="Nullam Vitae Nibh Un Odiosters" class="title">Nullam Vitae Nibh Un Odiosters</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri elit<div class="clear"></div></li></ul>    
                        <a href="#" class="button red full">See all</a>                
                </div>
                                
                <div id="comment_tab" class="tab_content recent_comments" >
                    <br><div style="text-align: center"><a href="#" style="color:#C53434">New Message</a></div>  
                    <ul><li><img alt='' src='http://1.gravatar.com/avatar/5bea567fcf9dd1022d9224e07bf194a5?s=50&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>Nguyen Duc:</cite> <em>2013-04-29 08:41:31</em> <a href="http://localhost/GreatBox/?p=213#comment-9" title="Nguyen Duc on Praesent Et Urna Turpis Sadips">You are right, that's an oversight on my part. Using ...</a></p><div class="clear"></div></li><li><img alt='' src='http://0.gravatar.com/avatar/0669909e23c39a648c28ea23c0b114d6?s=50&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>admin:</cite> <em>2012-08-02 13:39:49</em> <a href="http://localhost/GreatBox/?p=211#comment-4" title="admin on Nullam Vitae Nibh Un Odiosters">This is a reply test … Nulla nunc dui, tristique ...</a></p><div class="clear"></div></li><li><img alt='' src='http://0.gravatar.com/avatar/0669909e23c39a648c28ea23c0b114d6?s=50&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>admin:</cite> <em>2012-08-02 13:39:14</em> <a href="http://localhost/GreatBox/?p=211#comment-3" title="admin on Nullam Vitae Nibh Un Odiosters">This is a test … Quisque ligulas ipsum, euismod atras ...</a></p><div class="clear"></div></li><li><img alt='' src='http://0.gravatar.com/avatar/0669909e23c39a648c28ea23c0b114d6?s=50&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>admin:</cite> <em>2012-08-02 13:38:54</em> <a href="http://localhost/GreatBox/?p=213#comment-6" title="admin on Praesent Et Urna Turpis Sadips">This is a reply test … Class aptent taciti sociosqu ...</a></p><div class="clear"></div></li><li><img alt='' src='http://0.gravatar.com/avatar/0669909e23c39a648c28ea23c0b114d6?s=50&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>admin:</cite> <em>2012-08-02 13:38:32</em> <a href="http://localhost/GreatBox/?p=213#comment-5" title="admin on Praesent Et Urna Turpis Sadips">This is a test … Quisque ligulas ipsum, euismod atras ...</a></p><div class="clear"></div></li></ul>
                    
                    
                             
                    <a href="#" class="button red full">See all</a>
                </div>
                                
                  <div id="tag_tab" class="tab_content recent_posts">
                    <ul>
                        <li>
                         <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                            <img src="images/_small/1.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                        </a>
                        <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=215" title="Donec At Mauris Enim Duis Untis" class="small_thumb"><img src="images/_small/2.jpg" width="50" height="50" alt="Donec At Mauris Enim Duis Untis"></a><a href="http://localhost/GreatBox/?p=215" title="Donec At Mauris Enim Duis Untis" class="title">Donec At Mauris Enim Duis ...</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri elit<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb"><img src="images/_small/3.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips"></a><a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb"><img src="images/_small/4.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips"></a><a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div></li><li> <a href="http://localhost/GreatBox/?p=211" title="Nullam Vitae Nibh Un Odiosters" class="small_thumb"><img src="images/_small/5.jpg" width="50" height="50" alt="Nullam Vitae Nibh Un Odiosters"></a><a href="http://localhost/GreatBox/?p=211" title="Nullam Vitae Nibh Un Odiosters" class="title">Nullam Vitae Nibh Un Odiosters</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri elit<div class="clear"></div></li></ul>  
                        <a href="#" class="button red full">See all</a>                  
                </div>              
                                
            </div>
            
        </div>
        <!-- END WIDGET -->

        <div id="categories-3" class="widget widget_categories white_box"><h3 class="widget_title">Categories</h3>      <ul>
                <li class="cat-item cat-item-2"><a href="http://localhost/GreatBox/?cat=2" title="View all posts filed under Design">Design</a>
            </li>
                <li class="cat-item cat-item-3"><a href="http://localhost/GreatBox/?cat=3" title="View all posts filed under Photography">Photography</a>
            </li>
                <li class="cat-item cat-item-12"><a href="http://localhost/GreatBox/?cat=12" title="View all posts filed under Slider">Slider</a>
            </li>
                <li class="cat-item cat-item-4"><a href="http://localhost/GreatBox/?cat=4" title="View all posts filed under Videos">Videos</a>
            </li>
                <li class="cat-item cat-item-5"><a href="http://localhost/GreatBox/?cat=5" title="View all posts filed under Wordpress">Wordpress</a>
            </li>
                    </ul>
        </div>
    
    </div>
</div><!-- #main -->
    
<div id="footer">
        <div class="container clearfix">
            <div class="ft_left">&copy; 2014 <a href="#">PikeLife</a></div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- #footer -->
<div id="toTop"><a href="#">TOP</a></div>   
</body>
</html>
