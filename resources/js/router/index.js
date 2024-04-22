import { createRouter, createWebHistory } from 'vue-router'
import Calculator from '../components/Calculator.vue'
import Home from '../components/Index.vue'
import Aboutus from '../components/About.vue'
import Login from '../components/Auth/Login.vue'
import Register from '../components/Auth/Register.vue'
import Verify from '../components/Auth/Verify.vue'
import NewSubscriptionPlans from '../components/NewSubscriptionPlans.vue'
import axios from 'axios'
import Dashboard from '../components/Dashboard.vue'
import Unauthorized from '../components/Unauthorized.vue'
import About from '../components/Aboutus.vue'
import Overview from '../components/Overview.vue'
import Resource from '../components/Resource.vue'
import Contact from '../components/Contact.vue'
import FAQs from '../components/FAQs.vue'
import Advertisers from '../components/advertisers.vue'
import FrequentlyAskedQuestions from '../components/FrequentlyAskedQuestions.vue'

import PrivacyPolicy from '../components/PrivacyPolicy.vue'
import CookiesPolicy from '../components/CookiesPolicy.vue'
import TermsAndConditions from '../components/TermsAndConditions.vue'



const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/calculator',
        name: 'Calculator',
        component: Calculator,
        meta: {
            requiresAuth: true,
        },
    },
    {
        path: '/about-us',
        name: 'About-us',
        component: Aboutus,
    },
    {
        path: '/about',
        name: 'About',
        component: About,
    },
    {
        path: '/overview',
        name: 'Overview',
        component: Overview,
    },

    {
        path: '/resource',
        name: 'Resource',
        component: Resource,
    },
     {
        path: '/contact',
        name: 'Contact',
        component: Contact,
    },
    {
        path: '/faqs',
        name: 'FAQs',
        component: FAQs,
    },
    {
        path: '/advertisers',
        name: 'Advertisers',
        component: Advertisers,
    },
    {
        path: '/frequently-asked-questions',
        name: 'FrequentlyAskedQuestions',
        component: FrequentlyAskedQuestions,
    },

    {
        path: '/privacy-policy',
        name: 'Privacy Policy ',
        component: PrivacyPolicy ,
    },
    {
        path: '/cookies-policy',
        name: 'CookiesPolicy',
        component: CookiesPolicy ,
    },
 
    {
        path: '/terms-and-conditions',
        name: 'TermsAndConditions',
        component: TermsAndConditions,
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/verify',
        name: 'verify',
        component: Verify,
    },
    {
        path: '/forgot-password',
        name: 'forgot-password',
        component: () => import('../components/Auth/ForgotPassword.vue'),
    },
    {
        path: '/reset-password',
        name: 'reset-password',
        component: () => import('../components/Auth/ResetPassword.vue'),
    },
    {
        path: '/subscription-plan',
        name: 'subscription-plan',
      
        component: () => import('../components/SubscriptionPlan.vue'),
    },

    {
        path: '/payment-plan',
        name: 'payment-plan',
        component: () => import('../components/PaymentPlans.vue'),
    },

    {
        path: '/user-subscription',
        name: 'user-subscription',
        meta: {
            requiresAuth: true,
        },
        component: () => import('../components/Auth/UserSubscription.vue'),
    },
    {
        path: '/my-account',
        name: 'my-account',
        meta: {
            requiresAuth: true,
        },
        component: () => import('../components/MyAccount.vue'),
    },
    {
        path: '/register',
        name: 'register',
        component: () => Register,
    },
    {
        path: '/newsubscriptionplans',
        name: 'newsubscriptionplans',
        component: () => NewSubscriptionPlans,
    },
    
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
            requiresAuthAdminDashboard: true,
        },
    },
    {
        path: '/unauthorized',
        name: 'unauthorized',
        component: () => Unauthorized,
    },
    {
        path: '/test-s',
        name: 'test-s',
        component: () => import('../components/SubscriptionStripe.vue'),
    }
];


const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('user');
    const token = localStorage.getItem('token');

    // Check if the route requires authentication
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Check if the user is logged in
        if (!loggedIn) {
            // Redirect to the login page if not logged in
            next('/login');
            return;
        }

        // Check if the user is an admin
        const user = JSON.parse(loggedIn);

        if (to.matched.some(record => record.meta.requiresAuthAdminDashboard)) {
            if (user.is_admin === 1) {
                // Allow access to the dashboard if the user is an admin
                next('/dashboard');
            } else {
                // Redirect to unauthorized page if the user is not an admin
                next('/unauthorized');
            }
        } else if(to.matched.some(record => record.meta.requiresAuthAdminDashboard) && user.is_admin === 0) {
            // For routes that do not specifically require admin access
            next();
        }else{
            next();
        }
    } else {
        next();
    }

});




export default router;
