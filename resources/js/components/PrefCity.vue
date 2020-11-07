<template>
    <div>
        <select name="pref_id" id="prefs" class="form-control" @change="changePref">
            <option value="">都道府県</option>
            <option v-for="pref in prefs" :value="pref.id">{{ pref.name }}</option>
        </select>
        <select name="city_id" id="cities" class="form-control">
            <option value="">市区町村郡</option>
            <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
        </select>
    </div>
</template>

<script>
export default {
    props: {
        propPrefData: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            prefs: this.propPrefData,
            cities: [],
            prefId: '',
        }
    },
    methods: {
        changePref(e) {
            this.prefId = parseInt(e.target.value);
            console.log(typeof prefId, prefId);

            axios.post('api/cities', {
                prefectureId: this.prefId,
            }).then(function (responce) {
                console.log(responce);
            }).catch(function (error) {
                console.log(error);
            });
        },
    }
}
</script>
