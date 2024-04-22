<template>
  <FreeTrail></FreeTrail>
  <header class="header-sect">
    <div class="custom-container container-fluid px-5">
      <div v-if="loggedIn && $route.path === '/'" class="text-center userEmail">
        <span><strong>Sign in to :</strong> {{ email }}</span>
      </div>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Brand -->
        <a
          class="navbar-brand"
          href="javascript:void()"
          @click="$router.push('/')"
        >
          <img :src="Logo" alt="logo" class="img-logo" />
        </a>

        <!-- Toggler/collapsible Button -->
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto nav-fonts">
            <!-- Conditional rendering for user email -->
            <!-- <li class="nav-item" v-if="loggedIn && $route.path === '/'">
              <span class="nav-link userEmail">
                <strong>Sign in to :</strong> {{ email }}
              </span>
            </li> -->
            <!-- Links for Home, About Us, Contact, and other pages -->
            <li class="nav-item" :class="{ active: $route.path === '/' }">
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/')"
                >Home</a
              >
            </li>
            <li class="nav-item" :class="{ active: $route.path === '/about' }">
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/about')"
                >About Us</a
              >
            </li>
            <!-- <li
              class="nav-item"
              v-if="loggedIn && !plan_id"
              :class="{ active: $route.path === '/subscription-plan' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/subscription-plan')"
                >Subscription Plans</a
              >
            </li> -->
            <li
              class="nav-item"
              :class="{ active: $route.path === '/subscription-plan' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/subscription-plan')"
                >Subscription Plans</a
              >
            </li>
            <li
              class="nav-item"
              v-if="loggedIn && plan_id"
              :class="{ active: $route.path === '/user-subscription' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/user-subscription')"
                >User Subscription</a
              >
            </li>
            <!-- <li
              v-if="loggedIn"
              class="nav-item"
              :class="{ active: $route.path === 'payment-plan' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/payment-plan')"
                >Payment Plans</a
              >
            </li> -->
            <!-- <li
              class="nav-item"
              :class="{ active: $route.path === '/newsubscriptionplans' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/newsubscriptionplans')"
                >Pricing Plans</a
              >
            </li> -->
            <li
              class="nav-item"
              v-if="loggedIn"
              :class="{ active: $route.path === '/calculator' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/calculator')"
                >The Calculator</a
              >
            </li>
            <li
              class="nav-item"
              :class="{ active: $route.path === '/resource' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/resource')"
                >Resources</a
              >
            </li>
            <li
              class="nav-item"
              :class="{ active: $route.path === '/contact' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/contact')"
                >Contact</a
              >
            </li>
            <!-- Add other navbar items as needed -->
            <li class="nav-item" :class="{ active: $route.path === '/faqs' }">
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/faqs')"
                >FAQs</a
              >
            </li>
            <li class="nav-item" v-if="loggedIn && isAdmin === 1">
              <a
                class="nav-link"
                href="javascript:void()"
                @click="redirectToDashboard"
                >Admin Dashboard</a
              >
            </li>
            <!-- Link for My Account -->
            <li
              class="nav-item"
              v-if="loggedIn"
              :class="{ active: $route.path === '/my-account' }"
            >
              <a
                class="nav-link"
                href="javascript:void()"
                @click="$router.push('/my-account')"
                >Your Account</a
              >
            </li>
            <!-- Buttons for Sign In, Register, and Logout -->
            <li class="nav-item" v-if="!loggedIn">
              <button
                class="btn btn-primary btn-sm mr-2 ml-3 mb-1 logIn_Regester_btn"
                @click="$router.push('/login')"
              >
                Sign in
              </button>
            </li>
            <li class="nav-item" v-if="!loggedIn">
              <button
                class="btn btn-primary btn-sm mr-2 ml-2 mb-1 logIn_Regester_btn"
                @click="$router.push('/register')"
              >
                Register
              </button>
            </li>
            <li class="nav-item" v-if="loggedIn">
              <button
                class="btn btn-primary btn-sm mr-2 ml-2 mb-1 logIn_Regester_btn"
                @click="logout"
              >
                Logout
              </button>
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div
      class="col-12 col-sm-12 col-md-4 col-lg-12 text-center pt-3 pb-3 video-container"
      v-if="$route.path === '/'"
    >
      <iframe
        width="1050"
        height="500"
        src="https://www.youtube.com/embed/IluTgOHHKyE?si=am6wEd3-KC3zbL8w"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media;
                         gyroscope; picture-in-picture; web-share"
        allowfullscreen
      ></iframe>
    </div>
    <div
      class="col-12 col-sm-12mw-wwh m-auto col-md-4 col-lg-6 text-sm-center"
      v-if="$route.path === '/'"
    >
      <!-- <h2>Crypto Wiz Guy® LLC Buying and Selling Calculator.</h2> -->
      <!-- <p class="paragraph-text">
        Do you know how you can plan and buy cryptocurrency below the current
        market (spot) price?. Do you know how you can plan and sell
        cryptocurrency below the current market (spot) price?. Crypto Wiz Guy®
        will teach you to do it yourself !
      </p> -->
    </div>
  </header>
