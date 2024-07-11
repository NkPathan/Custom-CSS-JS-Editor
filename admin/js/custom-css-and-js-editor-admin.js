(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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
	document.addEventListener('DOMContentLoaded', function() {
        var customCSSEditor = ace.edit("custom-css-editor-code-panel");
        customCSSEditor.setTheme("ace/theme/monokai");
        customCSSEditor.session.setMode("ace/mode/css");
        
        var customJSEditor = ace.edit("custom-js-editor-code-panel");
        customJSEditor.setTheme("ace/theme/monokai");
        customJSEditor.session.setMode("ace/mode/javascript");
        
        var customCSSJSEditorform = document.querySelector('.custom-css-js-editor-code-form');
        customCSSJSEditorform.addEventListener('submit', function() {
            document.getElementById('custom-css-editor-textarea-panel').value = customCSSEditor.getValue();
            document.getElementById('custom-js-editor-textarea-panel').value = customJSEditor.getValue();
        });
        // Enable autocompletion
        ace.config.set('basePath', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/');
        ace.config.loadModule('ace/ext/language_tools', function() {
            customCSSEditor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: true
            });
            customJSEditor.setOptions({
                enableBasicAutocompletion: true,
                enableSnippets: true,
                enableLiveAutocompletion: true
            });
        });
    });

})( jQuery );
