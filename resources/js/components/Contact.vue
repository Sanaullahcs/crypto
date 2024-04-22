<template>
  <layout>
    <section class="choose-sect pb-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center">
            <div class="container my-5">
              <div class="row justify-content-center">
                <div class="col-8 col-sm-12 col-md-12 col-lg-8 text-center">
                  <div class="alert alert-primary" style="font-size: 17px;" v-if="showSuccessMessage">
                    Your request was submitted successfully!
                  </div>
                </div>
                <div class="col-lg-9">
                  <h2 class="mb-3">Contact Us</h2>
                  <form @submit.prevent="submitForm">
                    <div class="row g-3">
                      <div class="col-md-6 text-left">
                        <label for="first_name" class="form-label"
                          >First Name</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="first_name"
                          name="first_name"
                          placeholder="Jhon"
                          v-model="form.first_name"
                          :class="{
                            'is-invalid': showError && errors.first_name,
                          }"
                        />

                        <div
                          class="invalid-feedback"
                          v-if="showError && errors.first_name"
                        >
                          {{ errors.first_name }}
                        </div>
                      </div>

                      <div class="col-md-6 text-left pb-4">
                        <label for="last_name" class="form-label"
                          >Last Name</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="last_name"
                          name="last_name"
                          placeholder="DOe"
                          v-model="form.last_name"
                        />
                      </div>
                      <div class="col-md-6 text-left">
                        <label for="your-email" class="form-label">
                          Email
                        </label>
                        <input
                          type="email"
                          class="form-control"
                          id="your-email"
                          v-model="form.email"
                          placeholder="example@gmail.com"
                          :class="{ 'is-invalid': showError && errors.email }"
                        />
                        <div
                          class="invalid-feedback"
                          v-if="showError && errors.email"
                        >
                          {{ errors.email }}
                        </div>
                      </div>

                      <div class="col-md-6 text-left">
                        <label for="your-subject" class="form-label">
                          Subject</label
                        >
                        <input
                          type="text"
                          class="form-control"
                          id="subject"
                          name="subject"
                          v-model="form.subject"
                          placeholder="subject"
                          :class="{ 'is-invalid': showError && errors.subject }"
                        />

                        <div
                          class="invalid-feedback"
                          v-if="showError && errors.subject"
                        >
                          {{ errors.subject }}
                        </div>
                      </div>
                      <div class="col-12 text-left pb-3 pt-3">
                        <label for="your-message" class="form-label">
                          Message</label
                        >
                        <textarea
                          class="form-control"
                          id="your-message"
                          placeholder="message"
                          name="message"
                          rows="5"
                          v-model="form.message"
                        ></textarea>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-md-6 text-left">
                            <button
                              type="submit"
                              class="btn btn-primary btn-sm w-50 fw-bold"
                            >
                              Send
                              <div
                                v-if="loading"
                                class="spinner-border spinner-border-sm text-light"
                                role="status"
                              >
                                <span class="sr-only">Loading...</span>
                              </div>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
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
  name: "Contact",

  components: {
    Layout,
  },
  beforeUnmount() {},
  created() {},
  mounted() {},
  data() {
    return {
      form: {
        first_name: "",
        email: "",
        subject: "",
      },
      errors: {},
      showError: false, // Flag to control when to show errors
      loading: false,
      showSuccessMessage: false, // Track successful form submission
    };
  },
  watch: {},
  methods: {
    submitForm() {
      console.log(this.form);
      this.errors = {};
      this.loading = true;

      let hasError = false;

      if (!this.form.first_name) {
        this.errors.first_name = "First name is required";
        hasError = true;
      }

      if (!this.form.email) {
        this.errors.email = "Email is required";
        hasError = true;
      } else if (!this.isValidEmail(this.form.email)) {
        this.errors.email = "Please enter a valid email";
        hasError = true;
      }

      if (!this.form.subject) {
        this.errors.subject = "Subject is required";
        hasError = true;
      }

      if (hasError) {
        this.showError = true; // Show errors if there are any
        this.loading = false; // Stop loading due to errors
        return; // Exit the function without submitting the form
      }

      // Proceed with form submission if there are no errors
      axios
        .post("/api/contact", this.form)
        .then((response) => {
          this.showSuccessMessage = true;
          this.loading = false;
          this.errors = {}; // Reset errors object
          this.showError = false; // Hide errors after successful submission
          Object.keys(this.form).forEach((key) => {
            this.form[key] = ""; // Clear form fields after successful submission
          });
          // Handle success
        })
        .catch((error) => {
          // Handle errors
        });
    },

    isValidEmail(email) {
      // Implement your email validation logic here
      // This is a simple example, you can use a library or more complex logic
      const re = /\S+@\S+\.\S+/;
      return re.test(email);
    },
  },

  computed: {},
};
</script>
<style scoped>
.form-control {
  background-color: #4472c4 !important;
}

/* FOOTER STYLES
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.page-footer {
  position: fixed;
  right: 0;
  bottom: 50px;
  display: flex;
  align-items: center;
  padding: 5px;
  z-index: 1;
}

.page-footer a {
  display: flex;
  margin-left: 4px;
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
</style>
