<template>
    <layout>
        <section class="choose-sect">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <p>
                            <ul class="text-size" > 
                                <li class="first-child">Learn to <b>BUY</b> crypto <b>intelligently</b> </li>
                                <li> with an easy, short narrated video tutorial</li>
                                <li>that teaches you to how to set up a Limit Buy on Coinbase.com</li>
                                <li> and lets you set the coin price you want to pay</li>
                                <li> so you can buy below the current market price. </li>
                            </ul>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <p>
                            <ul class="text-size">
                                <li class="first-child">Learn to <b>SELL</b> crypto <b>intelligently</b> </li>
                                <li> by learning how to precisely choose the profit, proceeds, or coin price you want</li>
                                <li>with easy, short narrated video tutorials</li>
                                <li> that teach you how to use a Limit Sell on Coinbase.com</li>
                                <li>and lets you set the coin price you want to receive.</li>
                                <li>so you can sell above the current market price.</li>
                                
                            </ul>
                        </p>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                        <p>
                            <ul class="text-size">
                                <li class="first-child">Learn from the Resources page </li>
                                <li>with real-world informative videos specifically created for using the Calculator</li>
                                <li>and real-world explanatory videos of actual trades based on the Outputs of the Calculator</li>
                                <li> and links to helpful, focused pages with relevant subjects</li>
                                <li>to help you understand the vocabulary and concepts of <b>intelligently</b> buying and selling cryptocurrency.</li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="choose-sects pt-3 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-12">
                        <h3 class="underline-text"> <b>IT’S EASY!</b>    </h3>
                        <div class="d-blocks">
                            <p  class="text-size">After you explore the website and watch some videos you are ready to go! Just:</p>


                            <p>
                                <ul class="pl-4 text-size">
                                    <li>Join this website with your email address, user name, etc.</li>
                                    <li>Agree to the terms of service and user agreement</li>
                                    <li>Choose the pricing plan and the generous discount you want.</li>
                                    <li>Check out.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-12">
                        <h3 class="underline-text"> <b>BUY</b>    </h3>
                        <div class="d-blocks">
                            <p>
                                <ul class="pl-4 text-size">
                                    <li>Use the Calculator to target the cryptocurrency at a price you choose.</li>
                                    <li>Enter your limit buy order on Coinbase.com</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-12">
                        <h3 class="underline-text"> <b>SELL</b>    </h3>
                        <div class="d-blocks">
                            <p>
                                <ul class="pl-4 text-size">
                                    <li>Use the Calculator to help you decide how much profit $ or %, proceeds $ or %, or the selling price for a whole coin you want.</li>
                                    <li>Enter your limit sell order on Coinbase.com</li>
                                    <li>Cancel the order at no cost to you if you decide you do not want to sell at the coin price you chose.</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-12">
                        <div class="d-blocks">
                            <p class="text-size"> Spend <b class="underline-text">NO TIME</b> trying to time the market </p>
                            <p>
                                <ul class="pl-4 text-size">
                                    <li>Be patient and let the money come to you.</li>
                                    <li>Have fun and be careful out there! </li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-12">
                        <section data-testid="alert-banner-container" class="alert-banner__container" data-style="general">
                        <section data-testid="alert-banner-text-wrap" class="alert-banner__text-wrap">
                            <section data-testid="alert-banner-text-rte" class="alert-banner__text">
                                <span class="mr-2">
                                <svg role="img" width="24" height="24" xmlns="http://www.w3.org/2000/svg" data-testid="alert-banner-svg">
                                    <path d="M12 24C18.63 24 24 18.63 24 12C24 5.37 18.63 0 12 0C5.37 0 0 5.37 0 12C0 18.63 5.37 24 12 24ZM11 5H13V7H11V5ZM11 9H13V19H11V9Z" fill="#0052FF"></path>
                                </svg>
                                </span>
                            <p>
                                Disclaimer: Information provided is for general educational purposes only and is not intended to constitute investment or other advice on financial products. Such information is not, and should not be read as, an offer or recommendation to buy or sell or a solicitation of an offer or recommendation to buy or sell any particular digital asset or to use any particular investment strategy. Crypto Wiz Guy® and its affiliates (collectively “Crypto Wiz Guy®”) makes no representations as to the accuracy, completeness, timeliness, suitability, or validity of any information and will not be liable for any errors, omissions, or delays in this information or any losses, injuries, or damages arising from its display or use. Investing in crypto comes with risk. Please carefully consider whether trading or holding cryptocurrencies is suitable for you given your financial situation.
                            </p>
                            </section>
                        </section>
                        </section>
                    </div>

                </div>
            </div>
        </section>
    </layout>
      <div>
    <div v-show="showModal" id="openModal1" class="modalDialog1">
      <div class="overlay">
        <a href="#" title="Close" class="close1" @click="closeModal">X</a>
        <div class="modal-head1">
          <div class="modal-header1">flame
            <h2 class="modal-title1 text-white " id="purchaseLabel">
              <span>Wait! Before you go..</span>
            </h2>
          </div>
          <div class="modal-body1">
             <p class="text-white" style="font-size: 19px;">Get an exclusive {{ discount }}% off on Your First Order with coupon: ( <strong>{{ couponName }}</strong> ) *</p>
            <div class="middle-section1">
              <div class="hero connect-page">
                <div class="container">
                  <div class="hero-body">
                    <div class="campaign campaign-0">
                      <div class="counter timer">
                     
                        <div class="counter-boxes">
                          <div class="count-box">
                            <h1 class="value text-white day">{{ days }}</h1>
                            <span>Days</span>
                          </div>
                          <div class="count-box">
                            <h1 class="value text-white hour">{{ hours }}</h1>
                            <span>Hours</span>
                          </div>
                          <div class="count-box">
                            <h1 class="value text-white minute">{{ minutes }}</h1>
                            <span>Minutes</span>
                          </div>
                          <div class="count-box">
                            <h1 class="value text-white second">{{ seconds }}</h1>
                            <span>Seconds</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <p class="heading text-white">Hurry up! This offer is valid for the next {{ days }} {{ hours }} {{ minutes }} {{ seconds }}  only.</p>
          </div>
        </div>
      </div>
      <div class="modal-backdrop1" @click="closeModal"></div>
    </div>
  </div>
    <footer class="footer-site">
            <div class="container">

                <div class="copyright-text">
                    © 2024 Crypto Wiz Guy LLC, all U.S. and international rights reserved
                </div>
            </div>
             </footer>
