import './helpers/vue-filters';
import CurrentTime from './components/current-time';
import GoogleCalendar from './components/google-calendar';
import LastFm from './components/last-fm';
import moment from 'moment';
import Notification from './components/notification';
import Livecam from './components/livecam';
import PackagistStatistics from './components/packagist-statistics';
import RainForecast from './components/rain-forecast';
import Grid from './components/Grid';
import Vue from 'vue';
moment.locale('da');

moment.locale('da', {
    calendar: {
        lastDay: '[I går]',
        sameDay: '[I dag], HH:mm',
        nextDay: '[I morgen], HH:mm',
        lastWeek: '[Sidste] dddd',
        nextWeek: 'dddd',
        sameElse: 'L',
    }
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
        Livecam,
        Grid,
    },

});


