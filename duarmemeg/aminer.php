<?php
function adminer_object() {
    // required to run any plugin
    include_once "./plugins/plugin.php";
	include_once "./plugins/designs.php";
    
    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }
    
    // enable extra drivers just by including them
    //~ include "./plugins/drivers/simpledb.php";
	$designs = array();
	foreach (glob("./designs/*", GLOB_ONLYDIR) as $filename) {
		$designs["$filename/adminer.css"] = basename($filename);
	}
    
    $plugins = array(
        // specify enabled plugins here
        // new AdminerTheme(),
        // new AdminerThemeSwitcher(),
        // new AdminerDumpXml(),
        // new AdminerTinymce(),
        // new AdminerFileUpload("data/"),
        // new AdminerSlugify(),
        // new AdminerTranslation(),
        new AdminerForeignSystem(),
        new AdminerForeignKeys(),
        new AdminerDisplayForeignKeyName(),
        // new AdminerDisplayForeignKeyName(),
		new AdminerDesigns($designs),
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
?>