import Grid from './grid';
import Pusher from '../mixins/pusher';
import SaveState from '../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="padded overflow">
            <section class="packagist-statistics">
                <h1>Billet statistik</h1>
                    <ul>
                    <li class="packagist-statistic">
                        <span class="packagist-statistics__period">Solgt</span>
                        <span class="packagist-statistics__count">{{ sold | format-number }}</span>
                    </li>
                    <li class="packagist-statistic">
                        <h2 class="packagist-statistics__period">I Dag</h2>
                        <span class="packagist-statistics__count">{{ daily | format-number }}</span>
                    </li>
                    <li class="packagist-statistic -total">
                        <h2 class="packagist-statistics__period">I Alt </h2>
                        <span class="packagist-statistics__count">{{ total | format-number }}</span>
                    </li>
                </ul>
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
            sold: 0,
            daily: 0,
            total: 0,
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Packagist\\Events\\TotalsFetched': response => {
                    this.sold = response.sold;
                    this.daily = response.daily;
                    this.total = response.total;
                },
            };
        },

        getSavedStateId() {
            return 'packagist-statistics';
        },
    },
};