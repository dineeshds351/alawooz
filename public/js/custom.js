/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * Show Alert
 */
var Alert = {
    show: function(message, type) {
        $('.content-alert').html('<div class="alert alert-' + type + ' alert-dismissible alert-main"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + message + '</div>');
        setTimeout(function(){
            $('.content-alert').html('');
        }, 5000);
    }
};
