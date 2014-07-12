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


<div id="header">
        <div class="container clearfix">
            <h1 id="logo"><a href="/events.php"><img src="/images/logo.png" alt="Place" /></a></h1>
        </div>  
    </div>

    <div id="main">
        <div class="container clearfix">
            <div id="leftContent">
                <div class="inner">
                    
                    <div id="post_grids" class="post_content clearfix">

                <!-- STARTING THE PHP OPERATION TO GENERATES EVENTS -->
                        <?php

                            $todyear = date('Y');
                            $todmonth = date('m');
                            $todday = date('d');

                            if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])) 
                            {

                                $qyear = $_GET['year'];
                                $qmonth = $_GET['month'];
                                $qday = $_GET['day'];
                            }else{
                                
                                $qyear = $todyear;
                                $qmonth = $todmonth;
                                $qday = $todday;
                            }
                        ?>

                         
                         <?php

                                require_once('connect.php');
                                if(isset($_GET['interest'])){
                                        $inter = $_GET['interest'];
                                        $events_query = $connect->query("

                                            SELECT *
                                            FROM events
                                            JOIN userapps U ON U.usr_id = events.usr_create
                                            LEFT JOIN interests I ON I.interest_id = events.event_cat
                                            WHERE event_date = '". $qyear ."-". $qmonth ."-". $qday ."'
                                            and event_cat = ". $inter ."
                                            ORDER BY event_time Asc

                                        "); 
                                        }                                  
                                    else{
                                        $events_query = $connect->query("

                                            SELECT *
                                            FROM events
                                            JOIN userapps U ON U.usr_id = events.usr_create
                                            LEFT JOIN interests I ON I.interest_id = events.event_cat
                                            WHERE event_date = '". $qyear ."-". $qmonth ."-". $qday ."'
                                            ORDER BY event_time Asc

                                        "); 
                                }

                                
                                while(!is_null($events_query) && $event = $events_query->fetch()){                                    
                                    if($event['event_type'] != "Secret" || ($event['event_type'] == "Secret" && $event['usr_id'] == 36)){
                                    ?>                                                  
                                        <div class="post_col">
                                            <div class="post_item white_box">
                                                <div class="large_thumb thumb_hover">
                                                    
                                                        <div class="icon_bar for_link">
                                                            <a href="single.html" class="icon link"></a> 
                                                        </div>
                                                        <div class="icon_bar for_view">
                                                            <a href="/img/upload/events/<?php echo $event['event_pic']; ?>" class="icon view fancybox"></a> 
                                                        </div>
                                                        
                                                        <div class="img_wrapper"><img src="/img/upload/events/<?php echo $event['event_pic']; ?>"></div>
                                                </div>
                                            
                                                                        
                                                <h3 class="post_item_title "> <a href="/view.php?event_id=<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></a></h3>
                                                
                                                <div class="post_item_inner">

                                                    <div class="post_meta">
                                                        <span class="user">by <a href="#"><?php echo $event['usr_lname'] . ' '. $event['usr_fname']; ?></a></span> 
                                                        <span class="date"><?php echo $event['event_date']; ?></span><br><br>
                                                        <span class="time"><?php echo $event['event_time']; ?></span>
                                                        <span class="cats"><?php echo $event['interest_name']; ?></span><br><br>
                                                        <span class="place"><?php echo $event['event_place']; ?> </span>
                                                        
                                                    </div>

                                                    <p></p>
                                                    <?php if($event['event_type'] != "Private"){
                                                        if($event['usr_id'] != 36){
                                                        
                                                        ?>
                                                            <a href="#" class="button green">Pike</a>

                                                        <?php }else{ ?>

                                                            <a href="#" class="button green">Modify</a>                                                            

                                                        <?php } ?>

                                                        <a href="#" class="button blue">Invite</a>

                                                    <?php
                                                        }
                                                    ?>

                                            
                                                </div>
                                        
                                        </div>
                                    </div>
                                    <?php
                                            }
                                        }

                                    ?>
                    <!-- end of php -->
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
                        <td colspan="3"><a href="/add.php">New Pike</a></td>
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

                        <?php
                             if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])) 
                            {

                                $qyear = $_GET['year'];
                                $qmonth = $_GET['month'];
                                $qday = $_GET['day'];
                            }else{
                                
                                $qyear = $todyear;
                                $qmonth = $todmonth;
                                $qday = $todday;
                            }
                             if($d == $qday  && $m == $qmonth): ?>
                            <td style="background-color:#C53434"><a style="color:white" href="/events.php?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>"><?php echo $d; ?></td></a>
                        <?php else: ?>
                            <td><a href="/events.php?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>" ><?php echo $d; ?></td></a>
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

        <script>
            function pikesResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("PikesSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","PikesSearch.php?q="+str,true);
              xmlhttp.send();
            }

            function pikesResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("contactSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","contactphp?q="+str,true);
              xmlhttp.send();
            }

            function notifsResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("notifsSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","notifsSearch.php?q="+str,true);
              xmlhttp.send();
            }
        </script>
        
        <!-- BEGIN WIDGET -->
        <div class="widget tab_wrapper white_box" id="tab_wrapper_tab_widget-2">
            
            <ul class="tab_menu"><li class="tab_post"><a href="#post_tab">Notifs</a></li><li  class="tab_comment"><a href="#comment_tab">Contacts</a></li><li class="tab_tag"><a href="#tag_tab">your pikes</a></li></ul>
            <div class="clear"></div>
            <div class="tabs_container">
            <div id="post_tab" class="tab_content recent_posts">
                    <form>
                        <input type="text" placeholder="Click here to start searching in notifications ...">
                    </form>
                    <ul id="notifsSearch">
                        <li>
                         <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                            <img src="images/_small/1.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                        </a>
                        <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div>   
                        </a>  
                        </li>
                    </ul>                         
                </div>
                                
                <div id="comment_tab" class="tab_content recent_comments" >
                    <form>
                        <input type="text" placeholder="Click here to start searching in contacts ...">
                    </form>  
                    <ul id="contactSearch"><li ><img alt='' src='http://1.gravatar.com/avatar/5bea567fcf9dd1022d9224e07bf194a5?s=50&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>Nguyen Duc</cite><br><em>click to view last chat</em></p><div class="clear"></div></li>  
                    </ul>                           
  
                </div>
                                
                  <div id="tag_tab" class="tab_content recent_posts">

                    <form>
                        <input type="text" placeholder="Click here to start searching in your pikes ...">
                    </form>
                    <ul id="PikesSearch">
                        <li>
                         <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                            <img src="images/_small/1.jpg" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                        </a>
                        <a href="http://localhost/GreatBox/?p=213" title="Praesent Et Urna Turpis Sadips" class="title">Praesent Et Urna Turpis Sadips</a>Quisque ligulas ipsum, euismod atras vulputate iltricies etri<div class="clear"></div>   
                        </a>  
                        </li>
                    </ul>  
                    </div>       
            </div>
            
        </div>
        <!-- END WIDGET -->

        <!-- TExt Messagin -->
        <script>
            $(document).ready(function(){

                function fetch(){
                    $.post('chatFetch.php',function(data){
                        $('#message_el').html(data);
                    })
                }
                fetch();
                setInterval(fetch,2000);


                /*$('#message_el').keyup(function(e){
                    var post = $.trim($('message_el').val());

                    if(post != "" && e.keyCode ===  13 && e.shiftKey === false){
                        $.post('send.php',{post:post},function(data){
                            fetch();
                            $('.chat .post').val('');
                        });
                    }
                });*/
            });
        </script>

        <script>
            function showResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("categorySearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","categorySearch.php?q="+str,true);
              xmlhttp.send();
            }
        </script>


        <div id="categories-3" class="widget widget_categories white_box"><h3 class="widget_title">Interests</h3>
            <form>
                <input type="text" placeholder="click here to start searching in communities" onkeyup="showResult(this.value)">
            </form> 

            

                    <ul style="overflow: scroll;height: 450px;" id="categorySearch">
                        <?php      
                            require_once('connect.php');

                            $interests_query = $connect->query("
                                SELECT *
                                FROM interests
                                ORDER BY interest_name Asc
                            ");

                            while($interest = $interests_query->fetch()){
                        ?>
                            <li class="cat-item cat-item-2"><a href="/events.php?interest=<?php echo $interest['interest_id'] ?>"><?php echo $interest['interest_name'] ?></a></li>
                        <?php } ?>

                    </ul>
                
                    <a href="#" class="button red full">Create a Community</a>
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
