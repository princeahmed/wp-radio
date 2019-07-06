<?php

/**
 * =============================
 * Core Functions of this plugin
 * =============================
 */

defined( 'ABSPATH' ) || exit(); // Exit if accessed directly.


/**
 * Get post meta value. Default value return if meta value is empty
 *
 * @param $post_id
 * @param $key
 * @param string $default
 *
 * @return mixed|string
 */
function wp_radio_get_meta( $post_id, $key, $default = '' ) {
	$meta = get_post_meta( $post_id, $key, true );

	return ! empty( $meta ) ? $meta : $default;
}

function wp_radio_get_stream_data( $post_id ) {
	$stream = [
		'stream_id'    => $post_id,
		'title'        => get_the_title( $post_id ),
		'poster'       => prince_get_meta( $post_id, 'logo', WP_RADIO_ASSETS_URL . '/wp-radio-logo.png' ),
		'url'          => get_the_permalink( $post_id ),
		'mp3'          => prince_get_meta( $post_id, 'stream_url' ),
		'stream_title' => '',
	];

	return $stream;
}

/**
 * Get the streaming title
 *
 * Return the current track's title that is being playing
 *
 * @param $streamingUrl
 * @param $interval
 * @param int $offset
 *
 * @return false|string
 * @since 1.0.0
 *
 */
function wp_radio_get_stream_title( $streamingUrl, $interval = 19200, $offset = 0 ) {

	$needle = 'StreamTitle=';
	$ua     = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';
	$opts   = [
		'http' => [
			'method'     => 'GET',
			'header'     => 'Icy-MetaData: 1',
			'user_agent' => $ua
		]
	];

	try {
		@$headers = get_headers( $streamingUrl );
	} catch ( Exception $exception ) {
		return $exception->getMessage();
	}

	if ( ! is_array( $headers ) ) {
		return false;
	}


	foreach ( $headers as $h ) {
		if ( strpos( strtolower( $h ), 'icy-metaint' ) !== false && ( $interval = explode( ':', $h )[1] ) ) {
			break;
		}
	}

	$context = stream_context_create( $opts );

	if ( @$stream = fopen( $streamingUrl, 'r', false, $context ) ) {

		@$buffer = stream_get_contents( $stream, (int) $interval, $offset );

		if ( strpos( $buffer, $needle ) !== false ) {
			fclose( $stream );
			$title = explode( $needle, $buffer )[1];

			return substr( $title, 1, strpos( $title, ';' ) - 2 );
		}

	} else {
		return false;
	}
}

/**
 * Get the sidebar country list
 *
 * @return array
 * @since 1.0.0
 *
 */
