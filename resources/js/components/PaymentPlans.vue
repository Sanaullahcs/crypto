<template>
  <layout>
    <div class="container-fluid pb-5">
      <div class="">
        <div class="card br-10 mw-550 m-auto border">
          <div class="card-body p-4">
            <form id="msform">
              <!-- progressbar -->

              <!-- fieldsets -->
              <fieldset v-if="currentStep === 0">
                <div class="form-card pl-1">
                  <h3 class="font-weight-bolder">Choose a Payment Plan</h3>
                </div>
                <div class="row p-3">
                  <div
                    v-for="(subscription, index) in subscriptionplan"
                    :key="index"
                    class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 p-0 mt-3 mb-2"
                  >
                    <div class="radio-card">
                      <div class="inner-content" style="display: flex">
                        <div class="radio-btn-green">
                          <!-- You may want to uncomment this input if you're planning to use it -->
                          <!-- <input type="radio" :id="'subscription_' + subscription.id" name="radio" :value="subscription.id" v-model="selectedPlan" /> -->
                          <label
                            class="custom-radio pointer-cursor"
                            :for="'subscription_' + subscription.id"
                          ></label>
                        </div>
                        <div class="content-sect pointer-cursor">
                          <label
                            :for="'subscription_' + subscription.id"
                            class="value-text justify-content-left text-left pl-3 pb-0"
                          >
                            <h2 v-if="subscription.best_value == 1">
                              (BEST VALUE)
                            </h2>
                            <h3>{{ subscription.name }}</h3>
                            <p>
                              Payable
                              <!-- Make sure subscription.duration is defined in your subscription object -->
                              <span class="capital-duration">{{
                                subscription.duration
                              }}</span>
                            </p>
                          </label>
                          <div class="price-month">
                            <!-- Make sure formattedMonthlyPrice is correctly defined in your methods -->
                            <p>
                              ${{
                                formattedMonthlyPrice(
                                  subscription.price,
                                  subscription.duration
                                )
                              }}/mo
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div
                  class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 p-0 mt-3 mb-2"
                  id="payment-section"
                >
                  <p class="bottom-text">
                    <a
                      href=""
                      v-on:click="() => $router.push('/terms-and-conditions')"
                      >see Terms and conditions</a
                    >
                  </p>
                  <span class="number">1. </span>
                  <p class="bottom-text">
                    The Standard rate will automatically be charged on the day
                    after the expiration date, unless user unsubscribes before
                    the expiration date/time.
                  </p>
                  <span class="number">2. </span>
                  <p class="bottom-text">
                    A one week free trial period is part of every initial
                    subscription, and can be canceled within 7 days. Charges
                    will take place on the eighth day.
                  </p>
                  <span class="number">3. </span>
                  <p class="bottom-text">
                    No full or partial refunds given after 7 day free trial.
                  </p>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </layout>
