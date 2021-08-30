<template>
	<v-card class="mx-auto p-4" width="700" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="batches.title"
				:counter="20"
				:rules="titleRules"
				label="Title"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="batches.description"
				:rules="descriptionRules"
				:counter="200"
				label="Description"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-select
				v-model="batches.classroom_id"
				:items="classrooms"
				item-text="title"
				item-value="id"
				menu-props="auto"
				label="Select Classroom"
				hide-details
				single-line
			></v-select>
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
		batches: {
			title: '',
			description: '',
			classroom_id: '',
		},
		classrooms: [],
	}),

	mounted() {
		this.getClassrooms();
	},

	methods: {
		getClassrooms() {
			axios.get("classrooms").then(
				res => {
					console.log(res.data);
					this.classrooms = res.data;
				},
				() => {
					console.log("error");
				}
			);
		},
		submit() {
			this.errors = {};
			//console.log(this.classroom);
			axios.post('/batches/store', this.batches).then(response => {
          console.log('Message sent!');
          this.$router.push('/batches');
          }).catch(error => {
            if (error.response.status === 422) {
              console.log("error");
            }
          });
		}
	}
};
</script>
