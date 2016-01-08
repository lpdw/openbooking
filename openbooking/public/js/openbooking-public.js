(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$( window ).load(function() {
		var plugin_dir_url = $('#plugin_dir_url').val();
		$('.event_log_in').click(function(){
			var event_log_in_clicked = $(this);
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-log-in.php',
	         type : 'POST',
	         data : 'email=' + $(this).siblings('.email').val() + '&password=' + $(this).siblings('.password').val(),
	         success : function(code_html, statut){
						 $(event_log_in_clicked).siblings('.event_server_message').html();
						 if(code_html){
							 $(event_log_in_clicked).siblings('.event_server_message').html(code_html);
						 }else{
							 location.reload();
						 }
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){
	         }
	    });
	  });

	  $('.event_sign_in').click(function(){
		  var event_sign_in_clicked = $(this);
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-sign-in.php',
	         type : 'POST',
	         data : 'first_name=' + $(this).siblings('.first_name').val() + '&last_name=' + $(this).siblings('.last_name').val() + '&email=' + $(this).siblings('.email').val() + '&password_first=' + $(this).siblings('.password1').val() + '&password_second=' + $(this).siblings('.password2').val() ,
	         success : function(code_html, statut){
						 $(event_sign_in_clicked).siblings('.event_server_message').html();
						 if(code_html){
							 $(event_sign_in_clicked).siblings('.event_server_message').html(code_html);
						 }else{
							 location.reload();
						 }
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
			});
	  });

	$('.event_log_out').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-log-out.php',
	         type : 'POST',
	         success : function(code_html, statut){
					 location.reload();
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('.event_leave').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'event/openbooking-public-leave.php',
	         type : 'POST',
            data : 'event_id=' + $(this).data("event") ,
            success : function(code_html, statut){
				 location.reload();
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('.event_join').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'event/openbooking-public-join.php',
	         type : 'POST',
            data : 'event_id=' + $(this).data("event") ,
            success : function(code_html, statut){
					 location.reload();
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	 $('.btn_change').on('click', function(){
     $(this).siblings('.more').slideToggle();
     $(this).slideToggle();
   });

   $('.btn_cancel').on('click', function(){
     $(this).parents('.more').slideToggle();
     $(this).parents('.more').siblings('.btn_change').slideToggle();
   });
});
})( jQuery );
