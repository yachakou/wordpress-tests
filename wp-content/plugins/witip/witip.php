<?php

/*
Plugin Name: Witip examples
Plugin URI: http://witip.solutions
Description: Un plugin de tests de plugins sous Wordpress, pour le projet Formation-CE
Version: 0.1
Author: JB
License: GPL2
*/

class Witip_Plugin
{
	/**
	 * Fonction installation du plugin.
	 */
	public static function install()
	{
		// représente la connexion à la base de donnée.
		global $wpdb;

		// requête à executer (généralement des création de tables)
		// dans la requête, on peut utiliser la variable "{$wpdb->prefix}" pour récupérer le préfixe des tables de la BDD.
    	
    	// exemple :
    	// $wpdb->query( "CREATE TABLE IF NOT EXISTS zero_newsletter_email (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255) NOT NULL);" );
	}

	/**
	 *  Fonction qui désinstalle le plugin.
	 */
	public static function uninstall()
	{
		global $wpdb;
	}

	public function __construct()
	{
		include_once plugin_dir_path( __FILE__ ) . '/page_title.php' ;
		new Witip_Page_Title();

		include_once plugin_dir_path( __FILE__ ) . '/formation/formation.php' ;
		new Witip_Formation();

		// appelle la fonction d'installation WitipPlugin->install() SEULEMENT lorsqu'on active le plugin.
		register_activation_hook( __FILE__, array('Witip_Plugin', 'install' ) );

		// appelle la fonction de désinstallation, lorsqu'on supprime le plugin.
		register_uninstall_hook( __FILE__, array('Zero_Newsletter', 'uninstall') );
	}

}

new Witip_Plugin();