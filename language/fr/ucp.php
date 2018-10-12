<?php
/**
 *
 * Privacy protection. An extension for the phpBB Forum Software package.
 * French translation by Galixte (http://www.galixte.com)
 *
 * @copyright (c) 2018 tas2580 <https://tas2580.net>
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'DOWNLOAD_MY_DATA'				=> 'Téléchargement des données personnelles',
	'DOWNLOAD_MY_DATA_EXPLAIN'		=> 'Cliquer sur le lien ci-dessous pour télécharger ses données personnelles (fichier CSV).',
	'DOWNLOAD_MY_POSTS_EXPLAIN'		=> 'Cliquer sur ce lien ci-dessous pour télécharger ses messages (fichier CSV).',
	'DOWNLOAD_BTN'					=> 'Télécharger',
	'NEED_ACCEPT_PRIVACY'			=> 'La « Politique de vie privée » n’a pas été acceptée.',
	'PRIVACY_ACCEPTED'				=> 'Accorder son consentement pour la « Politique de vie privée »',
	'PRIVACY_ACCEPTED_EXPLAIN'		=> 'La « <a href="%s">Politique de vie privée</a> » requiert d’être lue et acceptée.',
	'PRIVACY_LAST_ACCEPTED'			=> 'Date d’acceptation de la « Politique de vie privée »',
	'REVOKE_PRIVACY'				=> 'Retirer son consentement pour la « Politique de vie privée »',
	'REVOKE_PRIVACY_CONFIRM'		=> 'Confirmer le retrait de son consentement pour la « Politique de vie privée ».',
	'REVOKE_PRIVACY_SUCCESS'		=> 'Le retrait du consentement pour la « Politique de vie privée » a été effectué avec succès !',
));
