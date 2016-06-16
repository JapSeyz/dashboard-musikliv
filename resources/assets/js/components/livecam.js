import Grid from './grid';
import Pusher from '../mixins/pusher';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid">
            <img :src="path" class="livecam" align="middle">
        </grid>
    `,

    components: {
        Grid,
    },

    mixins: [Pusher, SaveState],

    props: ['grid'],
    

    data() {
        return {
            path: [
            ],
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Livecam\\Events\\ImageFetched': response => {
                    this.path = response.path;
                    console.log(this.path);
                },
            };
        },
        getSavedStateId() {
            return 'livecam';
        },
    },
};
