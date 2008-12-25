<?php
/**
 * @version   $Id$
 * @package   Joomla
 * @copyright Copyright (C) 2008 Edvard Ananyan. All rights reserved.
 * @license   BSD License
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgEditorXinha extends JPlugin {
    function plgXinha(&$subject, $config) {
        parent::__construct($subject, $config);
    }

    function onInit() {
        // Editor gets loaded twice in Legacy mode
        if(defined('_XINHA_ISLOADED')) return false;
        define('_XINHA_ISLOADED', 1);

        $plugin =& JPluginHelper::getPlugin('editors', 'xinha');
        $params = $plugin->params;
        $language = $params->get('language', 'en');
        $skin = $params->get('skin', '');
        $load_plugins = '';
        if($params->get('plugin_Abbreviation', 0) == 1) $load_plugins .= "'Abbreviation',";
        if($params->get('plugin_BackgroundImage', 0) == 1) $load_plugins .= "'BackgroundImage',";
        if($params->get('plugin_CharacterMap', 1) == 1) $load_plugins .= "'CharacterMap',";
        if($params->get('plugin_CharCounter', 0) == 1) $load_plugins .= "'CharCounter',";
        if($params->get('plugin_ClientsideSpellcheck', 0) == 1) $load_plugins .= "'ClientsideSpellcheck',";
        if($params->get('plugin_ContextMenu', 1) == 1) $load_plugins .= "'ContextMenu',";
        if($params->get('plugin_CSS', 0) == 1) $load_plugins .= "'CSS',";
        if($params->get('plugin_DefinitionList', 0) == 1) $load_plugins .= "'DefinitionList',";
        if($params->get('plugin_DoubleClick', 0) == 1) $load_plugins .= "'DoubleClick',";
        if($params->get('plugin_DynamicCSS', 0) == 1) $load_plugins .= "'DynamicCSS',";
        if($params->get('plugin_EditTag', 0) == 1) $load_plugins .= "'EditTag',";
        if($params->get('plugin_Equation', 0) == 1) $load_plugins .= "'Equation',";
        if($params->get('plugin_ExtendedFileManager', 0) == 1) $load_plugins .= "'ExtendedFileManager',";
        if($params->get('plugin_Filter', 0) == 1) $load_plugins .= "'Filter',";
        if($params->get('plugin_FindReplace', 0) == 1) $load_plugins .= "'FindReplace',";
        if($params->get('plugin_FormOperations', 0) == 1) $load_plugins .= "'FormOperations',";
        if($params->get('plugin_Forms', 0) == 1) $load_plugins .= "'Forms',";
        if($params->get('plugin_FullPage', 0) == 1) $load_plugins .= "'FullPage',";
        if($params->get('plugin_GenericPlugin', 0) == 1) $load_plugins .= "'GenericPlugin',";
        if($params->get('plugin_GetHtml', 0) == 1) $load_plugins .= "'GetHtml',";
        if($params->get('plugin_HorizontalRule', 0) == 1) $load_plugins .= "'HorizontalRule',";
        if($params->get('plugin_HtmlEntities', 0) == 1) $load_plugins .= "'HtmlEntities',";
        if($params->get('plugin_HtmlTidy', 0) == 1) $load_plugins .= "'HtmlTidy',";
        if($params->get('plugin_ImageManager', 1) == 1) $load_plugins .= "'ImageManager',";
        if($params->get('plugin_InsertAnchor', 0) == 1) $load_plugins .= "'InsertAnchor',";
        if($params->get('plugin_InsertMarquee', 0) == 1) $load_plugins .= "'InsertMarquee',";
        if($params->get('plugin_InsertPagebreak', 0) == 1) $load_plugins .= "'InsertPagebreak',";
        if($params->get('plugin_InsertPicture', 0) == 1) $load_plugins .= "'InsertPicture',";
        if($params->get('plugin_InsertSmiley', 0) == 1) $load_plugins .= "'InsertSmiley',";
        if($params->get('plugin_InsertSnippet', 0) == 1) $load_plugins .= "'InsertSnippet',";
        if($params->get('plugin_InsertWords', 0) == 1) $load_plugins .= "'InsertWords',";
        if($params->get('plugin_LangMarks', 0) == 1) $load_plugins .= "'LangMarks',";
        if($params->get('plugin_Linker', 1) == 1) $load_plugins .= "'Linker',";
        if($params->get('plugin_ListType', 1) == 1) $load_plugins .= "'ListType',";
        if($params->get('plugin_NoteServer', 0) == 1) $load_plugins .= "'NoteServer',";
        if($params->get('plugin_PasteText', 0) == 1) $load_plugins .= "'PasteText',";
        if($params->get('plugin_PreserveScripts', 0) == 1) $load_plugins .= "'PreserveScripts',";
        if($params->get('plugin_QuickTag', 0) == 1) $load_plugins .= "'QuickTag',";
        if($params->get('plugin_SaveSubmit', 0) == 1) $load_plugins .= "'SaveSubmit',";
        if($params->get('plugin_SetId', 0) == 1) $load_plugins .= "'SetId',";
        if($params->get('plugin_SmartReplace', 0) == 1) $load_plugins .= "'SmartReplace',";
        if($params->get('plugin_SpellChecker', 0) == 1) $load_plugins .= "'SpellChecker',";
        if($params->get('plugin_Stylist', 1) == 1) $load_plugins .= "'Stylist',";
        if($params->get('plugin_SuperClean', 1) == 1) $load_plugins .= "'SuperClean',";
        if($params->get('plugin_TableOperations', 0) == 1) $load_plugins .= "'TableOperations',";
        if($params->get('plugin_Template', 0) == 1) $load_plugins .= "'Template',";
        if($params->get('plugin_UnFormat', 0) == 1) $load_plugins .= "'UnFormat',";
        $load_plugins = rtrim($load_plugins, ',');

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
            'xinha_plugins = xinha_plugins ? xinha_plugins : ['.$load_plugins.'];' .
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

    function onGetContent($editor) {
        return "xinha_editors.$editor.getHTML();";
    }

    function onSetContent($editor, $html) {
        return "xinha_editors.$editor.setHTML($html);";
    }

    function onSave( $editor ) {
        //TODO: make html cleanup
        return '"";';
    }

    function onDisplay($name, $content, $width, $height, $col, $row, $buttons = true) {
        // Only add "px" to width and height if they are not given as a percentage
        if(is_numeric($width)) $width .= 'px';
        if(is_numeric($height)) $height .= 'px';

        $buttons = $this->_displayButtons($name, $buttons);
        $editor = '<textarea name="'.$name.'" id="'.$name.'" cols="'.$col.'" rows="'.$row.'" style="width:'.$width.';height:'.$height.';">'.$content.'</textarea><br />'.$buttons;

        return $editor;
    }

    function onGetInsertMethod($name) {
        $doc =& JFactory::getDocument();

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