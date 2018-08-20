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
	'ACP_PRIVACY_SETTINGS'						=> 'Paramètres de la « Politique de vie privée »',
	'ACP_PRIVACY_URL'							=> 'URL de la page de la « Politique de vie privée »',
	'ACP_PRIVACY_URL_EXPLAIN'					=> 'Permet de saisir l’URL complète de la page de la « Politique de vie privée ». Ainsi, tous les liens pointant vers la page par défaut de phpBB de la « Politique de vie privée » seront remplacés.',
	'ACP_REJECT_URL'							=> 'URL de la page de refus de la « Politique de vie privée »',
	'ACP_REJECT_URL_EXPLAIN'					=> 'Permet de saisir l’URL complète de la page de refus de la « Politique de vie privée ». Ainsi, le message d’information concernant la publication d’une nouvelle révision de la « Politique de vie privée » affichera un bouton supplémentaire pour refuser la « Politique de vie privée » et pointant vers l’URL saisie ici. Pour insérer l’ID de session d’un utilisateur dans l’URL utiliser la variable <code>{SID}</code>, tel que : https://www.domain.tld/viewtopic.php?f=1&t=1?sid={SID}.',
	'ACP_REJECT_GROUP'							=> 'Déplacer dans un groupe',
	'ACP_REJECT_GROUP_EXPLAIN'					=> 'Permet de sélectionner un groupe dans lequel tous les membres n’ayant pas accepté la « Politique de vie privée » seront ajoutés.',
	'ACP_NO_REJECT_GROUP'						=> ' - Ne pas déplacer -',
	'ACP_MOVE_GROUP'						    => 'Déplacer depuis l’ancien groupe',
	'ACP_MOVE_GROUP_EXPLAIN'				    => 'Cocher cette case pour déplacer tous les membres du précédent groupe sélectionné vers le nouveau groupe sélectionné.',
	'ACP_REG_ACCEPT_PRIVACY'				    => 'Accepter la « Politique de vie privée » lors de l’enregistrement',
	'ACP_REG_ACCEPT_PRIVACY_EXPLAIN'		    => 'Permet d’obliger l’acceptation de la « Politique de vie privée » lors de l’enregistrement des nouveaux utilisateurs.',
	'ACP_REG_ACCEPT_MAIL'					    => 'Accepter la réception de courriels de masse lors de l’enregistrement',
	'ACP_REG_ACCEPT_MAIL_EXPLAIN'			    => 'Permet de proposer l’acceptation de recevoir des courriels de masse lors de l’enregistrement des nouveaux utilisateurs.',
	'ACP_IP_SETTINGS'						    => 'Addresses IP',
	'ACP_ANONYMIZE_IP'							=> 'Anonymiser les adresses IP',
	'ACP_ANONYMIZE_IP_EXPLAIN'					=> 'Permet de choisir si les adresses IP doivent être anonymisées et, dans l’affirmative, quelle méthode utiliser.',
	'ANONYMIZE_IP_NONE'							=> 'Ne pas anonymiser les adresses IP',
	'ANONYMIZE_IP_FULL'							=> 'Anonymiser complètement les adresses IP',
	'ANONYMIZE_IP_HASH'							=> 'Anonymiser via une fonction de hachage les adresses IP',
	'ANONYMIZE_IP_LAST'							=> 'Anonymiser la dernière partie des adresses IP',
	'ACP_ANONYMIZE_IP_TIME'					    => 'Anonymiser automatiquement',
	'ACP_ANONYMIZE_IP_TIME_EXPLAIN'			    => 'Permet de choisir à partir de quel moment les adresses IP stockées doivent être automatiquement rendues anonymes. Les adresses IP seront complètement anonymisées.',
	'WEEKS'									    => 'semaines',
	'MONTHS'								    => 'mois',
	'YEARS'									    => 'années',
	'ACP_FOOTERLINK'							=> 'Ajouter un lien dans le pied de page',
	'ACP_FOOTERLINK_EXPLAIN'					=> 'Permet d’activer l’affichage d’un lien pointant vers la page de la « Politique de vie privée » dans le pied de page du forum.',
	'ACP_DATA_DOWNLOAD_OPTIONS'					=> 'Téléchargement des données',
	'ACP_POST_FORMAT'							=> 'Messages',
	'ACP_POST_FORMAT_EXPLAIN'					=> 'Permet de définir l’étendue des données incluses lors du téléchargement des messages.',
	'INCLUDE_TEXT'								=> 'Le texte et les métadonnées',
	'ONLY_META'									=> 'Uniquement les métadonnées',
	'ACP_POST_READ'								=> 'Messages visibles uniquement',
	'ACP_POST_READ_EXPLAIN'						=> 'Permet de définir quels messages du membre ce dernier peut télécharger.',
	'ONLY_READ'									=> 'Restreindre le téléchargement des messages du membre aux seuls messages dont il a un accès en lecture',
	'ACP_POST_UNAPPROVED'						=> 'Messages en attente d’approbation',
	'ACP_POST_UNAPPROVED_EXPLAIN'				=> 'Permet d’inclure dans le téléchargement les messages du membre en attente d’approbation.',
	'ACP_POST_DELETED'							=> 'Messages supprimés',
	'ACP_POST_DELETED_EXPLAIN'					=> 'Permet d’inclure dans le téléchargement les messages supprimés du membres.',
	'ACP_PRIVACYPROTECTION_PRIVACY_EXPLAIN'		=> 'Depuis cette page il est possible de saisir son texte personnalisé pour la « Politique de vie privée », remplaçant ainsi celui par défaut dans phpBB. Il est possible d’utiliser le langage HTML. Pour le nom du forum il est possible d’utiliser la variable <code>{SITE_NAME}</code> et pour l’adresse du forum la variable <code>{SITE_URL}</code>. En laissant ce champ vide le texte par défaut de la « Politique de vie privée » de phpBB sera affiché.',
	'PRIVACY_URL_WARNING'						=> 'Avertissement :<br>L’URL suivante : <a href="%1$s">%1$s</a> a été spécifiée comme page de remplacement de la « Politique de vie privée ».<br>Le texte personnalisé pour la « Politique de vie privée » ci-dessous sera affiché uniquement si le lien indiqué précédemment est retiré depuis la page « Paramètres » de cette extension.',
	'ACP_PRIVACY_OPTIONS'						=> 'Options de la « Politique de vie privée »',
	'UPDATE_PRIVACY'							=> 'Réinitialiser l’acceptation de la « Politique de vie privée »',
	'UPDATE_PRIVACY_EXPLAIN'					=> 'Permet de réinitialiser l’acception de la « Politique de vie privée » auprès de tous les membres du forum, ainsi, ces derniers devront accorder à nouveau leur consentement pour cette nouvelle révision de la « Politique de vie privée ».',
	'PRIVACY_POLICE_UPDATED'					=> 'La « Politique de vie privée » vient d’être réinitialisée. À présent, tous les membres du forum sont dans l’obligation d’accepter à nouveau cette révision de la « Politique de vie privée » au préalable d’utiliser le forum.',
	'ACP_DELETE_IP'						        => 'Anonymiser tous les adresses IP stockées',
	'ACP_DELETE_IP_EXPLAIN'						=> 'Permet d’anonymiser toutes les adresses IP stockées dans la base de données du forum.<br><strong>Cette action est irréversible !</strong>',
	'IP_DELETE_SUCCESS'							=> 'Toutes les adresses IP ont été anonymisées avec succès !',
	'PRIVACY_LAST_ACCPEPT'						=> 'Date de la dernière acceptation de la « Politique de vie privée »',
	'LAST_ACCPEPT'								=> 'Date de la dernière acceptation',
	'ACP_SUBMIT'								=> 'Soumettre les changements',
	'ACP_SAVED'									=> 'Les paramètres ont été sauvegardés avec succès !',
	'USER_LIST_ACEPTED'							=> 'les membres ayant acceptés la « Politique de vie privée »',
	'USER_LIST_NOT_ACEPTED'						=> 'les membres ne s’étant pas encore connecté au forum depuis l’obligation d’accepter la « Politique de vie privée »',
	'USER_LIST_NOT_ACEPTED_ONLINE'				=> 'les membres s’étant connectés au forum depuis l’obligation d’accepter la « Politique de vie privée » mais ne l’ayant pas acceptée',
	'USER_ADMIN_REVOKE_PRIVACY'					=> 'Annuler le consentement de la « Politique de vie privée »',
));
