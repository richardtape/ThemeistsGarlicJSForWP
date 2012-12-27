//Trying to make this work with the Visual Editor
window.onload = function(){

	//If the Visual editor is active
	if( tinyMCE.activeEditor !== null ){

		//onKeyUp, copy the content from the TinyMCE editor to the Text Editor <textarea>
		tinyMCE.activeEditor.onKeyUp.add( function(){

			//Get the editor's content
			editor_content = this.getContent();

			//shove it over to the #content box's value
			jQuery( '#content' ).val( editor_content );

		} );

	}

}

jQuery( document ).ready( function( $ ){

	/* -----------------------------------------------------------------------------------

	On the new post/page/cpt screen we need to add 

	data-persist="garlic" 

	onto the form for which this would be useful i.e. the main content editor,
	excerpt and title boxes

	Title box: 			#title
	TextEditor box: 	#content
	Excerpt box: 		#excerpt

	VisualEditor box:

	This is actually an iframe from TinyMCE, but the TextEditor box is updated when this
	is updated (I hope)

	Form ID: #post

	-----------------------------------------------------------------------------------  */

	$( '#post, #tinymce' ).attr( 'data-persist', 'garlic' );


} );