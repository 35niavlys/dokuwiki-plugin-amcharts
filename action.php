<?php
/**
 * DokuWiki Plugin AmCharts (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Sylvain Menu <35niavlys@gmail.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_amcharts extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'handle_tpl_metaheader_output');
    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */
    public function handle_tpl_metaheader_output(Doku_Event &$event, $param) {
		
        $event->data["script"][] = array (
            "type" => "text/javascript",
            "src" => $this->get_asset($this->getConf('url_yaml')),
            "_data" => "",
        );
		
		$amfiles = array("amcharts.js", "funnel.js", "gantt.js", "gauge.js", "pie.js", "radar.js", "serial.js", "xy.js");
		$url_amcharts = $this->getConf('url_amcharts');
		foreach($amfiles as $file) {
			$event->data["script"][] = array (
				"type" => "text/javascript",
				"src" => $this->get_asset($url_amcharts.'/'.$file),
				"_data" => "",
			);
		}
		
		$lang = $this->getConf('amcharts_lang');
		if($lang != 'en') {
			$event->data["script"][] = array (
				"type" => "text/javascript",
				"src" => $this->get_asset($url_amcharts.'/lang/'.$lang.'.js'),
				"_data" => "",
			);
		}
		
		$themes = split("\|", $this->getConf('amcharts_themes'));
		foreach($themes as $theme) {
			$event->data["script"][] = array (
				"type" => "text/javascript",
				"src" => $this->get_asset($url_amcharts.'/themes/'.$theme.'.js'),
				"_data" => "",
			);
		}
		$plugins = array("dataloader", "export", "responsive");
		foreach($plugins as $plugin) {
			$event->data["script"][] = array (
				"type" => "text/javascript",
				"src" => $this->get_asset($url_amcharts.'/plugins/'.$plugin.'/'.$plugin.'.min.js'),
				"_data" => "",
			);
		}
		$event->data["script"][] = array (
			"type" => "text/javascript",
			"src" => $this->get_asset($url_amcharts.'/plugins/export/lang/'.$lang.'.js'),
			"_data" => "",
		);
        $event->data["link"][] = array (
            "type" => "text/css",
            "rel" => "stylesheet",
            "href" => $this->get_asset($url_amcharts.'/plugins/export/export.css'),
        );
    }

    private function get_asset($resource) {
        if(!preg_match('#^(?:(?:https?:)?/)?/#', $resource)) {
            $info = $this->getInfo();
            $resource = DOKU_BASE."lib/plugins/".$info['base']."/assets/".$resource;
        }
        return $resource;
    }

}