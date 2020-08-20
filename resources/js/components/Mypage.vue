<template>
  <button></button>

</template>

<script>
export default {
  props: {
    userLikes: {
        type: String,
        default: null
    },
    userJoins: {
        type: String,
        default: null
    }
  },
  data: {
    switch: true
  },
  data() {
    return {
        Likes: this.userLikes,
        Joins: this.userJoins
    };
  },
  methods: {
      switch: function() {
          this.Likes = this.Joins
      }
  }
};
</script>