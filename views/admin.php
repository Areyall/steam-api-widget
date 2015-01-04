<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', PLUGIN_LOCALE); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('apikey'); ?>"><?php _e('API-Key:', PLUGIN_LOCALE); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('apikey'); ?>" name="<?php echo $this->get_field_name('apikey'); ?>" type="text" value="<?php echo $api_key; ?>" />
    <a href="http://steamcommunity.com/dev/apikey" target="_blank">http://steamcommunity.com/dev/apikey</a>
</p>

<p>
    <label for="<?php echo $this->get_field_id('steamid64'); ?>"><?php _e('SteamID64:', PLUGIN_LOCALE); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('steamid64'); ?>" name="<?php echo $this->get_field_name('steamid64'); ?>" type="text" value="<?php echo $steam_id; ?>" />
    <a href="http://steamidconverter.com" target="_blank">http://steamidconverter.com</a>
</p>

<p>
    <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Show # of games:', PLUGIN_LOCALE); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
</p>