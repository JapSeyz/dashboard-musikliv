import './helpers/vue-filters';
import CurrentTime from './components/current-time';
import GoogleCalendar from './components/google-calendar';
import LastFm from './components/last-fm';
import moment from 'moment';
import Notification from './components/notification';
import PackagistStatistics from './components/packagist-statistics';
import RainForecast from './components/rain-forecast';
import Vue from 'vue';

moment.locale('da', {
    calendar: {
        lastDay: '[I går]',
        sameDay: '[I dag]',
        nextDay: '[I morgen]',
        lastWeek: '[Sidste] dddd',
        nextWeek: 'dddd',
        sameElse: 'L',
    },
});

new Vue({

    el: 'body',

    components: {
        CurrentTime,
        GoogleCalendar,
        LastFm,
        PackagistStatistics,
        RainForecast,
        Notification,
    },

});


