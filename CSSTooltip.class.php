<?php
class CSSTooltip {
	
	public static function CSSTooltipOnBeforePageDisplay( OutputPage &$out, Skin &$skin ) {

		// Add as ResourceLoader Module
		$out->addModules('ext.CSSTooltip.styles');

		return true;
	}

	public static function onParserSetup( &$parser ) {

		// Register parser functions
		$parser->setFunctionHook('tooltip-inline', 'CSSTooltip::inlineTooltip');
		$parser->setFunctionHook('tooltip-info', 'CSSTooltip::infoTooltip');
	}

    /**
     * Parser function handler for {{#tooltip-inline: inline-text | tooltip-text }}
     *
     * @param Parser $parser
     * @param string $arg
     *
     * @return string: HTML to insert in the page.
     */
    public static function inlineTooltip( $parser, $param1='', $param2='' ) {

        //////////////////////////////////////////
        // BUILD HTML                           //
        //////////////////////////////////////////

        $html  = '<div class="csstooltip">' . htmlspecialchars($param1);
        $html .= '<span class="csstooltiptext">';
        $html .= htmlspecialchars($param2) . '</span></div>';

        return array(
            $html,
            'noparse' => false,
            'isHTML' => true
            //"markerType" => ''
        );
    }

    /**
     * Parser function handler for {{#tooltip-info: tooltip-text }}
     *
     * @param Parser $parser
     * @param string $arg
     *
     * @return string: HTML to insert in the page.
     */
    public static function infoTooltip( $parser, $param1='' ) {

        //////////////////////////////////////////
        // BUILD HTML                           //
        //////////////////////////////////////////

        $html = '<img src="../images/blue_question_mark_icon.svg" width="15px" height="15px" data-toggle="tooltip" title="' . htmlspecialchars($param1) . '" />';
        $html .= '<script>$(document).ready(function(){ $(\'[data-toggle="tooltip"]\').tooltip(); });</script>';

        return array(
            $html,
            'noparse' => true,
            'isHTML' => true,
            "markerType" => 'nowiki'
        );
    }

}