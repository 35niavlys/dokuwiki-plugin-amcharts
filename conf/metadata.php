<?php
/**
 * Options for the amcharts plugin
 *
 * @author Sylvain Menu <35niavlys@gmail.com>
 */

$meta['url_yaml'] = array('string');
$meta['url_amcharts'] = array('string');
$meta['amcharts_js'] = array('string');
$meta['amcharts_css'] = array('string');
$meta['width'] = array('string', '_pattern' => '/^(?:\d+(px|%))?$/');
$meta['height'] = array('string', '_pattern' => '/^(?:\d+(px|%))?$/');
$meta['align'] = array('multichoice', '_choices' => array('none','left','center','right'));
