import Grid from './grid';
import Pusher from '../mixins/pusher';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
            <section class="github-file">
                <h1 class="github-file__title">{{ title | capitalize }}</h1>
                <div  class="github-file__content">
                    {{{ contents }}}
                </div>
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
            contents: '',
            title: '',
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Notification\\Events\\NotificationFetched': response => {
                    this.contents = response.contents;
                    this.title = response.title;
                },
            };
        },

        getSavedStateId() {
            return `notification-${this.title}`;
        },
    },
};
