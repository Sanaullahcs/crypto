<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-12">
            <p>
              <strong
                >
                <!-- terms-and-conditions -->
                <a href="" class="text-black" v-on:click="() => $router.push('/privacy-policy')"  >Privacy Policy
                </a></strong
              >
              <strong
                >
                <!-- terms-and-conditions -->
                <a href=""  class="pl-3 text-black" v-on:click="() => $router.push('/terms-and-conditions')"  >Terms and conditions
                </a></strong
              >
            </p>
            <h2>Crypto Wiz Guy® Calculator Overview</h2>
            <p>
              This site has a Calculator that lets you look at various profit or
              loss “what-if” <br> scenarios, to plan your cryptocurrency buys and
              sells.
            </p>
            <p>
              <strong
                >Your real-life inputs (what you have) and your desired results
                (what you want) drive the Calculator’s outputs.</strong
              >
            </p>
            <p class="pl-8">
              The outputs give you nine elements for as many as five alternative
              target types. <br> Outputs can be adjusted instantly to help you refine
              your plans.
            </p>
            <p class="pt-4">
              With our tools and your strategies, it is possible to:
            </p>
            <p class="pl-8">
              Use the Calculator's functions to plan a buy or sell at the coin
              price you  <br> choose, using the Advanced Limit Buy or Advanced Limit Sell features on
              Coinbase.com.
              <br />
              <strong
                >Plan your coin buying price below the current market price or
                plan your coin selling price above the current market
                price.</strong
              >
              <br />
              Calculate potential profits and proceeds for your specific
              circumstances before <br> you sell any of your cryptocurrency holdings.
            </p>

            <p class="pt-4">
              About the Crypto Wiz Guy Calculator’s tutorial videos and
              illustrations:
            </p>
            <p class="pl-8">
              Find these links in the Resources area of the website:<br>
              Illustrations with screenshots and explanations.

              <br />
              <strong
                >Know how to plan your precise pre-sale profit and proceeds.</strong
              >
              <br />
              Short, step-by-step narrated video clips show you the input and
              output <br> screens and how to use them, including avoidance of
              inherent pitfalls.
            </p>

            <p class="pt-4">About Coinbase.com and the tutorial videos.</p>
            <p class="pl-8">
              Find these links in the Resources area of the website.<br>
               Learn how to set up Advanced Limit Buys and Advanced Limit Sells on Coinbase.com

              <br />
              <strong
                >After you set up an Advanced Limit Sell all you really have to do is wait
                for the money to roll in.</strong
              >
              <br />
              Learn how to prevent the need for you to follow prices in real
              time on Coinbase.com, avoiding the frustrations, anxiety,
              uncertainties, and wasted time of "timing the market."
            </p>
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
  name: "Overview & Legal Stuff Page",

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
section p {
  font-size: 24px;
  color: #000;
  margin-bottom: 0;
  font-weight: 400;
  padding-bottom: 15px;
  line-height: 37px;
}
.pl-8 {
  padding-left: 80px;
}
</style>
