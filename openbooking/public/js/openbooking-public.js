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
		$('#event_log_in').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-log-in.php',
	         type : 'POST',
	         data : 'email=' + email_log.value + '&password=' + password.value,
	         success : function(code_html, statut){
	           $('#event_server_message').html(code_html);
	         },
	         error : function(resultat, statut, erreur){
	           alert('ERROR');
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('#event_sign_in').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-sign-in.php',
	         type : 'POST',
	         data : 'first_name=' + first_name.value + '&last_name=' + last_name.value + '&email=' + email.value + '&password_first=' + password1.value + '&password_second=' + password2.value,
	         success : function(code_html, statut){
	           $('#event_server_message').html(code_html);
	         },
	         error : function(resultat, statut, erreur){
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('#event_log_out').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'user/openbooking-public-log-out.php',
	         type : 'POST',
	         success : function(code_html, statut){
	           $('#event_server_message').html(code_html);
	         },
	         error : function(resultat, statut, erreur){
	           alert('ERROR');
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('#event_leave').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'event/openbooking-public-leave.php',
	         type : 'POST',
	         success : function(code_html, statut){
	           $('#event_server_message').html(code_html);
	         },
	         error : function(resultat, statut, erreur){
	           alert('ERROR');
	           console.log(resultat, statut, erreur);
	         },
	         complete : function(resultat, statut){

	         }
	    });
	  });

	  $('#event_join').click(function(){
	    $.ajax({
	         url : plugin_dir_url+'event/openbooking-public-join.php',
	         type : 'POST',
	         success : function(code_html, statut){
	           $('#event_server_message').html(code_html);
	         },
	         error : function(resultat, statut, erreur){
	           alert('ERROR');
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
