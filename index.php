<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <title>Photo Nabber</title>
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="styles/main.css" />
        <link rel="stylesheet" type="text/css" href="styles/libs/jCarousel.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <script src="http://connect.facebook.net/en_US/all.js"></script>
        <script type="text/javascript" src="scripts/libs/uiblock.js"></script>
       <!-- <script type="text/javascript" src="scripts/libs/jCarousel.js"></script> -->
        <script type="text/javascript" src="scripts/main.js"></script>
    </head>
    <body>
        <div id="container">
            <?php include("header.php"); ?>
            <!-- BODY/CONTENT -->
            <div id="main_content">
                <!-- GET PHOTOS -->
                <div id="get_photos_page">
                    <div id="instructions">
                        Follow the steps below and Photo Nabber will attempt to get as many of your
                        photos from Facebook as possible.
                        <br/>
                        Then you'll be able to view the photos individually or download them as a 
                        single zipped archive.
                    </div>
                    <br/>
                    <br/>
                    <div id="links">
                        <ul>
                            <li>
                                <div id="step_one">
                                    Step 1
                                    <br/>
                                    <img src="images/authorize_icon.png" border="0" onClick="login(); return false;" />
                                </div>
                            </li>
                            <li>
                                <div id="step_two">
                                    Step 2
                                    <br/>
                                    <img src="images/get_photos_icon_disabled.png" border="0" 
                                        onClick="return false;" id="disabled_photos" />
                                    <img src="images/get_photos_icon.png" border="0" 
                                        onClick="getThePics(); return false;" id="enabled_photos" />
                                </div>
                            </li>
                            <li>
                                <div id="step_one">
                                    Step 3
                                    <br/>
                                    <img src="images/download_icon_disabled.png" border="0" 
                                        onClick="return false;" id="disabled_download" />
                                    <img src="images/download_icon.png" border="0" 
                                        onClick="getThePics(); return false;" id="enabled_download" />
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div id="photos">
                        <ul id="carousel" class="jcarousel-skin-tango"></ul>
                    </div>
                    <div id="fb-root"></div>
                </div>
                <!-- /END GET PHOTOS -->
                <!-- ABOUT -->
                <div id="about" title="About">
                        Photo Nabber is an application where you can retrieve photos that you have
                        been tagged in on Facebook.  Due to privacy settings in Facebook,
                        Photo Nabber may not be able to retrieve all photos that you have
                        been tagged in.
                </div>
                <!-- /END ABOUT -->
                <!-- GOT PHOTOS -->
                <div id="got_photos" title="Got Photos!">
                    Done nabbing photos!  We were able to retrieve <span id="numOfPhotos"></span>
                    photos that you were tagged in!
                </div>
                <!-- /END GOT PHOTOS -->
                <!-- CREATED ZIP -->
                <div id="got_photos" title="Got Photos!">
                    Done nabbing photos!  We were able to retrieve <span id="numOfPhotos"></span>
                    photos that you were tagged in!
                </div>
                <!-- /END GOT PHOTOS -->
            </div>
            <!-- /END BODY/CONTENT -->
            <?php include("footer.php"); ?>
        </div>
    </body>
</html>
