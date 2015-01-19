<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '%aU]R9v<8zcL|-E<FgcJL6-q9D|OV-W{Gk)BiAMW0X4@V(o|rnwf4[LpErATL^^+');
define('SECURE_AUTH_KEY',  'g=pS|oc6|p.oXQF*X%whhd91su,8f7)?NL.4HR|@l*A%AAEw_V*tt`6N8.[Vx$}{');
define('LOGGED_IN_KEY',    'OKiUXs&]k|WMmm_{.%M-h&!F1%71CZrAD|;1A&ARWN)-B+P:h@ c$?<IGS$8)+N3');
define('NONCE_KEY',        '8v|[tba{?c+l K;@{6knU|s`UhMxk|@7DIWuClY{{d:=XqINjk. A& nVBcG&Vk#');
define('AUTH_SALT',        'LL4ep9F|UsG~uNG9m/grYD-E(ciBTRkIKbU)X8Q$xG<?|NDax2-iHR&Jns|ezns%');
define('SECURE_AUTH_SALT', 'h792253|K,b/@(^xE%L0`fboQP%wk4+xcdK9Co&e<i@X)+NA}79+ie81Y/[S`czO');
define('LOGGED_IN_SALT',   'gYlJ3|6X+Ey~G^-}D(YuP}w@NBdlQo12*cn;%-5IAGmt7b{49]=m^z5_tl(+to3P');
define('NONCE_SALT',       '8!jo}_;/iE!`zd]?-iw9GI(<T-S/HkUH-o=fRdfzGW]>Gq:XMA^r#}r>q>-`yyb~');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');