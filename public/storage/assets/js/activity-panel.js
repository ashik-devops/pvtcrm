/**
 * Created by rodelarode on 7/24/17.
 */



jQuery(document).ready(function () {



        jQuery.getJSON( "/ajax/activities/recent")
            .done(function(data){
                jQuery("#side-panel .items-wrapper").html(viewRecentActivities(data));
                console.log('activity loaded');
            })
            .fail(function( jqxhr, textStatus, error ) {
                var err = textStatus + ", " + error;
                console.log( "Request Failed: " + err );
            });

       function viewRecentActivities(data){
           var html='';
           for (var key in data) {
               if (data.hasOwnProperty(key)) {
                   html += buildActivityItemhtml(data[key]);
               }
           }
           return html;
       }

       function buildActivityItemhtml(item) {
            return '<div class="item"> <div class="symbol-holder"><button class="icon-container btn btn-warning btn-circle"><i class="icon fa fa-flag"></i></button></div>'+
               '<div class="content-holder"><div class="subject-line"><strong>'+item.message+'</strong><div class="time-stamp">'+item.happened+'</div></div></div>';
       }


});