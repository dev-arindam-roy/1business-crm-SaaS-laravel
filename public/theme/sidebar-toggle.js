function setCookieMenu() {
    if ($("body").hasClass("page-sidebar-closed") == true) {
        var cvalue = 'OPEN';
    } else {
        var cvalue = 'CLOSE';
    }
    var d = new Date();
    d.setTime(d.getTime() + (1*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = "1BCRM=" + cvalue + ";" + expires + ";path=/";
}
function getCookieMenu() {
    var name = "1BCRM=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkCookieMenu() {
    var user=getCookieMenu();
    if (user == "OPEN" || user == '') {
        $("body").removeClass("page-sidebar-closed");
        $(".page-sidebar-menu").removeClass("page-sidebar-menu-closed");
    } else {
        $("body").addClass("page-sidebar-closed");
        $(".page-sidebar-menu").addClass("page-sidebar-menu-closed");
    }
}
checkCookieMenu();