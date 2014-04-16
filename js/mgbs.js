/*global jQuery, alert */
/*jshint browser:true */

jQuery(document).ready(function($){
    $('.widget_mat_gargano_baseball_standings').on('click', '.division', function(){
        var division = $(this).data('division'),
            $parent = $(this).closest('.widget_mat_gargano_baseball_standings');
        $parent.find('table').hide();
        $parent.find('table.' + division).show();
        $parent.find('.divisions .division').removeClass('selected');
        $parent.find('.divisions .division[data-division="' + division + '"]').addClass('selected');
    });
    
});