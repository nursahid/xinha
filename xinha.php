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
        //$params = new JParameter($plugin->params);
        $params = $plugin->params;
        $language = $params->get('language', 'en');
        $skin = $params->get('skin', '');

        $return =  '<script type="text/javascript">' .
        '_editor_url  = "'.JURI::root().'plugins/editors/xinha/";' .
        '_editor_lang = "'.$language.'";' .
        '_editor_skin = "'.$skin.'";' .
        '</script>' .
        '<script type="text/javascript" src="'.JURI::root().'plugins/editors/xinha/XinhaCore.js"></script>' .
        '<script type="text/javascript">' .
        'xinha_editors = null;' .
        'xinha_init    = null;' .
        'xinha_config  = null;' .
        'xinha_plugins = null;' .
        'xinha_init = xinha_init ? xinha_init : function() {' .
            'xinha_editors = xinha_editors ? xinha_editors : [\'text\'];' .
            'xinha_plugins = xinha_plugins ? xinha_plugins : [\'CharacterMap\',\'ContextMenu\',\'ListType\',\'Stylist\',\'Linker\',\'SuperClean\',\'TableOperations\',\'ImageManager\'];' .
            'if(Xinha.loadPlugins(xinha_plugins, xinha_init) == false) return;' .
            'xinha_config = xinha_config ? xinha_config : new Xinha.Config();' .
            'xinha_config.pageStyleSheets = [_editor_url + "examples/full_example.css"];' .
            'xinha_editors = Xinha.makeEditors(xinha_editors, xinha_config, xinha_plugins);' .
            'Xinha.startEditors(xinha_editors);' .
        '};' .
        'Xinha.addOnloadHandler(xinha_init);' .
        '</script>';

        return $return;
}

    /**
     * Xinha WYSIWYG Editor - get the editor content
     *
     * @param string    The name of the editor
     */
    function onGetContent( $editor ) {
        //return "JContentEditor.getContent('".$editor."');";
        return "xinha_editors.$editor.getHTML();";

    }

    /**
     * Xinha WYSIWYG Editor - set the editor content
     *
     * @param string    The name of the editor
     */
    function onSetContent( $editor, $html ) {
        //return "tinyMCE.activeEditor.setContent(".$html.");";
        return "xinha_editors.$editor.setHTML(".$html.");";
    }

    /**
     * Xinha WYSIWYG Editor - copy editor content to form field
     *
     * @param string    The name of the editor
     */
    function onSave( $editor ) {
        //return "tinyMCE.triggerSave();";
        return '"";';
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
        //$editor .= "<textarea id=\"$name\" name=\"$name\" cols=\"$col\" rows=\"$row\" style=\"width:{$width}; height:{$height};\" class=\"mceEditor\">$content</textarea>\n" . $buttons;
        //$editor .= "<script type=\"text/javascript\">function jceOnLoad(){JContentEditor.initEditorMode('$name');}</script>";

        $editor = '<textarea name="'.$name.'" id="'.$name.'" cols="'.$col.'" rows="'.$row.'" style="width:'.$width.';height:'.$height.';">'.$content.'</textarea><br />'.$buttons;

        return $editor;
    }

    function onGetInsertMethod($name) {
        $doc =& JFactory::getDocument();

        //$js= "function jInsertEditorText( text, editor ) {tinyMCE.execInstanceCommand(editor, 'mceInsertContent',false,text);}";
        $js= "function jInsertEditorText(text, editor) {xinha_editors.$name.execCommand('insertHTML', false, text);}";
        $doc->addScriptDeclaration($js);

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

        if(!empty($buttons)) {
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