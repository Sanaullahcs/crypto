<template>
  <layout>
    <form id="payment-form">
      <div id="payment-element" class="pb-3">
        <!-- Stripe will create form elements here -->
      </div>
      <button
        type="button"
        class="btn btn-sm btn-primary my-2"
        @click="handleSubmit"
        :disabled="buttonDisabled"
      >
        Pay via Stripe
        <div
          v-if="loading"
          class="spinner-border spinner-border-sm text-light"
          role="status"
        >
          <span class="sr-only">Loading...</span>


        </div>

      </button>
      <div v-if="errorMessage" class="text-danger bg-yellow p-2 text-center" style="font-size: 13px;">
          {{ errorMessage }}
        </div>
    </form>
  </layout>
</template>
<script setup>
import { ref, onMounted, watch } from "vue";

const props = defineProps(["price"]);
const emit = defineEmits(["payment_success"]);
const loading = ref(false); // Define loading as a reactive variable
const buttonDisabled = ref(false);
const token = ref(null);
const stripe = ref(null);
const elements = ref(null);
const card = ref(null);
const errorMessage = ref(null); // Define errorMessage as a reactive variable

// Inside the error handling block
// test
// pk_test_51O9rjwHgAJ2a2cU6bxBBpmh3z11jZqTj0hkroRh2bA1eEsO89vzM0jBuxtE8E4aw20wf8XqJG5mFAA2S0gyUYlg600bekqVISk


// client
// pk_test_51O82a5IM6SlRmN2kQuxBzQUYRjJbdIl0ydfpjWx2DyWX0ubWMC9UBMspRVhcoRwWWBFjoNewSaxKUMrrTdqMYunA00y1WAT7zl
const stripeAPIToken = ref(
  "pk_test_51O82a5IM6SlRmN2kQuxBzQUYRjJbdIl0ydfpjWx2DyWX0ubWMC9UBMspRVhcoRwWWBFjoNewSaxKUMrrTdqMYunA00y1WAT7zl"
);
const intentToken = ref(null);
const paymentElement = ref(null);

onMounted(() => {
  console.log("props", props.price);
  includeStripe(
    "js.stripe.com/v3/",
    function () {
      configureStripe();
    }.bind(this)
  );
});
const newprice = ref(0);
watch(
  () => props.price,
  (first, second) => {
    newprice.value = second;
    includeStripe(
      "js.stripe.com/v3/",
      function () {
        configureStripe();
      }.bind(this)
    );
  }
);
const handleSubmit = async (e) => {
  loading.value = true; // Set loading to true when processing starts
  buttonDisabled.value = true; // Disable the button when it's clicked

  e.preventDefault();

  const { error } = await stripe.value.confirmPayment({
    elements: elements.value,
    redirect: "if_required",
  });

  if (error === undefined) {
    async function completePayment(tokenValue) {
      const userData = localStorage.getItem("user");
      const plan_id = localStorage.getItem("plan_id");
      const coupon = localStorage.getItem("coupon_code");

      let user = JSON.parse(userData);
      try {
        const response = await axios.post("api/payment/complete", {
          token: tokenValue,
          user: user,
          plan_id: plan_id,
          coupon: coupon,
        });
        // Handle the response from the API
        console.log("Response:", response.data);
        // Depending on the response, you can perform further actions
        // For example:
        emit("payment_success");
        loading.value = false;
        buttonDisabled.value = false; // Enable the button after processing completes
        if (response.data.success) {
          // Payment completed successfully
          localStorage.removeItem("coupon_code");
          emit("payment_success");
          console.log("Payment completed successfully");
        } else {
          localStorage.removeItem("coupon_code");
          // Payment failed or other error
          console.error("Payment failed:", response.data.message);
        }
      } catch (error) {
        this.loading = false;
        // Handle error if the API call fails
        console.error("Error:", error.message);
      }
    }

    // Assuming you have a token value obtained from somewhere
    const tokenValue = token;

    // Call the function with the token value
    completePayment(tokenValue);
  } else {
    errorMessage.value = error.message; // Set the error message value
    buttonDisabled.value = false; // Enable the button when error occurs
    loading.value = false; // Hide the loader when error occurs

    axios.post("api/payment/failure", {
      token: token.value,
      code: error.code,
      description: error.message,
    });
    localStorage.removeItem("coupon_code");
  }
};

function includeStripe(URL, callback) {
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
}
/*
        Configures Stripe by setting up the elements and
        creating the card element.
    */
function configureStripe() {
  stripe.value = Stripe(stripeAPIToken.value);
  const userData = localStorage.getItem("user");
  let user = JSON.parse(userData);

  axios
    .get(`/api/get-intent`, {
      params: {
        data: props.price == 0 ? 0 : props.price,
        id: user.id, // Include userData in the request
      },
    })
    .then(
      function (response) {
        console.log(response);
        var options = {
          clientSecret: response.data,
        };

        elements.value = stripe.value.elements(options);
        paymentElement.value = elements.value.create("payment");
        paymentElement.value.mount("#payment-element");
      }.bind(this)
    );
}
/*
        Loads the payment intent key for the user to pay.
    */
function loadIntent() {
  axios.get("/api/v1/user/setup-intent").then(
    function (response) {
      intentToken.value = response.data;
    }.bind(this)
  );
}
</script>
