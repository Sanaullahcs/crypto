<template>
  <layout>
    <div class="container-fluid pb-5">
      <div class="">
        <div class="card br-10 mw-550 m-auto border">
          <div class="card-body p-4">
            <form id="msform">
              <!-- progressbar -->
              <ul id="progressbar">
                <li
                  class="main-list"
                  :class="{ active: currentStep === 0 }"
                  id="account"
                >
                  <strong class="inner-list">Step1</strong>
                </li>
                <li :class="{ active: currentStep === 1 }" id="personal">
                  <strong>Step2</strong>
                </li>
                <li
                  class="main-list"
                  :class="{ active: currentStep === 2 }"
                  id="payment"
                >
                  <strong class="inner-list">Step3</strong>
                </li>
                <li
                  class="main-list"
                  :class="{ active: currentStep === 3 }"
                  id="confirm"
                >
                  <strong class="inner-list"> Finish</strong>
                </li>
              </ul>

              <!-- fieldsets -->
              <fieldset v-if="currentStep === 0">
                <div v-show="showModal" id="openModal1" class="modalDialog1">
                  <div class="overlay">
                    <a href="#" title="Close" class="close1" @click="closeModal"
                      >X</a
                    >
                    <div class="modal-head1">
                      <div class="modal-header1">
                        flame
                        <h2 class="modal-title1 text-white" id="purchaseLabel">
                          <span>Wait! Before you go..</span>
                        </h2>
                      </div>
                      <div class="modal-body1">
                        <p class="text-white" style="font-size: 19px">
                          Get an exclusive {{ Subdiscount }}% off on Your First
                          Order with coupon: (
                          <strong>{{ SubcouponName }}</strong> ) *
                        </p>
                        <div class="middle-section1">
                          <div class="hero connect-page">
                            <div class="container">
                              <div class="hero-body">
                                <div class="campaign campaign-0">
                                  <div class="counter timer">
                                    <div class="counter-boxes">
                                      <div class="count-box">
                                        <h1 class="value text-white day">
                                          {{ days }}
                                        </h1>
                                        <span>Days</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white hour">
                                          {{ hours }}
                                        </h1>
                                        <span>Hours</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white minute">
                                          {{ minutes }}
                                        </h1>
                                        <span>Minutes</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white second">
                                          {{ seconds }}
                                        </h1>
                                        <span>Seconds</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p class="heading text-white">
                          Hurry up! This offer is valid for the next {{ days }}
                          {{ hours }} {{ minutes }} {{ seconds }} only.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-backdrop1" @click="closeModal"></div>
                </div>

                <div class="form-card pl-1">
                  <h3 class="font-weight-bolder">Payment Plan</h3>
                  <!-- <p

                    class="col-12 pl-0"
                    >In The free trail, <strong>Crypto Wiz Guy</strong> Verifies
                    your card for $0.99, and this fee is subtract from the plan
                    cost upon subscription.</p -->
                </div>
                <div class="row p-3">
                  <div
                    class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 p-0 mt-3 mb-2"
                    id="payment-section"
                    v-for="(subscription, index) in subscriptionplan"
                    :key="index"
                  >
                    <div class="radio-card">
                      <div class="inner-content" style="display: flex">
                        <div class="radio-btn-green">
                          <label
                            class="custom-radio pointer-cursor"
                            :for="'subscription_' + subscription.id"
                          >
                            <input
                              type="radio"
                              :id="'subscription_' + subscription.id"
                              name="radio"
                              :value="subscription.id"
                              v-model="selectedPlan"
                            />
                          </label>
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
                              <span class="capital-duration">{{
                                subscription.duration
                              }}</span>
                            </p>
                          </label>

                          <div class="price-month">
                            <p v-if="subscription.duration != 'monthly'">
                              ${{
                                formattedMonthlyPrice(
                                  subscription.price,
                                  subscription.duration
                                )
                              }}/mo
                            </p>

                            <p>$ {{ subscription.price }}</p>
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
                <button
                  @click="nextStep"
                  :disabled="!checkSelection()"
                  class="next action-button btn-sm btn btn-primary"
                >
                  Next
                </button>
              </fieldset>
              <fieldset v-if="currentStep === 1">
                <div v-show="showModal" id="openModal1" class="modalDialog1">
                  <div class="overlay">
                    <a href="#" title="Close" class="close1" @click="closeModal"
                      >X</a
                    >
                    <div class="modal-head1">
                      <div class="modal-header1">
                        flame
                        <h2 class="modal-title1 text-white" id="purchaseLabel">
                          <span>Wait! Before you go..</span>
                        </h2>
                      </div>
                      <div class="modal-body1">
                        <p class="text-white" style="font-size: 19px">
                          Get an exclusive {{ Subdiscount }}% off on Your First
                          Order with coupon: (
                          <strong>{{ SubcouponName }}</strong> ) *
                        </p>
                        <div class="middle-section1">
                          <div class="hero connect-page">
                            <div class="container">
                              <div class="hero-body">
                                <div class="campaign campaign-0">
                                  <div class="counter timer">
                                    <div class="counter-boxes">
                                      <div class="count-box">
                                        <h1 class="value text-white day">
                                          {{ days }}
                                        </h1>
                                        <span>Days</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white hour">
                                          {{ hours }}
                                        </h1>
                                        <span>Hours</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white minute">
                                          {{ minutes }}
                                        </h1>
                                        <span>Minutes</span>
                                      </div>
                                      <div class="count-box">
                                        <h1 class="value text-white second">
                                          {{ seconds }}
                                        </h1>
                                        <span>Seconds</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p class="heading text-white">
                          Hurry up! This offer is valid for the next {{ days }}
                          {{ hours }} {{ minutes }} {{ seconds }} only.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="modal-backdrop1" @click="closeModal"></div>
                </div>

                <div class="form-card">
                  <div class="form-card">
                    <h3 class="font-weight-bolder">Payment Options</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <button
                          class="btn btn-primary btn-sm mt-4"
                          @click="selectPayment('Stripe')"
                        >
                          Stripe
                        </button>
                      </div>
                      <div class="col-md-6">
                        <button
                          class="btn btn-primary btn-sm mt-4"
                          @click="selectPayment('PayPal')"
                        >
                          PayPal
                        </button>
                      </div>
                    </div>
                    <div class="btn-options"></div>
                  </div>
                </div>
                <!-- <button
                  @click="nextStep"
                  class="next action-button btn btn-primary btn-sm"
                >
                  Next
                </button> -->
                <button
                  @click="previousStep"
                  class="previous action-button-previous btn-sm btn-primary my-2"
                >
                  Previous
                </button>
              </fieldset>
              <fieldset v-if="currentStep === 2">
                <div class="form-card">
                  <span v-if="selectedPaymentComponent == 'SubscriptionStripe'">
                    <div v-if="selectedPlan">
                      <!-- Add more details as needed -->
                    </div>
                    <div class="row pb-3">
                      <h3 class="font-weight-bolder pb-3">Pay with Stripe</h3>
                      <div
                        class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 p-0 mt-3 mb-2"
                        id="payment-section"
                      >
                        <div class="radio-card">
                          <div class="inner-content" style="display: flex">
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  {{ getSubscriptionName(selectedPlan) }}
                                  <span class="capital-duration"
                                    >({{
                                      getSubscriptionDuration(selectedPlan)
                                    }})</span
                                  >
                                </h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{ getSubscriptionPrice(selectedPlan) }} $
                                </p>
                              </div>
                            </div>
                          </div>

                          <div
                            class="inner-content border-buttom"
                            style="display: flex"
                            v-if="
                              !discount || (discount && discountAmount === 0)
                            "
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  Registration Discount
                                  <span class="capital-duration"
                                    >({{ regisitrationDiscount }} %)</span
                                  >
                                </h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    (getSubscriptionPrice(selectedPlan) / 100) *
                                    regisitrationDiscount
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>
                          <div
                            v-if="
                              !discount || (discount && discountAmount === 0)
                            "
                            class="inner-content"
                            style="display: flex"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>Payable</h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    getSubscriptionPrice(selectedPlan) -
                                    (getSubscriptionPrice(selectedPlan) / 100) *
                                      regisitrationDiscount
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- The part of HTML where you want to display discount information -->
                          <div
                            class="inner-content border-buttom"
                            v-if="discount && discountAmount !== 0"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  Discount
                                  <span class="capital-duration"
                                    >({{ discount }} %)</span
                                  >
                                </h3>
                              </div>

                              <div class="price-month">
                                <p>
                                  {{
                                    (
                                      (getSubscriptionPrice(selectedPlan) /
                                        100) *
                                      discount
                                    ).toFixed(2)
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>

                          <div
                            class="inner-content"
                            v-if="discount && discountAmount !== 0"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>Payable Total</h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    (
                                      getSubscriptionPrice(selectedPlan) -
                                      (getSubscriptionPrice(selectedPlan) /
                                        100) *
                                        discount
                                    ).toFixed(2)
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card mb-3 pt-3">
                          <div class="card-body">
                            <div class="form-group">
                              <label>Have an extended trial code?</label>
                              <form method="post" @submit.prevent="applyCoupon">
                                <div class="input-group">
                                  <input
                                    v-model="promocode"
                                    type="text"
                                    class="form-control coupon my-2 bg-primary text-white"
                                    placeholder="code"
                                  />
                                  <span class="input-group-append pt-35">
                                    <button
                                      :disabled="!promocode"
                                      class="btn btn-dafault btn-apply coupon"
                                    >
                                      Apply
                                    </button>
                                  </span>
                                </div>
                              </form>
                              <div
                                v-if="successMessage"
                                class="text-white bg-green p-2 w-50"
                              >
                                {{ successMessage }}
                              </div>

                              <!-- Error Message -->
                              <div
                                v-if="errorMessage"
                                class="text-danger bg-yellow p-2 w-50"
                              >
                                {{ errorMessage }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- {{payableTotal}} -->
                    <SubscriptionStripe
                      :price="payableTotal"
                      @payment_success="nextStep()"
                    />
                  </span>
                  <span v-if="selectedPaymentComponent == 'PayPalButton'">
                    <div class="row pb-3">
                      <h3 class="font-weight-bolder pb-3">Pay with Paypal</h3>
                      <div
                        class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-12 p-0 mt-3 mb-2"
                        id="payment-section"
                      >
                        <div class="radio-card">
                          <div class="inner-content" style="display: flex">
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  {{ getSubscriptionName(selectedPlan) }}
                                  <span class="capital-duration"
                                    >({{
                                      getSubscriptionDuration(selectedPlan)
                                    }})</span
                                  >
                                </h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{ getSubscriptionPrice(selectedPlan) }} $
                                </p>
                              </div>
                            </div>
                          </div>

                          <div
                            class="inner-content border-buttom"
                            style="display: flex"
                            v-if="
                              !discount || (discount && discountAmount === 0)
                            "
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  Registration Discount
                                  <span class="capital-duration"
                                    >({{ regisitrationDiscount }} %)</span
                                  >
                                </h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    (getSubscriptionPrice(selectedPlan) / 100) *
                                    regisitrationDiscount
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>
                          <div
                            v-if="
                              !discount || (discount && discountAmount === 0)
                            "
                            class="inner-content"
                            style="display: flex"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>Payable</h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    getSubscriptionPrice(selectedPlan) -
                                    (getSubscriptionPrice(selectedPlan) / 100) *
                                      regisitrationDiscount
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>
                          <!-- The part of HTML where you want to display discount information -->
                          <div
                            class="inner-content border-buttom"
                            v-if="discount && discountAmount !== 0"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>
                                  Discount
                                  <span class="capital-duration"
                                    >({{ discount }} %)</span
                                  >
                                </h3>
                              </div>

                              <div class="price-month">
                                <p>
                                  {{
                                    (
                                      (getSubscriptionPrice(selectedPlan) /
                                        100) *
                                      discount
                                    ).toFixed(2)
                                  }}
                                  $
                                </p>
                              </div>
                            </div>
                          </div>

                          <div
                            class="inner-content"
                            v-if="discount && discountAmount !== 0"
                          >
                            <div class="content-sect">
                              <div
                                class="value-text justify-content-left text-left pl-3 pb-0"
                              >
                                <h3>Payable Total</h3>
                              </div>
                              <div class="price-month">
                                <p>
                                  {{
                                    (
                                      getSubscriptionPrice(selectedPlan) -
                                      (getSubscriptionPrice(selectedPlan) /
                                        100) *
                                        discount
                                    ).toFixed(2)
                                  }}$
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card mb-3 pt-3">
                          <div class="card-body">
                            <div class="form-group">
                              <label>Have an extended trial code?</label>
                              <form method="post" @submit.prevent="applyCoupon">
                                <div class="input-group">
                                  <input
                                    v-model="promocode"
                                    type="text"
                                    class="form-control coupon my-2 bg-primary text-white"
                                    placeholder="code"
                                  />
                                  <span class="input-group-append pt-35">
                                    <button
                                      :disabled="!promocode"
                                      class="btn btn-dafault btn-apply coupon"
                                    >
                                      Apply
                                    </button>
                                  </span>
                                </div>
                              </form>
                              <div
                                v-if="successMessage"
                                class="text-white bg-green p-2 w-50"
                              >
                                {{ successMessage }}
                              </div>

                              <!-- Error Message -->
                              <div
                                v-if="errorMessage"
                                class="text-danger bg-yellow p-2 w-50"
                              >
                                {{ errorMessage }}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <PayPalButton
                      :price="payableTotal"
                      @payment_success="nextStep()"
                    />
                  </span>
                </div>
                <!-- <button
                  @click="nextStep"
                  class="next action-button btn btn-primary btn-sm"
                >
                  Submit
                </button> -->
                <button
                  @click="previousStep"
                  class="previous action-button-previous btn-sm btn-primary my-2"
                >
                  Previous
                </button>
              </fieldset>
              <fieldset v-if="currentStep === 3">
                <div class="form-card">
                  <!-- Content Start -->
                  <table
                    cellpadding="0"
                    cellspacing="0"
                    cols="1"
                    bgcolor="#d7d7d7"
                    align="center"
                    style="width: 100%"
                  >
                    <!-- This encapsulation is required to ensure correct rendering on Windows 10 Mail app. -->
                    <tr bgcolor="#d7d7d7">
                      <td
                        style="
                          color: #464646;
                          font-family: 'Helvetica Neue', Helvetica, Arial,
                            sans-serif;
                          font-size: 14px;
                          line-height: 16px;
                          vertical-align: top;
                        "
                      >
                        <!-- Generic Pod Left Aligned with Price breakdown Start -->
                        <table
                          align="center"
                          cellpadding="0"
                          cellspacing="0"
                          cols="3"
                          bgcolor="white"
                          class="bordered-left-right"
                          style="width: 100%"
                        >
                          <tr height="50">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr align="center">
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              class="text-primary"
                              style="
                                color: #f16522;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            >
                              <div class="success-animation">
                                <svg
                                  class="checkmark"
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 52 52"
                                >
                                  <circle
                                    class="checkmark__circle"
                                    cx="26"
                                    cy="26"
                                    r="25"
                                    fill="none"
                                  />
                                  <path
                                    class="checkmark__check"
                                    fill="none"
                                    d="M14.1 27.2l7.1 7.2 16.7-16.8"
                                  />
                                </svg>
                              </div>
                            </td>
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr height="17">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr align="center">
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              class="text-primary"
                              style="
                                color: #f16522;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            >
                              <h1
                                style="
                                  color: #000;
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 30px;
                                  font-weight: 700;
                                  line-height: 34px;
                                  margin-bottom: 0;
                                  margin-top: 0;
                                "
                              >
                                Trial Period Activated
                              </h1>
                            </td>
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr height="30">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr align="left">
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            >
                              <p
                                style="
                                  color: #464646;
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 14px;
                                  line-height: 22px;
                                  margin: 0;
                                "
                              >
                                Hi
                                <strong
                                  >{{ first_name }} {{ last_name }} </strong
                                >,
                              </p>
                            </td>
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr height="10">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr align="left">
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            >
                              <p
                                style="
                                  color: #464646;
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 14px;
                                  line-height: 22px;
                                  margin: 0;
                                "
                              ></p>
                              <br />
                              <p
                                style="
                                  color: #464646;
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 14px;
                                  line-height: 22px;
                                  margin: 0;
                                "
                              >
                                Thank you for choosing our service! Your trial
                                period has been successfully activated. You now
                                have full access to our platform's features for
                                the next 7 days. An email confirmation has been
                                sent to the provided email address. Enjoy
                                exploring our services, and should you have any
                                questions or need assistance, feel free to reach
                                out to our support team. Happy exploring!.<br />

                                <!-- Amount: €$moneyFormatter.format(${amount}) <br/> -->
                                <!-- Account: ${accountNumber}.<br/> -->
                              </p>
                              <br />
                              <p
                                style="
                                  color: #464646;
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 14px;
                                  line-height: 22px;
                                  margin: 0;
                                "
                              >
                                We advise to keep this email for future
                                reference.&nbsp;&nbsp;&nbsp;&nbsp;<br />
                              </p>
                            </td>
                            <td
                              width="36"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr height="30">
                            <td
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              style="
                                border-bottom: 1px solid #d3d1d1;
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                          <tr height="30">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>

                          <tr data-v-2b82409c="" align="center">
                            <td
                              data-v-2b82409c=""
                              width="36"
                              style="
                                color: rgb(70, 70, 70);
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                            <td
                              data-v-2b82409c=""
                              class="text-primary"
                              style="
                                color: rgb(241, 101, 34);
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            >
                              <h1
                                data-v-2b82409c=""
                                style="
                                  color: rgb(0, 0, 0);
                                  font-family: 'Helvetica Neue', Helvetica,
                                    Arial, sans-serif;
                                  font-size: 30px;
                                  font-weight: 700;
                                  line-height: 34px;
                                  margin-bottom: 0px;
                                  margin-top: 0px;
                                "
                              >
                                <button
                                  @click.prevent="showReceiptModal"
                                  class="btn btn-sm btn-primary"
                                  data-toggle="modal"
                                  data-target="#myModalDiscount"
                                >
                                  view invoice
                                </button>
                                &nbsp;&nbsp;
                                <button
                                  v-on:click="() => $router.push('/calculator')"
                                  class="btn btn-sm btn-primary"
                                >
                                  Calculator
                                </button>
                              </h1>
                            </td>
                            <td
                              data-v-2b82409c=""
                              width="36"
                              style="
                                color: rgb(70, 70, 70);
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>

                          <tr height="50">
                            <td
                              colspan="3"
                              style="
                                color: #464646;
                                font-family: 'Helvetica Neue', Helvetica, Arial,
                                  sans-serif;
                                font-size: 14px;
                                line-height: 16px;
                                vertical-align: top;
                              "
                            ></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                  <!-- Content End -->
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div
      id="myModalDiscount"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content printReceipt">
          <div class="modal-header">
            <button
              type="button"
              class="close"
              id="on-print-none"
              data-dismiss="modal"
            >
              &times;
            </button>
            <h4 class="modal-title text-center">TRANSACTION RECEIPT</h4>
          </div>
          <form method="post" @submit.prevent="SaveCoupon">
            <div class="container" id="receiptContainer">
              <div class="row">
                <!-- <div class="col-md-6 col-xs-6">Company LTD 2016</div> -->
                <div class="col-md-12 col-xs-12 text-right">
                  Date: {{ formattedDate }}
                </div>
              </div>
            </div>

            <div class="container">
              <div class="row">
                <div class="col-md-12 col-xs-12 text-center">
                  <a
                    href="javascript:void()"
                    v-on:click="() => $router.push('/')"
                    ><img :src="Logo" alt="logo" class="img-logo"
                  /></a>
                </div>
                <div
                  class="col-md-12 col-xs-12 text-left"
                  style="padding-top: 20px"
                >
                  <div
                    style="
                      font-size: 22px;
                      font-weight: bold;
                      padding-bottom: 6px;
                    "
                  >
                    Name: {{ first_name }} {{ last_name }}
                  </div>
                  <div style="padding-bottom: 6px">
                    <p class="pl-3">
                      <b> ({{ email }})</b>
                    </p>
                  </div>
                  <div class="text-right">
                    <p>
                      <b>Payment Method</b>:
                      {{ lastsubscriptiondata.card_brand }}- **** ****
                      {{ lastsubscriptiondata.last4 }}
                    </p>
                    <p><b>Card Type</b>:{{ lastsubscriptiondata.type }}</p>
                    <p>
                      <b>Transaction number</b>:{{
                        lastsubscriptiondata.invoice_number
                      }}
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="container">
              <div class="transaction-type">
                <div
                  style="
                    text-align: center;
                    font-size: 18px;
                    font-weight: 300;
                    letter-spacing: 3;
                  "
                >
                  <!-- TRANSACTION RECEIPT -->
                </div>
                <!-- <div
                  style="
                    text-align: center;
                    font-size: 16px;
                    font-weight: 500;
                    letter-spacing: 1;
                  "
                >
                  Transaction Type
                </div> -->
              </div>
            </div>

            <div class="container" style="display: none">
              <div class="detail-receipt">
                <div class="title-section">TRANSACTION DETAILS</div>
                <div class="row" style="margin-top: 20px"></div>
              </div>
              <div class="radio-cards">
                <div
                  class="inner-content border-buttom"
                  style="display: flex"
                  v-if="!discount || (discount && discountAmount === 0)"
                >
                  <div class="content-sect">
                    <div
                      class="value-text justify-content-left text-left pl-3 pb-0"
                    >
                      <h3>
                        Registration Discount
                        <span class="capital-duration"
                          >({{ regisitrationDiscount }} %)</span
                        >
                      </h3>
                    </div>
                    <div class="price-month">
                      <p>
                        {{
                          (getSubscriptionPrice(selectedPlan) / 100) *
                          regisitrationDiscount
                        }}
                        $
                      </p>
                    </div>
                  </div>
                </div>
                <div
                  v-if="!discount || (discount && discountAmount === 0)"
                  class="inner-content"
                  style="display: flex"
                >
                  <div class="content-sect">
                    <div
                      class="value-text justify-content-left text-left pl-3 pb-0"
                    >
                      <h3>Payable</h3>
                    </div>
                    <div class="price-month">
                      <p>
                        {{
                          getSubscriptionPrice(selectedPlan) -
                          (getSubscriptionPrice(selectedPlan) / 100) *
                            regisitrationDiscount
                        }}$
                        <!-- .00$ -->
                      </p>
                    </div>
                  </div>
                </div>
                <!-- The part of HTML where you want to display discount information -->
                <div
                  class="inner-content border-buttom"
                  v-if="discount && discountAmount !== 0"
                >
                  <div class="content-sect">
                    <div
                      class="value-text justify-content-left text-left pl-3 pb-0"
                    >
                      <h3>
                        Discount
                        <span class="capital-duration">({{ discount }} %)</span>
                      </h3>
                    </div>

                    <div class="price-month">
                      <p>
                        {{
                          (
                            (getSubscriptionPrice(selectedPlan) / 100) *
                            discount
                          ).toFixed(2)
                        }}
                        $
                      </p>
                    </div>
                  </div>
                </div>

                <div
                  class="inner-content"
                  v-if="discount && discountAmount !== 0"
                >
                  <div class="content-sect">
                    <div
                      class="value-text justify-content-left text-left pl-3 pb-0"
                    >
                      <h3>Payable Total</h3>
                    </div>
                    <div class="price-month">
                      <p>
                        {{
                          (
                            getSubscriptionPrice(selectedPlan) -
                            (getSubscriptionPrice(selectedPlan) / 100) *
                              discount
                          ).toFixed(2)
                        }}
                        $ .00$
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="container">
              <div class="column-table">
                <div class="title-section">
                  <h3>Summary</h3>
                </div>
                <table id="recipt">
                  <thead>
                    <tr>
                      <td>Billed to</td>
                      <td style="text-align: ">{{ email }}</td>
                      <td style="text-align: ">Invoice number</td>
                      <td style="text-align: end">
                        {{ lastsubscriptiondata.id }}
                      </td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td>Currency</td>
                      <td style="text-align: end">USD - US Dollar</td>
                    </tr>
                  </tbody>
                </table>
                <table id="recipt" class="mt-3">
                  <thead class="title-section">
                    <tr>
                      <td>Name</td>
                      <td style="text-align: "></td>
                      <td style="text-align: "></td>
                      <td style="text-align: "></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        {{ formatDate(lastsubscriptiondata.created_at) }} -
                        {{ formatDate(lastsubscriptiondata.ends_at) }}
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>Standard price</td>
                      <td></td>
                      <td>$ {{ getSubscriptionPrice(selectedPlan) }}</td>
                    </tr>

                    <tr v-if="!discount || (discount && discountAmount === 0)">
                      <td>Less discount</td>
                      <td>{{ regisitrationDiscount }} % off</td>
                      <td>
                        {{
                          (getSubscriptionPrice(selectedPlan) / 100) *
                          regisitrationDiscount
                        }}
                      </td>
                    </tr>
                    <tr v-if="discount && discountAmount !== 0">
                      <td>Less discount</td>
                      <td>{{ discount }} % off</td>
                      <td>
                        {{
                          (getSubscriptionPrice(selectedPlan) / 100) * discount
                        }}
                      </td>
                    </tr>
                    <tr>
                      <td>Equals amount due</td>
                      <td></td>
                      <td
                        v-if="!discount || (discount && discountAmount === 0)"
                      >
                        $
                        {{
                          getSubscriptionPrice(selectedPlan) -
                          (getSubscriptionPrice(selectedPlan) / 100) *
                            regisitrationDiscount
                        }}
                        <!-- .00 -->
                      </td>
                      <td v-if="discount && discountAmount !== 0">
                        {{
                          getSubscriptionPrice(selectedPlan) -
                          (getSubscriptionPrice(selectedPlan) / 100) *
                            regisitrationDiscount
                        }}
                      </td>
                    </tr>
                    <tr>
                      <td>Less amount paid</td>
                      <td></td>
                      <td
                        v-if="!discount || (discount && discountAmount === 0)"
                      >
                        $
                        {{
                          getSubscriptionPrice(selectedPlan) -
                          (getSubscriptionPrice(selectedPlan) / 100) *
                            regisitrationDiscount
                        }}
                      </td>
                      <td v-if="discount && discountAmount !== 0">
                        {{
                          getSubscriptionPrice(selectedPlan) -
                          (getSubscriptionPrice(selectedPlan) / 100) *
                            regisitrationDiscount
                        }}.00
                      </td>
                    </tr>
                    <tr>
                      <td>Equals balance due</td>
                      <td></td>
                      <td>$ 0.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="container" style="margin-top: 50px; font-weight: 300">
              <div class="col-md-12" style="text-align: center">
                <div style="font-size: 16px">
                  The transaction shown on your receipt is correct at the time
                  of downloading.
                </div>
              </div>
            </div>
          </form>
          <div class="modal-footer" id="on-print-none">
            <button
              class="btn btn-sm btn-primary my-2 cursor-pointer"
              @click="generatePDF"
            >
              Download PDF
            </button>
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
      showModal: false,
      days: 0,
      hours: 0,
      minutes: 0,
      seconds: 0,
      SubcouponName: "",
      Subdiscount: "",
      subscriptionDiscount: [],
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
      subscriptionplan: [
        // Your subscription plan data
      ],
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
  watch: {
    // Watch for changes in currentStep
    currentStep(newStep) {
      // If currentStep is equal to 1, show the modal
      if (newStep === 1) {
        setTimeout(() => {
          this.showModal = true;
        }, 5000);
      } else {
        this.showModal = false; // Close the modal for other steps
      }
    },
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
    this.getPlan();
    this.fetchExpiryDate();
    this.setupCountdown(1705780800000, 1802649540000);
  },
  mounted() {
    this.formatCurrentDate();
    const userData = localStorage.getItem("user");
    let user = JSON.parse(userData);
    // this.first_name = user.first_name;
    // this.email = user.email;
    // this.last_name = user.last_name;

    // this.includeStripe('js.stripe.com/v3/', function () {
    //     this.configureStripe();
    // }.bind(this));
    // this.loadIntent();
    // this.selectedPlan = this.$route.query.plan;
    // this.loadPlanDetail(this.selectedPlan);
    // this.loadPaymentMethods();
    // this.checkSubscription();
    this.fetchExpiryDate();
    this.setupCountdown(1705780800000, 1802649540000);
    setTimeout(() => {
      this.showModal = true;
    }, 10000);
  },
  methods: {
    async fetchExpiryDate() {
      try {
        const response = await axios.get("/api/discount-show");
        console.log("discount on subscription response", response.data);
        // this.subscriptionDiscount = response.data;
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
        const { name, expiry_date, discount } = discountDetails;
        this.SubcouponName = name;
        this.Subdiscount = discount;
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
    formatDate(timestamp) {
      const date = new Date(timestamp);
      const options = {
        day: "numeric",
        month: "short",
        year: "numeric",
      };
      return date.toLocaleDateString("en-US", options).toUpperCase();
    },
    generatePDF() {
      const element = document.querySelector(".printReceipt");
      const elementsToHide = document.querySelectorAll("#on-print-none");

      elementsToHide.forEach((el) => {
        el.style.display = "none";
      });
      const options = {
        margin: 10,
        filename: `Transaction_Receipt_${this.getFormattedTimestamp()}.pdf`,
        image: {
          type: "jpeg",
          quality: 0.98,
        },
        html2canvas: {
          scale: 2,
        },
        jsPDF: {
          unit: "mm",
          format: "a4",
          orientation: "portrait",
        },
      };

      this.is_export_in_progress = true;
      this.toast.info("Preparing the file");

      html2pdf()
        .from(element)
        .set(options)
        .outputPdf()
        .then(() => {
          setTimeout(() => {
            this.toast.clear();
            this.is_export_in_progress = false;
          }, 5000);
        })
        .save();
    },
    getFormattedTimestamp() {
      const now = new Date();
      const year = now.getFullYear();
      const month = `${now.getMonth() + 1}`.padStart(2, "0");
      const day = `${now.getDate()}`.padStart(2, "0");
      const hours = `${now.getHours()}`.padStart(2, "0");
      const minutes = `${now.getMinutes()}`.padStart(2, "0");
      const seconds = `${now.getSeconds()}`.padStart(2, "0");

      return `${year}-${month}-${day}_${hours}-${minutes}-${seconds}`;
    },

    async exportFile() {
      const params = {
        subscriptionName: this.getSubscriptionName(this.selectedPlan),
        subscriptionPrice: this.getSubscriptionPrice(this.selectedPlan),
        formattedDate: this.formattedDate,
        first_name: this.first_name,
        last_name: this.last_name,
        regisitrationDiscount: this.regisitrationDiscount,
        discount: this.discount,
        discountAmount: this.discountAmount,
        payableTotal: this.payableTotal,
        // Add other parameters if needed
      };

      this.is_export_in_progress = true;
      this.toast.info("Preparing the file");
      let url = "/api/receipt-export";

      try {
        const response = await axios.get(url, {
          params,
          responseType: "blob", // Response type is set to 'blob' for binary data
        });

        // Create a temporary link element
        const link = document.createElement("a");
        link.href = URL.createObjectURL(new Blob([response.data]));

        // Extract filename from response headers if available
        let suggestedFilename = "receipt.pdf";
        const contentDisposition = response.headers["content-disposition"];
        if (contentDisposition) {
          const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
          const matches = filenameRegex.exec(contentDisposition);
          if (matches != null && matches[1]) {
            suggestedFilename = matches[1].replace(/['"]/g, "");
          }
        }

        link.setAttribute("download", suggestedFilename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      } catch (error) {
        this.toast.error(
          error.response?.data?.message || "An error occurred while downloading"
        );
      } finally {
        this.is_export_in_progress = false;
      }
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
    showReceiptModal() {
      $("#myModalDiscount").modal("show");
      axios
        .get("/api/get-last-subscription")
        .then((response) => {
          this.lastsubscriptiondata = response.data;
          console.log("lastsubscriptiondata", this.lastsubscriptiondata);
          // Show your Bootstrap modal here (use appropriate modal show logic)
          // For example: $('#myModal').modal('show');
        })
        .catch((error) => {
          console.error("Error fetching subscription:", error);
          this.isLoading = false;
        });
    },
    // Show the Bootstrap modal

    hideReceiptModal() {
      // Hide the Bootstrap modal
      $("#myModalDiscount").modal("hide");
    },
    checkSelection() {
      // Check if a plan has been selected
      return this.selectedPlan !== null;
    },
    async applyCoupon() {
      this.processing = true;

      try {
        const response = await axios.post("/api/get-promocode", {
          promocode: this.promocode,
        });

        if (response.data.message === "success") {
          if (localStorage.getItem("coupon_code") == this.promocode) {
            this.errorMessage = "This coupon has expired222.";
            setTimeout(() => {
              this.errorMessage = null;
            }, 5000);
          } else if (response.data.message === "success") {
            localStorage.setItem("coupon_code", this.promocode);
            this.successMessage = "Coupon applied successfully.";
            localStorage.setItem("coupon_code", this.promocode);
            this.discount = response.data.data.discount;
            // this.getPaymentIntentNew(this.payableTotal);
            this.promocode = "";
            setTimeout(() => {
              this.successMessage = null;
            }, 5000);
          } else if (response.data.message === "coupon_expired") {
            this.errorMessage = "This coupon has expired111.";
            setTimeout(() => {
              this.errorMessage = null;
            }, 5000);
            this.successMessage = null;
          } else if (response.data.message === "coupon_not_found") {
            this.errorMessage = "Coupon not found.";

            setTimeout(() => {
              this.errorMessage = "Coupon not found.";
            }, 5000);
            this.errorMessage = null;
          } else {
            this.errorMessage = "Failed to add coupon. Please try again later.";
            setTimeout(() => {
              this.errorMessage = null;
            }, 5000);
            this.successMessage = null;
          }
        }
      } catch (error) {
        console.log("This coupon has expired.");
        this.errorMessage = "The coupon is not valid.";
        setTimeout(() => {
          this.errorMessage = null;
        }, 5000);
        this.successMessage = null;
      } finally {
        this.processing = false;
      }
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
      try {
        const response = await axios.get(`/api/get-subscription-plans`);
        this.subscriptionplan = response.data.subscription; // Store the retrieved coupons in the data property
        this.regisitrationDiscount = response.data.settings; // Store the retrieved coupons in the data property
        console.log("subscriptionplan", this.subscriptionplan);
      } catch (error) {
        console.error("Error getting coupons:", error);
        this.errorMessage = "Error getting coupons"; // Set an error message
      }
    },

    closeModal() {
      this.showModal = false;
    },
  },
};
</script>

<style scoped>
/* @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap"); */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap");

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
