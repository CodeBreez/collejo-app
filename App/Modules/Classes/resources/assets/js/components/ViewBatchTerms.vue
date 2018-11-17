<template>
    <div class="terms-list">

        <ul class="list-group">
            <li class="list-group-item term-layer">
                <div :style="{width:timeLineItem.width + '%'}" v-for="(timeLineItem, index) in timeLine.blocks" :key="index" class="block">
                    <div v-if="timeLineItem.term" class="term">
                        {{timeLineItem.term.name}}
                    </div>
                    <div v-if="!timeLineItem.term" class="vacation placeholder"></div>
                </div>
            </li>
            <li class="list-group-item term-layer">
                <div class="date" :style="{width:date.width + '%'}" v-for="(date, index) in timeLine.dates" :key="index">
                    {{date.label}}
                </div>
            </li>
        </ul>

        <b-table :items="terms" :fields="tableFields" responsive no-local-sorting></b-table>
    </div>
</template>

<script>

    export default {
        mixins: [C.mixins.Trans, C.mixins.DateTimeHelpers],

        props: {
            terms: {
                default: [],
                type: Array
            }
        },

        data() {

            return {
                containerWidth:0,
                tableFields: [
                    {
                        key: 'name',
                        label: this.trans('classes::term.name')
                    },{
                        key: 'start_date',
                        label: this.trans('classes::term.start_date'),
                        formatter: (value, key, item) => {
                            return this.dateFormat(this.dateToUserTz(value))
                        }
                    },{
                        key: 'end_date',
                        label: this.trans('classes::term.end_date'),
                        formatter: (value, key, item) => {
                            return this.dateFormat(this.dateToUserTz(value))
                        }
                    },
                ],
                timeLine: {
                    blocks: [],
                    dates: []
                },
                multiplier: 3,
                startDate: null,
                endDate: null,
                totalDays:null,
            }
        },

        mounted() {

            this._renderTimeLine();
        },

        methods:{

            _getDiffInDays(from, to){

                const ts = moment(from);
                const te = moment(to);

                return te.diff(ts, 'days');
            },

            _renderTimeLine(){

                const containerWidth = this.$el.offsetWidth;

                if(this.terms.length){

                    this.startDate = moment(this.terms[0].start_date);
                    this.endDate = moment(this.terms[this.terms.length -1].end_date);

                    this.totalDays = this._getDiffInDays(this.startDate, this.endDate);

                    //this.multiplier = (100 / this.totalDays).toFixed(2);

                    this._calculateBlocks();
                    this._calculateDates();
                }
            },

            _calculateDates(){

                let sd = this.startDate;

                this.timeLine.dates = [];

                while(sd.isSameOrBefore(this.endDate)){

                    this.timeLine.dates.push({
                        from: sd.clone(),
                        to: sd.clone(),
                        label: sd.format('MMM')
                    });

                    sd = sd.add(1, 'months');
                }

                this.timeLine.dates.forEach(date => {

                    date.from = date.from.clone().set('date', 1);
                    date.to = date.to.clone().set('date', date.to.daysInMonth());
                    date.days = this._getDiffInDays(date.from, date.to) +1;
                    date.width = date.days * this.multiplier;
                });

                const first = this.timeLine.dates[0];

                if(first) {
                    first.from.set('date', this.startDate.get('date'));
                    first.days = this._getDiffInDays(first.from, first.to) + 1;
                    first.width = first.days * this.multiplier;
                }

                const last = this.timeLine.dates[this.timeLine.dates.length-1];

                if(last){
                    last.to.set('date', this.endDate.get('date'));
                    last.days = this._getDiffInDays(last.from, last.to) +1;
                    last.width = last.days * this.multiplier;
                }
            },

            _calculateBlocks(){

                this.timeLine.blocks = [];

                this.terms.forEach((term, index) => {

                    let days = this._getDiffInDays(term.start_date, term.end_date);

                    this.timeLine.blocks.push({
                        term: term,
                        days : days,
                        width : days * this.multiplier
                    });

                    let nextTerm = this.terms[index + 1];

                    if(nextTerm){

                        let days = this._getDiffInDays(term.end_date, nextTerm.start_date);

                        this.timeLine.blocks.push({
                            days : days,
                            width : days * this.multiplier
                        });
                    }
                });
            }
        }
    }
</script>