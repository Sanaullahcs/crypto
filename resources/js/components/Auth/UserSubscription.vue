<template>
  <layout>
    <div class="container pb-5">
      <div
        class="col-12 col-sm-12 mw-wwh m-auto col-md-4 col-lg-12 header-sect pb-4"
      >
        <h2>SUBSCRIPTION DETAILS PAGE</h2>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="card-title">Current Subscription Plan</h5>
                </div>
                <div class="col-md-6 text-right">
                  <button
                    @click.prevent="showReceiptModal"
                    class="btn btn-sm btn-primary"
                    data-toggle="modal"
                    data-target="#myModalDiscount"
                  >
                    View Invoice
                  </button>
                </div>
              </div>

              <h3>{{ subscriptions.name }}</h3>
              <div class="row pt-3 pb-2">
                <div class="col-md-6">
                  <h4>{{ usersubscription.duration }}</h4>
                </div>
                <div class="col-md-6 text-right">
                  <h4>$ {{ this.subscriptions.stripe_price / 100 }}.00</h4>
                </div>
              </div>
              <p class="card-text">
                Next payment due date is seven days before subscription end
                date.
              </p>
              <div class="row">
                <div class="col-md-6">
                  <p>Start Date:</p>
                  <p>{{ formatDate(subscriptions.trial_ends_at) }}</p>
                </div>
                <div class="col-md-6 text-right">
                  <p>End Date:</p>
                  <p>{{ formatDate(subscriptions.ends_at) }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Cancel Subscription Plan</h5>
              <p>Subscriptions do not end mid-term.</p>
              <p class="pb-5">There is no full refund or partial refund.</p>
              <a class="btn bt-sm btn-primary mt-5" @click="cancelSubscription"
                >Cancel Subscription</a
              >
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row pt-2">
        <div class="col-md-12">
          <div v-if="cancellationMessage" class="text-white w-100 p-2 bg-green w-50 text-center">
            {{ cancellationMessage }}
          </div>
        </div>
      </div> -->
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
                        <p><b>Payment Method</b>: {{ subscriptions['card_brand'] }} - **** **** {{ subscriptions['last4'] }}</p>
                      <p><b>Card Type</b>: {{ subscriptions.type }}</p>
                      <p>
                        <b>Transaction number</b>:{{
                          subscriptions.invoice_number
                        }}
                      </p>
                    </div>
                    <!-- <div style="padding-bottom: 6px">
                    Address: 9 Portland Gardens
                  </div>
                  <div>Post code: N4 1HU</div> -->
                  </div>
                </div>
              </div>
              <div class="container">
                <div class="column-table">
                  <div class="title-section"><h3>Summary</h3></div>
                  <table id="recipt">
                    <thead>
                      <tr>
                        <td>Billed to</td>
                        <td style="text-align: ">{{ email }}</td>
                        <td style="text-align: ">Invoice number</td>
                        <td style="text-align: end">
                          {{ subscriptions.id }}
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

                          {{ formatDate(subscriptions.created_at) }} -
                          {{ formatDate(subscriptions.ends_at) }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Standard price</td>
                        <td></td>
                        <td>$ {{ this.usersubscription.price }}</td>
                      </tr>
                      <tr
                        v-if="
                          subscriptions.couponcode == '' &&
                          subscriptions.registerdiscount
                        "
                      >
                        <td>Less discount</td>
                        <td>({{ subscriptiondiscount }}) % off</td>
                        <td>
                          {{
                            (usersubscription.price / 100) *
                            subscriptiondiscount
                          }}
                        </td>
                      </tr>

                      <tr
                        v-if="
                          subscriptions.couponcode != '' &&
                          subscriptions.registerdiscount == null
                        "
                      >
                        <td>Less discount</td>
                        <td>({{ subscriptiondiscount }}) % off</td>
                        <td></td>
                      </tr>
                      <tr  v-if="
                          subscriptions.couponcode == '' &&
                          subscriptions.registerdiscount
                        ">
                        <td>Equals amount due</td>
                        <td></td>
                        <td> $ {{
                            this.usersubscription.price -
                            (usersubscription.price / 100) *
                              subscriptiondiscount
                          }}.00</td>

                      </tr>
                      <tr  v-if="
                          subscriptions.couponcode == '' &&
                          subscriptions.registerdiscount
                        ">
                        <td>Less amount paid</td>
                        <td></td>
                        <td>$ {{
                            this.usersubscription.price -
                            (usersubscription.price / 100) *
                              subscriptiondiscount
                          }}.00</td>

                      </tr>
                      <tr  v-if="
                          subscriptions.couponcode != '' &&
                          subscriptions.registerdiscount == null
                        ">
                        <td>Equals amount due</td>
                        <td></td>
                        <td> {{ this.subscriptions.stripe_price / 100 }}</td>

                      </tr>
                      <tr v-if="
                          subscriptions.couponcode != '' &&
                          subscriptions.registerdiscount == null
                        ">
                        <td>Less amount paid</td>
                        <td></td>
                        <td> {{ this.subscriptions.stripe_price / 100 }}</td>

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

              <div class="container " style="display: none;">
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

              <div class="container" style="display: none;">
                <div class="column-table">
                  <div class="title-section"><h3>RECIPIENT DETAILS</h3></div>
                  <table id="recipt">
                    <thead>
                      <tr>
                        <td>SUBSCRIPTION NAME</td>
                        <td style="text-align: center">STRIPE PRICE</td>
                        <td style="text-align: right">QUANTITY</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ subscriptions.name }}</td>
                        <td style="text-align: center">
                          $ {{ this.usersubscription.price }}
                        </td>
                        <td style="text-align: right">1</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="container" style="display: none;">
                <div class="detail-receipt">
                  <div class="title-section">TRANSACTION DETAILS</div>
                  <div class="row" style="margin-top: 20px"></div>
                </div>
                <div class="radio-cards">
                  <div
                    class="inner-content border-buttom"
                    style="display: flex"
                    v-if="
                      subscriptions.couponcode == '' &&
                      subscriptions.registerdiscount
                    "
                  >
                    <div class="content-sect">
                      <div
                        class="value-text justify-content-left text-left pl-3 pb-0"
                      >
                        <h3>
                          Registration Discount
                          <span class="capital-duration">
                            % ({{ subscriptiondiscount }})</span
                          >
                        </h3>
                      </div>
                      <div class="price-month">
                        <p>
                          $
                          {{
                            (usersubscription.price / 100) *
                            subscriptiondiscount
                          }}.00
                        </p>
                      </div>
                    </div>
                  </div>
                  <div
                    v-if="
                      subscriptions.couponcode == '' &&
                      subscriptions.registerdiscount
                    "
                    class="inner-content"
                    style="display: flex"
                  >
                    <div class="content-sect">
                      <div
                        class="value-text justify-content-left text-left pl-3 pb-0"
                      >
                        <h3>Payable Total</h3>
                      </div>
                      <div class="price-month">
                        <p>
                          $
                          {{
                            this.usersubscription.price -
                            (usersubscription.price / 100) *
                              subscriptiondiscount
                          }}.00
                        </p>
                      </div>
                    </div>
                  </div>
                  <!-- The part of HTML where you want to display discount information -->
                  <div
                    class="inner-content border-buttom"
                    v-if="
                      subscriptions.couponcode != '' &&
                      subscriptions.registerdiscount == null
                    "
                  >
                    <div class="content-sect">
                      <div
                        class="value-text justify-content-left text-left pl-3 pb-0"
                      >
                        <h3>
                          Discount
                          <span class="capital-duration">
                            % ({{ subscriptiondiscount }})</span
                          >
                        </h3>
                      </div>

                      <div class="price-month">
                        <p>
                          $
                          {{
                            (usersubscription.price / 100) *
                            subscriptiondiscount
                          }}.00
                        </p>
                      </div>
                    </div>
                  </div>

                  <div
                    class="inner-content"
                    v-if="
                      subscriptions.couponcode != '' &&
                      subscriptions.registerdiscount == null
                    "
                  >
                    <div class="content-sect">
                      <div
                        class="value-text justify-content-left text-left pl-3 pb-0"
                      >
                        <h3>Payable Total</h3>
                      </div>
                      <div class="price-month">
                        <p>$ {{ this.subscriptions.stripe_price / 100 }}.00</p>
                      </div>
                    </div>
                  </div>
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
    </div>
  </layout>
