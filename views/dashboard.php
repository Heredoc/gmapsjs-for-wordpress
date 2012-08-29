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
<h4>The "bulk" shortcode way</h4>
  <p>In wordpress you can either add for each page/post a shortcode or you can simply add that to your theme using the function do_shortcode(). This option is indicated where your site is about places, like, for example, a blog about restaraunt and pubs in london.</p>
  <p>Applying the shortcode directly in your templates make a lot easier to update and create new maps. For instance, you could save as custom field (using the one shipped directly with wordpress or some more fancy things like Types plugin) stuff like address and marker info - then just retrieve those custom fields and put the values inside the do_shortcode function.</p>
  <p>Choosing this option, if you will choose to move all the maps from below the post to a jquery ui tab, or to the sidebar, you won't need to cut and paste each single post - you'll just move the function in your template once.</p>
<h3>Settings</h3>
  <p>As far as i can see, we don't need constant options. If you think something is missing or just want to thank us, you can get in touch on tweeter (@nois3lab) or by mail ()</p>.