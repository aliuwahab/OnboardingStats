var app = new Vue({
    el: '#app',
    data: {
        baseUrl: null,
        message: 'Hello Vue!',
        onboardingStats: null
    },
    methods: {
        // baseUrl() {
        //
        // }
    },
    beforeMount() {
        this.baseUrl = window.location.origin;
    },
    mounted () {
        axios
            .get(this.baseUrl +'/stats/onboarding')
            .then(response => (this.onboardingStats = response.data.data))
            .catch(console.log('Request failed'))
    }
})