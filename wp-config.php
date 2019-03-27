<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'chillandlit');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', "root");

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'xAum&g.;1QTAtVPO)&*]}=DfoLiO5$k+cOOZb,m_@kT&gTmyw,2(+E6,*dmh^dKA');
define('SECURE_AUTH_KEY',  'PJ8(cRw<M(vJa|-sN9g?_c{W j/{n&7<q1_j6m:3Cv$ARcI6FAt-I.ID#P<PgK-n');
define('LOGGED_IN_KEY',    'IAg5.:{d17.$d&9mBTtEpz^p4a]tu2fcBuhU> ;J)K&zUV{Z{S*_X>6V0:GXS$Z]');
define('NONCE_KEY',        'XzH()*TdFv;!Z(IpNF]+4P$g@_ZIcZSbg~K~.N+L9$9QWp~,}`] /yQ^*Uf&_G*A');
define('AUTH_SALT',        'c6}|PPfhIo84_}~WGaCI_m7)$qQ]^nb@Z3vK/i/-wX6jZL9j.WJyZh>ew0]:zTvS');
define('SECURE_AUTH_SALT', 'PW~7~ahjM[ hPI|Zk*ex2z#8Th]HgRD#+DFKzRa9WKxzdb>b7`?qf4;Q-CsUKg*#');
define('LOGGED_IN_SALT',   'jA~X#P;8:o({~L3bj46]4)UYYz~Z##%dj5OXc.TSl,(&q.H{ord`a<^L7/:ZI=D<');
define('NONCE_SALT',       'iJRbLmlZ=D[QF%vq^ji5uH5tX;jI(yz  d3:^8eBQ<DAM!&(;QAs>y.a`b28X<o:');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
define('WP_ALLOW_REPAIR', true);