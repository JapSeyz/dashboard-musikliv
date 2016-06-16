import Grid from './grid';
import Pusher from '../mixins/pusher';
import moment from 'moment';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
            <section class="notification">
                <h1 class="notification__title">{{ title | capitalize }}</h1>
                <div  class="notification__content">
                    {{{ message }}}
                </div>
                <div class="notification__small">{{ time }}</div>
            </section>
        </grid>
    `,

    components: {
        Grid,
    },

    mixins: [Pusher, SaveState],

    props: ['grid'],

    data() {
        return {
            message: '',
            title: '',
            time: '',
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Notification\\Events\\NotificationFetched': response => {
                    if (this.grid == response.grid) {
                        this.message = response.message;
                        this.title = response.title;
                        this.time = moment().format('HH:mm');
                    }
                },
            };
        },

        getSavedStateId() {
            return `notification-${this.grid}`;
        },
    },
};
