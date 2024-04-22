<template>
  <layout>
    <div class="my-5">
      <div class="card br-10 mw-550 m-auto">
        <div class="card-body p-4">
          <h4 class="font-weight-bolder my-2">Log In</h4>
          <p>
            or
            <a
              href="javascript:void(0)"
              v-on:click="() => $router.push('/register')"
              class="text-dark text-underline"
              ><u>create an account</u></a
            >
          </p>
          <form action="" autocomplete="off">
            <div class="form-group">
              <label for="exampleInputEmail1" class="my-2">Email address</label>
              <input
                type="email"
                v-model="email"
                class="my-2 form-control bg-primary text-white"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="example@gmail.com"
                autocomplete="off"
              />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="my-2">Password</label>
              <input
                type="password"
                v-model="password"
                class="my-2 form-control bg-primary text-white auto-complete-off"
                id="exampleInputPassword1"
                placeholder="********"
                autocomplete="new-password"
              />
            </div>

            <div class="error">
              <p
                class="text-danger w-100 text-center bg-yellow text-red"
                v-if="error != undefined"
              >
                {{ error }}
              </p>
            </div>
            <button
              type="button"
              class="btn btn-sm btn-primary my-2"
              v-on:click="login()"
            >
              Login
              <div
                v-if="loading"
                class="spinner-border spinner-border-sm text-light"
                role="status"
              >
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </form>
          <br />
          <a
            href="javascript:void(0)"
            v-on:click="() => $router.push('/forgot-password')"
            class="text-dark mt-3"
            >Forgot Password?</a
          >
        </div>
      </div>
    </div>
  </layout>
</template>
<script>
import Layout from "../Layout.vue";
import "@fortawesome/fontawesome-free/css/all.css";

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
      email: "",
      password: "",
      error: "",
      loading: false,
    };
  },
  watch: {},
  methods: {
    login() {
      this.loading = true;
      if (this.email == "" || this.password == "") {
        this.error = "Please enter your email and password";
        this.loading = false;
        return;
      }

      this.error = "";
      axios
        .post("/api/sign-in", {
          email: this.email,
          password: this.password,
        })
        .then((response) => {
          console.log("data", response.data);
          this.loading = false;
          if (response.data.status == "success") {
            localStorage.setItem("user", JSON.stringify(response.data.user));
            localStorage.setItem("token", response.data.token);
            localStorage.setItem("verification", false);
            this.$router.push("/verify?type=l");
          } else {
            this.error = response.data.message;
          }
        })
        .catch((error) => {
          this.loading = false;
          this.error = error.response.data.message;
        });
    },
  },
  computed: {},
};
</script>
<style>
.mw-550 {
  max-width: 550px;
}
.bg-primary {
  background-color: #4472c4 !important;
}

input.bg-primary {
  background-color: #4472c4 !important;
  color: #fff;
}

input.bg-primary::placeholder {
  color: #fff;
}
input.bg-primary:focus {
  background-color: #4472c4 !important;
  color: #fff;
}
input.bg-primary:focus::placeholder {
  color: #fff;
}
label {
  font-weight: 600;
  font-size: 16px;
}
.form-control {
  font-size: 16px !important;
}
</style>
