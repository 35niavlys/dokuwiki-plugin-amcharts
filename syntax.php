<?php
/**
 * DokuWiki Plugin AmCharts (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author Sylvain Menu <35niavlys@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_amcharts extends DokuWiki_Syntax_Plugin {
    /**
     * @return string Syntax mode type
     */
    public function getType() {
        return 'substition';
    }
    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'block';
    }
    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort() {
        return 200;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<amchart.+?</amchart>',$mode,'plugin_amcharts');
    }

    /**
     * Handle matches of the amchart syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler $handler){
        $match = substr(trim($match), 8, -10);
        list($opts, $amdata) = explode('>', $match, 2);
        preg_match_all('/(\S+)=["\']?((?:.(?!["\']?\s+(?:\S+)=|[>"\']))+.)["\']?/', $opts, $matches, PREG_SET_ORDER);
        $opts = array(
            'width' => $this->getConf('width'),
            'height' => $this->getConf('height'),
            'align' => $this->getConf('align'),
        );
        foreach($matches as $m) {
            $opts[strtolower($m[1])] = $m[2];
        }

        $amdata = preg_replace_callback(
            '#//.*?$|/\*.*?\*/|\'(?:\\.|[^\\\'])*\'|"(?:\\.|[^\\"])*"#ms',
            function($matches){
                $m = $matches[0];
                return substr($m, 0, 1)==='/' ? ' ' : $m;
            }, $amdata
        ); // remove comments (respecting quoted strings)
        $amdata = explode("\n", $amdata);
        $amdata = implode("", array_map(trim, $amdata));
        $chartid = uniqid('__amchart_');
        $amdata = base64_encode($amdata);

        return array($chartid, $amdata, $opts);
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer $renderer, $data) {
        if($mode != 'xhtml') return false;

        list($chartid, $amdata, $opts) = $data;
        $s = '';
        $c = '';
        foreach($opts as $n => $v) {
            if(in_array($n, array('width','height')) && $v) {
                $s .= $n.':'.hsc($v).';';
            } elseif($n=='align' && in_array($v, array('left','right','center'))) {
                $c = 'media'.$v;
            }
        }
        if($s) $s = ' style="'.$s.'"';
        if($c) $c = ' class="'.$c.'"';
        $renderer->doc .= '<div id="'.$chartid.'"'.$c.$s.' data-amchart="'.$amdata.'"></div>'."\n";
    
        return true;
    }
}