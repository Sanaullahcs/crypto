<template>
  <Layout>
    <div class="pricing-container">
      <div class="price-headers">
        <h1 class="pricing-heading">Choose Your Plan</h1>
        <p class="pricing-text">No contracts, no surprise fees.</p>
      </div>
      <div class="tabs-price-container">
        <div class="pricing-tabs">
          <div
            v-for="(tab, index) in tabs"
            :key="index"
            @mouseover="hoverTab(index)"
            class="pricing-tab"
            :class="{ active: activeTab === index }"
          >
            {{ tab }}
          </div>
        </div>

        <div class="pricing-row">
          <div
            v-for="(card, index) in cards"
            :key="index"
            @mouseover="hoverCard(index)"
            @mouseleave="resetActiveTab"
            class="pricing-card"
            :class="{ selected: activeTab === index }"
          >
            <h2 class="pricing-title">{{ card.title }}</h2>
            <p class="price-value">
              {{ card.price }}<span class="price-month">/Month</span>
            </p>
            <div class="pricing-features">
              <ul>
                <li
                  v-for="(feature, fIndex) in card.features"
                  :key="fIndex"
                  class="features-list"
                >
                  <img
                    :src="isActiveTab(index) ? tickIconWhite : tickIconBlue"
                    :alt="'Feature ' + (fIndex + 1)"
                    class="tick-icon-img"
                  />
                  {{ feature }}
                </li>
              </ul>
            </div>
            <div class="pricing-actions">
              <button class="btn-subscribe">Choose Plan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script>
import Layout from "./Layout.vue";
import tickIconBlue from "./../../../public/images/tick-icon2.svg";
import tickIconWhite from "./../../../public/images/tick-icon3.svg";
export default {
  components: {
    Layout,
  },
  data() {
    return {
      activeTab: 1,
      tickIconBlue: tickIconBlue,
      tickIconWhite: tickIconWhite,
      tabs: ["Basic", "Plus", "Best"],
      cards: [
        {
          title: "Lite",
          price: "$29",
          features: [
            "Today & Planning view",
            "Checklist templates",
            "Calendar integration",
            "Browser extension",
          ],
        },
        {
          title: "Plus",
          price: "$89",
          features: [
            "Today & Planning view",
            "Checklist templates",
            "Calendar integration",
            "Browser extension",
          ],
        },
        {
          title: "Best Plan",
          price: "$159",
          features: [
            "Today & Planning view",
            "Checklist templates",
            "Calendar integration",
            "Browser extension",
          ],
        },
      ],
    };
  },
  methods: {
    hoverTab(index) {
      this.activeTab = index;
    },
    hoverCard(index) {
      this.activeTab = index;
    },
    resetActiveTab() {
      if (this.activeTab !== 1) {
        this.activeTab = 1;
      }
    },
    isActiveTab(index) {
      return this.activeTab === index;
    },
  },
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

.pricing-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  margin-top: 100px;
  margin: auto;
  text-align: center;
  gap: 30px;
  margin-bottom: 80px !important;
}

.tick-img {
  width: 16px;
  height: 16px;
}

.features-list {
  font-family: Montserrat;
  font-size: 18px;
  font-weight: 400;
  line-height: 28.8px;
  margin-bottom: 15px;
}

.pricing-heading {
  font-family: Montserrat;
  font-size: 48px;
  font-weight: 700;
  line-height: 52.8px;
  text-align: center;
  color: black;
}

.tabs-price-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 40px;
}
.pricing-text {
  font-family: Montserrat;
  font-size: 18px;
  font-weight: 400;
  line-height: 28.8px;
  text-align: center;
}

.pricing-row {
  display: flex;
  justify-content: center;
  text-align: left;
  gap: 30px;
}

.tick-icon-img {
}

.pricing-card {
  padding: 40px 30px;
  border-radius: 8px;
  background-color: #f2f4f6;

  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease-in-out;
  cursor: pointer;
  margin: 0 10px;
  width: 295px;
  height: 479px;
  border-radius: 20px;
}

.pricing-card:hover {
  transform: translateY(-5px);
  background-color: #5f30e2;
  color: white;
}

.pricing-title {
  font-family: Montserrat;
  font-size: 24px;
  font-weight: 700;
  line-height: 38.4px;
  text-align: left;
}

.pricing-features {
  margin-top: 20px;
}

.pricing-features ul {
  list-style-type: none;
  padding: 0;
  margin-top: 20px;
}

.pricing-actions {
  text-align: left;
}

.btn-subscribe {
  width: 179px;
  height: 54px;

  border-radius: 50px;
  border: 1px solid #5f30e2;
  color: #5f30e2;
  margin-top: 30px;
  font-family: Montserrat;
  font-size: 18px;
  font-weight: 500;
  line-height: 21.94px;
  text-align: center;
}

.btn-subscribe:hover {
  color: white;
  border: 1px solid white;
  background-color: #5f30e2;
}

.price-value {
  font-family: Montserrat;
  font-size: 48px;
  font-weight: 700;
  margin-top: -15px;
}

.price-month {
  font-family: Montserrat;
  font-size: 18px;
  font-weight: 400;
  line-height: 28.8px;
}

.selected {
}

.pricing-tabs {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
  width: 355px;
  height: 56px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
  border-radius: 66px;
  border: 2px solid #5f30e2;
}

.pricing-tab {
  width: 118.33px;
  height: 56px;
  border-radius: 66px;
  font-family: Montserrat;
  font-size: 16px;
  font-weight: 600;
  line-height: 25.6px;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
}

.pricing-tab.active {
  background-color: #5f30e2;
  color: white;
}

.pricing-card.selected {
  background-color: #5f30e2; /* Change background color of selected card */
  color: white; /* Change text color of selected card */
}

@media (max-width: 776px) {
  .pricing-row {
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: left;
    gap: 30px;
  }
}

@media (max-width: 992px) {
  .pricing-row {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: left;
  }
}
</style>
