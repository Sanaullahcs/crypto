<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-4 col-lg-12 text-center">
            <div v-if="successMessage" class="text-white w-50 p-2 bg-green pb-2">
              {{ successMessage }}
            </div>

            <!-- Error Message -->
            <div
              v-if="errorMessage"
              class="text-danger w-50 p-2 bg-yellow text-red pb-2"
            >
              {{ errorMessage }}
            </div>
            <form
              class="needs-validation"
              novalidate
              @submit.prevent="UpdateUserInfo"
            >
              <div class="card col-lg-12">
                <div class="">
                  <h3 class="pt-2 pb-0">
                    <strong>Personal Information</strong>
                  </h3>
                  <hr class="hr_line" />
                  <div class="form-row">
                    <div class="col-md-4 mb-3 text-left">
                      <label for="validationTooltip01">First name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="validationTooltip01"
                        placeholder="First name"
                        v-model="user.first_name"
                      />
                    </div>
                    <div class="col-md-4 mb-3 text-left">
                      <label for="validationTooltip02">Last name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="validationTooltip02"
                        placeholder="Last name"
                        v-model="user.last_name"
                      />
                    </div>
                    <div class="col-md-4 mb-3 text-left">
                      <label for="validationTooltipUsername">Email</label>
                      <div class="input-group">
                        <input
                          type="text"
                          class="form-control"
                          v-model="user.email"
                          placeholder="Email"
                          disabled
                        />
                      </div>
                    </div>
                    <div class="row pb-2">
                      <div class="col-md-12 ml-1">
                        <button
                          data-toggle="modal"
                          class="btn btn-sm btn-primary"
                        >
                          Update Account
                        </button>
                      </div>
                    </div>
                  </div>
                  <h3 class="pt-2 pb-0">
                    <strong>Change Password</strong>
                  </h3>
                  <hr class="hr_line" />
                  <div class="form-row">
                    <div class="col-md-4 mb-3 text-left">
                      <label for="validationTooltip03">Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="validationTooltip03"
                        placeholder="Password"
                        v-model="user.password"
                        required
                      />
                    </div>
                    <div class="col-md-4 mb-3 text-left">
                      <label for="validationTooltip04">Confirm Password</label>
                      <input
                        type="password"
                        class="form-control"
                        id="validationTooltip04"
                        placeholder="Confirm Password"
                        v-model="user.password_confirmation"
                        required
                      />
                      <div v-if="passwordsDoNotMatch" class="text-danger">
                        Passwords do not match.
                      </div>
                    </div>
                  </div>
                  <div class="row pb-2">
                    <div class="col-md-12 text-left pb-3">
                      <button
                        class="btn btn-sm btn-primary"
                        type="submit"
                        :disabled="passwordsDoNotMatch"
                      >
                        Update Password
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
  mounted() {
    this.getUsers();
    const authToken = "Bearer " + localStorage.getItem("token"); // Replace with your storage method
    axios
      .get("/api/user", {
        headers: {
          Authorization: authToken,
        },
      })
      .then((response) => {
        this.user = response.data;
      })
      .catch((error) => {
        console.error("Error fetching user data:", error);
      });
  },
  data() {
    return {
        errors: {
        firstName: [],
        lastName: [],
        email: [],
        password: [],
        password_confirmation: [],
        fromemail:[],
      },
      user: {
        id: null,
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        password_confirmation: "",
        // other user properties
      },
      loading: false,
      successMessage: null,
      errorMessage: null,
    };
  },
  watch: {},
  methods: {
    UpdateUserInfo() {
      const authToken = "Bearer " + localStorage.getItem("token"); // Replace with your storage method
      // Check if passwords match before making the API request
      if (this.user.password !== this.user.password_confirmation) {
        this.passwordsDoNotMatch = true;
        return;
      }
      // Clear the error message if passwords match
      this.passwordsDoNotMatch = false;

      // Make the API request
      axios
        .put(
          "/api/user/update",
          {
            first_name: this.user.first_name,
            last_name: this.user.last_name,
            password: this.user.password,
            password_confirmation: this.user.password_confirmation,
          },
          {
            headers: {
              Authorization: authToken,
            },
          }
        )
        .then((response) => {
          // Handle success, show a success message or redirect
          this.successMessage = "User Account updated Successfully.";
          this.user.password = ""; // Clear the password field
          this.user.password_confirmation = ""; // Clear the password confirmation field
          setTimeout(() => {
            this.successMessage = null;
          }, 3000);
        })
        .catch((error) => {
          // Handle error, show an error message or log the error
          console.error("Error updating user:", error);
          this.errorMessage =
            "The password field must be at least 8 characters";
          setTimeout(() => {
            this.errorMessage = null;
          }, 3000);
        });
    },
    async getUsers() {
        try {
            const response = await axios.get('/api/get-users');

            if (response && response.data && response.data.stats) {
                const { stats: { total_users, active_subscriptions, total_subscriptions, total_revenue } } = response.data;

                this.users = response.data.stats.users;

                this.stats = {
                    total_users,
                    active_subscriptions,
                    total_subscriptions,
                    total_revenue,
                };

                // this.monthlyRevenueData = monthly_revenue;

                // this.renderChart();
            } else {
                console.error('Invalid response format');
                this.errorMessage = 'Invalid response format';
            }
        } catch (error) {
            console.error('Error getting data:', error);
            this.errorMessage = 'Error getting data';
        }
    },

  },
  computed: {},
};
</script>