function wp_radio_get_country_list() {
	$countries = array(
		"AF" => array( "country" => "Afghanistan", "continent" => "Asia" ),
		"AL" => array( "country" => "Albania", "continent" => "Europe" ),
		"DZ" => array( "country" => "Algeria", "continent" => "Africa" ),
		"AS" => array( "country" => "American Samoa", "continent" => "Oceania" ),
		"AD" => array( "country" => "Andorra", "continent" => "Europe" ),
		"AO" => array( "country" => "Angola", "continent" => "Africa" ),
		"AI" => array( "country" => "Anguilla", "continent" => "North America" ),
		"AG" => array( "country" => "Antigua and Barbuda", "continent" => "North America" ),
		"AR" => array( "country" => "Argentina", "continent" => "South America" ),
		"AM" => array( "country" => "Armenia", "continent" => "Asia" ),
		"AW" => array( "country" => "Aruba", "continent" => "North America" ),
		"AU" => array( "country" => "Australia", "continent" => "Oceania" ),
		"AT" => array( "country" => "Austria", "continent" => "Europe" ),
		"AZ" => array( "country" => "Azerbaijan", "continent" => "Asia" ),
		"BS" => array( "country" => "Bahamas", "continent" => "North America" ),
		"BH" => array( "country" => "Bahrain", "continent" => "Asia" ),
		"BD" => array( "country" => "Bangladesh", "continent" => "Asia" ),
		"BB" => array( "country" => "Barbados", "continent" => "North America" ),
		"BY" => array( "country" => "Belarus", "continent" => "Europe" ),
		"BE" => array( "country" => "Belgium", "continent" => "Europe" ),
		"BZ" => array( "country" => "Belize", "continent" => "North America" ),
		"BJ" => array( "country" => "Benin", "continent" => "Africa" ),
		"BM" => array( "country" => "Bermuda", "continent" => "North America" ),
		"BT" => array( "country" => "Bhutan", "continent" => "Asia" ),
		"BO" => array( "country" => "Bolivia", "continent" => "South America" ),
		"BA" => array( "country" => "Bosnia and Herzegovina", "continent" => "Europe" ),
		"BW" => array( "country" => "Botswana", "continent" => "Africa" ),
		"BR" => array( "country" => "Brazil", "continent" => "South America" ),
		"BN" => array( "country" => "Brunei Darussalam", "continent" => "Asia" ),
		"BG" => array( "country" => "Bulgaria", "continent" => "Europe" ),
		"BF" => array( "country" => "Burkina Faso", "continent" => "Africa" ),
		"BI" => array( "country" => "Burundi", "continent" => "Africa" ),
		"BQ" => array( "country" => "Bonaire", "continent" => "Europe" ),
		"KH" => array( "country" => "Cambodia", "continent" => "Asia" ),
		"CM" => array( "country" => "Cameroon", "continent" => "Africa" ),
		"CA" => array( "country" => "Canada", "continent" => "North America" ),
		"CV" => array( "country" => "Cape Verde", "continent" => "Africa" ),
		"KY" => array( "country" => "Cayman Islands", "continent" => "North America" ),
		"CF" => array( "country" => "Central African Republic", "continent" => "Africa" ),
		"TD" => array( "country" => "Chad", "continent" => "Africa" ),
		"CL" => array( "country" => "Chile", "continent" => "South America" ),
		"CN" => array( "country" => "China", "continent" => "Asia" ),
		"CO" => array( "country" => "Colombia", "continent" => "South America" ),
		"KM" => array( "country" => "Comoros", "continent" => "Africa" ),
		"CG" => array( "country" => "Congo", "continent" => "Africa" ),
		"CD" => array( "country" => "The Democratic Republic of The Congo", "continent" => "Africa" ),
		"CK" => array( "country" => "Cook Islands", "continent" => "Oceania" ),
		"CR" => array( "country" => "Costa Rica", "continent" => "North America" ),
		"CI" => array( "country" => "Cote D'ivoire", "continent" => "Africa" ),
		"HR" => array( "country" => "Croatia", "continent" => "Europe" ),
		"CU" => array( "country" => "Cuba", "continent" => "North America" ),
		"CY" => array( "country" => "Cyprus", "continent" => "Asia" ),
		"CZ" => array( "country" => "Czech Republic", "continent" => "Europe" ),
		"CW" => array( "country" => "Curacao", "continent" => "South America" ),
		"xk" => array( "country" => "Cosvo", "continent" => "Europe" ),
		"DK" => array( "country" => "Denmark", "continent" => "Europe" ),
		"DJ" => array( "country" => "Djibouti", "continent" => "Africa" ),
		"DM" => array( "country" => "Dominica", "continent" => "North America" ),
		"DO" => array( "country" => "Dominican Republic", "continent" => "North America" ),
		"EC" => array( "country" => "Ecuador", "continent" => "South America" ),
		"EG" => array( "country" => "Egypt", "continent" => "Africa" ),
		"SV" => array( "country" => "El Salvador", "continent" => "North America" ),
		"GQ" => array( "country" => "Equatorial Guinea", "continent" => "Africa" ),
		"ER" => array( "country" => "Eritrea", "continent" => "Africa" ),
		"EE" => array( "country" => "Estonia", "continent" => "Europe" ),
		"ET" => array( "country" => "Ethiopia", "continent" => "Africa" ),
		"FK" => array( "country" => "Falkland Islands (Malvinas)", "continent" => "South America" ),
		"FO" => array( "country" => "Faroe Islands", "continent" => "Europe" ),
		"FJ" => array( "country" => "Fiji", "continent" => "Oceania" ),
		"FI" => array( "country" => "Finland", "continent" => "Europe" ),
		"FR" => array( "country" => "France", "continent" => "Europe" ),
		"GF" => array( "country" => "French Guiana", "continent" => "South America" ),
		"PF" => array( "country" => "French Polynesia", "continent" => "Oceania" ),
		"GA" => array( "country" => "Gabon", "continent" => "Africa" ),
		"GM" => array( "country" => "Gambia", "continent" => "Africa" ),
		"GE" => array( "country" => "Georgia", "continent" => "Asia" ),
		"DE" => array( "country" => "Germany", "continent" => "Europe" ),
		"GH" => array( "country" => "Ghana", "continent" => "Africa" ),
		"GI" => array( "country" => "Gibraltar", "continent" => "Europe" ),
		"GR" => array( "country" => "Greece", "continent" => "Europe" ),
		"GL" => array( "country" => "Greenland", "continent" => "North America" ),
		"GD" => array( "country" => "Grenada", "continent" => "North America" ),
		"GP" => array( "country" => "Guadeloupe", "continent" => "North America" ),
		"GU" => array( "country" => "Guam", "continent" => "Oceania" ),
		"GT" => array( "country" => "Guatemala", "continent" => "North America" ),
		"GG" => array( "country" => "Guernsey", "continent" => "Europe" ),
		"GN" => array( "country" => "Guinea", "continent" => "Africa" ),
		"GW" => array( "country" => "Guinea-bissau", "continent" => "Africa" ),
		"GY" => array( "country" => "Guyana", "continent" => "South America" ),
		"HT" => array( "country" => "Haiti", "continent" => "North America" ),
		"VA" => array( "country" => "Holy See (Vatican City State)", "continent" => "Europe" ),
		"HN" => array( "country" => "Honduras", "continent" => "North America" ),
		"HK" => array( "country" => "Hong Kong", "continent" => "Asia" ),
		"HU" => array( "country" => "Hungary", "continent" => "Europe" ),
		"IS" => array( "country" => "Iceland", "continent" => "Europe" ),
		"IN" => array( "country" => "India", "continent" => "Asia" ),
		"ID" => array( "country" => "Indonesia", "continent" => "Asia" ),
		"IR" => array( "country" => "Iran", "continent" => "Asia" ),
		"IQ" => array( "country" => "Iraq", "continent" => "Asia" ),
		"IE" => array( "country" => "Ireland", "continent" => "Europe" ),
		"IM" => array( "country" => "Isle of Man", "continent" => "Europe" ),
		"IL" => array( "country" => "Israel", "continent" => "Asia" ),
		"IT" => array( "country" => "Italy", "continent" => "Europe" ),
		"JM" => array( "country" => "Jamaica", "continent" => "North America" ),
		"JP" => array( "country" => "Japan", "continent" => "Asia" ),
		"JE" => array( "country" => "Jersey", "continent" => "Europe" ),
		"JO" => array( "country" => "Jordan", "continent" => "Asia" ),
		"KZ" => array( "country" => "Kazakhstan", "continent" => "Asia" ),
		"KE" => array( "country" => "Kenya", "continent" => "Africa" ),
		"KI" => array( "country" => "Kiribati", "continent" => "Oceania" ),
		"KP" => array( "country" => "Democratic People's Republic of Korea", "continent" => "Asia" ),
		"KR" => array( "country" => "Republic of Korea", "continent" => "Asia" ),
		"KW" => array( "country" => "Kuwait", "continent" => "Asia" ),
		"KG" => array( "country" => "Kyrgyzstan", "continent" => "Asia" ),
		"LA" => array( "country" => "Lao People's Democratic Republic", "continent" => "Asia" ),
		"LV" => array( "country" => "Latvia", "continent" => "Europe" ),
		"LB" => array( "country" => "Lebanon", "continent" => "Asia" ),
		"LS" => array( "country" => "Lesotho", "continent" => "Africa" ),
		"LR" => array( "country" => "Liberia", "continent" => "Africa" ),
		"LY" => array( "country" => "Libya", "continent" => "Africa" ),
		"LI" => array( "country" => "Liechtenstein", "continent" => "Europe" ),
		"LT" => array( "country" => "Lithuania", "continent" => "Europe" ),
		"LU" => array( "country" => "Luxembourg", "continent" => "Europe" ),
		"MK" => array( "country" => "Macedonia", "continent" => "Europe" ),
		"MG" => array( "country" => "Madagascar", "continent" => "Africa" ),
		"MW" => array( "country" => "Malawi", "continent" => "Africa" ),
		"MY" => array( "country" => "Malaysia", "continent" => "Asia" ),
		"MV" => array( "country" => "Maldives", "continent" => "Asia" ),
		"ML" => array( "country" => "Mali", "continent" => "Africa" ),
		"MT" => array( "country" => "Malta", "continent" => "Europe" ),
		"MH" => array( "country" => "Marshall Islands", "continent" => "Oceania" ),
		"MQ" => array( "country" => "Martinique", "continent" => "North America" ),
		"MR" => array( "country" => "Mauritania", "continent" => "Africa" ),
		"MU" => array( "country" => "Mauritius", "continent" => "Africa" ),
		"YT" => array( "country" => "Mayotte", "continent" => "Africa" ),
		"MX" => array( "country" => "Mexico", "continent" => "North America" ),
		"FM" => array( "country" => "Micronesia", "continent" => "Oceania" ),
		"MD" => array( "country" => "Moldova", "continent" => "Europe" ),
		"MC" => array( "country" => "Monaco", "continent" => "Europe" ),
		"MN" => array( "country" => "Mongolia", "continent" => "Asia" ),
		"ME" => array( "country" => "Montenegro", "continent" => "Europe" ),
		"MS" => array( "country" => "Montserrat", "continent" => "North America" ),
		"MA" => array( "country" => "Morocco", "continent" => "Africa" ),
		"MZ" => array( "country" => "Mozambique", "continent" => "Africa" ),
		"MM" => array( "country" => "Myanmar", "continent" => "Asia" ),
		"MF" => array( "country" => "Saint Martin", "continent" => "North America" ),
		"SX" => array( "country" => "Sint Maarten", "continent" => "North America" ),
		"BL" => array( "country" => "Saint-Barthelemy", "continent" => "North America" ),
		"NA" => array( "country" => "Namibia", "continent" => "Africa" ),
		"NP" => array( "country" => "Nepal", "continent" => "Asia" ),
		"NL" => array( "country" => "Netherlands", "continent" => "Europe" ),
		"NC" => array( "country" => "New Caledonia", "continent" => "Oceania" ),
		"NZ" => array( "country" => "New Zealand", "continent" => "Oceania" ),
		"NI" => array( "country" => "Nicaragua", "continent" => "North America" ),
		"NE" => array( "country" => "Niger", "continent" => "Africa" ),
		"NG" => array( "country" => "Nigeria", "continent" => "Africa" ),
		"MP" => array( "country" => "Northern Mariana Islands", "continent" => "Oceania" ),
		"NO" => array( "country" => "Norway", "continent" => "Europe" ),
		"OM" => array( "country" => "Oman", "continent" => "Asia" ),
		"PK" => array( "country" => "Pakistan", "continent" => "Asia" ),
		"PW" => array( "country" => "Palau", "continent" => "Oceania" ),
		"PS" => array( "country" => "Palestinia", "continent" => "Asia" ),
		"PA" => array( "country" => "Panama", "continent" => "North America" ),
		"PG" => array( "country" => "Papua New Guinea", "continent" => "Oceania" ),
		"PY" => array( "country" => "Paraguay", "continent" => "South America" ),
		"PE" => array( "country" => "Peru", "continent" => "South America" ),
		"PH" => array( "country" => "Philippines", "continent" => "Asia" ),
		"PL" => array( "country" => "Poland", "continent" => "Europe" ),
		"PT" => array( "country" => "Portugal", "continent" => "Europe" ),
		"PR" => array( "country" => "Puerto Rico", "continent" => "North America" ),
		"QA" => array( "country" => "Qatar", "continent" => "Asia" ),
		"RE" => array( "country" => "Reunion", "continent" => "Africa" ),
		"RO" => array( "country" => "Romania", "continent" => "Europe" ),
		"RU" => array( "country" => "Russian Federation", "continent" => "Europe" ),
		"RW" => array( "country" => "Rwanda", "continent" => "Africa" ),
		"KN" => array( "country" => "Saint Kitts and Nevis", "continent" => "North America" ),
		"LC" => array( "country" => "Saint Lucia", "continent" => "North America" ),
		"PM" => array( "country" => "Saint Pierre and Miquelon", "continent" => "North America" ),
		"VC" => array( "country" => "Saint Vincent and The Grenadines", "continent" => "North America" ),
		"WS" => array( "country" => "Samoa", "continent" => "Oceania" ),
		"SM" => array( "country" => "San Marino", "continent" => "Europe" ),
		"ST" => array( "country" => "Sao Tome and Principe", "continent" => "Africa" ),
		"SA" => array( "country" => "Saudi Arabia", "continent" => "Asia" ),
		"SN" => array( "country" => "Senegal", "continent" => "Africa" ),
		"RS" => array( "country" => "Serbia", "continent" => "Europe" ),
		"SC" => array( "country" => "Seychelles", "continent" => "Africa" ),
		"SS" => array( "country" => "South Sudan", "continent" => "Africa" ),
		"SL" => array( "country" => "Sierra Leone", "continent" => "Africa" ),
		"SG" => array( "country" => "Singapore", "continent" => "Asia" ),
		"SK" => array( "country" => "Slovakia", "continent" => "Europe" ),
		"SI" => array( "country" => "Slovenia", "continent" => "Europe" ),
		"SB" => array( "country" => "Solomon Islands", "continent" => "Oceania" ),
		"SO" => array( "country" => "Somalia", "continent" => "Africa" ),
		"ZA" => array( "country" => "South Africa", "continent" => "Africa" ),
		"ES" => array( "country" => "Spain", "continent" => "Europe" ),
		"LK" => array( "country" => "Sri Lanka", "continent" => "Asia" ),
		"SD" => array( "country" => "Sudan", "continent" => "Africa" ),
		"SR" => array( "country" => "Suriname", "continent" => "South America" ),
		"SZ" => array( "country" => "Swaziland", "continent" => "Africa" ),
		"SE" => array( "country" => "Sweden", "continent" => "Europe" ),
		"CH" => array( "country" => "Switzerland", "continent" => "Europe" ),
		"SY" => array( "country" => "Syrian Arab Republic", "continent" => "Asia" ),
		"TW" => array( "country" => "Taiwan, Province of China", "continent" => "Asia" ),
		"TJ" => array( "country" => "Tajikistan", "continent" => "Asia" ),
		"TZ" => array( "country" => "Tanzania, United Republic of", "continent" => "Africa" ),
		"TH" => array( "country" => "Thailand", "continent" => "Asia" ),
		"TL" => array( "country" => "Timor-leste", "continent" => "Asia" ),
		"TG" => array( "country" => "Togo", "continent" => "Africa" ),
		"TK" => array( "country" => "Tokelau", "continent" => "Oceania" ),
		"TO" => array( "country" => "Tonga", "continent" => "Oceania" ),
		"TT" => array( "country" => "Trinidad and Tobago", "continent" => "North America" ),
		"TN" => array( "country" => "Tunisia", "continent" => "Africa" ),
		"TR" => array( "country" => "Turkey", "continent" => "Asia" ),
		"TM" => array( "country" => "Turkmenistan", "continent" => "Asia" ),
		"TC" => array( "country" => "Turks and Caicos Islands", "continent" => "North America" ),
		"TV" => array( "country" => "Tuvalu", "continent" => "Oceania" ),
		"UG" => array( "country" => "Uganda", "continent" => "Africa" ),
		"UA" => array( "country" => "Ukraine", "continent" => "Europe" ),
		"AE" => array( "country" => "United Arab Emirates", "continent" => "Asia" ),
		"UK" => array( "country" => "United Kingdom", "continent" => "Europe" ),
		"US" => array( "country" => "United States", "continent" => "North America" ),
		"UY" => array( "country" => "Uruguay", "continent" => "South America" ),
		"UZ" => array( "country" => "Uzbekistan", "continent" => "Asia" ),
		"VU" => array( "country" => "Vanuatu", "continent" => "Oceania" ),
		"VE" => array( "country" => "Venezuela", "continent" => "South America" ),
		"VN" => array( "country" => "Viet Nam", "continent" => "Asia" ),
		"VG" => array( "country" => "Virgin Islands, British", "continent" => "North America" ),
		"VI" => array( "country" => "Virgin Islands, U.S.", "continent" => "North America" ),
		"WF" => array( "country" => "Wallis and Futuna", "continent" => "Oceania" ),
		"EH" => array( "country" => "Western Sahara", "continent" => "Africa" ),
		"YE" => array( "country" => "Yemen", "continent" => "Asia" ),
		"ZM" => array( "country" => "Zambia", "continent" => "Africa" ),
		"ZW" => array( "country" => "Zimbabwe", "continent" => "Africa" )
	);

	return $countries;
}

