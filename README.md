#AmCharts Plugin for DokuWiki#

The `amcharts` plugin for DokuWiki makes it easy to insert interactive data charts rendered by [amcharts.js](http://www.amcharts.com/).

This plugin accepts the same JavaScript object that AmCharts takes to generate a chart. Any chart describable by a static JavaScript object is supported. All types of charts natively supported by AmCharts can be rendered.

## Installation ##
The latest ZIP package of this plugin can be downloaded [here](https://github.com/35niavlys/dokuwiki-plugin-amcharts/archive/master.zip).

If you install this plugin manually, make sure it is installed in `lib/plugins/amcharts/` - if the folder is called different it may not work.

Please refer to the [DokuWiki document](http://www.dokuwiki.org/plugins) for additional info on how to install plugins in DokuWiki.

## Usage ##
This plugin accepts the same JavaScript object that the `makeChart()` function of amcharts.js takes to render a chart. To include a chart in your DokuWiki page, simply wrap such a JavaScript object with a `<amchart>` tag.

To render a pie chart for exemple:
```
<amchart>
{
  "type": "pie",
  "dataProvider": [ {
    "country": "Lithuania",
    "litres": 501.9
  }, {
    "country": "Czech Republic",
    "litres": 301.9
  }, {
    "country": "Ireland",
    "litres": 201.1
  }, {
    "country": "Germany",
    "litres": 165.8
  }, {
    "country": "Australia",
    "litres": 139.9
  }, {
    "country": "Austria",
    "litres": 128.3
  }, {
    "country": "UK",
    "litres": 99
  }, {
    "country": "Belgium",
    "litres": 60
  }, {
    "country": "The Netherlands",
    "litres": 50
  } ],
  "valueField": "litres",
  "titleField": "country",
   "balloon":{
   "fixedPosition":true
  }
}
</amchart>
```

Also note that you can include comments in the snippet, both styles (`//` and `/* */`) are supported.

The major restriction is that the JavaScript object must be **static**, i.e. it cannot include function calls or function expressions, for security reasons.



## License ##
Copyright (C) Sylvain Menu

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

See the COPYING file in your DokuWiki folder for details