<style scoped>
/**
 * Fonts
 */

@import url("https://fonts.googleapis.com/icon?family=Material+Icons");
/* @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap'); */

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}

::placeholder {
  color: white !important;
  opacity: 1;
  /* Firefox */
}

::-ms-input-placeholder {
  /* Edge 12-18 */
  color: white !important;
}

:-ms-input-placeholder {
  /* Edge 19+ */
  color: white !important;
}

/* Chrome, Safari, and Opera */
input::placeholder {
  color: white !important;
}

/**
 * Article Block
 */
.article-block {
  text-align: center;
}

.article-block .entry-content>p {
  color: #666;
}

/**
 * Tabs Container
 */
.tabs-container {
  padding: 2rem;
}

/**
 * Tabs Block
 */
.tabs-block {
  display: flex;
  align-items: center;
  justify-content: center;
}

/**
 * Tabs
 */
.tabs {
  display: flex;
}
section p {
  font-size: 24px;
  color: #000;
  margin-bottom: 0;
  font-weight: 400;
  padding-bottom: 15px;
  line-height: 37px;
}
.tabs>ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 15%;
}

.tabs>ul li {
  display: block;
}

.tabs>ul li:not(:last-child) {
  border-bottom: 1px solid #262626;
}

.tabs>ul li a,
.tabs>ul li a:visited {
  display: flex;
  border-bottom: none;
  text-decoration: none;
  background-color: #cae7f7;
  color: black;
  padding: 1rem 1.5rem;
  transition: all 0.2s ease-in-out;
  word-wrap: break-word;
  cursor: pointer;
}

.tabs>ul li a:hover,
.tabs>ul li a:focus,
.tabs>ul li a:active {
  border-bottom: none;
  outline: 0;
}

.tabs>ul li a.active {
  background-color: #000;
  color: white;
}

.tabs>ul li a:hover:not(.active) {
  color: #0067b8;
}

.tabs>ul li a>span {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
}

.tabs>ul li a>span.tab-label {
  display: none;
}

.tabs section {
  width: 85%;
  background-color: #fff;
  padding: 1rem;
  display: none;
  word-wrap: break-word;
  border-bottom: 6px solid #0067b8;
}

.tabs section>* {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.2s, transform 0.2s;
}

.tabs section>*:nth-child(1) {
  transition-delay: 0.2s;
}

.tabs section>*:nth-child(2) {
  transition-delay: 0.3s;
}

.tabs section>*:nth-child(3) {
  transition-delay: 0.4s;
}

.tabs section>*:nth-child(4) {
  transition-delay: 0.5s;
}

.tabs section>*:nth-child(5) {
  transition-delay: 0.6s;
}

.tabs section>*:nth-child(6) {
  transition-delay: 0.7s;
}

.tabs section>*:nth-child(7) {
  transition-delay: 0.8s;
}

.tabs section>*:nth-child(8) {
  transition-delay: 0.9s;
}

.tabs section>*:nth-child(9) {
  transition-delay: 1s;
}

.tabs section>*:nth-child(10) {
  transition-delay: 1.1s;
}

.tabs section>*:nth-child(11) {
  transition-delay: 1.2s;
}

.tabs section>*:nth-child(12) {
  transition-delay: 1.3s;
}

.tabs section>*:nth-child(13) {
  transition-delay: 1.4s;
}

.tabs section>*:nth-child(14) {
  transition-delay: 1.5s;
}

.tabs section>*:nth-child(15) {
  transition-delay: 1.6s;
}

.tabs section>*:nth-child(16) {
  transition-delay: 1.7s;
}

.tabs section>*:nth-child(17) {
  transition-delay: 1.8s;
}

.tabs section>*:nth-child(18) {
  transition-delay: 1.9s;
}

.tabs section>*:nth-child(19) {
  transition-delay: 2s;
}

.tabs section>*:nth-child(20) {
  transition-delay: 2.1s;
}

.tabs section.active {
  display: block;
}

.tabs section.active-content>* {
  opacity: 1;
  transform: translateY(0);
}

@media (min-width: 576px) {
  .tabs>ul {
    width: 150px;
  }

  .tabs>ul li a {
    flex-wrap: wrap;
  }

  .tabs>ul li a>span {
    width: 100%;
  }

  .tabs>ul li a>span.tab-label {
    width: 100%;
    display: block;
    margin-top: 0.2rem;
  }

  .tabs section {
    width: calc(100% - 150px);
    padding: 0rem 1rem;
  }
}

@media (min-width: 768px) {
  body {
    font-size: 1.125rem;
  }

  .tabs-container {
    padding: 4rem 4rem;
  }
}

@media (min-width: 992px) {
  .tabs {
    width: 1200px;
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

.bg-green {
  background-color: rgb(17, 199, 231);
}

.text-danger {
  color: #dc3545 !important;
  font-size: 15px;
}

.text-white {
  font-size: 15px;
}
.user-text-black {
  color: black;
  font-weight: 500;
  font-size: 18px;
}
.user-number-black {
  color: black;
  /* font-weight: 700; */
}
</style>
