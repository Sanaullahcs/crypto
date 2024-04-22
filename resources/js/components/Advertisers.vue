<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-12 text-center">
            <h1>Advertisers</h1>
          </div>
        </div>
      </div>
    </section>
  </layout>
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
  created() {},
  mounted() {},
  data() {
    return {
      videoSource: "/assets/video/demo-video.mkv",
      Platform,
      Star,
      faq,
    };
  },
  watch: {},
  methods: {},
  computed: {},
};
</script>
