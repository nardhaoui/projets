
window.onload = function () {
    height("content");
    actuChat();
    setTimeout(function () {
	confirm();
    }, 1500);
};
window.onresize = function () {
    height("content");
};

function snowScroll() {
    var scrollTop = document.documentElement.scrollTop;
    document.getElementById('snowBig').style = 'background-position: 0% ' + (scrollTop / 5) + '%;';
    document.getElementById('snow').style = 'background-position: 0% ' + (-scrollTop / 50) + '%;';
    document.getElementById('background').style = 'background-position: 0% ' + (scrollTop / 30) + '%;';
}

function height(bloc) {
    var hauteur;

    if (typeof (window.innerWidth) === 'number')
	hauteur = window.innerHeight;
    else if (document.documentElement && document.documentElement.clientHeight)
	hauteur = document.documentElement.clientHeight;

    document.getElementById(bloc).style.minHeight = hauteur - 220 + "px"; //220 et 220 pour toujours
}

function confirm() {
    document.getElementById('correctBox').style.opacity = 1.00;
    var opa = setInterval(function () {
	document.getElementById('correctBox').style.opacity -= 0.01;
	if (document.getElementById('correctBox').style.opacity <= 0.00) {
	    document.getElementById('correctBox').style = 'display:none;';
	    clearInterval(opa);
	}
    }, 30);
}

//Fonctions COOKIE miam

function setCookie(sName, sValue) {
    var today = new Date(), expires = new Date();
    expires.setTime(today.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = sName + "=" + encodeURIComponent(sValue) + ";expires=" + expires.toGMTString();
}

function getCookie(sName) {
    var oRegex = new RegExp("(?:; )?" + sName + "=([^;]*);?");

    if (oRegex.test(document.cookie)) {
	return decodeURIComponent(RegExp["$1"]);
    } else {
	return null;
    }
}