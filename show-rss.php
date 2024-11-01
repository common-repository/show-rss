<?php 
/*
Plugin Name: Show RSS Feeds
Version: 0.2
Plugin URI: http://wordpress.org/extend/plugins/show-rss/
Description: Displays RSS feed in templates
Author:
Author URI:
*/
function display_feed($url, $title, $count, $display=true)
{
        echo "<h3>".$title."</h3>";
        include_once(ABSPATH . WPINC . '/feed.php');
        $rss = fetch_feed($url);
        $maxitems = $rss->get_item_quantity($count); 
        $rss_items = $rss->get_items(0, $maxitems); 
        if($display){
            foreach ( $rss_items as $item )
            {
                $source = $item->get_item_tags('','source');
                $posted_category = $source[0]['data'];
                $posted_category_link = $source[0]['attribs']['']['url'];
                $permalink = $item->get_permalink();
                echo "<div class='info'><div class='posted'>Posted in ";
                echo "<a href='".$posted_category_link."' rel='nofollow'>".$posted_category."</a></div>";
                echo "<h2><a href='". $permalink ."' rel='nofollow' title='Permanent Link to ".$permalink. "' target='_blank'>";
                echo $item->get_title()."</a></h2>";
                echo "<div class='posted'>Posted on ".$item->get_date('F jS, Y')."</div>";
                echo "<div class='excerpt'>".$item->get_content()."</div>";
                echo "<a class='inGreen' href=".$permalink." rel='nofollow' target='_blank'>READ MORE</a></div>";
            }
        }
        return $rss_items;
}

function display_rss_feed($url, $title, $count, $display=true)
{
        include_once(ABSPATH . WPINC . '/feed.php');
        $rss = fetch_feed($url);
        $maxitems = $rss->get_item_quantity($count); 
        $rss_items = $rss->get_items(0, $maxitems); 
        if($display){
            echo "<h3>".$title."</h3>"; 
           foreach ( $rss_items as $item )
            {
                $source = $item->get_item_tags('','source');
                $posted_category = $source[0]['data'];
                $posted_category_link = $source[0]['attribs']['']['url'];
                $permalink = $item->get_permalink();
                echo "<div class='info'><div class='posted'>Posted in ";
                echo "<a href='".$posted_category_link."' rel='nofollow'>".$posted_category."</a></div>";
                echo "<h2><a href='". $permalink ."' rel='nofollow' title='Permanent Link to ".$permalink. "' target='_blank'>";
                echo $item->get_title()."</a></h2>";
                echo "<div class='posted'>Posted on ".$item->get_date('F jS, Y')."</div>";
                echo "<div class='excerpt'>".$item->get_content()."</div>";
                echo "<a class='inGreen' href=".$permalink." rel='nofollow'>READ MORE</a></div>";
            }
        }
        return $rss_items;
}

?>
