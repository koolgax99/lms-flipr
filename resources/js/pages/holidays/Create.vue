<template>
	<v-card class="mx-auto p-4" width="700" raised>
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
	  		<v-menu
		        v-model="holidays.date"
		        :close-on-content-click="false"
		        :nudge-right="40"
		        transition="scale-transition"
		        offset-y
		        min-width="290px"
		      	>
		        <template v-slot:activator="{ on, attrs }">
		          <v-text-field
		            v-model="holidays.date"
		            label="Select Date"
		            prepend-icon="event"
		            readonly
		            v-bind="attrs"
		            v-on="on"
		          ></v-text-field>
		        </template>
		        <v-date-picker v-model="date" ></v-date-picker>
		      </v-menu>
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

	methods: {
		submit() {
				this.errors = {};
				axios.post('/holidays/store', this.holidays).then(response => {
	          console.log('Message sent!');
	          this.$router.push('/holidays');
	          }).catch(error => {
	            if (error.response.status === 422) {
	              console.log("error");
	            }
	          });
			}
		}
};
</script>
