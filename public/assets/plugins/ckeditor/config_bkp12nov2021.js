/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Save,NewPage,Export to PDF,Preview,Print,Templates,Paste,Styles,Format,Font,FontSize,ShowBlocks,Maximise,Character,Smiley,Flash,Iframe,HiddenField,ImageButton,Button,SelectionField,Textarea,Radio,Checkbox,Breakforprinting,Specialcharacter,Anchor';
};




