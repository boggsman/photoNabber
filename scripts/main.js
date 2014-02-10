var userObject = false;
var numOfPhotos = 0;
var php_pic_url = "";
var authorized = false;
var gotPhotos = false;
var gallery = null;
var onMouseOutOpacity = null;
var photoArray = [];
function fbInit() {
    FB.init({appId: '130704463612618', status: true, cookie: true, xfbml: true});
    FB.Event.subscribe('auth.login', function(response) {
        getUserObject();
    });
}
function login() {
    if(authorized === false) {
        FB.login(function(response) {
            if (response.session) {
                if (response.perms) {
                    // logged in w/ some permissions
                } else {
                    // logged in w/o permissions
                }
            } else {
                // not logged in
            }
        }, {perms:'user_about_me, user_photo_video_tags, user_photos, friends_photo_video_tags, friends_photos'});
    }
}
function getUserObject() {
    // async
    FB.api('/me', function(response) {
        if(response.error) {
            // $("#message").append("An error occured retrieving your user data.  Sorry! <br/><br/>");
            if(response.error.message) {
                // $("#message").append("Error message was:" + response.error.message + " <br/><br/>");
                userObject = false;
            } else {
                userObject = false;
            }
        } else {
            if(response === null) {
                userObject = false;
            } else {
                userObject = response;
            }
        }
        // complete
        if(userObject !== false) {
            loggedIn();
        }
    });
}
function getStatus() {
    FB.getLoginStatus(function(response) {
        if(response.session) {
            getUserObject();
            authorized = true;
        }
    });
}
function loggedIn() {
    $("#user_name").append(""+userObject.name);
    $("#welcome_div").css("display", "block");
    $("#disabled_photos").css("display", "none");
    $("#enabled_photos").css("display", "block");
}
function getThePics() {
    if(authorized === true && gotPhotos === false) {
        $.blockUI({ 
            message: '<h2>Just a moment...</h2>',
            css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            }
        });
        php_pic_url = "";
        numOfPhotos = 0;
        $("#carousel")[0].innerHTML = "";
        $("#numOfPhotos")[0].innerHTML = "";
        getPhotos('');
    }
}
function aboutPhotoNabber() {
    $("#about").dialog("open");
}
function getPhotos(str) {
    FB.api("/me/photos"+str, function(response) {
        processPhotos(response);
    });
}
function processPhotos(subset) {
    for(var x=0; x < subset.data.length; x++) {
        var dataObj = subset.data[x];
        photoArray[x] =
            "<a href='" + dataObj.source + "'" +
            " target=_blank>" +
            "<img src='" + dataObj.picture + "'" +
            " border='0' class='fb_photo'" +
            " width='" + Math.round(dataObj.width / 5.5) + "' " +
            " height='" + Math.round(dataObj.height / 5.5) + "' /></a>";
        php_pic_url += dataObj.source + ",";
        numOfPhotos++;
    }
    if(subset.paging) {
        getPhotos(parseOffNxt(subset.paging.next));
    } else {
        photosComplete();
    }
}
function parseOffNxt(s) {
    return s.substring(s.indexOf("photos?") + "photos?".length - 1, s.length);
}
function photosComplete() {
    $("#numOfPhotos").append(numOfPhotos);
    $("#got_photos").dialog("open");
    $("#photos").css("display", "block");
    addPhotos();
    gotPhotos = true;
    $.unblockUI();
    // callPHPforZIP();
}
function setupCarousel() {
    jQuery('#carousel').jcarousel({
        scroll: '7',
        visible: '8'
    });
}
function addPhotos() {
    for(var x=0; x < photoArray.length; x++) {
        jQuery('#carousel').jcarousel('add', x, photoArray[x]);
    }
}
function callPHPforZIP() {
    $.ajax({
        type: "POST",
        url: "get_photos.php",
        data: "username=" + userObject.first_name + "_" + userObject.last_name +
            userObject.id + "&pics=" + php_pic_url.substring(0,php_pic_url.length-1),
        success: function(data, status) {
            $("#download")[0].innerHTML = "";
            var json = jQuery.parseJSON(data.substring(0, data.length-3));
            $("#download").append("Your photos are ready!  Please" +
                "click the download link below: <br/><br/>" +
                "<a href='" + json.pics_url + "'>Download ZIP of your photos!</a>");
            $.unblockUI();
        },
        error: function(data, status) {
            $("#download")[0].innerHTML = "";
            $("#download").append("There was an error creating your zip file.  Please" +
                "try again");
        }
    });
}
$(document).ready(function(){
    fbInit();
    getStatus();
    $("#about").dialog({autoOpen: false, modal: true, height: 200, width: 600});
    $("#got_photos").dialog({autoOpen: false, modal: true, height: 2000, width: 600});
    setupCarousel();
    $("#photos").css("display", "none");
});