</template>
<script>
import Logo from "./../../assets/logo.png";
import Layout from "./Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";
import { StripeCheckout } from "@vue-stripe/vue-stripe";
import SubscriptionStripe from "./SubscriptionStripe.vue";
import PayPalButton from "./SubscriptionPaypal.vue";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import { useToast } from "vue-toastification";
import html2pdf from "html2pdf.js";
export default {
  data() {
    return {
      publishableKey:
        "pk_test_51O9rjwHgAJ2a2cU6bxBBpmh3z11jZqTj0hkroRh2bA1eEsO89vzM0jBuxtE8E4aw20wf8XqJG5mFAA2S0gyUYlg600bekqVISk",
      loading: false,
      lineItems: [
        {
          price: "some-price-id", // The id of the recurring price you created in your Stripe dashboard
          quantity: 1,
        },
      ],
      successURL: "http://127.0.0.1:8000/",
      cancelURL: "http://127.0.0.1:8000/",
      currentStep: 0,
      steps: 4,
      progressBarWidth: "0%",
      selectedPayment: null,
      selectedPaymentComponent: null,
      subscriptionplan: [],
      successMessage: null,
      errorMessage: null,
      selectedPlan: null,
      regisitrationDiscount: null,
      showRecipetModal: false,
      lastsubscriptiondata: [],
      subscriptionplan: [],

      promocode: "",
      discount: "",
      user: null,
      first_name: null,
      email: null,

      last_name: null,
      user: null,
      Logo: Logo,
      formattedDate: "",
    };
  },
  components: {
    Layout,
    StripeCheckout,
    SubscriptionStripe,
    PayPalButton,
    Logo,
  },
  computed: {
    progressBarWidth() {
      return `${((this.currentStep + 1) / this.steps) * 100}%`;
    },
    payableTotal() {
      const subscriptionPrice = this.getSubscriptionPrice(this.selectedPlan);
      let totalAfterDiscount = 0;

      if (this.discount && this.discountAmount !== 0) {
        const registrationDiscount =
          (subscriptionPrice / 100) * this.regisitrationDiscount;
        totalAfterDiscount = subscriptionPrice - this.discountAmount;

        console.log("if subscriptionPrice", subscriptionPrice);
        console.log("if registrationDiscount", registrationDiscount);
        console.log("if this.discountAmount", this.discountAmount);

        console.log("if totalAfterDiscount", totalAfterDiscount);
      } else {
        totalAfterDiscount =
          subscriptionPrice -
          (subscriptionPrice / 100) * this.regisitrationDiscount;

        console.log("else subscriptionPrice", subscriptionPrice);
        console.log("else subscriptionPrice", this.regisitrationDiscount);

        console.log("else totalAfterDiscount", totalAfterDiscount);
      }

      return totalAfterDiscount.toFixed(2);
    },

    // Compute the discount amount
    discountAmount() {
      if (this.discount) {
        const subscriptionPrice = this.getSubscriptionPrice(this.selectedPlan);
        const registrationDiscount =
          (subscriptionPrice / 100) * this.regisitrationDiscount;
        console.log(
          "discountAmount registrationDiscount",
          registrationDiscount
        );
        console.log(
          "discountAmount registrationDiscount",
          this.regisitrationDiscount
        );
        console.log("discountAmount subscriptionPrice", this.subscriptionPrice);
        return ((subscriptionPrice / 100) * this.discount).toFixed(2);
      }
      return 0;
    },
  },
  created() {
    this.toast = useToast();
    this.formatCurrentDate();
    this.getPlan();
  },
  mounted() {},
  methods: {
    formatDate(timestamp) {
      const date = new Date(timestamp);
      const options = { day: "numeric", month: "short", year: "numeric" };
      return date.toLocaleDateString("en-US", options).toUpperCase();
    },

    formatCurrentDate() {
      const currentDate = new Date();
      const options = {
        day: "numeric",
        month: "short",
        year: "numeric",
        hour: "numeric",
        minute: "numeric",
      };

      const formatted = currentDate.toLocaleDateString("en-US", options);
      this.formattedDate = formatted.replace(",", " at");
    },

    // Show the Bootstrap modal

    checkSelection() {
      // Check if a plan has been selected
      return this.selectedPlan !== null;
    },

    formattedMonthlyPrice(price, duration) {
      // Your formatted monthly price logic here
    },
    getSubscriptionName(selectedId) {
      const selectedSubscription = this.subscriptionplan.find(
        (subscription) => subscription.id === selectedId
      );
      return selectedSubscription ? selectedSubscription.name : "";
    },
    getSubscriptionPrice(selectedId) {
      const selectedSubscription = this.subscriptionplan.find(
        (subscription) => subscription.id === selectedId
      );
      return selectedSubscription ? selectedSubscription.price : "";
    },
    getSubscriptionDuration(selectedId) {
      const selectedSubscription = this.subscriptionplan.find(
        (subscription) => subscription.id === selectedId
      );
      return selectedSubscription ? selectedSubscription.duration : "";
    },
    formattedMonthlyPrice(price, duration) {
      let monthlyPrice = price;

      if (duration === "yearly") {
        monthlyPrice /= 12; // Divide by 12 for yearly
      } else if (duration === "quarterly") {
        monthlyPrice /= 3; // Divide by 3 for quarterly
      } else {
        monthlyPrice /= 12; // Divide by 3 for quarterly
      }

      return monthlyPrice.toFixed(2);
    },
    getMonthlyPrice() {
      if (this.subscription.duration === "yearly") {
        return (this.subscription.price / 12).toFixed(2);
      } else if (this.subscription.duration === "quarterly") {
        return (this.subscription.price / 3).toFixed(2);
      }
      // Add additional conditions for other durations if needed
      return this.subscription.price;
    },
    selectPayment(payment) {
      if (this.currentStep < this.steps - 1) {
        this.currentStep++;
      }
      this.selectedPayment = payment;
      // Set the component based on the selected payment method
      if (payment === "Stripe") {
        this.selectedPaymentComponent = "SubscriptionStripe";
      } else if (payment === "PayPal") {
        this.selectedPaymentComponent = "PayPalButton";
      }
    },
    loadIntent() {
      axios.get("/api/get-stripe-intent").then(
        function (response) {
          this.intentToken = response.data?.token;
        }.bind(this)
      );
    },
    loadPlanDetail(id) {
      this.isLoading = true;
      document.body.style.overflow = "hidden";
      axios.get("/api/v1/plan/" + id).then(
        function (response) {
          this.planDetail = response.data;
          this.isLoading = false;
          document.body.style.overflow = "visible";
        }.bind(this)
      );
    },
    checkSubscription() {
      axios({
        method: "GET",
        headers: {
          "content-type": "application/x-www-form-urlencoded",
          Authorization: "Bearer " + localStorage.userToken,
          "X-Requested-With": "XMLHttpRequest",
        },
        url: "api/v1/user/subscription",
      })
        .then((res) => {
          this.isSubscribed = res.data.subscription;
          this.isLoading = false;
          document.body.style.overflow = "visible";
        })
        .catch((error) => {
          if (error.response) {
            this.isSubscribed = false;
          } else {
            this.isSubscribed = false;
          }
          this.isLoading = false;
          document.body.style.overflow = "visible";
        });
    },
    loadPaymentMethods() {
      this.paymentMethodsLoadStatus = 1;
      axios.get("/api/v1/user/payment-methods").then(
        function (response) {
          this.paymentMethods = response.data;
          this.paymentMethodsLoadStatus = 2;
        }.bind(this)
      );
      // this.isLoading = false;
      document.body.style.overflow = "hidden";
    },
    configureStripe() {
      this.stripe = Stripe(
        "sk_test_51O9rjwHgAJ2a2cU6LHAf6OCLQECdubOAEQdG8Md8hmIvRKkuVfLHbcrKvAG6KGHGARaeJ09zk25mkgZPQWhfY96y00w2MY0SB8"
      );
      this.elements = this.stripe.elements();
      this.card = this.elements.create("payment");
      this.card.mount("#card-element");
    },
    nextStep() {
      localStorage.setItem("plan_id", this.selectedPlan);
      if (this.currentStep < this.steps - 1) {
        if (this.checkSelection()) {
          console.log("next step inser side");

          this.currentStep++; // Assuming currentStep controls the form steps
        }
      }
    },
    includeStripe(URL, callback) {
      let documentTag = document,
        tag = "script",
        object = documentTag.createElement(tag),
        scriptTag = documentTag.getElementsByTagName(tag)[0];
      object.src = "//" + URL;
      if (callback) {
        object.addEventListener(
          "load",
          function (e) {
            callback(null, e);
          },
          false
        );
      }
      scriptTag.parentNode.insertBefore(object, scriptTag);
    },
    previousStep() {
      if (this.currentStep > 0) {
        this.currentStep--;
      }
    },
    submit() {
      // You will be redirected to Stripe's secure checkout page
      this.$refs.checkoutRef.redirectToCheckout();
    },

    async getPaymentIntentNew(data) {
      try {
        const response = await axios.get(`/api/get-intent`);
        console.log(response.data);
        console.log(this.payableTotal);
        // this.includeStripe('js.stripe.com/v3/', function () {
        //     this.configureStripe();
        // }.bind(this));
        // this.loadIntent();
        // this.selectedPlan = this.$route.query.plan;
        // this.loadPlanDetail(this.selectedPlan);
        // this.loadPaymentMethods();
        // this.checkSubscription();

        // Handle the response data as needed
      } catch (error) {
        console.error("Error getting data:", error);
        // Handle the error
      }
    },

    async getPlan() {
      axios
        .get(`/api/get-subscription-plans`)
        .then((response) => {
          this.subscriptionplan = response.data.subscription; // Store the retrieved coupons in the data property
          this.regisitrationDiscount = response.data.settings; // Store the retrieved coupons in the data property
          console.log("subscriptionplan", this.subscriptionplan);
        })
        .catch((error) => {
          console.error("Error getting coupons:", error);
          this.errorMessage = "Error getting coupons"; // Set an error message
        });
    },
  },
};
</script>
<style scoped>
/* @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap"); */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");

