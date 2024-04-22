<template>
  <div>
    <!-- <div id="paypal-button-container"></div> -->
    <div id="paypal-button-container-P-03U946421L6438535MW5HONY"></div>
  </div>
</template>

<script>
const axios = require("axios");
import { defineEmits } from "vue";

// const emit = defineEmits(["payment_success"]);
export default {
  props: {
    price: {
      type: String, // Change the type based on your use case (String, Number, etc.)
      required: true,
    },
    payment_success: {
      type: String, // Change the type based on your use case (String, Number, etc.)
      required: true,
    },
  },
  mounted() {
    // Load PayPal SDK script dynamically
    const script = document.createElement("script");
    // https://www.paypal.com/sdk/js?client-id=AUlrSytmqZdhiXwO1AvfRjffkDsKQIiCtqar72KgloSINn9Qod8XeS-dK1ZzY4grhsaXovXk-PQ2Zfgr
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AQfIg0q8HI86W8WtI6LquO9PMwSZ1KebL08HIkSbtsHYqwr6N-fygTBUgUDG3NN9UF97R8uI8xj46Wy_&vault=true&intent=subscription"; // Replace with your PayPal client ID
    script.async = true;
    document.body.appendChild(script);
    script.onload = () => {
      this.initPayPalButton();
    };
  },
  methods: {
    initPayPalButton() {
      //   paypal
      //     .Buttons({
      //       createOrder: (data, actions) => {
      //         return actions.order.create({
      //           purchase_units: [
      //             {
      //               amount: {
      //                 value: this.price, // Use the dynamic price here
      //               },
      //             },
      //           ],
      //         });
      //       },
      paypal
        .Buttons({
          style: {
            color: "gold",
            color: "blue",
            layout: "vertical",
            label: "subscribe",
          },
          createSubscription: function (data, actions) {
            return actions.subscription.create({
              /* Creates the subscription */
              plan_id: "P-03U946421L6438535MW5HONY",
            });
          },
          onApprove: function (data, actions) {
            console.log(data.subscriptionID); // You can add optional success message for the subscriber here
            localStorage.removeItem("coupon_code");
            // const transactionAmount = details.purchase_units[0].amount.value;
            // console.log("Transaction amount:", transactionAmount);
            const userData = localStorage.getItem("user");
            const plan_id = "P-03U946421L6438535MW5HONY";

            let user = JSON.parse(userData);
            try {
              const response = axios.post("api/payment/complete", {
                user: user,
                data: data,
                // details: details,
                plan_id: plan_id,
                type: "paypal",
              });
              // Handle the response from the API
              console.log("Response:", response.data);
              // Depending on the response, you can perform further actions
              // For example:
              this.$emit("payment_success");
              if (response.data.success) {
                // Payment completed successfully
                localStorage.removeItem("coupon_code");
                this.$emit("payment_success");
                console.log("Payment completed successfully");
              } else {
                localStorage.removeItem("coupon_code");
                // Payment failed or other error
                console.error("Payment failed:", response.data.message);
              }
            } catch (error) {
              // Handle error if the API call fails
              console.error("Error:", error.message);
            }

            this.$emit("payment_success");
            // Redirect or perform actions upon successful payment
          },

          onError: (err) => {
            // Handle errors or failed payment
            console.error(err);
          },
          fundingSource: paypal.FUNDING.PAYPAL,
        })
        .render("#paypal-button-container-P-03U946421L6438535MW5HONY"); // Renders the PayPal button
      // })
      // .render("#paypal-button-container");
      this.emit("payment_success");
    },
  },
};
</script>
