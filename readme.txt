=== Mat Gargano's Baseball Standings ===
Contributors: matstars  
Tags: post, widget  
Tested up to: 3.9
Requires at least: 3.0  
Stable tag: 2.0.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  


Provides you with a WordPress widget to display current MLB Standings

== Description ==

### Simple Usage
Simple use, just drag and drop, set your title, division and you're good to go. Data is reupdated every 60 minutes.

### Advanced Usage

This plugin exposes a bunch of different filters that allow you to customize your output, which include:

#### mgbs_shorten_name

Pass an array of key=>value pairs, just like MLB_Standings_Helper::get_short_name() has, (see `/lib/class-mlb-standings.php`) for more info

#### mgbs_template

Allows a custom template file to be used, example of how to work this:

Add a template directory and file named "custom-standings" to your template directory (in this example we're assuming it in `{template_directory}/view/custom-mgbs.php`). 

See `/views/widget.php` for how to structure this template file.

Then add the following to your functions.php (or any arbitrary file that gets included when your wordpress application runs)

`
<?php
    function customize_mgbs_template_filter( $template ){
        $template_dir = get_template_directory();
        return $template_dir . '/views/custom-mgbs.php';    
    }
    add_filter( 'mgbs_template', 'customize_mgbs_template_filter' );
?>
`


#### mgbs_standings_data

This passes (and allows you to customize) the data that gets output to the frontend. An example usage of this is if you want to only output only NL.

== Grunt ==

This plugin takes advantage of [Grunt](http://gruntjs.com) for validating JavaScript, SASS compilation and minification. To take advantage of Grunt you have to have both npm and Grunt installed. Visit the respective sites for the applications and make sure they are installed. Once installed, if you want to edit/fork this plugin, it will be helpful to be familiar with these two tools.


== Installation ==

1. If installing manually, unzip and copy the resulting directory to your plugin directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add the widget to any widgetized area/sidebar and configure as desired.


== Changelog ==

= 2.0.0 =
* Completely rewrote plugin
* Data is now refetched every 60 minutes

= 0.1.2 =
* Incremental bugfixes


= 0.1.1 =
* Incremental bugfixes


= 0.1.0 =
* Initial release

== Upgrade Notice ==

= 2.0.0 =
* The plugin was completely rewritten, please recreate your widgets accordingly.

== Screenshots ==

1. Widget screenshot

== Frequently Asked Questions ==

= Where does this data come from? =

The data comes from [Erik Berg](http://erikberg.com) and I'm grateful to his making it available.

= How frequently is the data refreshed? =

The data pings the aforementioned server every 60 minutes.

