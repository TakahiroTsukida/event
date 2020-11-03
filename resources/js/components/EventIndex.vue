<template>
    <div>
<!--        <p>ハロー・ワールド</p>-->
<!--        <div v-for="event in eventsData">-->
<!--            {{ event.name }}-->
<!--            <a href="{{ route('user.event.show', ['event' => $event]) }}">-->
<!--                <div class="d-flex flex-row">-->
<!--                    <div class="font-weight-bold">-->
<!--                        <h3 class="title">{{ $event->title }}</h3>-->
<!--                        @if ($event->image_path)-->
<!--                        <p class="img"><img src="{{ asset('storage/image/event_images/'.$event->image_path) }}"></p>-->
<!--                        @endif-->
<!--                        <h2 class="name">{{ $event->name }}</h2>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div>-->
<!--            {{ currentPage }}-->
<!--        </div>-->
    </div>
</template>

<script>
export default {
    props: {
        propEventData: {
            type: Array,
            default: [],
        },
        initialCurrentPage: {
            type: Number,
            default: 1,
        },
    },
    data() {
        return {
            eventsData: this.propEventData,
            currentPage: this.initialCurrentPage,
        }
    },
    methods: {

    },
};
</script>
