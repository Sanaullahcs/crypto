<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-12 text-center">
            <p> Crypto Wiz Guy About 2023-11-30</p>
            <p> Crypto Wiz Guy® LLC was formed and trademarked in 2022.</p>
            <p>CryptoWizGuy.com was created in 2022</p>
            <p> The Guy lives high in a hollow tree in Forest Park near the Zoo in St. Louis, Missouri, USA</p>
            <p>©2023 by Crypto Wiz Guy LLC. All rights reserved.</p>
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
  name: "About us",

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

</style>
