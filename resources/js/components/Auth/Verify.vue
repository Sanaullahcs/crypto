<template>
    <layout>
        <div class="my-5">
            <div class="card br-10 mw-550 m-auto">
                <div class="card-body p-4">
                    <h4 class="font-weight-bolder my-2">Verification</h4>
                    <p>Enter the verification code we just sent you on your email address.</p>
                    <form action="" autocomplete="off">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="my-2 ">Enter Code</label>
                            <input type="text" v-model="code" class="my-2 form-control bg-primary text-white" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="******  " autocomplete="off">
                        </div>
                         <p style="font-size: 14px;"><i>Please check your inbox for the verification code. If you don’t see it, it may have been filtered to your junk or spam folder.</i></p>
                        <div class="error">
                            <p class="text-danger w-100 text-center bg-yellow text-red" v-if="error != undefined">{{ error }}</p>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary my-2" v-on:click="verify()">Verify
                            <div v-if="loading" class="spinner-border spinner-border-sm text-light" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>
<script>
import axios from 'axios';
import Layout from '../Layout.vue';
import '@fortawesome/fontawesome-free/css/all.css';


export default {
    name: 'Home',

    components: {
        Layout
    },
    beforeUnmount() {

    },
    created() {

    },
    mounted() {

    },
    data() {
        return {
            code: '',
            error: '',
            loading: false,
        }


    },
    watch: {

    },
    methods: {
        verify() {
            this.loading = true;
            if(this.code == '') {
                this.loading = false;
                this.error = 'Please enter the verification code';
                return;
            }

            let id = JSON.parse(localStorage.getItem('user')).id;
            let inviteslug = localStorage.getItem('invite-slug');

            axios.get('/api/verify/' + this.code + '/' + id).then((response) => {
                this.loading = false;
                if(response.data.status == 'success') {
                    let type = this.$route.query.type;
                    const newVerificationData = true; // Set the verification data to true
                     localStorage.setItem('trial_days_difference', response.data.trial_days_difference ?? '');
                     localStorage.setItem('verification', JSON.stringify(newVerificationData));
                     if(type == 'fp') {
                        this.$router.push('/reset-password');
                        window.location.assign("/reset-password")
                    } else if(type == 'l') {
                        this.$router.push('/calculator');
                        window.location.assign("/calculator")
                    } else if(type == 'r') {
                        this.$router.push('/subscription-plan');
                        window.location.assign("/subscription-plan")
                    }else if(type == 'I'){
                        this.$router.push('/calculator');
                        window.location.assign("/calculator")
                    }
                    this.error = '';
                } else {
                    this.error = response.data.message;
                    this.toast.error(response.data.message);
                }
            }).catch((error) => {
                this.loading = false;
                this.error = error.response.data.message
            });
        }
    },
    computed: {

    }
}
</script>
<style>

</style>
