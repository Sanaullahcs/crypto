<template>
    <Navbar />
    <div class="custom-container container-fluid">
        <slot></slot>
    </div>
    <Footer />
</template>
<script>
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';
export default {
    name: 'Home',
    components: {
        Navbar,
        Footer
    },
}
</script>
<style>
/* change blue button color code to #4472C4 */

.btn-primary:focus, .btn-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(68, 114, 196, 0.5);
}
.custom-container {
    margin-left: auto;
    margin-right: auto;
    /* padding-left: 15px; */
    /* padding-right: 15px; */
}

/* Responsive custom container styles */
@media (min-width: 576px) {

    /* Small devices (576px and up) */
    .custom-container {
        max-width: 720px;
        /* Increased from 540px */
    }
}

@media (min-width: 768px) {

    /* Medium devices (768px and up) */
    .custom-container {
        max-width: 960px;
        /* Increased from 720px */
    }
}

@media (min-width: 992px) {

    /* Large devices (992px and up) */
    .custom-container {
        max-width: 1200px;
        /* Increased from 960px */
    }
}

@media (min-width: 1200px) {

    /* Extra-large devices (1200px and up) */
    .custom-container {
        max-width: 1400px;
        /* Increased from 1140px */
    }
}
</style>