</template>
<script>
import Layout from "./Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";
import { useToast } from "vue-toastification";
import Platform from "./../../assets/platform.png";
import Star from "./../../assets/star.png";
import faq from "./../../assets/faqs.png";

export default {
  name: "Home",

  components: {
    Layout,
  },
  beforeUnmount() {},
  created() {
    this.fetchExpiryDate();
  },
  mounted() {
    this.fetchExpiryDate();
    this.setupCountdown(1705780800000, 1802649540000);
    setTimeout(() => {
      this.showModal = true;
    }, 10000);
  },
  data() {
    return {
      videoSource: "/assets/video/demo-video.mkv",
      Platform,
      Star,
      faq,
      showModal: false,
      days: 0,
      hours: 0,
      minutes: 0,
      seconds: 0,
      couponName:'',
      discount:'',
    };
  },
  watch: {},
  methods: {
    async fetchExpiryDate() {
      try {
        const response = await axios.get("/api/discount-show"); 
        console.log("discount response", response.data)
        return response.data;
        
      } catch (error) {
        console.error("Error fetching expiry date:", error);
        return null; // Handle error gracefully
      }
    },
    async setupCountdown() {
      // Fetch the expiry date using the API call

      const discountDetails = await this.fetchExpiryDate();
      if (discountDetails) {
            const { name, expiry_date,discount } = discountDetails;
            this.couponName = name;
            this.discount = discount;
            this.expiry_date = expiry_date;
      }
      // Parse the expiry date to milliseconds
      const startTimeMillis = new Date().getTime();
      const endTimeMillis = new Date(this.expiry_date).getTime();

      const second = 1000;
      const minute = second * 60;
      const hour = minute * 60;
      const day = hour * 24;

      function calculateRemaining() {
        const now = new Date().getTime();
        return now >= startTimeMillis && now < endTimeMillis
          ? endTimeMillis - now
          : 0;
      }

      let previousGap = calculateRemaining();

      setInterval(() => {
        const gap = calculateRemaining();
        const textDay = Math.floor(gap / day);
        const textHour = Math.floor((gap % day) / hour);
        const textMinute = Math.floor((gap % hour) / minute);
        const textSecond = Math.floor((gap % minute) / second);

        this.days = textDay;
        this.hours = textHour;
        this.minutes = textMinute;
        this.seconds = textSecond;

        if (
          (previousGap > day && gap <= day) ||
          (previousGap > 0 && gap === 0)
        ) {
          setTimeout(() => {
            window.location.reload();
          }, 30000 + Math.random() * 90000);
        }

        previousGap = gap;
      }, 1000);
    },

    openModal() {
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
  },
  computed: {},
};
</script>
<style scoped>
/* modal code */


.flame  span {
  height: 300px;
  width: 100%;
  background-image: url("https://dl.dropbox.com/s/r2s8s2r17wi0xm6/flame.png?dl=0");
  background-position: 0 -1000px;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: fire 4s linear infinite;
}

@keyframes fire {
  0% {
    background-position: 0% -50%;
  }
  100% {
    background-position: 0% -25%;
  }
}

.container {
  flex-grow: 1;
  margin: 0 auto;
  position: relative;
  width: auto;
}

@media screen and (min-width: 1024px) {
  .container {
    max-width: 960px;
  }
}

@media screen and (min-width: 1204px) {
  .container {
    max-width: 1140px;
  }
  .container {
    max-width: 1140px;
  }
}

@media screen and (max-width: 768px) {
  .hero {
    min-height: auto;
  }
}

.hero .hero-body .campaign {
  flex-direction: column;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
}

.hero.connect-page {
  min-height: auto;
}

.hero .hero-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

@media screen and (max-width: 768px) {
  .hero .hero-body {
    padding: 2rem 0;
  }
}

.section.pair .pair-steps .step .step-number .value {
  color: #fff;
  font-weight: 700;
  font-size: 3rem;
}

.hero .hero-body .counter {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin: 3rem 0;
}

@media screen and (max-width: 768px) {
  .hero .hero-body .counter {
    margin: 2rem 0 0;
  }
}

.hero .hero-body .counter .title {
  color: #9c9c9c;
  font-size: 1rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  margin-bottom: 0.5rem;
  text-shadow: 0 1px 2px #0003;
}

.hero .hero-body .counter .counter-boxes {
  display: flex;
  flex-direction: row;
}

.hero .hero-body .counter .counter-boxes .count-box {
  background-color: #1a1c1ccc;
  box-shadow: 0 5px 10px #0000004d;
  border-radius: 8px;
  backdrop-filter: blur(5px);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  width: 100px;
  height: 100px;
  margin-right: 4px;
  text-shadow: 0 1px 0 #0000004d;
  padding: 5px;
}

@media screen and (max-width: 768px) {
  .hero .hero-body .counter .counter-boxes .count-box {
    width: 70px;
    height: 70px;
  }
}

.hero .hero-body .counter .counter-boxes .count-box h1 {
  color: #fff;
  padding: 8px 0 0;
  margin: 0;
  font-size: 2.5rem;
  line-height: 2rem;
}

@media screen and (max-width: 768px) {
  .hero .hero-body .counter .counter-boxes .count-box h1 {
    font-size: 2rem;
  }
}

.hero .hero-body .counter .counter-boxes .count-box span {
  color: #9c9c9c;
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
}

@media screen and (max-width: 768px) {
  .hero .hero-body .counter .counter-boxes .count-box span {
    font-size: 10px;
    letter-spacing: 0;
  }
}

.hero .hero-body .counter .counter-boxes .count-box:last-of-type {
  margin-right: 0;
}

.container {
  width: 100%;
}

.modal-backdrop {
  display: none;
}
.modalDialog1 {
  position: fixed;
  font-family: Arial, Helvetica, sans-serif;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 99999;
  opacity: 1;
  -webkit-transition: opacity 400ms ease-in;
  -moz-transition: opacity 400ms ease-in;
  transition: opacity 400ms ease-in;
  pointer-events: auto;

  /*	background:rgba(0,0,0,0.8);*/
}
.modal-backdrop1 {
  background: rgba(0, 0, 0, 0.8);
  position: absolute;
  top: 0;
  height: 100%;
  width: 100%;
}
.modalDialog1:target {
  opacity: 1;
  pointer-events: auto;
}
.modalDialog1 .overlay {
  width: 50%;
  position: relative;
  margin: 5% auto;
  padding: 40px 50px;
  border-radius: 0;
  background: #000000a8;
  z-index: 9999;
}
.close1 {
  background: #dc241e;
  color: #ffffff;
  line-height: 25px;
  position: absolute;
  right: -12px;
  text-align: center;
  top: -10px;
  text-decoration: none;
  font-weight: bold;
  opacity: 1;
  width: 37px;
  height: 36px;
  border-radius: 50%;
  padding: 6px 1px;
}
.modal-backdrop1.in {
  opacity: 0;
}
.close1:focus,
.close1:hover {
  background: black;
  color: white;
  opacity: 1;
  text-decoration: none;
}
.modal-body1 .coupon-btn1,
.modal-body1 .thanks-btn1 {
  background: #dc241e;
  width: 36%;
  float: left;
  display: inline-block;
  margin: 30px 20px 20px;
  color: #fff;
  cursor: pointer;
  font-family: "Oswald", sans-serif;
}
.modal-head1 {
  text-align: center;
}
.modal-body1 .coupon-btn1 {
  background: gray;
}
body.modal-open {
  overflow: auto;
  padding-right: 0 !important;
}
.heading {
  display: table;
  width: 100%;
}
.open {
  background: #00bcd4;
  padding: 8px 30px;
  font-size: 23px;
  color: white;
  border-radius: 3px;
  border: none;
  text-transform: uppercase;
  font-weight: 600;
  cursor: pointer;
}

/* end modal code */

footer.footer-site {
  background: #cae7f7;
  padding: 0px 0 12px;
}

footer.footer-site p {
  font-weight: 600;
  max-width: 320px;
  color: #000;
}

footer.footer-site p span {
  font-weight: 400;
  font-size: 14px;
  color: #000;
}

.copyright-text {
  text-align: center;
  border-top: 1px solid #87adde;
  padding-top: 8px;
  margin-top: 60px;
  color: #000;
  font-size: 14px;
}

footer.footer-site ul {
  list-style: none;
  padding: 0;
  margin-top: 22px;
}

footer.footer-site a {
  text-decoration: unset;
  font-size: 14px;
  color: #000;
  line-height: 30px;
}

footer.footer-site h3 {
  font-size: 17px;
  font-weight: 700;
  color: #000;
}
.alert-banner__container[data-style="general"] {
  background-color: #f5f8ff;
  border-color: #5b616e33;
}
.alert-banner__container {
  border: 1px solid #5b616e33;
  border-radius: 12px;
  display: flex;
  padding: 24px;
  margin-top: 50px;
  flex-direction: column;
}

.underline-text {
  text-decoration: underline;
}
.alert-banner__text p {
  margin-bottom: 0;
  font-size: 1rem;
  color: #135;
}
.alert-banner__text {
  font-size: 1rem;
  line-height: 1.5;
  font-weight: 400;
  margin-bottom: 0;
  color: #5b616e;
  display: flex;
}
li.first-child {
  list-style: none;
  text-decoration: underline;
  padding: 12px;
  /* text-align: center; */
}
.d-blocks {
  display: inline-block;
}
.faq-item {
  margin-bottom: 20px;
}

.faq-question {
  display: flex;
  align-items: center;
  cursor: pointer;
  background: #fff;
  padding: 10px;
  border-radius: 8px;
}

.faq-answer {
  display: none;
  padding-left: 30px;
}

.icon-wrapper .icon {
  margin-right: 10px;
  background: #4473c5;
  width: 30px;
  height: 30px;
  border-radius: 50px;
  position: relative;
}

.icon-wrapper .icon span {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  font-size: 14px;
  font-weight: 700;
}
.text-size {
  font-size: 31px;
  color: #000;
  margin-bottom: 0;
  font-weight: 400;
  padding-bottom: 15px;
  line-height: 37px;
}

.card button .icon::before {
  content: "\f106";
  font-family: "Font Awesome 5 Free";
  color: #ffff;
  position: absolute;
  right: 6px;
  font-size: 23px;
  top: -1px;
  font-weight: 800;
}

.faq-answer p {
  margin-top: 12px;
}

.card button.collapsed .icon::before {
  content: "\f107";
  font-family: "Font Awesome 5 Free";
  color: #ffff;
  position: absolute;
  right: 6px;
  font-size: 20px;
  top: 2px;
  font-weight: 800;
}

.arrow {
  border: solid black;
  border-width: 0 3px 3px 0;
  display: inline-block;
  padding: 3px;
}

.right {
  transform: rotate(-45deg);
  -webkit-transform: rotate(-45deg);
}

.left {
  transform: rotate(135deg);
  -webkit-transform: rotate(135deg);
}

.up {
  transform: rotate(-135deg);
  -webkit-transform: rotate(-135deg);
}

.down {
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
}

section.banner-sect h1,
section.trial h1 {
  font-size: 36px;
  font-weight: 700;
  color: #000;
}

section.banner-sect p,
section.trial p {
  color: #000;
  font-size: 16px;
  max-width: 1024px;
  margin: auto;
}

.bg-light-blue {
  background: #cbe8fa;
  border-radius: 25px;
  padding: 30px 26px;
  margin-bottom: 25px;
}

.bg-light-blue h3 {
  font-size: 16px;
  font-weight: 700;
}

.bg-light-blue p {
  line-height: 18px;
}

section.platform-work {
  background: #cce7fa;
  padding: 60px 0 !important;
}

section.platform-work h2 {
  font-size: 36px;
  font-weight: 700;
  color: #000;
}

section.platform-work p {
  font-size: 14px;
  color: #000;
  /* max-width: 350px; */
}

.side-icon {
  background: #fff;
  padding: 14px;
  border-radius: 8px;
  position: relative;
  margin-bottom: 14px;
}

.bg-white-block {
  /* max-width: 360px; */
  list-style: none;
  padding: 0px;
}

.side-icon h3 {
  font-size: 14px;
  color: #000;
  font-weight: 700;
  margin: 0;
}

.side-icon p {
  font-size: 12px !important;
  margin: 0;
}

section.choose-sect p {
  color: #000;
  font-size: 14px;
  max-width: 600px;
  margin: auto;
}

h2 {
  font-size: 36px;
  font-weight: 700;
  color: #000;
}

.card-sect {
  border: 1px solid #87a5da;
  border-radius: 12px;
  padding: 20px 40px;
  text-align: center;
  max-width: 32%;
  margin: auto;
  margin-bottom: 12px;
}

.card-sect h3 {
  font-size: 16px;
  color: #000;
  font-weight: 700;
}

section.faqs-sect {
  background: #cce7fa;
  padding: 60px 0;
  margin: 100px 0;
}

section.faqs-sect p {
  font-size: 14px;
  color: #000;
}

section.faqs-sect .row .col-12.col-sm-12.col-md-6.col-lg-6:first-child {
  max-width: 450px;
  margin-right: auto;
}

section.partners-sect {
  margin: 100px 0;
}

section.partners-sect p {
  color: #000;
  font-size: 14px;
  max-width: 600px;
  margin: auto;
}

.mw-wwh {
  max-width: 943px;
}

video#video-style {
  width: 100%;
  max-width: 947px;
  border: 2px solid #cce7fa;
}

@media (max-width: 767.9px) {
  section#wwwwh {
    margin-top: 0rem !important;
  }
  .underline-text {
    text-decoration: underline;
    font-size: 1.75rem !important;
  }
  .text-size {
    font-size: 20px;
    color: #000;
    margin-bottom: 0;
    font-weight: 400;
    padding-bottom: 15px;
    line-height: 37px;
  }
}
</style>
