<?php
/**
 * Options for the c3chart plugin
 *
 * @author Sylvain Menu <35niavlys@gmail.com>
 */

$meta['url_yaml'] = array('string', '_pattern' => '#^(?:(?:(?:https?:)?/)?/)?(?:[\w.][\w./]*/)?js-yaml(?:\.min)?\.js$#');
$meta['url_amcharts'] = array('string', '_pattern' => '#^(?:(?:(?:https?:)?/)?/)?(?:[\w.][\w./]*/)?amcharts/?$#');
$meta['amcharts_lang'] = array('multichoice', '_choices' => array('en','az','bg','de','es','fi','fo','fr','hr','hu','id','is','it','lt','lv','mk','mn','mt','nl','no','pl','pt','ro','ru','rw','sk','so','th','tr'));
$meta['amcharts_themes'] = array('string', '_pattern' => '#^(\w+|)*\w+$#');
$meta['width'] = array('string', '_pattern' => '/^(?:\d+(px|%))?$/');
$meta['height'] = array('string', '_pattern' => '/^(?:\d+(px|%))?$/');
$meta['align'] = array('multichoice', '_choices' => array('none','left','center','right'));
