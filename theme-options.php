<?php

/*
  SET FUNCTIONS
*/
      // GET TOP 10 STORIES FROM ALL BLOGS
      function array_top_ten(){
        global $latest;

        // $blogs = get_all_blogs();
        // foreach($blogs as $key=>$val){
        //   switch_to_blog($key);

          // GET RECENT POSTS BY BLOG
          $args = array('numberposts' => 20);
          $recent_posts =       wp_get_recent_posts($args);
          $array[]      =       array('title'=>'-- '.$val->blogname.' --','name'=>'');
          
          foreach($recent_posts as $r){
            $array[$r[ID]][title]     = $r[post_title];
            $array[$r[ID]][name]      = $key . ':' . $r[ID];
          }

        //   restore_current_blog();
        // }

        // GET LATEST POST FROM CURRENT BLOG
        $latest = wp_get_recent_posts( '1');
        $latest = '1:'.$latest['0']['ID'];

        return $array;
      }
  
/*
  SET TABS
*/
      
  $colors_tab = array(
      "name" => "colors_and_images",
      "title" => __("Theme Settings","rnl"),
      "sections" => array(
          "color_scheme" => array(
              "name" => "color_scheme",
              "title" => __( "Theme Settings", "rnl" ),
              "description" => __( "Add basic elements to your theme.","rnl" )
          )
      )

  );
  register_theme_option_tab($colors_tab);

  $story_tab = array(
    "name" => "the_top_stories",
    "title" => __("Top Story","rnl"),
    "sections" => array(
      "top_story" => array(
        "name" => "top_story",
        "title" => __( "Top Story", "rnl" ),
        "description" => __( "Select the top story for the homepage","rnl" )
      )
    )
  );
  register_theme_option_tab($story_tab);

  $sidebar_menus = array(
    "name" => "sidebar_menu",
    "title" => __("Menus &amp; Icons","rnl"),
    "sections" => array(
      "front_menu" => array(
        "name" => "front_menu",
        "title" => __( "Front Menu", "rnl" ),
        "description" => __( "Add icons and links to the sidebar for the homepage.","rnl" )
      ),
      "inside_menu" => array(
        "name" => "inside_menu",
        "title" => __( "Inner Page Menu", "rnl" ),
        "description" => __( "Add icons and links to the sidebar for the remaining pages.","rnl" )
      ),
      "social_media_icons" => array(
        "name" => "social_media_icons",
        "title" => __( "Social Media Icons", "rnl" ),
        "description" => __( "Add social media links and icons to the header.","rnl" )
      )
    )
  );
  register_theme_option_tab($sidebar_menus);

