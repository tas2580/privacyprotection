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
	'NEED_ACCEPT_PRIVACY_HL'			=> 'Une nouvelle révision de la « Politique de vie privée » vient d’être publiée !',
	'NEED_ACCEPT_PRIVACY'				=> 'La « <a href="%s">Politique de vie privée</a> » a été modifiée, ainsi, il est nécessaire d’accepter sa nouvelle révision pour continuer à participer sur ce forum.',
	'PRIVACY_ACCEPT_SUCCESS'			=> 'La nouvelle révision de la « Politique de vie privée » a été acceptée, ainsi, l’accès au forum est à présent débloqué. Bonne continuation !',
	'ACCEPT_PRIVACY'					=> 'Accepter la « Politique de vie privée »',
	'REJECT_PRIVACY'					=> 'Refuser la « Politique de vie privée »',
	'NEED_TO_ACCEPT_PRIVACY_POLICY'		=> 'Il est nécessaire de confirmer l’acception de la « Politique de vie privée » pour publier du contenu sur ce forum.',
	'CONFIRM_ACCEPT_PRIVACY'			=> 'Donner son accord pour la « <a href="%s">Politique de vie privée</a> ».',
));