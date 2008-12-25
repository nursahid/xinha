<?php
/**
 * @version   $Id$
 * @package   Joomla
 * @copyright Copyright (C) 2008 Edvard Ananyan. All rights reserved.
 * @license   BSD License
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Xinha WYSIWYG Editor Plugin
 *
 * @author Edvard Ananyan <edo888@gmail.com>
 * @package Editors
 * @since 1.5
 */
class plgEditorXinha extends JPlugin {
    /**
     * Constructor
     *
     * For php4 compatability we must not use the __constructor as a constructor for plugins
     * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
     * This causes problems with cross-referencing necessary for the observer design pattern.
     *
     * @param   object $subject The object to observe
     * @param   array  $config  An array that holds the plugin configuration
     * @since 1.5
     */
    function plgXinha(& $subject, $config){
        parent::__construct($subject, $config);
    }

    /**
     * Method to handle the onInit event.
     *  - Initializes the Xinha WYSIWYG Editor
     *
     * @access public
     * @return string JavaScript Initialization string
     * @since 1.5
     */
    function onInit() {
        // Editor gets loaded twice in Legacy mode
        if(defined('_XINHA_ISLOADED'))
            return false;

        define('_XINHA_ISLOADED', 1);

        $plugin =& JPluginHelper::getPlugin('editors', 'xinha');
        $params = new JParameter($plugin->params);

        return <<<EOD
<script type="text/javascript">
_editor_url  = "/plugins/editors/xinha/"
_editor_lang = "{$params->language}";
_editor_skin = "{$params->skin}";
</script>
<script type="text/javascript" src="/plugins/editors/xinha/XinhaCore.js"></script>
<script type="text/javascript">
xinha_editors = null;
xinha_init    = null;
xinha_config  = null;
xinha_plugins = null;

// This contains the names of textareas we will make into Xinha editors
xinha_init = xinha_init ? xinha_init : function() {
/** STEP 1
 * First, specify the textareas that shall be turned into Xinhas.
 * For each one add the respective id to the xinha_editors array.
 * I you want add more than on textarea, keep in mind that these
 * values are comma seperated BUT there is no comma after the last value.
 * If you are going to use this configuration on several pages with different
 * textarea ids, you can add them all. The ones that are not found on the
 * current page will just be skipped.
 **/

xinha_editors = xinha_editors ? xinha_editors : ['introtext', 'fulltext'];

/** STEP 2
 * Now, what are the plugins you will be using in the editors on this
 * page.  List all the plugins you will need, even if not all the editors
 * will use all the plugins.
 *
 * The list of plugins below is a good starting point, but if you prefer
 * a simpler editor to start with then you can use the following
 *
 * xinha_plugins = xinha_plugins ? xinha_plugins : [ ];
 *
 * which will load no extra plugins at all.
 **/

xinha_plugins = xinha_plugins ? xinha_plugins : ['CharacterMap','ContextMenu','ListType','Stylist','Linker','SuperClean','TableOperations','ImageManager'];

// THIS BIT OF JAVASCRIPT LOADS THE PLUGINS, NO TOUCHING
if(!Xinha.loadPlugins(xinha_plugins, xinha_init)) return;


/** STEP 3
 * We create a default configuration to be used by all the editors.
 * If you wish to configure some of the editors differently this will be
 * done in step 5.
 *
 * If you want to modify the default config you might do something like this.
 *
 *   xinha_config = new Xinha.Config();
 *   xinha_config.width  = '640px';
 *   xinha_config.height = '420px';
 *
 **/

xinha_config = xinha_config ? xinha_config() : new Xinha.Config();

// To adjust the styling inside the editor, we can load an external stylesheet like this
// NOTE : YOU MUST GIVE AN ABSOLUTE URL

xinha_config.pageStyleSheets = [ _editor_url + "examples/full_example.css" ];

/** STEP 4
 * We first create editors for the textareas.
 *
 * You can do this in two ways, either
 *
 *   xinha_editors   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);
 *
 * if you want all the editor objects to use the same set of plugins, OR;
 *
 *   xinha_editors = Xinha.makeEditors(xinha_editors, xinha_config);
 *   xinha_editors.myTextArea.registerPlugins(['Stylist']);
 *   xinha_editors.anotherOne.registerPlugins(['CSS','SuperClean']);
 *
 * if you want to use a different set of plugins for one or more of the
 * editors.
 **/

xinha_editors   = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);

/** STEP 5
 * If you want to change the configuration variables of any of the
 * editors,  this is the place to do that, for example you might want to
 * change the width and height of one of the editors, like this...
 *
 *   xinha_editors.myTextArea.config.width  = '640px';
 *   xinha_editors.myTextArea.config.height = '480px';
 *
 **/


/** STEP 6
 * Finally we "start" the editors, this turns the textareas into
 * Xinha editors.
 **/

Xinha.startEditors(xinha_editors);

}

// this executes the xinha_init function on page load
// and does not interfere with window.onload properties set by other scripts
Xinha._addEvent(window,'load', xinha_init);
</script>
EOD;
}

    /**
     * Xinha WYSIWYG Editor - get the editor content
     *
     * @param string    The name of the editor
     */
    function onGetContent( $editor ) {
        //return "JContentEditor.getContent('".$editor."');";
        return '';
    }

    /**
     * Xinha WYSIWYG Editor - set the editor content
     *
     * @param string    The name of the editor
     */
    function onSetContent( $editor, $html ) {
        //return "tinyMCE.activeEditor.setContent(".$html.");";
        return '';
    }

    /**
     * Xinha WYSIWYG Editor - copy editor content to form field
     *
     * @param string    The name of the editor
     */
    function onSave( $editor ) {
        //return "tinyMCE.triggerSave();";
        return '';
    }

    /**
     * TinyMCE WYSIWYG Editor - display the editor
     *
     * @param string The name of the editor area
     * @param string The content of the field
     * @param string The width of the editor area
     * @param string The height of the editor area
     * @param int The number of columns for the editor area
     * @param int The number of rows for the editor area
     * @param mixed Can be boolean or array.
     */
    function onDisplay( $name, $content, $width, $height, $col, $row, $buttons = true) {
        // Only add "px" to width and height if they are not given as a percentage
        if (is_numeric( $width )) {
            $width .= 'px';
        }
        if (is_numeric( $height )) {
            $height .= 'px';
        }

        $buttons = $this->_displayButtons($name, $buttons);
        $editor .= "<textarea id=\"$name\" name=\"$name\" cols=\"$col\" rows=\"$row\" style=\"width:{$width}; height:{$height};\" class=\"mceEditor\">$content</textarea>\n" . $buttons;
        $editor .= "<script type=\"text/javascript\">function jceOnLoad(){JContentEditor.initEditorMode('$name');}</script>";

        return <<<EOD
        <textarea name="$name" id="$name" cols="$col" rows="$row" style="width:$width;height:$height;">$content</textarea>
        <br />$buttons
        EOD;
    }

    function onGetInsertMethod($name) {
        $doc = & JFactory::getDocument();

        //$js= "function jInsertEditorText( text, editor ) {tinyMCE.execInstanceCommand(editor, 'mceInsertContent',false,text);}";
        //$doc->addScriptDeclaration($js);

        return true;
    }

    function _displayButtons($name, $buttons) {
        // Load modal popup behavior
        JHTML::_('behavior.modal', 'a.modal-button');

        $args['name'] = $name;
        $args['event'] = 'onGetInsertMethod';

        $return = '';
        $results[] = $this->update($args);
        foreach ($results as $result) {
            if (is_string($result) && trim($result)) {
                $return .= $result;
            }
        }

        if(!empty($buttons))
        {
            $results = $this->_subject->getButtons($name, $buttons);

            /*
             * This will allow plugins to attach buttons or change the behavior on the fly using AJAX
             */
            $return .= "\n<div id=\"editor-xtd-buttons\">\n";
            foreach ($results as $button)
            {
                /*
                 * Results should be an object
                 */
                if ( $button->get('name') )
                {
                    $modal      = ($button->get('modal')) ? 'class="modal-button"' : null;
                    $href       = ($button->get('link')) ? 'href="'.JURI::base().$button->get('link').'"' : null;
                    $onclick    = ($button->get('onclick')) ? 'onclick="'.$button->get('onclick').'"' : null;
                    $return .= "<div class=\"button2-left\"><div class=\"".$button->get('name')."\"><a ".$modal." title=\"".$button->get('text')."\" ".$href." ".$onclick." rel=\"".$button->get('options')."\">".$button->get('text')."</a></div></div>\n";
                }
            }
            $return .= "</div>\n";
        }

        return $return;
    }
}