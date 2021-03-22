<template>
  <div></div>
</template>

<script>

export default {
  metaInfo: { title: 'Login' },
  components: {
  },
  data() {
    return {
      form: this.$inertia.form({
        email: 'johndoe@example.com',
        password: 'secret',
        remember: false,
      }),
    }
  },
  methods: {
    login() {
      this.form
        .transform(data => ({
          ...data,
          remember: data.remember ? 'on' : '',
        }))
        .post(this.route('login.attempt'))
    },
  },
};
</script>