.bg-green {
  background-color: #00b050;
}
.modal-header {
  border: unset;
}
.title-section h3 {
  font-size: 20px;
  font-weight: 500;
}
* {
  font-family: "Open Sans", sans-serif;
}
.modal-content.printReceipt {
  border: unset;
}
/* Your CSS styles for modal here */
#receiptContainer {
  font-family: "Helvetica Neue", Helvetica, "Segoe UI", Arial, sans-serif;
  font-size: 13px;
}
table#recipt {
  font-size: 19px;
  font-weight: 600;
}
.inner-content.title-section {
  font-size: 18px;
  border-bottom: 1px solid;
  padding-top: 12px;
}
.title-section {
  font-size: 18px;
  border-bottom: 1px solid;
  padding-top: 12px;
}
img.img-logo {
  width: 100%;
  max-width: 112px;
}
#receiptContainer .container {
  margin-top: 40px;
}
#receiptContainer .col-md-6,
#receiptContainer .col-xs-6 {
  width: 50%;
}

#receiptContainer .col-md-7,
#receiptContainer .col-xs-7 {
  width: 58.333333%;
}
.detail-receipt .title-section {
  font-size: 20px;
  border-bottom: 1px solid;
  padding-top: 19px;
  font-weight: 700;
  padding-left: 11px;
}

