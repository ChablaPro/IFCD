<template>

	<!-- Project Card -->
	<a-card class="card-project">
		<img style="max-height: 300px;"
			slot="cover"
			alt="example"
			:src="cover"
		/>
		<div class="card-tag">Activity #{{ id }}</div>
		<h5>{{ title }}</h5>
		<p>
			{{ content }}
		</p>
	</a-card>
	<!-- / Project Card -->

</template>

<script>

	export default ({
		props: {
			id: {
				type: Number,
				required: true,
			},
			title: {
				type: String,
				default: "",
			},
			content: {
				type: String,
				default: "",
			},
			cover: {
				type: String,
				default: "",
			},
			team: {
				type: Array,
				default: () => [],
			},
			row: []
		},
		data() {
			return {
			}
		},
		methods:{
			deleted(row) {
			this.$emit("handleDelete", row);
			},
			edited(row) {
			this.$emit("handleEdit", row);
			},
			view(row) {
			this.$emit("handleView", row);
			},
			validated(row) {
			this.$emit("handleValidate", row);
			},
		}
	})

</script>