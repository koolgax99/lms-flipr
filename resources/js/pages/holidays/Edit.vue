<template>
  <v-card
    class="mx-auto p-4"
    width="700"
    raised
  >
  <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field
        v-model="holidays.title"
        :counter="20"
        :rules="titleRules"
        label="Title"
        required
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-text-field
        v-model="holidays.description"
        :rules="descriptionRules"
        :counter="200"
        label="Description"
        required
      ></v-text-field>
    <v-spacer></v-spacer>
        <v-date-picker 
          v-model="holidays.date"
          dateFormat="dd-MM-yyyy"
          name="date"
        ></v-date-picker>
    <v-spacer></v-spacer>
    <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
      Submit
    </v-btn>
  </v-form>
  </v-card>
</template>

<script>
  export default {
    data: () => ({
      valid: true,

      titleRules: [
      v => !!v || "Title is required",
      v => (v && v.length <= 20) || "Title must be less than 20 characters"
    ],

    descriptionRules: [
      v => !!v || "Description is required",
      v => (v && v.length <= 200) || "Description must be less than 200 characters"
    ],
  

    holidays: {
      title: '',
      description: '',
      date: '',
    },
    }),

    created() {
        let url = process.env.MIX_APP_URL + `/api/holidays/${this.$route.params.id}/edit`;
        this.axios.get(url).then((response) => {
            this.holidays = response.data;
        });
      },
      
    methods: {
      submit() {
          this.errors = {};
      axios.put(`/holidays/${this.$route.params.id}/update/`, this.holidays).then(response => {
        console.log('Message sent!');
        this.$router.push('/holidays');
      }).catch(error => {
        if (error.response.status === 422) {
        console.log("error");
        }
      });

        }
      },
    }
</script>
