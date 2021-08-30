<template>
	<v-card class="mx-auto p-4" width="700" raised>
		<v-form ref="form" v-model="valid" lazy-validation>
			<v-text-field
				v-model="subjects.title"
				:counter="20"
				:rules="titleRules"
				label="Title"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.description"
				:rules="descriptionRules"
				:counter="200"
				label="Description"
				required
			></v-text-field>
      <v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.semester"
				:rules="semesterRules"
				:counter="20"
				label="semester"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.code"
				:rules="codeRules"
				:counter="20"
				label="Code"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.lecture_hours_per_week"
				:rules="lecture_hours_per_weekRules"
				:counter="2"
				label="lecture_hours_per_week"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.tutorial_hours_per_week"
				:rules="tutorial_hours_per_weekRules"
				:counter="20"
				label="tutorial_hours_per_week"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.practical_hours_per_week"
				:rules="practical_hours_per_weekRules"
				:counter="20"
				label="practical_hours_per_week"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.ss_hours_per_week"
				:rules="ss_hours_per_weekRules"
				:counter="20"
				label="ss_hours_per_week"
				required
			></v-text-field>

		<v-spacer></v-spacer>
			<v-text-field
				v-model="subjects.credits"
				:rules="creditsRules"
				:counter="20"
				label="credits"
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

		descriptionRules: [
			v => !!v || "Description is required",
			v => (v && v.length <= 200) || "Description must be less than 200 characters"
		],
		semesterRules: [
			v => !!v || "Semester is required",
			v => (v && v.length <= 20) || "Semester must be less than 20 characters"
		],
		codeRules: [
			v => !!v || "Code is required",
			v => (v && v.length <= 20) || "Code must be less than 20 characters"
		],
		lecture_hours_per_weekRules: [
			v => !!v || "lecture_hours_per_week is required",
			v => (v && v.length <= 20) || "lecture_hours_per_week must be less than 20 characters"
		],
		tutorial_hours_per_weekRules: [
			v => !!v || "tutorial_hours_per_week is required",
			v => (v && v.length <= 20) || "tutorial_hours_per_week must be less than 20 characters"
		],
		practical_hours_per_weekRules: [
			v => !!v || "practical_hours_per_week is required",
			v => (v && v.length <= 20) || "practical_hours_per_week must be less than 20 characters"
		],
		ss_hours_per_weekRules: [
			v => !!v || "ss_hours_per_week is required",
			v => (v && v.length <= 20) || "ss_hours_per_week must be less than 20 characters"
		],
		creditsRules: [
			v => !!v || "credits is required",
			v => (v && v.length <= 20) || "credits must be less than 20 haracters"
		],

		subjects: {
			title: '',
			description: '',
			code: '',
			semester:'',
			lecture_hours_per_week:'',
			tutorial_hours_per_week:'',
			practical_hours_per_week:'',
			ss_hours_per_week:'',
			credits:''
		},
	}),

	methods: {
		submit() {
				this.errors = {};
				axios.post('/subjects/store', this.subjects).then(response => {
	          console.log('Message sent!');
	          this.$router.push('/subjects');
	          }).catch(error => {
	            if (error.response.status === 422) {
	              console.log("error");
	            }
	          });
			}
		}
};
</script>
