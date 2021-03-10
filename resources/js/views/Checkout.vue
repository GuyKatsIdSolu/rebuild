<template>
  <div class="checkout-page shop">
    <cart ref="cart"></cart>
    <div class="main-page">
      <div class="page-title">
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <g>
            <g>
              <path d="M393.542,219.688c-0.973,2.383-1.519,4.983-1.519,7.711v31.152h32.975v-38.863H393.542z" />
            </g>
          </g>
          <g>
            <g>
              <path d="M0,219.688v87.403c0,24.162,19.656,43.819,43.818,43.819h239.189v-47.358v-30.001h19.014v-46.152
              c0-2.592,0.097-5.162,0.273-7.711H0z" />
            </g>
          </g>
          <g>
            <g>
              <path d="M381.18,52.461H43.818C19.656,52.461,0,72.117,0,96.279v17.236v1.001h424.998v-1.001V96.279
              C424.998,72.117,405.341,52.461,381.18,52.461z" />
            </g>
          </g>
          <g>
            <g>
              <path d="M0,144.517v42.168v3.002h308.653c6.395-17.555,17.123-33.043,30.882-45.17H0z" />
            </g>
          </g>
          <g>
            <g>
              <path d="M412.504,146.916c-44.377,0-80.481,36.105-80.481,80.483v46.152h30.001v-46.152c0-27.836,22.646-50.482,50.48-50.482
              s50.481,22.647,50.481,50.482v46.152h30.001v-46.152C492.986,183.021,456.881,146.916,412.504,146.916z" />
            </g>
          </g>
          <g>
            <g>
              <path d="M313.007,303.552v155.988H512V303.552H313.007z M427.504,397.182v32.575h-30.001v-32.575
              c-10.471-5.442-17.644-16.385-17.644-28.98c0-18,14.644-32.645,32.645-32.645s32.645,14.644,32.645,32.645
              C445.148,380.796,437.975,391.74,427.504,397.182z" />
            </g>
          </g>
        </svg>Secure Checkout
      </div>
      <div v-if="$root.isMobile" class="top-summary row">
        <div class="title row">
          <div class="col-md-7">Order Summary Quick View</div>
          <div class="col-md-5 purple1" @click="goToSum">View Details</div>
        </div>
        <div class="col-md-7">Total cost</div>
        <div class="col-md-5">${{total}} USD</div>
        <div class="col-md-7">Total shipping</div>
        <div class="col-md-5">${{totalShipping}} USD</div>
        <div class="col-md-7">Total discount</div>
        <div class="col-md-5">${{totalDiscount}} USD</div>
        <div class="col-md-7 bold">Order Sub Total</div>
        <div class="col-md-5 bold">${{total-totalDiscount}} USD</div>
      </div>
      <div class="shop-info wrap">
        <div class="row">
          <div class="col-md-6 shipping-header needs-validation">
            <form id="form">
              <h3>Shipping Details</h3>
              <div class="row">
                <div class="col-md-12">
                  <input type="email" v-model="email" class="form-control" placeholder="Email Address" required>
                </div>
                <div class="col-md-6">
                  <input type="text" v-model="firstName" class="form-control" placeholder="First name" required>
                </div>
                <div class="col-md-6">
                  <input type="text" v-model="lastName" class="form-control" placeholder="Last name" required>
                </div>
                <div class="col-md-12">
                  <input type="text" v-model="address1" class="form-control" placeholder="Street Address" required>
                </div>
                <div class="col-md-12">
                  <input type="text" v-model="address2" class="form-control" placeholder="Apartment, Suite, Unit etc.">
                </div>
                <div class="col-md-6">
                  <input type="text" v-model="city" class="form-control" placeholder="Town / City" required>
                </div>
                <div class="col-md-6" v-if="country_code=='US'">
                  <select class="form-control" v-model='state' required>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <select v-model="country_code" class="form-control" name='country'>
                    <option value="AF">Afghanistan</option>
                    <option value="AX">Åland Islands</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AQ">Antarctica</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia, Plurinational State of</option>
                    <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BV">Bouvet Island</option>
                    <option value="BR">Brazil</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei Darussalam</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CC">Cocos (Keeling) Islands</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros</option>
                    <option value="CG">Congo</option>
                    <option value="CD">Congo, the Democratic Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Côte d'Ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CU">Cuba</option>
                    <option value="CW">Curaçao</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GG">Guernsey</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="HM">Heard Island and McDonald Islands</option>
                    <option value="VA">Holy See (Vatican City State)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IR">Iran, Islamic Republic of</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Ireland</option>
                    <option value="IM">Isle of Man</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JE">Jersey</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KP">Korea, Democratic People's Republic of</option>
                    <option value="KR">Korea, Republic of</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Lao People's Democratic Republic</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macao</option>
                    <option value="MK">Macedonia, the former Yugoslav Republic of</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia, Federated States of</option>
                    <option value="MD">Moldova, Republic of</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PS">Palestinian Territory, Occupied</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Réunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="BL">Saint Barthélemy</option>
                    <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="MF">Saint Martin (French part)</option>
                    <option value="PM">Saint Pierre and Miquelon</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SX">Sint Maarten (Dutch part)</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="GS">South Georgia and the South Sandwich Islands</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SD">Sudan</option>
                    <option value="SR">Suriname</option>
                    <option value="SJ">Svalbard and Jan Mayen</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="SY">Syrian Arab Republic</option>
                    <option value="TW">Taiwan, Province of China</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania, United Republic of</option>
                    <option value="TH">Thailand</option>
                    <option value="TL">Timor-Leste</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US">United States</option>
                    <option value="UM">United States Minor Outlying Islands</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela, Bolivarian Republic of</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VG">Virgin Islands, British</option>
                    <option value="VI">Virgin Islands, U.S.</option>
                    <option value="WF">Wallis and Futuna</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <input type="text" v-model="postCode" class="form-control" placeholder="Postcode / ZIP" required>
                </div>
              </div>
              <div class="wrap payment-get-way " style="    margin-top: 30px;">
                <div class="">
                  <div class="row pay-br">
                    <div class="col-md-6 ">
                      <div class="radio radio-info radio-inline">
                        <input type="radio" id="credit-radio" v-model="payMethod" value="bluesnap" name="radioInline">
                        <label for="credit-radio"> Credit Card </label>
                      </div>
                    </div>
                    <div class="col-md-6 text-right">
                      <img src="/assets/minishop/img/shop-muckup-cart-2.png" alt="">
                    </div>
                  </div>
                  <transition name="fade">
                    <div v-show="payMethod=='bluesnap'" class="panel panel-default bootstrap-basic card-form">
                      <div class="row">
                        <div class="form-group col-md-12">
                          <label for="cardholder-name">Name on Card</label>
                          <input type="text" class="form-control" id="cardholder-name" placeholder="Full Name">
                          <span class="helper-text"></span>
                        </div>
                        <!--Hosted Field for CC number-->
                        <div class="form-group col-md-12 fit-size ">
                          <label for="card-number">Card Number</label>
                          <div class="input-group">
                            <div class="form-control" id="card-number" data-bluesnap="ccn"></div>
                            <div id="card-logo" class="input-group-addon"><img src="https://files.readme.io/d1a25b4-generic-card.png" height="20px"></div>
                          </div>
                          <span class="helper-text" id="ccn-help"></span>
                        </div>
                        <!--Hosted Field for CC EXP-->
                        <div class="form-group col-md-6 fit-size">
                          <label for="exp-date">Exp. Date</label>
                          <div class="form-control" id="exp-date" data-bluesnap="exp"></div>
                          <span class="helper-text" id="exp-help"></span>
                        </div>
                        <!--Hosted Field for CC CVV-->
                        <div class="form-group col-md-6 fit-size">
                          <label for="cvv">Security Code</label>
                          <div class="form-control" id="cvv" data-bluesnap="cvv"></div>
                          <span class="helper-text" id='cvv-help'></span>
                        </div>
                      </div>
                    </div>
                  </transition>
                </div>
                <div class="row pay-br">
                  <div class="col-md-6">
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="paypal-radio" v-model="payMethod" value="paypal" name="radioInline">
                      <label for="paypal-radio"> Paypal </label>
                    </div>
                  </div>
                  <div class="col-md-6 text-right">
                    <img src="/assets/minishop/img/paypal.png" alt="">
                  </div>
                </div>
                <div class="row pay-br">
                  <div class="col-md-12 text-right">
                    <button @click.prevent="placeOrder" type="submit" class="btn crt-btn grn btn-order" style="    width: 100%;">Place Order</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="wrap product-table col-md-6" style="    display: inline-flex;padding: 0px;">
            <div class="container pro-tab">
              <div class="order-info">
                <div class="h3"><b>Order Summary</b></div>
                <div class="sum">
                  <div class="col-md-12 item row" v-for="(item, key,index) in cartContent" :key="key">
                    <div class="img col-md-4">
                      <img :src="item.options.previewUrl" alt="" />
                    </div>
                    <div class="details col-md-8 row">
                      <div class="col-md-7 bold">{{item.name}}</div>
                      <div class="col-md-5 bold">{{item.qty}}x ${{item.price}} USD</div>
                      <div class="col-md-12" >
                        <span class="property" v-for="(property, key,index) in item.options.properties">
                          &nbsp&nbsp&nbsp{{key}}:
                          {{property}}&nbsp
                        </span>
                      </div>
                      <div class="col-md-7">Shipping</div>
                      <div class="col-md-5">${{item.options.shippingPrice}} USD</div>
                      <div class="col-md-7">Discount {{item.options.discount}}%</div>
                      <div class="col-md-5">-${{(item.price*(item.options.discount / 100)).toFixed(2)}} USD</div>
                      <div class="col-md-7 bold margin-top">Sub Total</div>
                      <div class="col-md-5 bold margin-top">${{(item.price*(1 - (item.options.discount / 100))+item.options.shippingPrice).toFixed(2)}} USD</div></b>
                    </div>
                  </div>
                  <div class="total row">
                    <div class="col-md-7">Order Total</div>
                    <div class="col-md-5">${{total.toFixed(2)}} USD</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row page-footer">
      <div class="title row col-md-12">
        <div class="col-md-4 line"></div>
        <div class="col-md-4 text">why you will love shopping with us</div>
        <div class="col-md-4 line"></div>
        <div class="col-md-12"><span></span></div>
      </div>
      <div class="col-md-4">
        <div class="shp-box">
          <span>FAST SHIPPING</span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="shp-box">
          <span>100% SATISFIED</span>
        </div>
      </div>
      <div class="col-md-4">
        <div class="shp-box">
          <span>SECURE PAYMENT</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    cartContent: {},
    subTotal: 0,
    total: 0,
    products_id: 0,
    totalShipping: 0,
    totalDiscount: 0,
    itemCount: 0,
    email: '',
    firstName: '',
    lastName: '',
    address1: '',
    address2: '',
    city: '',
    state: '',
    country_code: 'US',
    postCode: '',
    cardholderName: '',
    payMethod: 'bluesnap',
    pfToken: '',
  }),
  watch: {
    country_code(val,old) {
      if(val!='US'){
        this.$toast.info({
          title: 'Out of delivery area',
          message: "We are sorry, in light of the Covid 19 pandemic, we are not currently shipping orders outside of the United States.",
          position: this.$root.toastPosition,
        });
        this.country_code='US';
      }
    },
    state(val) {
      // var that=this;
      // axios.post('/update-shipping', {
      //   state: that.state,
      //   country_code: that.country_code,
      //   post_code: that.postCode,
      // }).then(response => {
      //   if(response.data.success){
      //     // that.$root.$refs.cart.cartContent = JSON.parse(response.data.cartContent);
      //     that.getContent();
      //   }
      // });
    },
  },
  methods: {
    goToSum() {
      $('html,body').animate({
        scrollTop: $('.order-info').offset().top
      }, 'slow');
    },
    placeOrder() {
      var isOk=true;
      $('.needs-validation').find('input,select,textarea').each(function () {
        // check element validity and change class
        if(!this.checkValidity()){
          isOk=false;
        }
        $(this).removeClass('is-valid is-invalid')
        .addClass(this.checkValidity() ? 'is-valid' : 'is-invalid');
      });
      if(!isOk) return;
      var that = this;
      if (this.payMethod == 'bluesnap') {
        bluesnap.submitCredentials(function(cardData) {
          if (!cardData.ccType) {
            that.$toast.error({
              title: 'Wrong card details.',
              message: "the card type is " +
              cardData.ccType +
              " and last 4 digits are " +
              cardData.last4Digits +
              " and exp is " +
              cardData.exp,
              position: that.$root.toastPosition,
            });
            return false;
          }
          that.cardholderName = $('#cardholder-name').val();
          axios.post('/api/pay-with-credit-card', {
            email: that.email,
            first_name: that.firstName,
            last_name: that.lastName,
            address_1: that.address1,
            address_2: that.address2,
            city: that.city,
            state: that.state,
            country_code: that.country_code,
            post_code: that.postCode,
            cardholder_name: that.cardholderName,
            pfToken: that.pfToken,
          }).then(response => {
            // fbq('track', 'Purchase', {
            //   value: that.subTotal,
            //   content_ids: that.products_id,
            //   content_type: 'product',
            //   currency: 'USD',
            // });
            // ga('send', 'event', 'EnhancedEcommerce', 'Completed-Order', response.data);
            if(response.data.success){
              that.$router.push(response.data.url);
            }else{
              that.$toast.error({
                title: 'Payment Error',
                message: response.data.msg,
                position: that.$root.toastPosition,
              });
            }
          });
        });
      }
      if (this.payMethod == 'paypal') {
        axios.post('/api/pay-with-paypal', {
          email: that.email,
          first_name: that.firstName,
          last_name: that.lastName,
          address_1: that.address1,
          address_2: that.address2,
          city: that.city,
          state: that.state,
          country_code: that.country_code,
          post_code: that.postCode,
        }).then(response => {
          window.location.href = response.data;
        })
        .catch(error => {
          that.$toast.error({
            title: 'Paypal Error',
            message: "We are Having Some trouble completing your request right now",
            position: that.$root.toastPosition,
          });
        });
      }
    },
    getContent() {
      var that = this;
      axios.get('/api/get-cart-content')
      .then(response => {
        that.cartContent = response.data;
        that.subTotal = that.itemCount = that.totalShipping=that.total = 0;
        that.products_id='';
        for (var item in that.cartContent) {
          item=that.cartContent[item];
          that.subTotal += item.price * item.qty * (1 - item.options.discount / 100);
          that.products_id += item.id + ',';
          that.total += (item.price * (1 - item.options.discount / 100) + item.options.shippingPrice) * item.qty;
          that.totalShipping += item.options.shippingPrice * item.qty;
          that.itemCount++; // parseInt(this.cartContent[item].qty);
        }
        that.products_id = (that.products_id).substring(0, (that.products_id).length - 1);

      });
    },
  },
  mounted() {

    let themejs = document.createElement('script');
    themejs.setAttribute('src',
    this.$root.isDev?
    'https://sandbox.bluesnap.com/services/hosted-payment-fields/v2.0/bluesnap.hpf.min.js'
    :
    'https://ws.bluesnap.com/services/hosted-payment-fields/v2.0/bluesnap.hpf.min.js');
  document.head.appendChild(themejs);
  $('.needs-validation').find('input,select,textarea').on('focusout', function () {
    // check element validity and change class
    $(this).removeClass('is-valid is-invalid')
    .addClass(this.checkValidity() ? 'is-valid' : 'is-invalid');
  });
  // fbq('track', 'InitiateCheckout');
  // ga('send', 'event', 'EnhancedEcommerce', 'checkout step', window.location.href);
  var vm = this;
  axios.get('/api/get-bluesnap-token')
  .then(response => {
    bluesnap.hostedPaymentFieldsCreation(response.data, bsObj); //insert your Hosted Payment Fields token
    vm.pfToken = response.data;
  });
},
created() {
  this.getContent();
}
};
function changeImpactedElement(tagId, removeClass, addClass) {
  removeClass = removeClass || "";
  addClass = addClass || "";
  $("[data-bluesnap=" + tagId + "]")
  .removeClass(removeClass)
  .addClass(addClass);
}
// getErrorText: function that takes error code (received from BlueSnap) and returns associated help text
function getErrorText(errorCode) {
  switch (errorCode) {
    case "001":
    return "Please enter a valid card number";
    case "002":
    return "Please enter the CVV/CVC of your card";
    case "003":
    return "Please enter your card's expiration date";
    case "22013":
    return "Card type is not supported by merchant";
    case "400":
    return "Session expired please refresh page to continue";
    case "403":
    case "404":
    case "500":
    return "Internal server error please try again later";
    default:
    break;
  }
}
// cardUrl: object that stores card type code and associated card image URL
var cardUrl = {
  "AmericanExpress": "https://files.readme.io/97e7acc-Amex.png",
  "CarteBleau": "https://files.readme.io/5da1081-cb.png",
  "DinersClub": "https://files.readme.io/8c73810-Diners_Club.png",
  "Discover": "https://files.readme.io/caea86d-Discover.png",
  "JCB": "https://files.readme.io/e076aed-JCB.png",
  "MaestroUK": "https://files.readme.io/daeabbd-Maestro.png",
  "MasterCard": "https://files.readme.io/5b7b3de-Mastercard.png",
  "Solo": "https://sandbox.bluesnap.com/services/hosted-payment-fields/cc-types/solo.png",
  "Visa": "https://files.readme.io/9018c4f-Visa.png"
};

