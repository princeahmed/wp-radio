<div class="wrap">
	<?php 
$countries = array_change_key_case( wp_radio_get_country_list() );
printf(
    '<h1>%s <a href="%s" class="button button-secondary">%s</a> <a href="%s" class="button button-secondary">%s</a> </h1>',
    __( 'Import Stations', 'wp-radio' ),
    WP_RADIO_CONTACT,
    __( 'Contact', 'wp-radio' ),
    WP_RADIO_SUPPORT,
    __( 'Support Forum', 'wp-radio' )
);
?>

    <p class="description">
        If any error occurred during import, Please reload the page and try again with the previous selected countries. </p>

    <p class="description">
        <strong>Tips:</strong> Don't select more than 20 countries at once. Select only one country if it has 1000+ station. The blue marked value is the station number of the country.
    </p>

    <div class="wp-radio-importer">

        <select multiple="multiple" id="import-country-select" name="import-country-select[]">
			<?php 
ob_start();
?>
            <option value="af" data-country="af" data-count="17"> Afghanistan</option>
            <option value="al" data-country="al" data-count="66"> Albania</option>
            <option value="dz" data-country="dz" data-count="49"> Algeria</option>
            <option value="as" data-country="as" data-count="2"> American Samoa</option>
            <option value="ad" data-country="ad" data-count="6"> Andorra</option>
            <option value="ao" data-country="ao" data-count="13"> Angola</option>
            <option value="ai" data-country="ai" data-count="2"> Anguilla</option>
            <option value="ag" data-country="ag" data-count="12"> Antigua and Barbuda</option>
            <option value="ar" data-country="ar" data-count="954" disabled="disabled"> Argentina</option>
            <option value="am" data-country="am" data-count="33"> Armenia</option>
            <option value="aw" data-country="aw" data-count="22"> Aruba</option>
            <option value="au" data-country="au" data-count="380" disabled="disabled"> Australia</option>
            <option value="at" data-country="at" data-count="227" disabled="disabled"> Austria</option>
            <option value="az" data-country="az" data-count="25"> Azerbaijan</option>
            <option value="bs" data-country="bs" data-count="14"> Bahamas</option>
            <option value="bh" data-country="bh" data-count="1"> Bahrain</option>
            <option value="bd" data-country="bd" data-count="41"> Bangladesh</option>
            <option value="bb" data-country="bb" data-count="11"> Barbados</option>
            <option value="by" data-country="by" data-count="65" disabled="disabled"> Belarus</option>
            <option value="be" data-country="be" data-count="493" disabled="disabled"> Belgium</option>
            <option value="bz" data-country="bz" data-count="4"> Belize</option>
            <option value="bj" data-country="bj" data-count="6"> Benin</option>
            <option value="bm" data-country="bm" data-count="10"> Bermuda</option>
            <option value="bt" data-country="bt" data-count="2"> Bhutan</option>
            <option value="bo" data-country="bo" data-count="96" disabled="disabled"> Bolivia</option>
            <option value="ba" data-country="ba" data-count="128" disabled="disabled"> Bosnia and Herzegovina</option>
            <option value="bw" data-country="bw" data-count="3"> Botswana</option>
            <option value="br" data-country="br" data-count="6129" disabled="disabled"> Brazil</option>
            <option value="bn" data-country="bn" data-count="4"> Brunei Darussalam</option>
            <option value="bg" data-country="bg" data-count="118" disabled="disabled"> Bulgaria</option>
            <option value="bf" data-country="bf" data-count="5"> Burkina Faso</option>
            <option value="bi" data-country="bi" data-count="6"> Burundi</option>
            <option value="bq" data-country="bq" data-count="8"> Bonaire</option>
            <option value="kh" data-country="kh" data-count="20"> Cambodia</option>
            <option value="cm" data-country="cm" data-count="9"> Cameroon</option>
            <option value="ca" data-country="ca" data-count="791" disabled="disabled"> Canada</option>
            <option value="cv" data-country="cv" data-count="3"> Cape Verde</option>
            <option value="ky" data-country="ky" data-count="12"> Cayman Islands</option>
            <option value="cf" data-country="cf" data-count="2"> Central African Republic</option>
            <option value="td" data-country="td" data-count="1"> Chad</option>
            <option value="cl" data-country="cl" data-count="641" disabled="disabled"> Chile</option>
            <option value="cn" data-country="cn" data-count="65" disabled="disabled"> China</option>
            <option value="co" data-country="co" data-count="1345" disabled="disabled"> Colombia</option>
            <option value="km" data-country="km" data-count="7"> Comoros</option>
            <option value="cg" data-country="cg" data-count="3"> Congo</option>
            <option value="cd" data-country="cd" data-count="11"> The Democratic Republic of The Congo</option>
            <option value="ck" data-country="ck" data-count="2"> Cook Islands</option>
            <option value="cr" data-country="cr" data-count="103" disabled="disabled"> Costa Rica</option>
            <option value="ci" data-country="ci" data-count="19"> Cote D'ivoire</option>
            <option value="hr" data-country="hr" data-count="166" disabled="disabled"> Croatia</option>
            <option value="cu" data-country="cu" data-count="11"> Cuba</option>
            <option value="cy" data-country="cy" data-count="55" disabled="disabled"> Cyprus</option>
            <option value="cz" data-country="cz" data-count="144" disabled="disabled"> Czech Republic</option>
            <option value="cw" data-country="cw" data-count="23"> Curacao</option>
            <option value="xk" data-country="xk" data-count="25"> Cosvo</option>
            <option value="dk" data-country="dk" data-count="150" disabled="disabled"> Denmark</option>
            <option value="dj" data-country="dj" data-count="1"> Djibouti</option>
            <option value="dm" data-country="dm" data-count="10"> Dominica</option>
            <option value="do" data-country="do" data-count="279" disabled="disabled"> Dominican Republic</option>
            <option value="ec" data-country="ec" data-count="424" disabled="disabled"> Ecuador</option>
            <option value="eg" data-country="eg" data-count="45" disabled="disabled"> Egypt</option>
            <option value="sv" data-country="sv" data-count="127" disabled="disabled"> El Salvador</option>
            <option value="gq" data-country="gq" data-count="1"> Equatorial Guinea</option>
            <option value="er" data-country="er" data-count="1"> Eritrea</option>
            <option value="ee" data-country="ee" data-count="44" disabled="disabled"> Estonia</option>
            <option value="et" data-country="et" data-count="7"> Ethiopia</option>
            <option value="fk" data-country="fk" data-count="1"> Falkland Islands (Malvinas)</option>
            <option value="fo" data-country="fo" data-count="9"> Faroe Islands</option>
            <option value="fj" data-country="fj" data-count="11"> Fiji</option>
            <option value="fi" data-country="fi" data-count="63" disabled="disabled"> Finland</option>
            <option value="fr" data-country="fr" data-count="1445" disabled="disabled"> France</option>
            <option value="gf" data-country="gf" data-count="8"> French Guiana</option>
            <option value="pf" data-country="pf" data-count="4"> French Polynesia</option>
            <option value="ga" data-country="ga" data-count="5"> Gabon</option>
            <option value="gm" data-country="gm" data-count="6"> Gambia</option>
            <option value="ge" data-country="ge" data-count="30"> Georgia</option>
            <option value="de" data-country="de" data-count="3187" disabled="disabled"> Germany</option>
            <option value="gh" data-country="gh" data-count="160" disabled="disabled"> Ghana</option>
            <option value="gi" data-country="gi" data-count="5"> Gibraltar</option>
            <option value="gr" data-country="gr" data-count="870" disabled="disabled"> Greece</option>
            <option value="gl" data-country="gl" data-count="3"> Greenland</option>
            <option value="gd" data-country="gd" data-count="21"> Grenada</option>
            <option value="gp" data-country="gp" data-count="6"> Guadeloupe</option>
            <option value="gu" data-country="gu" data-count="12"> Guam</option>
            <option value="gt" data-country="gt" data-count="229" disabled="disabled"> Guatemala</option>
            <option value="gg" data-country="gg" data-count="2"> Guernsey</option>
            <option value="gn" data-country="gn" data-count="12"> Guinea</option>
            <option value="gw" data-country="gw" data-count="2"> Guinea-bissau</option>
            <option value="gy" data-country="gy" data-count="9"> Guyana</option>
            <option value="ht" data-country="ht" data-count="180" disabled="disabled"> Haiti</option>
            <option value="va" data-country="va" data-count="2"> Holy See (Vatican City State)</option>
            <option value="hn" data-country="hn" data-count="116" disabled="disabled"> Honduras</option>
            <option value="hk" data-country="hk" data-count="26"> Hong Kong</option>
            <option value="hu" data-country="hu" data-count="197" disabled="disabled"> Hungary</option>
            <option value="is" data-country="is" data-count="21"> Iceland</option>
            <option value="in" data-country="in" data-count="224" disabled="disabled"> India</option>
            <option value="id" data-country="id" data-count="455" disabled="disabled"> Indonesia</option>
            <option value="ir" data-country="ir" data-count="16"> Iran</option>
            <option value="iq" data-country="iq" data-count="30"> Iraq</option>
            <option value="ie" data-country="ie" data-count="143" disabled="disabled"> Ireland</option>
            <option value="im" data-country="im" data-count="5"> Isle of Man</option>
            <option value="il" data-country="il" data-count="88" disabled="disabled"> Israel</option>
            <option value="it" data-country="it" data-count="875" disabled="disabled"> Italy</option>
            <option value="jm" data-country="jm" data-count="39" disabled="disabled"> Jamaica</option>
            <option value="jp" data-country="jp" data-count="197" disabled="disabled"> Japan</option>
            <option value="je" data-country="je" data-count="1"> Jersey</option>
            <option value="jo" data-country="jo" data-count="23"> Jordan</option>
            <option value="kz" data-country="kz" data-count="31"> Kazakhstan</option>
            <option value="ke" data-country="ke" data-count="53" disabled="disabled"> Kenya</option>
            <option value="ki" data-country="ki" data-count="1"> Kiribati</option>
            <option value="kp" data-country="kp" data-count="1"> Democratic People's Republic of Korea</option>
            <option value="kr" data-country="kr" data-count="25"> Republic of Korea</option>
            <option value="kw" data-country="kw" data-count="5"> Kuwait</option>
            <option value="kg" data-country="kg" data-count="9"> Kyrgyzstan</option>
            <option value="la" data-country="la" data-count="2"> Lao People's Democratic Republic</option>
            <option value="lv" data-country="lv" data-count="37" disabled="disabled"> Latvia</option>
            <option value="lb" data-country="lb" data-count="59" disabled="disabled"> Lebanon</option>
            <option value="ls" data-country="ls" data-count="4"> Lesotho</option>
            <option value="lr" data-country="lr" data-count="7"> Liberia</option>
            <option value="ly" data-country="ly" data-count="7"> Libya</option>
            <option value="li" data-country="li" data-count="2"> Liechtenstein</option>
            <option value="lt" data-country="lt" data-count="49" disabled="disabled"> Lithuania</option>
            <option value="lu" data-country="lu" data-count="20"> Luxembourg</option>
            <option value="mk" data-country="mk" data-count="53" disabled="disabled"> Macedonia</option>
            <option value="mg" data-country="mg" data-count="22"> Madagascar</option>
            <option value="mw" data-country="mw" data-count="5"> Malawi</option>
            <option value="my" data-country="my" data-count="171" disabled="disabled"> Malaysia</option>
            <option value="mv" data-country="mv" data-count="5"> Maldives</option>
            <option value="ml" data-country="ml" data-count="33" disabled="disabled"> Mali</option>
            <option value="mt" data-country="mt" data-count="27"> Malta</option>
            <option value="mh" data-country="mh" data-count="1"> Marshall Islands</option>
            <option value="mq" data-country="mq" data-count="4"> Martinique</option>
            <option value="mr" data-country="mr" data-count="2"> Mauritania</option>
            <option value="mu" data-country="mu" data-count="18"> Mauritius</option>
            <option value="yt" data-country="yt" data-count="10"> Mayotte</option>
            <option value="mx" data-country="mx" data-count="999" disabled="disabled"> Mexico</option>
            <option value="fm" data-country="fm" data-count="2"> Micronesia</option>
            <option value="md" data-country="md" data-count="32" disabled="disabled"> Moldova</option>
            <option value="mc" data-country="mc" data-count="15"> Monaco</option>
            <option value="mn" data-country="mn" data-count="10"> Mongolia</option>
            <option value="me" data-country="me" data-count="44" disabled="disabled"> Montenegro</option>
            <option value="ms" data-country="ms" data-count="1"> Montserrat</option>
            <option value="ma" data-country="ma" data-count="40" disabled="disabled"> Morocco</option>
            <option value="mz" data-country="mz" data-count="3"> Mozambique</option>
            <option value="mm" data-country="mm" data-count="7"> Myanmar</option>
            <option value="mf" data-country="mf" data-count="1"> Saint Martin</option>
            <option value="sx" data-country="sx" data-count="4"> Sint Maarten</option>
            <option value="bl" data-country="bl" data-count="1"> Saint-Barthelemy</option>
            <option value="na" data-country="na" data-count="17"> Namibia</option>
            <option value="np" data-country="np" data-count="179" disabled="disabled"> Nepal</option>
            <option value="nl" data-country="nl" data-count="808" disabled="disabled"> Netherlands</option>
            <option value="nc" data-country="nc" data-count="5"> New Caledonia</option>
            <option value="nz" data-country="nz" data-count="115" disabled="disabled"> New Zealand</option>
            <option value="ni" data-country="ni" data-count="47" disabled="disabled"> Nicaragua</option>
            <option value="ne" data-country="ne" data-count="1"> Niger</option>
            <option value="ng" data-country="ng" data-count="84" disabled="disabled"> Nigeria</option>
            <option value="mp" data-country="mp" data-count="1"> Northern Mariana Islands</option>
            <option value="no" data-country="no" data-count="126" disabled="disabled"> Norway</option>
            <option value="om" data-country="om" data-count="6"> Oman</option>
            <option value="pk" data-country="pk" data-count="65" disabled="disabled"> Pakistan</option>
            <option value="pw" data-country="pw" data-count="1"> Palau</option>
            <option value="ps" data-country="ps" data-count="24"> Palestinia</option>
            <option value="pa" data-country="pa" data-count="91" disabled="disabled"> Panama</option>
            <option value="pg" data-country="pg" data-count="2"> Papua New Guinea</option>
            <option value="py" data-country="py" data-count="150" disabled="disabled"> Paraguay</option>
            <option value="pe" data-country="pe" data-count="244" disabled="disabled"> Peru</option>
            <option value="ph" data-country="ph" data-count="210" disabled="disabled"> Philippines</option>
            <option value="pl" data-country="pl" data-count="261" disabled="disabled"> Poland</option>
            <option value="pt" data-country="pt" data-count="278"> Portugal</option>
            <option value="pr" data-country="pr" data-count="111" disabled="disabled"> Puerto Rico</option>
            <option value="qa" data-country="qa" data-count="6"> Qatar</option>
            <option value="re" data-country="re" data-count="5"> Reunion</option>
            <option value="ro" data-country="ro" data-count="337" disabled="disabled"> Romania</option>
            <option value="ru" data-country="ru" data-count="918" disabled="disabled"> Russian Federation</option>
            <option value="rw" data-country="rw" data-count="15"> Rwanda</option>
            <option value="kn" data-country="kn" data-count="11"> Saint Kitts and Nevis</option>
            <option value="lc" data-country="lc" data-count="10"> Saint Lucia</option>
            <option value="pm" data-country="pm" data-count="3"> Saint Pierre and Miquelon</option>
            <option value="vc" data-country="vc" data-count="25"> Saint Vincent and The Grenadines</option>
            <option value="ws" data-country="ws" data-count="1"> Samoa</option>
            <option value="sm" data-country="sm" data-count="2"> San Marino</option>
            <option value="st" data-country="st" data-count="2"> Sao Tome and Principe</option>
            <option value="sa" data-country="sa" data-count="12"> Saudi Arabia</option>
            <option value="sn" data-country="sn" data-count="52" disabled="disabled"> Senegal</option>
            <option value="rs" data-country="rs" data-count="248" disabled="disabled"> Serbia</option>
            <option value="sc" data-country="sc" data-count="6"> Seychelles</option>
            <option value="ss" data-country="ss" data-count="1"> South Sudan</option>
            <option value="sl" data-country="sl" data-count="5"> Sierra Leone</option>
            <option value="sg" data-country="sg" data-count="31" disabled="disabled"> Singapore</option>
            <option value="sk" data-country="sk" data-count="40" disabled="disabled"> Slovakia</option>
            <option value="si" data-country="si" data-count="55" disabled="disabled"> Slovenia</option>
            <option value="sb" data-country="sb" data-count="2"> Solomon Islands</option>
            <option value="so" data-country="so" data-count="5"> Somalia</option>
            <option value="za" data-country="za" data-count="185" disabled="disabled"> South Africa</option>
            <option value="es" data-country="es" data-count="1197" disabled="disabled"> Spain</option>
            <option value="lk" data-country="lk" data-count="90"> Sri Lanka</option>
            <option value="sd" data-country="sd" data-count="11"> Sudan</option>
            <option value="sr" data-country="sr" data-count="28"> Suriname</option>
            <option value="sz" data-country="sz" data-count="2"> Swaziland</option>
            <option value="se" data-country="se" data-count="170" disabled="disabled"> Sweden</option>
            <option value="ch" data-country="ch" data-count="283" disabled="disabled"> Switzerland</option>
            <option value="sy" data-country="sy" data-count="21"> Syrian Arab Republic</option>
            <option value="tw" data-country="tw" data-count="56" disabled="disabled"> Taiwan, Province of China</option>
            <option value="tj" data-country="tj" data-count="9"> Tajikistan</option>
            <option value="tz" data-country="tz" data-count="47"> Tanzania, United Republic of</option>
            <option value="th" data-country="th" data-count="96" disabled="disabled"> Thailand</option>
            <option value="tl" data-country="tl" data-count="1"> Timor-leste</option>
            <option value="tg" data-country="tg" data-count="2"> Togo</option>
            <option value="tk" data-country="tk" data-count="2"> Tokelau</option>
            <option value="to" data-country="to" data-count="2"> Tonga</option>
            <option value="tt" data-country="tt" data-count="43" disabled="disabled"> Trinidad and Tobago</option>
            <option value="tn" data-country="tn" data-count="29"> Tunisia</option>
            <option value="tr" data-country="tr" data-count="579" disabled="disabled"> Turkey</option>
            <option value="tm" data-country="tm" data-count="3"> Turkmenistan</option>
            <option value="tc" data-country="tc" data-count="3"> Turks and Caicos Islands</option>
            <option value="tv" data-country="tv" data-count="1"> Tuvalu</option>
            <option value="ug" data-country="ug" data-count="33"> Uganda</option>
            <option value="ua" data-country="ua" data-count="199" disabled="disabled"> Ukraine</option>
            <option value="ae" data-country="ae" data-count="42" disabled="disabled"> United Arab Emirates</option>
            <option value="uk" data-country="uk" data-count="1329" disabled="disabled"> United Kingdom</option>
            <option value="us" data-country="us" data-count="11416" disabled="disabled"> United States</option>
            <option value="uy" data-country="uy" data-count="146" disabled="disabled"> Uruguay</option>
            <option value="uz" data-country="uz" data-count="9"> Uzbekistan</option>
            <option value="vu" data-country="vu" data-count="2"> Vanuatu</option>
            <option value="ve" data-country="ve" data-count="331" disabled="disabled"> Venezuela</option>
            <option value="vn" data-country="vn" data-count="9"> Viet Nam</option>
            <option value="vg" data-country="vg" data-count="6"> Virgin Islands, British</option>
            <option value="vi" data-country="vi" data-count="11"> Virgin Islands, U.S.</option>
            <option value="wf" data-country="wf" data-count="1"> Wallis and Futuna</option>
            <option value="eh" data-country="eh" data-count="1"> Western Sahara</option>
            <option value="ye" data-country="ye" data-count="4"> Yemen</option>
            <option value="zm" data-country="zm" data-count="12"> Zambia</option>
            <option value="zw" data-country="zw" data-count="12"> Zimbabwe</option>

			<?php 
$options = ob_get_clean();
echo  $options ;
?>
        </select>

        <div class="import-actions">
            <a href="javascript:void(0)" class="run-import button button-primary button-large" id="run-import"><?php 
_e( 'Run Importer', 'wp-radio' );
?></a>
        </div>

        <div class="import-progress" id="import-progress">

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress" style="width:0.1%">Imported: 0</div>
            </div>

        </div>

    </div>

</div>