table#recipt td {
  font-size: 13px;
  padding: 7px;
}
#receiptContainer.col-md-5,
#receiptContainer.col-xs-5 {
  width: 41.666667%;
}

#receiptContainer .row {
  display: flex;
  flex-wrap: wrap;
  margin-right: -15px;
  margin-left: -15px;
}

#receiptContainer .text-right {
  text-align: right;
}

#receiptContainer img {
  width: 100px;
  height: 120px;
}

#receiptContainer .title-section {
  font-size: 16px;
  letter-spacing: 1px;
  border-bottom: 2px #666666 solid;
  padding-bottom: 10px;
}

#receiptContainer table {
  width: 100%;
  margin-top: 20px;
}

#recipt td {
  /* border: 1px solid #666666; */
  border-collapse: collapse;
  font-size: 16px;
}

#receiptContainer th,
td {
  padding: 1px;
}

#receiptContainer hr {
  border-top: 1px solid #666666;
}
table#recipt {
  width: 100%;
}

table#recipt td {
  /* text-align: center !important; */
}
.time-date {
  font-size: 20px;
}

.time-date:first-child {
  font-weight: 300;
  font-size: 18px;
}

.border-bottom {
  border-bottom: 1px solid !important;
}
.modal-backdrop {
  position: absolute !important;
}
@media (min-width: 576px) {
  .modal-backdrop {
    position: absolute !important;
  }
  .modal-dialog {
    max-width: 850px;
    margin: 1.75rem auto;
  }
}
.btn-apply {
  background-color: #e8e8e8 !important;
}
.input-group {
  flex-wrap: initial !important;
}
.pt-35 {
  padding-top: 0.5rem;
  display: block;
}
.capital-duration {
  text-transform: capitalize;
  font-size: 18px;
  font-weight: 400;
}
.border-buttom {
  border: 1px solid #8a8383;
  border-left: none;
  border-top: none;
  border-right: none;
}

