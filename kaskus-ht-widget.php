<?php
/*
Plugin Name: Kaskus Hot Threads Widget
Plugin URI: http://hendrasetiawan.net/kaskus-hot-threads-widget
Description: Plugin yang berfungsi untuk menampilkan Widget yang berisi Kaskus Hot Threads di Blog Wordpress Agan. Plugin ini telah support untuk Kaskus Evolution.
Author: Hendra Setiawan
Version: 1.1
Author URI: http://hendrasetiawan.net/
*/


function showht() {
  $path = "http://pipes.yahoo.com/pipes/pipe.run?_id=6b3b92723c84f29fbd76953027882b2d&_render=rss";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $path);
  curl_setopt($ch, CURLOPT_FAILONERROR, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 15);
  $returned = curl_exec($ch);
  curl_close($ch);	

  $feed = simplexml_load_string($returned);
	
  foreach ($feed->channel->item as $item) {
  $title       = (string) $item->title;
  $link 	   = (string) $item->link;

  echo "<a href='".$link."' target='_blank'>".$title."</a>";
  }
}

function widgetht($args) {
    extract($args);
    echo $before_widget;
    echo $before_title;
	echo "Kaskus Hot Threads";
    echo $after_title;
    echo "<ul>";
    showht();
    echo "</ul>";
    echo $after_widget;
}

function ht_init() {
    register_sidebar_widget(__('Kaskus Hot Threads'), 'widgetht');
}

add_action("plugins_loaded", "ht_init");

?>