/**
 *
 * Get the sidebar country list
 *
 * @return array
 * @since 1.0.0
 *
 */
function wp_radio_get_language( $key = false ) {
	$languages = array(
		'Afrikaans'      => 'Afrikaans (Afrikaans)',
		'Akan'           => 'Akan (Akan)',
		'Albanian'       => 'Albanian (shqip)',
		'Amharic'        => 'Amharic (አማርኛ)',
		'Arabic'         => 'Arabic (العربية)',
		'Armenian'       => 'Armenian (հայերէն)',
		'Assamese'       => 'Assamese (অসমীয়া)',
		'Azerbaijani'    => 'Azerbaijani (Azərbaycan dili)',
		'Basque'         => 'Basque (Euskara)',
		'Belarusian'     => 'Belarusian (Беларускі)',
		'Bengali'        => 'Bengali (বাংলা)',
		'Bislama'        => 'Bislama (Bislama)',
		'Bosnian'        => 'Bosnian (босански)',
		'Bulgarian'      => 'Bulgarian (български)',
		'Burmese'        => 'Burmese (မြန်မာစာ)',
		'Cantonese'      => 'Cantonese (廣州話)',
		'Catalan'        => 'Catalan (Catalan)',
		'Chinese'        => 'Chinese (汉语)',
		'Corsican'       => 'Corsican (Corsu)',
		'Croatian'       => 'Croatian (Hrvatski)',
		'Czech'          => 'Czech (Čeština)',
		'Dagaare'        => 'Dagaare (Dagaare)',
		'Dagbani'        => 'Dagbani (Dagbanli)',
		'Dangme'         => 'Dangme (Dangme)',
		'Danish'         => 'Danish (Dansk)',
		'Dari'           => 'Dari (دری‎‎)',
		'Dutch'          => 'Dutch (Nederlands)',
		'Dzongkha'       => 'Dzongkha (རྫོང་ཁ་)',
		'Edo'            => 'Edo (Ẹ̀dó)',
		'English'        => 'English (English)',
		'Estonian'       => 'Estonian (Eesti keel)',
		'Faroese'        => 'Faroese (føroyskt)',
		'Fijian'         => 'Fijian (Na Vosa Vakaviti)',
		'Filipino'       => 'Filipino (Pilipino)',
		'Finnish'        => 'Finnish (Suomen kieli)',
		'Frafra'         => 'Frafra (Gurenɛ)',
		'French'         => 'French (Français)',
		'Georgian'       => 'Georgian (ქართული)',
		'German'         => 'German (Deutsch)',
		'Greek'          => 'Greek (Ελληνικά)',
		'Greenlandic'    => 'Greenlandic (Kalaallisut)',
		'Gujarati'       => 'Gujarati (ગુજરાતી)',
		'Haitian Creole' => 'Haitian Creole (kreyòl)',
		'Hausa'          => 'Hausa (هَرْشَن هَوْسَ‎)',
		'Hebrew'         => 'Hebrew (עברית)',
		'Hindi'          => 'Hindi (हिन्दी)',
		'Hungarian'      => 'Hungarian (Magyar)',
		'Icelandic'      => 'Icelandic (íslenska)',
		'Idemili'        => 'Idemili (Idemili)',
		'Igbo'           => 'Igbo (Asụsụ Igbo)',
		'Indonesian'     => 'Indonesian (Bahasa Indonesia)',
		'Irish'          => 'Irish (Gaeilge)',
		'Italian'        => 'Italian (Italiano)',
		'Japanese'       => 'Japanese (日本語)',
		'Kannaḍa'        => 'Kannaḍa (ಕನ್ನಡ)',
		'Kashmiri'       => 'Kashmiri (کٲشُر)',
		'Kazakh'         => 'Kazakh (Қазақ)',
		'Khmer'          => 'Khmer (ភាសាខ្មែរ)',
		'Korean'         => 'Korean (한국어)',
		'Kurdish'        => 'Kurdish (کوردی)',
		'Kyrgyz'         => 'Kyrgyz (قىرگىچه)',
		'Lao'            => 'Lao (ພາສາ)',
		'Latvian'        => 'Latvian (Latviešu valoda)',
		'Lithuanian'     => 'Lithuanian (Lietuvių kalba)',
		'Macedonian'     => 'Macedonian (Македонски)',
		'Malagasy'       => 'Malagasy (Malagasy)',
		'Malay'          => 'Malay (Bahasa Melayu)',
		'Malayalam'      => 'Malayalam	(മലയാളം)',
		'Maldivian'      => 'Maldivian (Dhivehi)',
		'Maltese'        => 'Maltese (Malti)',
		'Mandarin'       => 'Mandarin (官話)',
		'Maori'          => 'Maori (Te Reo)',
		'Mongolian'      => 'Mongolian (Mongɣol)',
		'Nepali'         => 'Nepali (नेपाली)',
		'Norwegian'      => 'Norwegian (norsk)',
		'Persian'        => 'Persian (فارسی)',
		'Polish'         => 'Polish (Polskie)',
		'Portuguese'     => 'Portuguese (Português)',
		'Punjabi'        => 'Punjabi (ਪੰਜਾਬੀ)',
		'Romanian'       => 'Romanian (Română)',
		'Russian'        => 'Russian (Русский)',
		'Sango'          => 'Sango (yângâ tî sängö)',
		'Serbian'        => 'Serbian (Srpski)',
		'Sindhi'         => 'Sindhi (سنڌ‎)',
		'Sinhalese'      => 'Sinhalese (සිංහල)',
		'Slovak'         => 'Slovak (slovenský)',
		'Slovene'        => 'Slovene (Slovenski)',
		'Somali'         => 'Somali (اف سومالى‎)',
		'Sotho'          => 'Sotho (Sesotho)',
		'Spanish'        => 'Spanish (Español)',
		'Swahili'        => 'Swahili (Kiswahili)',
		'Swazi'          => 'Swazi (SiSwati)',
		'Swedish'        => 'Swedish (Svenska)',
		'Tajik'          => 'Tajik (тоҷикӣ)',
		'Tamil'          => 'Tamil (தமிழ்)',
		'Tatar'          => 'Tatar (Татар теле)',
		'Telugu'         => 'Telugu (తెలుగు)',
		'Thai'           => 'Thai (ภาษาไทย)',
		'Tigrinya'       => 'Tigrinya (ትግርኛ)',
		'Tswana'         => 'Tswana (Setswana)',
		'Turkish'        => 'Turkish (Türk)',
		'Turkmen'        => 'Turkmen (تورکمنچه)',
		'Twi'            => 'Twi (Twi)',
		'Ukrainian'      => 'Ukrainian (Українська)',
		'Urdu'           => 'Urdu (اُردُو)',
		'Uzbek'          => 'Uzbek (Oʻzbekcha)',
		'Vietnamese'     => 'Vietnamese (Tiếng Việt)',
		'Yoruba'         => 'Yoruba (Èdè Yorùbá)',
	);

	if ( ! empty( $key ) ) {
		return $languages[ $key ];
	}

	return $languages;
}

