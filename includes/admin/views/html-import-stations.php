<div class="wrap">
	<?php

	$countries = array_change_key_case( wp_radio_get_country_list() );
	echo '<h1>' . __( 'Import Stations', 'wp-radio' ) . ' <a href="https://wordpress.org/support/plugin/wp-radio/" class="button button-secondary">'.__('Support', 'wp-radio').'</a> </h1>';
	echo '<h3>' . __( 'You can select maximum 20 countries from the available free countries in the free version', 'wp-radio' ) . '</h3>';

	?>

    <div class="wp-radio-importer">

        <select multiple="multiple" id="import-country-select" name="import-country-select[]">
            <option value="af" data-count="17"> Afghanistan</option>
            <option value="al" data-count="66"> Albania</option>
            <option value="dz" data-count="49"> Algeria</option>
            <option value="as" data-count="2"> American Samoa</option>
            <option value="ad" data-count="6"> Andorra</option>
            <option value="ao" data-count="13"> Angola</option>
            <option value="ai" data-count="2"> Anguilla</option>
            <option value="ag" data-count="12"> Antigua and Barbuda</option>
            <option value="ar" data-count="954" disabled="disabled"> Argentina</option>
            <option value="am" data-count="33"> Armenia</option>
            <option value="aw" data-count="22"> Aruba</option>
            <option value="au" data-count="380" disabled="disabled"> Australia</option>
            <option value="at" data-count="227" disabled="disabled"> Austria</option>
            <option value="az" data-count="25"> Azerbaijan</option>
            <option value="bs" data-count="14"> Bahamas</option>
            <option value="bh" data-count="1"> Bahrain</option>
            <option value="bd" data-count="41"> Bangladesh</option>
            <option value="bb" data-count="11"> Barbados</option>
            <option value="by" data-count="65" disabled="disabled"> Belarus</option>
            <option value="be" data-count="493" disabled="disabled"> Belgium</option>
            <option value="bz" data-count="4"> Belize</option>
            <option value="bj" data-count="6"> Benin</option>
            <option value="bm" data-count="10"> Bermuda</option>
            <option value="bt" data-count="2"> Bhutan</option>
            <option value="bo" data-count="96" disabled="disabled"> Bolivia</option>
            <option value="ba" data-count="128" disabled="disabled"> Bosnia and Herzegovina</option>
            <option value="bw" data-count="3"> Botswana</option>
            <option value="br" data-count="6129" disabled="disabled"> Brazil</option>
            <option value="bn" data-count="4"> Brunei Darussalam</option>
            <option value="bg" data-count="118" disabled="disabled"> Bulgaria</option>
            <option value="bf" data-count="5"> Burkina Faso</option>
            <option value="bi" data-count="6"> Burundi</option>
            <option value="bq" data-count="8"> Bonaire</option>
            <option value="kh" data-count="20"> Cambodia</option>
            <option value="cm" data-count="9"> Cameroon</option>
            <option value="ca" data-count="791" disabled="disabled"> Canada</option>
            <option value="cv" data-count="3"> Cape Verde</option>
            <option value="ky" data-count="12"> Cayman Islands</option>
            <option value="cf" data-count="2"> Central African Republic</option>
            <option value="td" data-count="1"> Chad</option>
            <option value="cl" data-count="641" disabled="disabled"> Chile</option>
            <option value="cn" data-count="65" disabled="disabled"> China</option>
            <option value="co" data-count="1345" disabled="disabled"> Colombia</option>
            <option value="km" data-count="7"> Comoros</option>
            <option value="cg" data-count="3"> Congo</option>
            <option value="cd" data-count="11"> The Democratic Republic of The Congo</option>
            <option value="ck" data-count="2"> Cook Islands</option>
            <option value="cr" data-count="103" disabled="disabled"> Costa Rica</option>
            <option value="ci" data-count="19"> Cote D'ivoire</option>
            <option value="hr" data-count="166" disabled="disabled"> Croatia</option>
            <option value="cu" data-count="11"> Cuba</option>
            <option value="cy" data-count="55" disabled="disabled"> Cyprus</option>
            <option value="cz" data-count="144" disabled="disabled"> Czech Republic</option>
            <option value="cw" data-count="23"> Curacao</option>
            <option value="xk" data-count="25"> Cosvo</option>
            <option value="dk" data-count="150" disabled="disabled"> Denmark</option>
            <option value="dj" data-count="1"> Djibouti</option>
            <option value="dm" data-count="10"> Dominica</option>
            <option value="do" data-count="279" disabled="disabled"> Dominican Republic</option>
            <option value="ec" data-count="424" disabled="disabled"> Ecuador</option>
            <option value="eg" data-count="45" disabled="disabled"> Egypt</option>
            <option value="sv" data-count="127" disabled="disabled"> El Salvador</option>
            <option value="gq" data-count="1"> Equatorial Guinea</option>
            <option value="er" data-count="1"> Eritrea</option>
            <option value="ee" data-count="44" disabled="disabled"> Estonia</option>
            <option value="et" data-count="7"> Ethiopia</option>
            <option value="fk" data-count="1"> Falkland Islands (Malvinas)</option>
            <option value="fo" data-count="9"> Faroe Islands</option>
            <option value="fj" data-count="11"> Fiji</option>
            <option value="fi" data-count="63" disabled="disabled"> Finland</option>
            <option value="fr" data-count="1445" disabled="disabled"> France</option>
            <option value="gf" data-count="8"> French Guiana</option>
            <option value="pf" data-count="4"> French Polynesia</option>
            <option value="ga" data-count="5"> Gabon</option>
            <option value="gm" data-count="6"> Gambia</option>
            <option value="ge" data-count="30"> Georgia</option>
            <option value="de" data-count="3187" disabled="disabled"> Germany</option>
            <option value="gh" data-count="160" disabled="disabled"> Ghana</option>
            <option value="gi" data-count="5"> Gibraltar</option>
            <option value="gr" data-count="870" disabled="disabled"> Greece</option>
            <option value="gl" data-count="3"> Greenland</option>
            <option value="gd" data-count="21"> Grenada</option>
            <option value="gp" data-count="6"> Guadeloupe</option>
            <option value="gu" data-count="12"> Guam</option>
            <option value="gt" data-count="229" disabled="disabled"> Guatemala</option>
            <option value="gg" data-count="2"> Guernsey</option>
            <option value="gn" data-count="12"> Guinea</option>
            <option value="gw" data-count="2"> Guinea-bissau</option>
            <option value="gy" data-count="9"> Guyana</option>
            <option value="ht" data-count="180" disabled="disabled"> Haiti</option>
            <option value="va" data-count="2"> Holy See (Vatican City State)</option>
            <option value="hn" data-count="116" disabled="disabled"> Honduras</option>
            <option value="hk" data-count="26"> Hong Kong</option>
            <option value="hu" data-count="197" disabled="disabled"> Hungary</option>
            <option value="is" data-count="21"> Iceland</option>
            <option value="in" data-count="224" disabled="disabled"> India</option>
            <option value="id" data-count="455" disabled="disabled"> Indonesia</option>
            <option value="ir" data-count="16"> Iran</option>
            <option value="iq" data-count="30"> Iraq</option>
            <option value="ie" data-count="143" disabled="disabled"> Ireland</option>
            <option value="im" data-count="5"> Isle of Man</option>
            <option value="il" data-count="88" disabled="disabled"> Israel</option>
            <option value="it" data-count="875" disabled="disabled"> Italy</option>
            <option value="jm" data-count="39" disabled="disabled"> Jamaica</option>
            <option value="jp" data-count="197" disabled="disabled"> Japan</option>
            <option value="je" data-count="1"> Jersey</option>
            <option value="jo" data-count="23"> Jordan</option>
            <option value="kz" data-count="31"> Kazakhstan</option>
            <option value="ke" data-count="53" disabled="disabled"> Kenya</option>
            <option value="ki" data-count="1"> Kiribati</option>
            <option value="kp" data-count="1"> Democratic People's Republic of Korea</option>
            <option value="kr" data-count="25"> Republic of Korea</option>
            <option value="kw" data-count="5"> Kuwait</option>
            <option value="kg" data-count="9"> Kyrgyzstan</option>
            <option value="la" data-count="2"> Lao People's Democratic Republic</option>
            <option value="lv" data-count="37" disabled="disabled"> Latvia</option>
            <option value="lb" data-count="59" disabled="disabled"> Lebanon</option>
            <option value="ls" data-count="4"> Lesotho</option>
            <option value="lr" data-count="7"> Liberia</option>
            <option value="ly" data-count="7"> Libya</option>
            <option value="li" data-count="2"> Liechtenstein</option>
            <option value="lt" data-count="49" disabled="disabled"> Lithuania</option>
            <option value="lu" data-count="20"> Luxembourg</option>
            <option value="mk" data-count="53" disabled="disabled"> Macedonia</option>
            <option value="mg" data-count="22"> Madagascar</option>
            <option value="mw" data-count="5"> Malawi</option>
            <option value="my" data-count="171" disabled="disabled"> Malaysia</option>
            <option value="mv" data-count="5"> Maldives</option>
            <option value="ml" data-count="33" disabled="disabled"> Mali</option>
            <option value="mt" data-count="27"> Malta</option>
            <option value="mh" data-count="1"> Marshall Islands</option>
            <option value="mq" data-count="4"> Martinique</option>
            <option value="mr" data-count="2"> Mauritania</option>
            <option value="mu" data-count="18"> Mauritius</option>
            <option value="yt" data-count="10"> Mayotte</option>
            <option value="mx" data-count="999" disabled="disabled"> Mexico</option>
            <option value="fm" data-count="2"> Micronesia</option>
            <option value="md" data-count="32" disabled="disabled"> Moldova</option>
            <option value="mc" data-count="15"> Monaco</option>
            <option value="mn" data-count="10"> Mongolia</option>
            <option value="me" data-count="44" disabled="disabled"> Montenegro</option>
            <option value="ms" data-count="1"> Montserrat</option>
            <option value="ma" data-count="40" disabled="disabled"> Morocco</option>
            <option value="mz" data-count="3"> Mozambique</option>
            <option value="mm" data-count="7"> Myanmar</option>
            <option value="mf" data-count="1"> Saint Martin</option>
            <option value="sx" data-count="4"> Sint Maarten</option>
            <option value="bl" data-count="1"> Saint-Barthelemy</option>
            <option value="na" data-count="17"> Namibia</option>
            <option value="np" data-count="179" disabled="disabled"> Nepal</option>
            <option value="nl" data-count="808" disabled="disabled"> Netherlands</option>
            <option value="nc" data-count="5"> New Caledonia</option>
            <option value="nz" data-count="115" disabled="disabled"> New Zealand</option>
            <option value="ni" data-count="47" disabled="disabled"> Nicaragua</option>
            <option value="ne" data-count="1"> Niger</option>
            <option value="ng" data-count="84" disabled="disabled"> Nigeria</option>
            <option value="mp" data-count="1"> Northern Mariana Islands</option>
            <option value="no" data-count="126" disabled="disabled"> Norway</option>
            <option value="om" data-count="6"> Oman</option>
            <option value="pk" data-count="65" disabled="disabled"> Pakistan</option>
            <option value="pw" data-count="1"> Palau</option>
            <option value="ps" data-count="24"> Palestinia</option>
            <option value="pa" data-count="91" disabled="disabled"> Panama</option>
            <option value="pg" data-count="2"> Papua New Guinea</option>
            <option value="py" data-count="150" disabled="disabled"> Paraguay</option>
            <option value="pe" data-count="244" disabled="disabled"> Peru</option>
            <option value="ph" data-count="210" disabled="disabled"> Philippines</option>
            <option value="pl" data-count="261" disabled="disabled"> Poland</option>
            <option value="pt" data-count="278"> Portugal</option>
            <option value="pr" data-count="111" disabled="disabled"> Puerto Rico</option>
            <option value="qa" data-count="6"> Qatar</option>
            <option value="re" data-count="5"> Reunion</option>
            <option value="ro" data-count="337" disabled="disabled"> Romania</option>
            <option value="ru" data-count="918" disabled="disabled"> Russian Federation</option>
            <option value="rw" data-count="15"> Rwanda</option>
            <option value="kn" data-count="11"> Saint Kitts and Nevis</option>
            <option value="lc" data-count="10"> Saint Lucia</option>
            <option value="pm" data-count="3"> Saint Pierre and Miquelon</option>
            <option value="vc" data-count="25"> Saint Vincent and The Grenadines</option>
            <option value="ws" data-count="1"> Samoa</option>
            <option value="sm" data-count="2"> San Marino</option>
            <option value="st" data-count="2"> Sao Tome and Principe</option>
            <option value="sa" data-count="12"> Saudi Arabia</option>
            <option value="sn" data-count="52" disabled="disabled"> Senegal</option>
            <option value="rs" data-count="248" disabled="disabled"> Serbia</option>
            <option value="sc" data-count="6"> Seychelles</option>
            <option value="ss" data-count="1"> South Sudan</option>
            <option value="sl" data-count="5"> Sierra Leone</option>
            <option value="sg" data-count="31" disabled="disabled"> Singapore</option>
            <option value="sk" data-count="40" disabled="disabled"> Slovakia</option>
            <option value="si" data-count="55" disabled="disabled"> Slovenia</option>
            <option value="sb" data-count="2"> Solomon Islands</option>
            <option value="so" data-count="5"> Somalia</option>
            <option value="za" data-count="185" disabled="disabled"> South Africa</option>
            <option value="es" data-count="1197" disabled="disabled"> Spain</option>
            <option value="lk" data-count="90"> Sri Lanka</option>
            <option value="sd" data-count="11"> Sudan</option>
            <option value="sr" data-count="28"> Suriname</option>
            <option value="sz" data-count="2"> Swaziland</option>
            <option value="se" data-count="170" disabled="disabled"> Sweden</option>
            <option value="ch" data-count="283" disabled="disabled"> Switzerland</option>
            <option value="sy" data-count="21"> Syrian Arab Republic</option>
            <option value="tw" data-count="56" disabled="disabled"> Taiwan, Province of China</option>
            <option value="tj" data-count="9"> Tajikistan</option>
            <option value="tz" data-count="47"> Tanzania, United Republic of</option>
            <option value="th" data-count="96" disabled="disabled"> Thailand</option>
            <option value="tl" data-count="1"> Timor-leste</option>
            <option value="tg" data-count="2"> Togo</option>
            <option value="tk" data-count="2"> Tokelau</option>
            <option value="to" data-count="2"> Tonga</option>
            <option value="tt" data-count="43" disabled="disabled"> Trinidad and Tobago</option>
            <option value="tn" data-count="29"> Tunisia</option>
            <option value="tr" data-count="579" disabled="disabled"> Turkey</option>
            <option value="tm" data-count="3"> Turkmenistan</option>
            <option value="tc" data-count="3"> Turks and Caicos Islands</option>
            <option value="tv" data-count="1"> Tuvalu</option>
            <option value="ug" data-count="33"> Uganda</option>
            <option value="ua" data-count="199" disabled="disabled"> Ukraine</option>
            <option value="ae" data-count="42" disabled="disabled"> United Arab Emirates</option>
            <option value="uk" data-count="1329" disabled="disabled"> United Kingdom</option>
            <option value="us" data-count="11416" disabled="disabled"> United States</option>
            <option value="uy" data-count="146" disabled="disabled"> Uruguay</option>
            <option value="uz" data-count="9"> Uzbekistan</option>
            <option value="vu" data-count="2"> Vanuatu</option>
            <option value="ve" data-count="331" disabled="disabled"> Venezuela</option>
            <option value="vn" data-count="9"> Viet Nam</option>
            <option value="vg" data-count="6"> Virgin Islands, British</option>
            <option value="vi" data-count="11"> Virgin Islands, U.S.</option>
            <option value="wf" data-count="1"> Wallis and Futuna</option>
            <option value="eh" data-count="1"> Western Sahara</option>
            <option value="ye" data-count="4"> Yemen</option>
            <option value="zm" data-count="12"> Zambia</option>
            <option value="zw" data-count="12"> Zimbabwe</option>
        </select>

        <div class="import-actions">
            <a href="javascript:void(0)" class="deselect button button-link-delete" title="<?php _e( 'Deselect all selected countries.', 'wp-radio' ); ?>"><?php _e( 'Deselect All', 'wp-radio' ); ?></a>
            <a href="javascript:void(0)" class="run-import button button-primary button-large" id="run-import"><?php _e( 'Run Importer', 'wp-radio' ); ?></a>
        </div>

        <div class="import-progress" id="import-progress">

            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" id="progress" style="width:0.1%">Imported: 0</div>
            </div>

        </div>

    </div>

</div>
