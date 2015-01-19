<?php

class Witip_Formation
{

	public function __construct()
	{
		add_action( 'init', array( $this, 'creer_posttype' ) );
		add_filter( 'template_include', array( $this, 'custom_template' ), 1 );
	}

	/**
	 * Template personalisé pour l'affichage d'une formation.
	 */ 
	public function custom_template( $template_path ) 
	{
	    if ( get_post_type() == 'formation' ) 
	    {
	        if ( is_single() ) 
	        {
	            // checks if the file exists in the theme first,
	            // otherwise serve the file from the plugin
	            if ( $theme_file = locate_template( array ( 'single-formation.php' ) ) ) {
	                $template_path = $theme_file;
	            } else {
	                $template_path = plugin_dir_path( __FILE__ ) . '/templates/single-formation.php';
	            }
	        }
	    }
	    return $template_path;
	}

	/**
	 * Création du type de post personalisé 'formations'.
	 */
	public function creer_posttype() 
	{
		register_post_type( 
			'formation',

	    	array(
	      	'labels' => array(
	        	'name' 			=> __( 'Formation' ),
	        	'singular_name' => __( 'Formation' )
	      	),
	      	
	      	'public' 		=> true,
	      	'has_archive' 	=> false,
	      	'rewrite' 		=> array( 'slug' => 'formations', 'with front' => 'false' ),
	      	'show_ui' 		=> true,
	      	'_builtin' 		=> false,	// il s'agit d'un post type perso, pas "built in" wordpress
	      	'query_var' 	=> "formations"
	   	) );

		add_action( 'add_meta_boxes', array( $this, 'ajout_champs_persos' ) );
		add_action( 'save_post', array( $this, 'sauvegarder_champs_persos' ) );

		/**
		 * URLs personalisés.
		 */

		// structure des liens : /formations/id-formation/nom-formation
		
		// on indique à Wordpress d'utiliser notre structure d'URL pour la création des liens.
        add_filter( 'post_type_link', array ( $this, 'fix_permalink' ), 1, 2 );
		
		// permet à Wordpress de reconnaître notre nouvelle structure d'URLs.
        add_rewrite_rule(
        	'^formations/(\d+)/[^/]+/?$',
        	'index.php?post_type=formation&p=$matches[1]&preview=true',
        	'top'
        );

        /**
         * Divers exemples.
         */
        // executé AVANT le chargement d'un post sur le front end.
        add_action( 'pre_get_posts', array( $this, 'avant_chargement_post' ) );

        // executé juste avant l'affichage du thème, utile pour par exemple initialiser des variables dont on aura besoin dans la vue.
        add_action( 'wp', array( $this, 'avant_affichage' ) );
	}

	public function avant_chargement_post( $query ) 
	{
		// le contenu de cette fonction est executé avant le chargement d'un post.
	}

	public function avant_affichage()
	{
		die( var_dump( $post ) );
	}


	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** 
	 * Champs personalisés, propre à l'entié FORMATION pour correspondre aux champs souhaités.
	 ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** /

	/**
	 * Ajout de champs personalisés  à notre entité.
	 */
	public function ajout_champs_persos()
	{
		// ajout de champs personalisés.
		// documentation : http://codex.wordpress.org/Function_Reference/add_meta_box
		// dans l'ordre : 	id du champ, 
		//					titre du champ affiché à l'utilisateur, 
		//					nom d'une fonction qui se charge d'afficher le champ, 
		//					post type concerné
		add_meta_box( "date_debut", "Date de début", array( $this, "add_champ_date_debut") , "formation" );
	}

	/**
	 * Sauvegarde des champs personalisés à notre entité.
	 */
	public function sauvegarder_champs_persos( $post_id )
	{
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) // fonction pour éviter  le vidage des champs personnalisés lors de la sauvegarde automatique
		{ 
			return $postID;
		}

		update_post_meta( $post_id, "date_debut", sanitize_text_field($_POST["date_debut"]) ); // enregistrement dans la base de données.
	}

	/**
	 * Formulaire.
	 */

	// champ perso : 'date début'
	public function add_champ_date_debut()
	{
		global $post;
		$formationDateDebut 			= get_post_meta( $post->ID, 'date_debut', true );// lors d'une édition, on récupére la formation existante.
		echo '<input type="text" name="date_debut" value="'.esc_attr($formationDateDebut).'" />';
	}

	/** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **
	 * Divers.
	 ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** ** **/

	/**
     * Filter permalink construction.
     *
     * Source : http://wordpress.stackexchange.com/questions/44221/custom-post-types-use-post-id-in-permalink-structure-when-using-has-archive
     * 
     * @wp-hook post_type_link
     * @param  string $post_link default link.
     * @param  int    $id Post ID
     * @return string
     */
    public function fix_permalink( $post_link, $id = 0 )
    {
        $post = get_post($id);

        if ( is_wp_error($post) || $post->post_type != 'formation' )
        {
            return $post_link;
        }

        // preview
        $title = sanitize_title_with_dashes( $post->post_title );

        return home_url(
            user_trailingslashit( "formations/$post->ID/$title" )
        );
    }

}