function wp_radio_get_country( $country_code ) {
	$term = get_term_by( 'slug', $country_code, 'radio_country' );

	return $term ? $term : false;
}

function wp_radio_get_country_image_url( $country_code, $size = 16 ) {

	return sprintf( 'https://www.countryflags.io/%s/flat/%s.png', $country_code, $size );
}

function wp_radio_get_next_prev_stream_data( $current_id, $next_prev = 'next' ) {

	global $post;
	$post = get_post( $current_id );

	$next_post = get_next_post();
	$prev_post = get_previous_post();

	if ( 'next' == $next_prev && $next_post ) {
		$post_id = $next_post->ID;
	} elseif ( 'prev' == $next_prev && $prev_post ) {
		$post_id = $prev_post->ID;
	}

	if ( ! empty( $post_id ) ) {
		return wp_radio_get_stream_data( $post_id );
	}

	return false;
}

function wp_radio_get_stations( $args = [], $return_query = false ) {

	$posts_per_page = get_option( 'posts_per_page' );

	$args = wp_parse_args( $args, [
		'post_type'      => 'wp_radio',
		'posts_per_page' => $posts_per_page,
		'orderby'        => 'title',
		'order'          => 'ASC',
	] );

	if ( ! empty( $_REQUEST['keyword'] ) ) {
		$args['s'] = esc_attr( $_REQUEST['keyword'] );
	}

	if ( ! empty( $_REQUEST['paginate'] ) ) {
		$args['offset'] = ( intval( $_REQUEST['paginate'] ) - 1 ) * $posts_per_page;
	}

	$query = new WP_Query( $args );

	if ( $return_query ) {
		return $query;
	}

	return $query->have_posts() ? $query->posts : false;
}

