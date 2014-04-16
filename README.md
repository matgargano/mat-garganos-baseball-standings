Mat Gargano's Baseball Standings
===================
Contributors: matstars  
Tags: post, widget  
Tested up to: 3.8.3
Requires at least: 3.0  
Stable tag: 2.0.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  
  
  
## Description
Provides you with a WordPress widget to display current MLB Standings

## Installation
> See [Installing Plugins](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).


## Usage

### Simple Usage
Simple use, just drag and drop, set your title, division and you're good to go.

### Advanced Usage

This plugin exposes a bunch of different filters that allow you to customize your output, which include:

##### mgbs_shorten_name

Pass an array of key=>value pairs, just like MLB_Standings_Helper::get_short_name() has, (see ```/lib/class-mlb-standings.php```) for more info

#### mgbs_template

Allows a custom template file to be used, example of how to work this:

Add a template directory and file named "custom-standings" to your template directory (in this example we're assuming it in ```{template_directory}/view/custom-mgbs.php```). 

See ```/views/widget.php``` for how to structure this template file.

Then add the following to your functions.php (or any arbitrary file that gets included when your wordpress application runs)

```
<?php
    function customize_mgbs_template_filter( $template ){
        $template_dir = get_template_directory();
        return $template_dir . '/views/custom-mgbs.php';    
    }
    add_filter( 'mgbs_template', 'customize_mgbs_template_filter' );
?>
```


##### mgbs_standings_data

This passes (and allows you to customize) the data that gets output to the frontend. An example usage of this is if you want to only output only NL.

## Changelog


**2.0**  
Completely rewrote plugin

**1.3**  
Team names now show up as expected 

**1.2**  
Fixed a bug that did not properly display winning percentage for teams.

**1.1**  
Fixed a bug that caused the plugin to not operate properly

