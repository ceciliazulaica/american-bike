/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

   config.filebrowserBrowseUrl = '../ckeditor/kcfinder/browse.php?type=files';
   config.filebrowserImageBrowseUrl = '../ckeditor/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = '../ckeditor/kcfinder/browse.php?type=flash';
   config.filebrowserUploadUrl = '../ckeditor/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = '../ckeditor/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = '../ckeditor/kcfinder/upload.php?type=flash';

 

config.toolbar = 'full';
 	config.toolbar_full=
	[
	
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
		{ name: 'insert', items: [ 'Image',  'Table', 'SpecialChar' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	];



	/* default */
	config.toolbar =
	[
	
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',  '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	];


};



/* Para usar esta barra hay q hacerlo asi

            var instance = CKEDITOR.instances["txt_detalle"];
            if (instance) {
                CKEDITOR.remove(instance);
            }
            CKEDITOR.replace("txt_detalle", { toolbar: 'full' });



 */