/* Defining bsObj: object that stores Hosted Payment Fields
event handlers, styling, placeholder text, etc. */
var bsObj = {
  onFieldEventHandler: {
    onFocus: function(tagId) {
      // Handle focus
      changeImpactedElement(tagId, "hosted-field-valid hosted-field-invalid", "hosted-field-focus");
    },
    onBlur: function(tagId) {
      // Handle blur
      changeImpactedElement(tagId, "hosted-field-focus");
    },
    onError: function(tagId, errorCode) {
      // Handle a change in validation
      changeImpactedElement(tagId, "hosted-field-valid hosted-field-focus", "hosted-field-invalid");
      $("#" + tagId + "-help").text(getErrorText(errorCode));
    },
    onType: function(tagId, cardType) {
      // get card type from cardType and display card image
      $("#card-logo > img").attr("src", cardUrl[cardType]);
    },
    onValid: function(tagId) {
      // Handle a change in validation
      changeImpactedElement(tagId, "hosted-field-focus hosted-field-invalid", "hosted-field-valid");
      $("#" + tagId + "-help").text("");
    }
  },
  //styling is optional
  style: {
    // Styling all inputs
    "input": {
      "font-size": "14px",
      "font-family": "Helvetica Neue,Helvetica,Arial,sans-serif",
      "line-height": "1.42857143",
      "color": "#555"
    },
    // Styling a specific field
    /*"#ccn": {

  },*/

  // Styling Hosted Payment Field input state
  ":focus": {
    "color": "#555"
  }
},
ccnPlaceHolder: "4111222233334444",
cvvPlaceHolder: "123",
expPlaceHolder: "MM/YY",
expDropDownSelector: false //set to true for exp. date dropdown
};

/* Calling bluesnap.submitCredentials: function that submits card data to BlueSnap, where it will be associated with token, and calls input function with card data object if submission was successful */
function do_when_clicking_submit_button() {
  bluesnap.submitCredentials(function(cardData) {
    alert(
      "the card type is " +
      cardData.ccType +
      " and last 4 digits are " +
      cardData.last4Digits +
      " and exp is " +
      cardData.exp +
      " after that I can call final submit"
    );
    // This is where you would perform final submission to your server
    $('#payment-form').submit();
  });
}
</script>
<!-- <script type="text/javascript" src="https://ws.bluesnap.com/services/hosted-payment-fields/v2.0/bluesnap.hpf.min.js"></script> -->
<!-- <script type="text/javascript" src="https://sandbox.bluesnap.com/services/hosted-payment-fields/v2.0/bluesnap.hpf.min.js"></script> -->
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script> -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/> -->
