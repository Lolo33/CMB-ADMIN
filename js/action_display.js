/**
 * Created by Niquelesstup on 11/09/2017.
 */
function fadeAction(message, reussite) {
    var action_info = $("#action-info");
    if (reussite === true) {
        action_info.html('<span class="glyphicon glyphicon-ok"></span> ' + message);
        action_info.removeClass("fail").addClass("success");
    }else {
        action_info.html('<span class="glyphicon glyphicon-remove"></span> ' + message);
        action_info.removeClass("success").addClass("fail");
    }
    action_info.fadeIn(1000);
    setTimeout(function(){ action_info.fadeOut(1000) }, 3000);
}