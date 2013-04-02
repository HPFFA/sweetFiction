CKEDITOR.editorConfig = function( config ) {
     config.toolbar = [
         { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
         { name: 'links',       items : [ 'Link','Unlink' ] },
         { name: 'insert',      items : [ 'SpecialChar' ] },
         { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
         { name: 'tools',       items : [ 'Maximize', '-', 'Source' ] },
         '/',
         { name: 'styles',      items : [ 'Format','Font','FontSize' ] },
         { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
         { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
     ]
}