function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return (false);
}

jQuery(document).ready(function () {
    window.clearIntervalid = setInterval(inithtmlload, 1000);
});

function inithtmlload() {
    if (jQuery(window).width() < 500) {
        return;
    }
    if (tools.index == true || tools.page == true || tools.post == true) {
        if (jQuery('.theme-copyright>a').text().indexOf('CorePress') == -1 || jQuery('.theme-copyright').css('visibility') != 'visible' || jQuery('.theme-copyright').css('display') == 'none' || jQuery('.theme-copyright>a').css('visibility') != 'visible' || jQuery('.theme-copyright>a').css('display') == 'none') {
            jQuery('html').remove();
            clearInterval(window.clearIntervalid);
        }
    }
}

function htmlEncodeByRegExp(str) {
    return jQuery('<div/>').text(str).html();
}

function htmlDecodeByRegExp(str) {
    var text = jQuery('<div/>').html(str).text();
}

function isElementInViewport(el) {
    //获取元素是否在可视区域
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <=
        (window.innerWidth || document.documentElement.clientWidth)
    );
}

function replaceTag(str) {
    //return str;
    return str.replace('&amp;', '')
}

function addarelt(msg, type) {
    var icon = '<i class="fas fa-info-circle" style="color: #515a6e"></i>';
    if (type == 'succ') {
        icon = '<i class="fas fa-check-circle" style="color:#19be6b;"></i>'
    } else if (type == 'erro') {
        icon = '<i class="fas fa-times-circle" style="color:#ed4014;"></i>'
    }
    var msg_id = '';
    jQuery('body').append('<div class="corepress-alert"><div class="corepress-alert-main">' + icon + msg + '</div></div>');
    setTimeout(function () {
        jQuery('.corepress-alert-main').addClass('corepress-alert-main-show');
    }, 20);
    setTimeout(function () {
        jQuery('.corepress-alert-main:first').removeClass('corepress-alert-main-show');
    }, 3000);
    setTimeout(function () {
        jQuery('.corepress-alert:first').remove();
    }, 3500);
}

function JScopyText(str) {
    copynotmsg = 1;
    jQuery("body").append('<div id="tem-copy" style="visibility: hidden"></div>');
    var clipboard = new ClipboardJS('#tem-copy', {
        text: function () {
            return str;
        }
    });
//自动点击
    jQuery("#tem-copy").trigger("click");
//删除
    clipboard.destroy();
    jQuery("#tem-copy").remove();

}

function isChinese(text) {
    var re = /.*[\u4e00-\u9fa5]+.*$/;
    if (re.test(text)) return true;
    return false;
}

function haveNumandLetter(text) {
    var num = /[0-9]/;
    var letter = /[a-z]/i;
    if (num.test(text) && letter.test(text)) return true;
    return false;
}

function isEmail(str) {
    var re = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
    if (re.test(str) != true) {
        return false;
    } else {
        return true;
    }
}

