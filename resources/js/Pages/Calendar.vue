<template>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-4 border">
                <form class="mt-3" @submit="save">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm rounded-0" v-model="form.event"
                               placeholder="Event...">
                        <small class="text-danger" v-if="$page.props.errors.event">{{
                            $page.props.errors.event
                            }}</small>
                        <DatePicker input-class="form-control form-control-sm rounded-0 mt-3" v-model="form.dates" range
                                    placeholder="Select dates..." range-separator=" to "></DatePicker>
                        <small class="text-danger" v-if="$page.props.errors.dates">{{
                            $page.props.errors.dates
                            }}</small>
                        <div class="mt-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[0]">
                                <label class="form-check-label">M</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[1]">
                                <label class="form-check-label">T</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[2]">
                                <label class="form-check-label">W</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[3]">
                                <label class="form-check-label">Th</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[4]">
                                <label class="form-check-label">F</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[5]">
                                <label class="form-check-label">S</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" v-model="form.recurrences[6]">
                                <label class="form-check-label">S</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" :disabled="loading" class="btn btn-sm rounded-0 btn-primary">Submit
                    </button>
                </form>
            </div>
            <div class="col-md-8">
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>
    </div>
</template>

<script>
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import DatePicker from 'vue2-datepicker';

export default {
    components: {
        FullCalendar,
        DatePicker,
    },
    props: {
        calendars: Object,
    },
    data() {
        return {
            loading: false,
            form: {
                event: null,
                dates: null,
                recurrences: [
                    false,
                    false,
                    false,
                    false,
                    false,
                    false,
                    false
                ]
            },
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                events: this.calendars
            }
        }
    },
    methods: {
        save() {
            this.$inertia.post("store", this.form, {
                onStart: () => (this.loading = true),
                onFinish: () => (this.loading = false),
            });
        },
    }
}
</script>
