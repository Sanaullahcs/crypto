<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-12  h4">
            <h2 class="mb-3 text-center">Crypto Wiz Guy video Resources</h2>
            <div class="col-12 resource-div">
              <p class="pb-0">
                <a href="https://youtu.be/IluTgOHHKyE" target="_blank"
                  >Video: Jeff and Monica introduce the Crypto Wiz Guy®
                  Calculator</a
                >
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/uR3b-YYfKR0" target="_blank"
                  >Video: Selling Calculator Introduction</a
                >
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/-FXwDsaY24s" target="_blank"
                  >Video: Calculator Required Inputs</a
                >
              </p>
              <p class="pb-0">
                <a
                  href="https://www.coinbase.com/learn/your-crypto/knowing-your-cost-basis"
                  target="_blank"
                  >Page: Coinbase Cost basis: What is it</a
                >
              </p>
              <p class="pb-0">
                <a
                  href="https://koinly.io/blog/calculate-cost-basis-crypto-bitcoin/"
                  target="_blank"
                  >Page: Cost methods Select your current or permanent cost-basis accounting
                  method</a
                >
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/-S2pwtR33sA" target="_blank"
                  >Video: Calculator Selling fee, Alternatives, and Outputs
                </a>
              </p>
              <p class="pb-0">
                <a
                  href="https://help.coinbase.com/en/coinbase/trading-and-funding/advanced-trade/advanced-trade-fees"
                  target="_blank"
                  >Page: Coinbase Advanced fees. Requires Coinbase Sign in
                </a>
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/3gviOrMOwX8" target="_blank"
                  >Video: Calculator What if and PDF review
                </a>
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/1XeQfl5rXzg" target="_blank">
                  Video: Coinbase Advanced Limit Sell order</a
                >
              </p>
              <p class="pb-0">
                <a
                  href="https://youtu.be/Wg6hn_I00GE?si=_3tfCr1FeQCJ5GWI"
                  target="_blank"
                  >Video: “Coinbase Advanced Trade for Beginners - Step by Step
                  Tutorial!” by Eddie Moon</a
                >
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/1M-5kPC9T00" target="_blank"
                  >Video: Coinbase filled Sell order and How to Cancel an order
                </a>
              </p>
              <p class="pb-0">
                <a
                  href="https://help.coinbase.com/en/contact-us/support-faq/coinbase/how-to-view-your-balance-and-transactions"
                  target="_blank"
                  >Page: View Coinbase balance and transactions
                </a>
              </p>
              <p class="pb-0">
                <a href="https://youtu.be/Z_PvwoyjypY" target="_blank"
                  >Video: Coinbase Advanced Limit Buy
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </layout>
</template>
<script>
import Layout from "./Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  name: "Resource",

  components: {
    Layout,
  },
  beforeUnmount() {},
  created() {},
  mounted() {},
  data() {
    return {};
  },
  watch: {},
  methods: {},
  computed: {},
};
</script>
<style scoped>
section p a {
  font-size: 24px;
  color: #000 !important;
  margin-bottom: 0;
  font-weight: 400;
  padding-bottom: 15px;
  line-height: 37px;
}
.resource-div{
    max-width: 750px;
    margin: auto;
}
</style>
