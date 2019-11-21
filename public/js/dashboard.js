var app = new Vue({
    el: '#app',
    data: {
        baseUrl: null,
        onboardingStats: null,
        chartOptions: {
        title: {
            text: 'Users Performance Through the Onboarding Flow\'',
            x: -20
        },
        xAxis: {
            title: {
                text: 'Steps in Onboarding Process'
            },
            categories: []
        },
        yAxis: {
            title: {
                text: 'Percentage of Users'
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        legend: {
            layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
        },
        series: []
    }
    },
    methods: {
    },
    beforeCreate() {
        this.baseUrl = window.location.origin;
        axios
            .get(this.baseUrl +'/stats/onboarding')
            .then(response => {
                this.onboardingStats = response.data.data;
                this.chartOptions.xAxis.categories = this.onboardingStats.categories;
                this.chartOptions.series = this.onboardingStats.series;
            }).catch(console.log('Request failed'));
    }
})