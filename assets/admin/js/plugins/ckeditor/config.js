/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	config.toolbar = 'MyToolbar';
		/*[
	      			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
	    			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','-','Undo','Redo' ] },
	    			{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList' ] },
	    			//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
	    			{ name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
	    		];
	*/
	config.toolbar_Full =
		  [
		  	{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
		  	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		  	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		  	{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
		          'HiddenField' ] },
		  	'/',
		  	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		  	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		  	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		  	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		  	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
		  	'/',
		  	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		  	{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		  	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
		  ];
		  
	config.toolbar_Basic =
		  [
		  	{ name: 'clipboard', items : [ 'Undo','Redo' ] },
		  	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		  	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		  	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		  	'/',
		  	{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		  	{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley' ] },
		  	'/',
		  	{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		  	{ name: 'colors', items : [ 'TextColor','BGColor' ] }
		  ];
	
	config.toolbar_MyToolbar =
		[
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','-','Undo','Redo' ] },
			{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList' ] },
			//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
			{ name: 'insert', items : [ 'Image','Table','Smiley','SpecialChar' ] },
		];
	
	config.toolbar_Simple =
		[
			['Bold', 'Italic', '-', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
		];
};