function wp_radio_get_station_count( $country ) {
	global $wpdb;

	$sql = "SELECT COUNT(`id`) FROM {$wpdb->prefix}wp_radio_station WHERE country_code = '%s'; ";

	$result = $wpdb->get_var( $wpdb->prepare( $sql, $country ) );

	return $result;
}

function wp_radio_premium_countries() {
	$premium_countries = array(
		'AR',
		'AU',
		'AT',
		'BY',
		'BE',
		'BR',
		'BO',
		'BA',
		'BG',
		'CA',
		'CL',
		'CN',
		'CO',
		'CR',
		'HR',
		'CY',
		'CZ',
		'DK',
		'DO',
		'EC',
		'EG',
		'SV',
		'EE',
		'FI',
		'FR',
		'GR',
		'DE',
		'GH',
		'GR',
		'GT',
		'HT',
		'HN',
		'HU',
		'IN',
		'ID',
		'IE',
		'IL',
		'IT',
		'JM',
		'JP',
		'KE',
		'LV',
		'LB',
		'LT',
		'MK',
		'MY',
		'ML',
		'MX',
		'MD',
		'ME',
		'MA',
		'NP',
		'NL',
		'NZ',
		'NI',
		'NG',
		'NO',
		'PK',
		'PA',
		'PY',
		'PE',
		'PH',
		'PL',
		'PR',
		'RO',
		'RU',
		'SN',
		'RS',
		'SG',
		'SK',
		'SI',
		'ZA',
		'ES',
		'SE',
		'CH',
		'TW',
		'TH',
		'TT',
		'TR',
		'UA',
		'AE',
		'US',
		'UK',
		'UY',
		'VE',
	);

	return array_map( 'strtolower', $premium_countries );
}

