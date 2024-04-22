<template>
  <div
    id="trial-message"
    v-if="trial_days_difference != '' && trial_days_difference >= 0"
  >
    Your trial membership ends in {{ trial_days_difference }} days and your card
    will be charged, unless you unsubscribe before the trail period ends.
  </div>
</template>

<script>
export default {
  name: "Header",

  components: {},
  beforeUnmount() {},
  created() {},
  mounted() {},
  data() {
    return {
      trial_days_difference: "",
    };
  },

  created() {
    // Check if user data exists in local storage
    const userData = localStorage.getItem("user");
    if (userData) {
      // If user data exists, parse it to get the user ID
      const userId = JSON.parse(userData).id;

      // Make API request only if user ID is available
      axios
        .get("/api/free-trial-check/" + userId)
        .then((response) => {
          if (response.data.status == "success") {
            this.trial_days_difference = response.data.trial_days_difference;
          }
        })
        .catch((error) => {
          this.loading = false;
          this.error = error.response.data.message;
        });
    } else {
      // Handle case where user data doesn't exist
      console.log("User data not found in local storage.");
    }
  },
  watch: {},
};
</script>

<style scoped>
.userEmail {
  position: absolute;
  top: 80px;
  left: 22%;
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

.header-sect {
  padding: 40px 0;
}

.header-sect img {
  width: 200px;
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