.inner-content {
  /* display: flex; */
  align-items: start;
  width: 100%;
}

.btn-options button {
  margin: 7px;
}

.value-text h2 {
  margin: 0;
}

.value-text h3 {
  margin: 6px 0;
  font-weight: 700;
}

.price-month p {
  color: black;
  font-size: 18px;
}
.value-text h4 {
  font-size: 18px;
}
.subscription-info {
  max-width: 600px;
  margin: 0 auto;
}

.info-item {
  margin-bottom: 15px;
}

.value-text p {
  margin: 0;
  color: black;
  font-size: 22px;
  font-weight: 500;
}

label.custom-radio input {
  margin-top: 10px;
  margin-right: 16px;
}

.content-sect {
  display: flex;
  justify-content: space-between;
  width: 97%;
}

.radio-btn-green {
  width: 5%;
}

.radio-card {
  border: 1px solid grey;
  width: 100%;
  margin: auto;
  border-radius: 16px;
  padding: 25px;
}

html {
  height: 100%;
}

p {
  color: grey;
}

#heading {
  text-transform: uppercase;
  color: #673ab7;
  font-weight: normal;
}

#msform {
  text-align: center;
  position: relative;
  margin-top: 20px;
}

#msform fieldset {
  background: white;
  border: 0 none;
  border-radius: 0.5rem;
  box-sizing: border-box;
  width: 100%;
  margin: 0;
  padding-bottom: 20px;
  position: relative;
}

.form-card {
  text-align: left;
}

#msform fieldset:not(:first-of-type) {
  display: none;
}

#msform input,
#msform textarea {
  padding: 8px 15px 8px 15px;
  border: 1px solid #ccc;
  border-radius: 0px;
  margin-bottom: 25px;
  margin-top: 13px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2c3e50;
  background-color: #eceff1;
  font-size: 16px;
  letter-spacing: 1px;
}

#msform input:focus,
#msform textarea:focus {
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  border: 1px solid #673ab7;
  outline-width: 0;
}

div#payment-section p {
  text-align: justify;
  margin-bottom: 12px;
  font-size: 16px;
  color: #212529;
  font-weight: 500;
}

#msform .action-button {
  /* width: 100px; */

  /* padding: 10px 19px; */
  margin-top: 10px;
  float: right;
}

.btn {
  display: inline-block;
  font-weight: 400;
  color: #212529;
  text-align: center;
  vertical-align: middle;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
  background-color: transparent;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-primary {
  color: #fff;
  background-color: #007bff;
  border-color: #007bff;
}

.btn-sm,
.btn-group-sm > .btn {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5;
  border-radius: 0.2rem;
}

#msform .action-button:hover,
#msform .action-button:focus {
  background-color: #311b92;
}

#msform .action-button-previous {
  font-weight: bold;
  border: 0 none;
  border-radius: 0px;
  font-weight: bold;
  color: white;
  cursor: pointer;

  float: left;
  background: #616161;
  /* margin-left: 7px; */
  font-size: 13px;
  font-weight: 500;
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
  background-color: #000000;
}

