<!-- 
	This is the tables page, it uses the dashboard layout in: 
	"./layouts/Dashboard.vue" .
 -->

<template>
	<div>

		<a-modal v-model:open="openOrg" width="1000px" title="Add Organisation" @ok="handleOkOrg">
			<p>
				<label >Année de collecte</label>
				<a-select
					v-model="year"
					style="width: 100%"
					@focus="focus"
					@change="handleChange"
					>
					<a-select-option value="2024">2024</a-select-option>
					<a-select-option value="2025">2025</a-select-option>
					<a-select-option value="2026">2026</a-select-option>
					<a-select-option value="2027">2027</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Nouvelle OPA?</label>
				<a-radio-group v-model="newOPA" style="width: 100%">
					<a-radio :style="radioStyle" value="oui">Oui</a-radio>
					<a-radio :style="radioStyle" value="non">Non</a-radio>
				</a-radio-group>
			</p>
			<p>
				<label >Département</label>
				<a-select v-model="depOrg"
					show-search
					placeholder="Select a Department"
					option-filter-prop="children"
					style="width: 100%"
					:filter-option="filterOptionDep"
				>
					<a-select-option value="Alibori">
						Alibori
					</a-select-option>
					<a-select-option value="Atacora">
						Atacora
					</a-select-option>
					<a-select-option value="Atlantique">
						Atlantique
					</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Commune</label>
				<a-select v-model="comOrg"
					show-search
					placeholder="Select a commune"
					option-filter-prop="children"
					style="width: 100%"
					:filter-option="filterOptionDep"
				>
					<a-select-option value="Banikoara">
						Banikoara
					</a-select-option>
					<a-select-option value="Natitingou">
						Natitingou
					</a-select-option>
					<a-select-option value="Abomey-Calavi">
						Abomey-Calavi
					</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Arrondissement</label>
				<a-select v-model="depAr"
					show-search
					placeholder="Select a Arrondissement"
					option-filter-prop="children"
					style="width: 100%"
					:filter-option="filterOptionDep"
				>
				   <a-select-option value="Gogounou">
						Gogounou
					</a-select-option>
					<a-select-option value="Kandi I">
						Kandi I
					</a-select-option>
					<a-select-option value="Cotonou I">
						Cotonou I
					</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Village</label>
				<label >Arrondissement</label>
				<a-select v-model="depVil"
					show-search
					placeholder="Select a Village"
					option-filter-prop="children"
					style="width: 100%"
					:filter-option="filterOptionDep"
				>
					<a-select-option value="Lafia">
						Lafia
					</a-select-option>
					<a-select-option value="Kpérou">
						Kpérou
					</a-select-option>
					<a-select-option value="Akassato">
						Akassato
					</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Adresse/Maison</label>
				<a-input  />
			</p>
			<p>
				<label >Type d'OPA</label>
				<a-select
					v-model="typeOPA"
					style="width: 100%"
					@focus="focus"
					@change="handleChange"
					>
					<a-select-option value="Coopérative">Coopérative</a-select-option>
					<a-select-option value="Association">Association</a-select-option>
					<a-select-option value="GIE">Groupe d'Intérêt Economique (GIE)</a-select-option>
					<a-select-option value="Union Communale">Union Communale</a-select-option>
				</a-select>
			</p>
			<p>
				<label >Dénomination de l'OPA</label>
				<a-input  />
			</p>
			<p>
				<label >Mallions</label>
				<a-select
					v-model="maillons"
					style="width: 100%"
					@focus="focus"
					@change="handleChange"
					>
					<a-select-option value="Coopérative">Production Végétale</a-select-option>
					<a-select-option value="Association">Transformation</a-select-option>
					<a-select-option value="GIE">Commercialisation</a-select-option>
					<a-select-option value="Union Communale">Production animale</a-select-option>
					<a-select-option value="Coopérative">Fourniture de biens et services</a-select-option>
					<a-select-option value="Association">Acteurs Publics</a-select-option>
					<a-select-option value="GIE">ATDA4</a-select-option>
					<a-select-option value="Union Communale">CCIC</a-select-option>
					<a-select-option value="Coopérative">GIC</a-select-option>
					<a-select-option value="Association">INRAB</a-select-option>
					<a-select-option value="GIE">Transporteur</a-select-option>
					<a-select-option value="Union Communale">mPME</a-select-option>
				</a-select>
			</p>
			<p>
				<label >L'OPA a t-elle un comité de gestion?</label>
				<a-radio-group v-model="newOPA" style="width: 100%">
					<a-radio :style="radioStyle" value="oui">Oui</a-radio>
					<a-radio :style="radioStyle" value="non">Non</a-radio>
				</a-radio-group>
			</p>
			<p>
				<label >L'OPA a-t-elle un conseil d’administration ?</label>
				<a-radio-group v-model="newOPA" style="width: 100%">
					<a-radio :style="radioStyle" value="oui">Oui</a-radio>
					<a-radio :style="radioStyle" value="non">Non</a-radio>
				</a-radio-group>
			</p>
			<p>
				<label >L'OPA a-t-elle un Bureau exécutif?</label>
				<a-radio-group v-model="newOPA" style="width: 100%">
					<a-radio :style="radioStyle" value="oui">Oui</a-radio>
					<a-radio :style="radioStyle" value="non">Non</a-radio>
				</a-radio-group>
			</p>
			
		</a-modal>



		<!-- Projects Table -->
		<a-row :gutter="24" type="flex">

			<!-- Projects Table Column -->
			<a-col :span="24" class="mb-24">

				<!-- Projects Table Column -->
				<CardProjectTable2
					:data="table2Data"
					:columns="table2Columns"
				></CardProjectTable2>
				<!-- / Projects Table Column -->

			</a-col>
			<!-- / Projects Table Column -->

		</a-row>
		<!-- / Projects Table -->

	</div>
