<template>
    <Datepicker name="date"
        id="js-calendar"
        class="event-index-calendar"
        v-model="date"
        :language="ja"
        :format="DatePickerFormat">

    </Datepicker>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {ja} from 'vuejs-datepicker/dist/locale'
export default {
    components : {
        Datepicker
    },
    props: {
        propDate: String,
    },
    data () {
        return {
            ja:ja,
            DatePickerFormat: 'yyyy年MM月dd日',
        }
    },
    computed: {
        date: {
            get() {
                return this.propDate
            },
            set(value) {
                this.$emit('change', value)
            },
        },
    },
}
</script>
