<style type="text/css">
.gmaps_cb {
  margin-top: 10px;
}
.gmaps_cb label {
  padding-left: 6px;
}
</style>
<h2>Gmaps.js info and settings page</h2>
<h3>About the authors</h3>
  <p>Gmaps.js is a javascript library written by Gustavo Leon. You can read more <a href="https://github.com/hpneo/gmaps#license" target="_blank">here</a>.</p>
  <p>The wordpress porting has been made by Marco Antonutti, a <em>young</em> italian <em>senior</em> developer at <a href="http://nois3lab.it/en" target="_blank">nois3lab</a>. You are not asked to donate but reviews, feedback, blogpost and case studies will be higly appreciated.</p>
<h3>Usage</h3>
  <p>You can use this plugin in two different ways: using shortcodes inside your rich text editor or making it a lot more easier calling the shortcode directly from you php template. Explanations of both follow.</p>
<h4>The shortcode way</h4>
  <p>(for the full list of options available, <a href="#" target="_blank">click here</a>)</p>
  <p>The simplest shortcode is <pre>[gmapsjs address="Piazza del Colosseo, Roma"]</pre>. It simply displays a map with 12 of zoom and with the Colosseum (or whatever you may like) at the center.</p>
  <p>But the show goes on. With gmaps.js for wordpress, you can specify markers, use geolocation - if the user allows it - draw predefined routes and even make new ones based on user's input or geolocation.</p>
  <p>This option is awesome if you just need maps occasionally.</p>
<h4>The meta-box way</h4>
  
<h3>Generic Settings</h3>
<h4>Only apply to meta-box way - don't allow overwriting</h4>
<div id="generic-settings-container">
  <p>You can define options about which content type are supporting maps and where the map should be placed. </p>
  <p>Anyway, it won't be rare that you will need to move your map far from your main content, perhaps in the sidebar or in a jquery ui tab.</p>
  <p>If this case match your needs, below "Placement" select the option "manual" and put &lt;?php echo gmapsjs_frontend($post->ID); ?&gt; where you want.</p>
  <p>Short explanation: $post->ID is the name of the identifier of the post currently in the wordpress loop. If you rename the variable or if it doesn't work and you don't know why, try to remove the argument writing just &lt;?php echo gmapsjs_fronted(); ?&gt;. We will do our best to guess the post identifier.</p>
  <form name="gmapsjs_settings" method="post" action="">
    <label for="post_types">
      Select one or more <strong>post type</strong> where the meta-box will appear during post editing. Leave blank for "all".
    </label>
    <br/>
    <?php
    $post_types = get_post_types('','names'); 
    foreach ($post_types as $post_type ) {
      echo '<div class="gmaps_cb"><input type="checkbox" name="post_types[]" id="cb_'.$post_type.'" value="'.$post_type.'" /><label for="cb_'.$post_type.'">'.$post_type.'</label></div>';
    }
  ?>
    <label for="placement"><strong>Placement</strong></label>
    <select id="placement" name="placement">
      <option value="0">Manual</option>
      <option value="1">Before content</option>
      <option value="2">After content</option>
    </select>
    <?php wp_nonce_field(basename(__FILE__),'gmapsjs_se123curity'); ?>
    <input type="submit" value="Save Generic Settings" />
  </form>
  </div>
  <h3>Overwritable Settings</h3>
  <h4>Only apply to meta-box - allow overwriting durint post editing (more options)</h4>
  <div id="over-settings-container">
  <form name="over-settings">

  </form>
  </div>