</template>

<script>
import Logo from "./../../assets/logo.png";
import FreeTrail from "./FreeTrail.vue";
export default {
  name: "Header",
  components: {
    FreeTrail,
  },
  beforeUnmount() {},
  created() {},
  data() {
    return {
      loggedIn: false,
      trial_days_difference: "",
      isAdmin: null,
      email: null,
      Logo: Logo,
      plan_id: "",
    };
  },

  mounted() {
    this.loggedIn =
      localStorage.getItem("user") && localStorage.getItem("verification")
        ? true
        : false;
    const userData = localStorage.getItem("user");
    const verificationData = localStorage.getItem("verification");
    this.plan_id = localStorage.getItem("plan_id");
    if (userData && verificationData) {
      const user = JSON.parse(userData);
      // Assuming verification is a boolean value in local storage
      const isVerified = JSON.parse(verificationData);
      // Perform an action when both user data and verification are present and valid
      if (user && isVerified) {
        // Your logic here
        this.isAdmin = user.is_admin;
        this.email = user.email;
        // Perform other actions or set other flags as needed
      } else {
        console.log("User data or verification is invalid.");
      }
    } else {
      console.log("User not logged in or not verified.");
    }
  },
  watch: {},
  methods: {
    showWarningMessage(event) {
      // Display a warning message when leaving the page
      event.preventDefault();
      event.returnValue = ""; // For modern browsers

      // Customize the message shown to the user
      return "Are you sure you want to leave this page? Changes you made may not be saved.";
    },
    redirectToDashboard() {
      // Redirect to the admin dashboard
      this.$router.push("/dashboard");
    },
    goToPreviousPage() {
      const currentRoute = this.$route;
      const routeName = currentRoute.name;

      if (routeName === "Calculator") {
        console.log("Calculator");
        const confirmed = window.confirm(
          "Are you sure you want to leave this page? Changes you made may not be saved.?"
        );
        if (confirmed) {
          this.$router.go(-1);
        } else {
          // Handle 'No' button click or cancel
          console.log('User clicked "No" or cancelled');
          // Perform actions if the user clicks 'No' or cancels
        }
      } else {
        window.removeEventListener("beforeunload", this.showWarningMessage);
        this.$router.go(-1);
      }
    },
    logout() {
      localStorage.removeItem("user");
      localStorage.removeItem("token");
      localStorage.removeItem("varification");
      localStorage.removeItem("varification");
      localStorage.removeItem("trial_days_difference");
      if (this.$route.path != "/") this.$router.push("/");
      else location.reload();
    },
  },
};
</script>

<style scoped>
/* end modal  */
.userEmail {
  top: 20px;
  font-size: 20px;
  display: grid;
  text-align: justify;
}
.dropdown-item {
  cursor: pointer;
}
#trial-message {
  background-color: #0067b8; /* Light red background color */
  color: white; /* Dark red text color */
  padding: 10px;
  text-align: center;
  font-size: 16px;
  font-weight: bold;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000; /* Set a high z-index to make sure it's on top of other elements */
}

.active {
  color: gray !important;
  background: #f4eeee !important;
}
.paragraph-text {
  width: 100%;
  max-width: 963px;
  margin: auto;
}
.header-sect h2 {
  font-size: 40px;
  font-weight: 600;
  color: #000;
  width: 100%;
  margin: auto;
  margin-top: 15px;
}

.header-sect p {
  font-size: 31px;
  color: #000;
  margin-bottom: 0;
}
.logIn_Regester_btn {
  font-size: 20px;
}

.header-sect {
  padding: 40px 0;
}

.header-sect img {
  width: 200px;
}
.nav-fonts {
  font-size: 16px !important;
}
.home-mr {
  margin-right: 5px;
}
.toggle-menu {
  position: absolute;
  right: 13%;
  top: 15%;
}
.toggle-menu-login {
  position: absolute;
  right: 13%;
  top: 30%;
}

@media (max-width: 767.9px) {
  .header-sect img {
    width: 139px !important;
  }
  .header-sect h2 {
    font-size: 20px !important;
  }
  #trial-message {
    font-size: 11px;
  }
  .video-container {
    position: relative;
    padding-bottom: 56.25% !important; /* 16:9 aspect ratio */
    /* height: 0; */
    overflow: hidden;
  }

  .video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
  .header-sect p {
    font-size: 20px !important;
    color: #000 !important;
    margin-bottom: 30px !important;
  }

  section#wwwwh {
    margin-top: 0rem !important;
  }
  .mobile-logo {
    padding-top: 20px;
  }
  .userEmail {
    position: absolute;
    top: 40px;
    left: -20%;
    font-size: 12px;
    display: grid;
    text-align: justify;
  }
  .toggle-menu {
    top: 81px !important;
  }
}
</style>