/**
 * Get the user country code and show the radio stations
 * of the country as default in the index page
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_get_visitor_country() {

	$ip = $_SERVER['REMOTE_ADDR'];

	$json_feed_url = 'http://ip-api.com/json/' . $ip;
	$args          = [
		'timeout' => 120,
	];

	$response = wp_remote_get( $json_feed_url, $args );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	$json_feed = json_decode( $response['body'] );

	return !empty($json_feed->countryCode) ? strtolower( $json_feed->countryCode ) : false;

}

function wp_radio_export_csv() {

	global $wpdb;

	$free_countries = '';

	foreach ( wp_radio_premium_countries() as $c ) {
		$free_countries .= "'$c',";
	}

	$free_countries = trim( $free_countries, ',' );

	$sql = "SELECT * FROM {$wpdb->prefix}wp_radio WHERE  country_code NOT IN ($free_countries);";

	$results = $wpdb->get_results( $sql );

	$header = array_keys( (array) $results[0] );


	$file_name = "wp-radio-stations-free.csv";
	header( "Content-type: application/csv" );
	header( "Content-Disposition: attachment; filename=$file_name" );
	$fp = fopen( 'php://output', 'w' );
	fputcsv( $fp, $header );
	foreach ( (array) $results as $result ) {
		fputcsv( $fp, array_values( (array) $result ) );
	}
	fclose( $fp );
	exit();
}