</template>

<script>

	// "Authors" table component.
	import CardAuthorTable from '../components/Cards/CardAuthorTable' ;

	// "Projects" table component.
	import CardProjectTable2 from '../components/Cards/CardProjectTable2' ;
	
	// "Authors" table list of columns and their properties.
	const table1Columns = [
		{
			title: 'AUTHOR',
			dataIndex: 'author',
			scopedSlots: { customRender: 'author' },
		},
		{
			title: 'FUNCTION',
			dataIndex: 'func',
			scopedSlots: { customRender: 'func' },
		},
		{
			title: 'STATUS',
			dataIndex: 'status',
			scopedSlots: { customRender: 'status' },
		},
		{
			title: 'EMPLOYED',
			dataIndex: 'employed',
			class: 'text-muted',
		},
		{
			title: '',
			scopedSlots: { customRender: 'editBtn' },
			width: 50,
		},
	];

	// "Authors" table list of rows and their properties.
	const table1Data = [
		{
			key: '1',
			author: {
				avatar: 'images/face-2.jpg',
				name: 'Michael John',
				email: 'michael@mail.com',
			},
			func: {
				job: 'Manager',
				department: 'Organization',
			},
			status: 1,
			employed: '23/04/18',
		},
		{
			key: '2',
			author: {
				avatar: 'images/face-3.jpg',
				name: 'Alexa Liras',
				email: 'alexa@mail.com',
			},
			func: {
				job: 'Programator',
				department: 'Developer',
			},
			status: 0,
			employed: '23/12/20',
		},
		{
			key: '3',
			author: {
				avatar: 'images/face-1.jpg',
				name: 'Laure Perrier',
				email: 'laure@mail.com',
			},
			func: {
				job: 'Executive',
				department: 'Projects',
			},
			status: 1,
			employed: '13/04/19',
		},
		{
			key: '4',
			author: {
				avatar: 'images/face-4.jpg',
				name: 'Miriam Eric',
				email: 'miriam@mail.com',
			},
			func: {
				job: 'Marketing',
				department: 'Organization',
			},
			status: 1,
			employed: '03/04/21',
		},
		{
			key: '5',
			author: {
				avatar: 'images/face-5.jpeg',
				name: 'Richard Gran',
				email: 'richard@mail.com',
			},
			func: {
				job: 'Manager',
				department: 'Organization',
			},
			status: 0,
			employed: '23/03/20',
		},
		{
			key: '6',
			author: {
				avatar: 'images/face-6.jpeg',
				name: 'John Levi',
				email: 'john@mail.com',
			},
			func: {
				job: 'Tester',
				department: 'Developer',
			},
			status: 0,
			employed: '14/04/17',
		},
	];
	
	// "Projects" table list of columns and their properties.
	const table2Columns = [
		{
			title: 'Organisation',
			dataIndex: 'company',
			scopedSlots: { customRender: 'company' },
			width: 300,
		},
		{
			title: 'Type',
			dataIndex: 'budget',
			class: 'font-semibold text-muted',
		},
		{
			title: 'Village',
			dataIndex: 'status',
			class: 'font-semibold text-muted text-sm',
		},
		{
			title: 'Value chain',
			dataIndex: 'value',
			class: 'font-semibold text-muted text-sm',
		},
		{
			title: 'Date de création',
			dataIndex: 'value',
			class: 'font-semibold text-muted text-sm',
		},
		{
			title: 'Actions',
			scopedSlots: { customRender: 'editBtn' },
			width: 50,
		},
	];

	// "Projects" table list of rows and their properties.
	const table2Data = [
		{
			key: '1',
			company: {
				name: 'Spotify Version',
				logo: 'images/logos/logo-spotify.svg',
			},
			status: "working",
			budget: '$14,000',
			completion: 60,
		},
		{
			key: '2',
			company: {
				name: 'Progress Track',
				logo: 'images/logos/logo-atlassian.svg',
			},
			status: "working",
			budget: '$3,000',
			completion: 10,
		},
		{
			key: '3',
			company: {
				name: 'Jira Platform Errors',
				logo: 'images/logos/logo-slack.svg',
			},
			status: "done",
			budget: 'Not Set',
			completion: {
				status: 'success',
				value: 100,
			},
		},
		{
			key: '4',
			company: {
				name: 'Launch new Mobile App',
				logo: 'images/logos/logo-spotify.svg',
			},
			status: "canceled",
			budget: '$20,600',
			completion: {
				status: 'exception',
				value: 50,
			},
		},
		{
			key: '5',
			company: {
				name: 'Web Dev',
				logo: 'images/logos/logo-webdev.svg',
			},
			status: "working",
			budget: '$4,000',
			completion: 80,
		},
		{
			key: '6',
			company: {
				name: 'Redesign Online Store',
				logo: 'images/logos/logo-invision.svg',
			},
			status: "canceled",
			budget: '$2,000',
			completion: {
				status: 'exception',
				value: 0,
			},
		},
	];

	export default ({
		components: {
			CardAuthorTable,
			CardProjectTable2,
		},
		data() {
			return {
				itemsDepOrg: ['jack', 'lucy'],
				
				nameDepOrg: '',
				inputRef: null,
				index: 0,
				openOrg: true,
				newOPA: "oui",

				// Associating "Authors" table data with its corresponding property.
				table1Data: table1Data,

				// Associating "Authors" table columns with its corresponding property.
				table1Columns: table1Columns,

				// Associating "Projects" table data with its corresponding property.
				table2Data: table2Data,

				// Associating "Projects" table columns with its corresponding property.
				table2Columns: table2Columns,
			}
		},
		methods: {
			handleOkOrg(){

			},
			filterOptionDep(input, option) {
				return (
					option.componentOptions.children[0].text.toLowerCase().indexOf(input.toLowerCase()) >= 0
				);
			},
		},
		mounted() {
			this.inputRef = this.$refs.inputRef;
		},
	})

</script>

<style lang="scss">
</style>