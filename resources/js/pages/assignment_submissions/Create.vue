<template>
	<v-card class="mx-auto p-4" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="submissions.title"
				:counter="20"
				:rules="titleRules"
				label="Title"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="submissions.answers"
				:rules="answersRules"
				:counter="200"
				label="Answers"
				required
			></v-text-field>
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

		answersRules: [
			v => !!v || "Answer is required",
			v => (v && v.length <= 1000) || "Answer must be less than 1000 characters"
		],

		submissions: {
			title: '',
			answer: '',
		},
	}),

	mounted(){
		this.checkStudentAddAssignmentSubmissionPermission();
	},
	methods: {
		checkStudentAddAssignmentSubmissionPermission(){
			this.axios.get(`/assignments/${this.$route.params.assignment_id}/add-permission`)
			.then(response =>{
				if(response.data == '')
				{
					this.$router.push(`/assignments`);
				}
			})
		},
		submit() {
			this.errors = {};
			//console.log(this.classroom);
			axios.post(`/assignments/${this.$route.params.assignment_id}/submissions/store`, this.submissions)
			.then(response => {
				console.log('Message sent!');
				this.$router.push(`/assignments/${this.$route.params.assignment_id}/submissions`);
			})
			.catch(error => {
				console.log("error");
			});
		}
	}
};
</script>