</template>

<script>
import Layout from "../Layout.vue";
import Logo from "./../../../assets/logo.png";

import "@fortawesome/fontawesome-free/css/all.css";
import axios from "axios";
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import { useToast } from "vue-toastification";
import html2pdf from "html2pdf.js";
export default {
  name: "Home",
  components: {
    Layout,
    Logo,
  },
  data() {
    return {
      subscriptions: [], // Initialize subscriptions data property
      usersubscription: [], // Initialize usersubscription data property
      errorMessage: null,
      cancellationMessage: "",
      subscription_id: "",
      formattedDate: "",
      promocode: "",
      discount: "",
      user: null,
      first_name: null,
      last_name: null,
      email: null,
      user: null,
      Logo: Logo,
      regisitrationDiscount: null,
      subscriptiondiscount: null,
    };
  },

  mounted() {
    this.getSubscriptionPlans();
    this.formatCurrentDate();
    const userData = localStorage.getItem("user");
    let user = JSON.parse(userData);
    this.first_name = user.first_name;
    this.last_name = user.last_name;
    this.email = user.email;
  },
  created() {
    this.toast = useToast();
  },
  methods: {
    formatDate(timestamp) {
      const date = new Date(timestamp);
      const options = { day: "numeric", month: "short", year: "numeric" };
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
        image: { type: "jpeg", quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
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
    async getSubscriptionPlans() {
      try {
        const user = JSON.parse(localStorage.getItem("user"));
        const response = await axios.get("/api/user-subscription-plan", {
          headers: {
            Authorization: `Bearer ${user.token}`, // Assuming user object has a token property
          },
          params: {
            userId: user.id, // Assuming user object has an id property
          },
        });
        this.subscriptions = response.data.subscription.subscriptions;
        this.usersubscription = response.data.subscription.subscriptionsPlan;
        this.subscriptiondiscount =
          response.data.subscription.subscriptiondiscount;

        console.log("subscriptions", this.subscriptions);
        console.log("usersubscription", this.usersubscription);
      } catch (error) {
        console.error("Error getting subscription plans:", error);
        this.errorMessage = "Error getting subscription plans";
      }
    },
    formatDate(dateString) {
      // Convert the string to a Date object
      const date = new Date(dateString);
      // Format the date as "Month Day, Year" (e.g., September 24, 2023)
      const formattedDate = date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
      return formattedDate;
    },

    cancelSubscription() {
      const subscriptionId = JSON.parse(localStorage.getItem("plan_id")); // Replace with actual subscription ID
      axios
        .post("/api/cancel-subscription", { subscription_id: subscriptionId })
        .then((response) => {
          console.log(response.data);
          // Handle success response here
          this.$router.push("/subscription-plan"); // Replace '/dashboard' with your dashboard route
          localStorage.removeItem("plan_id"); // Remove plan_id upon successful cancellation
          this.cancellationMessage =
            "Your subscription has been successfully canceled.";
          // For example, update the UI or show a success message
        })
        .catch((error) => {
          console.error(error.response.data);
          // Handle error response here
          this.cancellationMessage =
            "Failed to cancel the subscription. Please try again.";
          // For example, show an error message to the user
        });
    },

    showReceiptModal() {
      // Show the Bootstrap modal
      $("#myModalDiscount").modal("show");
    },

    hideReceiptModal() {
      // Hide the Bootstrap modal
      $("#myModalDiscount").modal("hide");
    },

    async getPlan() {
      axios
        .get(`/api/get-subscription-plans`)
        .then((response) => {
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
.header-sect h2 {
  font-size: 40px;
  font-weight: 600;
  color: #000;
  width: 100%;
}
.card {
  border: 1px solid rgb(0 0 0 / 0%);
  background: #cbe7f9;
  border-radius: 16px;
}
h3 {
  font-weight: 700;
}
.card-title {
  margin-bottom: 0.75rem;
  font-size: 18px;
  font-weight: 600;
}
p {
  margin-bottom: 0;
  margin-bottom: 12px;
  font-size: 16px;
  color: #212529;
  font-weight: 500;
}
h4 {
  font-weight: 600;
  text-transform: capitalize;
  font-size: 18px;
}
.bg-green {
  background-color: rgb(17, 199, 231);
  font-size: 18px;
}
</style>
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