/*The background card*/
.card {
  z-index: 0;
  border: none;
  position: relative;
}

/*FieldSet headings*/
.fs-title {
  font-size: 25px;
  color: #673ab7;
  margin-bottom: 15px;
  font-weight: normal;
  text-align: left;
}

.purple-text {
  color: #673ab7;
  font-weight: normal;
}

/*Step Count*/
.steps {
  font-size: 25px;
  color: gray;
  margin-bottom: 10px;
  font-weight: normal;
  text-align: right;
}

/*Field names*/
.fieldlabels {
  color: gray;
  text-align: left;
}

/*Icon progressbar*/
#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  color: lightgrey;
}

#progressbar .active {
  color: #00b050;
}

#progressbar li {
  list-style-type: none;
  font-size: 15px;
  width: 25%;
  float: left;
  position: relative;
  font-weight: 400;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
  font-family: FontAwesome;
  content: url(/images/deactive-tab.svg);
  background: unset;
  display: block;
  position: absolute;
  left: -13px;
  top: 8px;
}
#progressbar .active:before {
  font-family: FontAwesome;
  content: url(/images/active-tab.svg) !important;
}

#progressbar li:before {
  width: 50px;
  height: 50px;
  line-height: 45px;
  display: block;
  font-size: 20px;
  color: #ffffff;
  background: lightgray;
  border-radius: 50%;
  margin: 0 auto 10px auto;

  padding: 2px;
}

/*ProgressBar connectors*/

#progressbar li:after {
  content: "";
  width: 170%;
  height: 2px;
  background: lightgray;
  position: absolute;
  left: 0;
  top: 25px;

  z-index: -1;
}

/*Color number of the step and the connector before it*/

li#account strong.inner-list {
  position: absolute;
  top: 50px;
  left: -8px;
}

li#personal strong {
  position: absolute;
  top: 50px;
  left: 23%;
}

li#payment strong.inner-list {
  position: absolute;
  top: 50px;
  right: -100px;
}

li#confirm::before {
  content: url(/images/deactive-tab.svg);
  background: unset !important;
  position: absolute;
  right: -110px;
  top: 7px;
}

li#confirm strong.inner-list {
  position: absolute;
  top: 50px;
  right: -110px;
}

/*Animated Progress Bar*/
.progress {
  height: 20px;
}

.progress-bar {
  background-color: #00b050;
}

/*Fit image in bootstrap div*/
.fit-image {
  width: 100%;
  object-fit: cover;
}

/* #progressbar li.active:before,
#progressbar li.active:after {
  background-color:#00B050;
} */
li#personal::before {
  font-family: FontAwesome;
  content: url(/images/deactive-tab.svg);
  background: unset;
  top: 9px;
  position: absolute;
  left: 23%;
}
ul#progressbar {
  height: 105px;
}
ul#progressbar {
  height: 105px;
}

.main-list {
  border-bottom: 1px solid transparent !important;
}
.main-list {
  border-bottom: 1px solid transparent;
}

li#payment::before {
  font-family: FontAwesome;
  content: url(/images/deactive-1-tab.svg) !important;
  background: unset;
  position: absolute;
  top: 8px;
  right: -100px;
}
.progress {
  height: 20px;
}

.progress-bar {
  background-color: #00b050;
}

.fit-image {
  width: 100%;
  object-fit: cover;
}

.outer-div {
  border: 1px solid gray;
  width: 100%;
  max-width: 950px;
  margin: auto;
  margin-bottom: 100px;
  margin-top: 50px;
  border-radius: 30px;
}

.inner-div {
  border: 1px solid gray;
  width: 100%;
  max-width: 780px;
  margin: auto;
  margin-bottom: 100px;
  margin-top: 50px;
  border-radius: 10px;
}

