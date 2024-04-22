<template>
    <layout>
      <section class="choose-sect pb-5">
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-12 text-center">
              <h1>Privacy Policy </h1>
              <div name="termly-embed"  data-id="3e5e1a27-9d83-4885-b7cc-05ef584ca109"></div>
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
    name: "Privacy Policy ",
    components: {
      Layout,
    },
    mounted() {
      // Dynamically add the Termly script after the component is mounted
      const termlyScript = document.createElement("script");
      termlyScript.id = "termly-jssdk";
      termlyScript.src = "https://app.termly.io/embed-policy.min.js";
      document.body.appendChild(termlyScript);
    },
  };
  </script>

  <style scoped>
  h1{
    color:black;
  }
  /* Your scoped styles here */
  </style>