/* 
  SET OPTIONS 
*/
          
  $options = array(
        // "theme_color_scheme" => array(
        //     "tab" => $colors_tab["name"],
        //     "name" => "theme_color_scheme",
        //     "title" => "Theme Color Scheme",
        //     "description" => __( "Display header navigation menu above or below the site title/description?", "upfw" ),
        //     "section" => "color_scheme",
        //     "since" => "1.0",
        //     "id" => "color_scheme",
        //     "type" => "select",
        //     "default" => "light",
        //     "valid_options" => array(
        //         "light" => array(
        //             "name" => "light",
        //             "title" => __( "Light", "rnl" )
        //         ),
        //         "dark" => array(
        //             "name" => "dark",
        //             "title" => __( "Dark", "rnl" )
        //         )
        //     )
        // ),
        // "theme_hyperlink_color" => array(
        //     "tab" => $colors_tab["name"],
        //     "name" => "theme_hyperlink_color",
        //     "title" => "Theme Hyperlink Color",
        //     "description" => __( "Default hyperlink color.", "rnl" ),
        //     "section" => "color_scheme",
        //     "since" => "1.0",
        //     "id" => "color_scheme",
        //     "type" => "color",
        //     "default" => "#ffffff"
        // ),
        "google_analytics" => array(
            "tab" => $colors_tab["name"],
            "name" => "google_analytics",
            "title" => "<b>Google Analytics</b><br/><small>Include the Google Property ID to add tracking info.<br/><b>Example: UA-00000000-0</b></small>",
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "google_analytics",
            "type" => "text"
        ),
	"google_analytics_site" => array(
            "tab" => $colors_tab["name"],
            "name" => "google_analytics_site",
            "title" => "<b>Google Analytics URL</b><br/><small>Include the URL registered with Google to add tracking info.<br/><b>Example: 'reesenewslab.org'</b></small>",
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "google_analytics_site",
            "type" => "text"
        ),
        "meta_description" => array(
            "tab" => $colors_tab["name"],
            "name" => "meta_description",
            "title" => "<b>Meta description</b><br/><small>This will be displayed on Facebook and in sharing when an excerpt is not available.</small>",
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "meta_description",
            "type" => "textarea"
        ),
        "theme_meta_photo" => array(
            "tab" => $colors_tab["name"],
            "name" => "theme_meta_photo",
            "title" => "<b>Logo Image</b><br/> (must be at least 200x200)",
            "description" => __( "Default logo.", "rnl" ),
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "color_scheme",
            "type" => "image"
        ),
        "theme_background_image" => array(
            "tab" => $colors_tab["name"],
            "name" => "theme_background_image",
            "title" => "<b>Background Image</b>",
            "description" => __( "Default background image.", "rnl" ),
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "color_scheme",
            "type" => "image"
        ),
	"theme_organization" => array(
            "tab" => $colors_tab["name"],
            "name" => "theme_organization",
            "title" => "<b>Organization</b><br/>Included above the logo",
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "theme_organization",
            "type" => "text"
        ),
        "theme_logo" => array(
            "tab" => $colors_tab["name"],
            "name" => "theme_logo",
            "title" => "<b>Logo</b>",
            "description" => __( "Choose the logo.", "rnl" ),
            "section" => "color_scheme",
            "since" => "1.0",
            "id" => "color_scheme",
            "type" => "image"
        ),
        "theme_cover_story" => array(
            "tab" => $story_tab["name"],
            "name" => "theme_cover_story",
            "title" => "<b>Cover story</b>",
            "description" => __( "Top Story", "rnl" ),
            "section" => "top_story",
            "since" => "1.0",
            "id" => "top_story",
            "type" => "select",
            "valid_options" => array_top_ten(),
            "default" => $latest
            ),
        "front_menu" => array(
            "tab" => $sidebar_menus["name"],
            "name" => "front_menu",
            "title" => "<b>Front Menu<b>
                        <br/><small style='color: #555'>One group per line in format 
                        <br/>
                        <b>URL, ICON CLASS, NAME</b>.
                        <br/><br/>
                        Example: <br/>
                        <b>http://url.com, icon-home, Home</b><br/>
                        <a target='blank' href='http://fortawesome.github.io/Font-Awesome/icons/#brand'>View All</a>
                        </small>",
            "section" => "front_menu",
            "since" => "1.0",
            "id" => "front_menu",
            "type" => "textarea"
            ),
        "inner_menu" => array(
            "tab" => $sidebar_menus["name"],
            "name" => "inner_menu",
            "title" => "<b>Sidebar Menu, displayed on every page except home<b>
                        <br/><small style='color: #555'>One group per line in format 
                        <br/>
                        <b>URL, ICON CLASS, NAME</b>.
                        <br/><br/>
                        Example: <br/>
                        <b>http://url.com, icon-home, Home</b><br/>
                        <a target='blank' href='http://fortawesome.github.io/Font-Awesome/icons/#brand'>View All</a>
                        </small>",
            "section" => "inside_menu",
            "since" => "1.0",
            "id" => "inner_menu",
            "type" => "textarea"
            ),
        "social_media" => array(
            "tab" => $sidebar_menus["name"],
            "name" => "social_media",
            "title" => "
                        <link rel='stylesheet' href='".get_bloginfo('template_url')."/css/font-awesome.min.css' type='text/css'/> 
                        <b>Social Media<b>
                        <br/><small style='color: #555'>One group per line in format 
                        <br/>
                        <b>URL, ICON CLASS, NAME</b>.
                        <br/><br/>
                        Example: <br/>
                        <b>http://www.facebook.com/reesenewslab, icon-facebook, Facebook</b><br/>
                        <br/>
                          <i class='icon-facebook icon-2x'></i>
                          <i class='icon-twitter icon-2x'></i>
                          <i class='icon-linkedin icon-2x'></i>
                          <i class='icon-pinterest icon-2x'></i>
                          <i class='icon-google-plus icon-2x'></i><br/>
                        <a target='blank' href='http://fortawesome.github.io/Font-Awesome/icons/#brand'>View All</a>
                        </small>",
            "section" => "social_media_icons",
            "since" => "1.0",
            "id" => "social_media",
            "type" => "textarea"
            )
    );
            
    register_theme_options($options);

?>