#payment-section h2 {
  font-weight: 800;
}
h2,
.h2 {
  font-size: 1.5rem;
}
h3,
.h3 {
  font-size: 1.5rem;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
}

.radio {
  margin: 0.5rem;

  input[type="radio"] {
    position: absolute;
    opacity: 0;

    + .radio-label {
      &:before {
        content: "";
        background: #f4f4f4;
        border-radius: 100%;
        border: 1px solid darken(#f4f4f4, 25%);
        display: inline-block;
        width: 1.4em;
        height: 1.4em;
        position: relative;
        top: -0.2em;
        margin-right: 1em;
        vertical-align: top;
        cursor: pointer;
        text-align: center;
        transition: all 250ms ease;
      }
    }

    &:checked {
      + .radio-label {
        &:before {
          background-color: #3197ee;
          box-shadow: inset 0 0 0 4px #f4f4f4;
        }
      }
    }

    &:focus {
      + .radio-label {
        &:before {
          outline: none;
          border-color: #3197ee;
        }
      }
    }

    &:disabled {
      + .radio-label {
        &:before {
          box-shadow: inset 0 0 0 4px #f4f4f4;
          border-color: darken(#f4f4f4, 25%);
          background: darken(#f4f4f4, 25%);
        }
      }
    }

    + .radio-label {
      &:empty {
        &:before {
          margin-right: 0;
        }
      }
    }
  }
}
@keyframes reveal-message {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.success {
  color: green;
}

.success::before {
  content: "✓";
  background-color: #eff;
  box-shadow: 0px 0px 12px 7px rgba(200, 255, 150, 0.8) inset;
  border: 5px solid green;
}

@keyframes reveal {
  0% {
    border: 5px solid transparent;
    color: transparent;
    box-shadow: 0px 0px 12px 7px rgba(255, 250, 250, 0.8) inset;
    transform: rotate(1000deg);
  }
  25% {
    border-top: 5px solid gray;
    color: transparent;
    box-shadow: 0px 0px 17px 10px rgba(255, 250, 250, 0.8) inset;
  }
  50% {
    color: transparent;
    box-shadow: 0px 0px 17px 10px rgba(200, 200, 200, 0.8) inset;
  }
  75% {
    border-bottom: 5px solid gray;
    color: gray;
    box-shadow: 0px 0px 12px 7px rgba(200, 200, 200, 0.8) inset;
  }
  100% {
    border: 5px solid gray;
    box-shadow: 0px 0px 12px 7px rgba(200, 200, 200, 0.8) inset;
  }
}
.success-animation {
  margin: 0px 6px 9px 40px;
}

.checkmark {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #4bb71b;
  stroke-miterlimit: 10;
  box-shadow: inset 0px 0px 0px #4bb71b;
  animation: fill 0.4s ease-in-out 0.4s forwards,
    scale 0.3s ease-in-out 0.9s both;
  position: relative;
  top: 5px;
  right: 5px;
  margin: 0 auto;
}
.checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #4bb71b;
  fill: #fff;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes scale {
  0%,
  100% {
    transform: none;
  }

  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}

@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #4bb71b;
  }
}

.modal-header {
  display: block !important;
}

.form-control {
  background-color: #4472c4 !important;
}

.hr_line {
  margin-top: 10px !important;
  margin-bottom: 10px !important;
  border: 0 !important;
  border-top: 2px solid rgb(0 0 0 / 38%) !important;
}

@media print {
  button#on-print-none {
    display: none !important;
  }
  div#on-print-none {
    display: none !important;
  }
}
p {
  color: #212529;
}
div#payment-section .bottom-text {
  text-align: justify;
  margin-bottom: 12px;
  font-size: 16px;
  color: #212529;
  font-weight: 500;
  padding-left: 17px;
}
span.number {
  display: flex;
  position: absolute;
  font-size: 16px;
  color: #212529;
  font-weight: 500;
}
.pointer-cursor {
  cursor: pointer;
}
</style>
