import Grid from "./grid";
import Pusher from "../mixins/pusher";
import SaveState from "../mixins/save-state";

export default {

    template: `
        <grid :position="grid" modifiers="padded overflow">
            <section class="packagist-statistics">
                <h1>Package Downloads</h1>
                    <ul>
                    <li class="packagist-statistic">
                        <span class="packagist-statistics__period">Billetter</span>
                        <span class="packagist-statistics__count tickets"></span>
                    </li>
                    <li class="packagist-statistic">
                        <span class="packagist-statistics__period">Dørsalg</span>
                        <span class="packagist-statistics__count door"></span>
                    </li>
                    <li class="packagist-statistic">
                        <h2 class="packagist-statistics__period">Fredag</h2>
                        <span class="packagist-statistics__count friday"></span>
                    </li>
                    <li class="packagist-statistic">
                        <h2 class="packagist-statistics__period">Lørdag</h2>
                        <span class="packagist-statistics__count saturday"></span>
                    </li>
                    <li class="packagist-statistic">
                        <h2 class="packagist-statistics__period">Madbilletter</h2>
                        <span class="packagist-statistics__count food"></span>
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
        return {};
    },

    methods: {
        getEventHandlers() {
            return {
                'App\\Components\\Packagist\\Events\\TotalsFetched': response => {
                    $('.tickets').html(response.tickets);
                    $('.door').html(response.door);
                    $('.friday').html(response.friday);
                    $('.saturday').html(response.saturday);
                    $('.food').html(response.food);
                },
            };
        },

        getSavedStateId() {
            return 'packagist-statistics';
        },
    },
};