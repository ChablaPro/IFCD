<template>

	<!-- Billing Information Card -->
	<a-card :bordered="false" class="header-solid h-full" :bodyStyle="{paddingTop: 0, paddingBottom: '16px' }">
		<!--template #title>
			<h6 class="font-semibold m-0">Billing Information</h6>
		</template-->
		<a-row :gutter="[24, 24]">
			<div class="col-action">
				<a-button type="link" size="small"  @click="deleted">
					<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path class="fill-danger" fill-rule="evenodd" clip-rule="evenodd" d="M9 2C8.62123 2 8.27497 2.214 8.10557 2.55279L7.38197 4H4C3.44772 4 3 4.44772 3 5C3 5.55228 3.44772 6 4 6L4 16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V6C16.5523 6 17 5.55228 17 5C17 4.44772 16.5523 4 16 4H12.618L11.8944 2.55279C11.725 2.214 11.3788 2 11 2H9ZM7 8C7 7.44772 7.44772 7 8 7C8.55228 7 9 7.44772 9 8V14C9 14.5523 8.55228 15 8 15C7.44772 15 7 14.5523 7 14V8ZM12 7C11.4477 7 11 7.44772 11 8V14C11 14.5523 11.4477 15 12 15C12.5523 15 13 14.5523 13 14V8C13 7.44772 12.5523 7 12 7Z" fill="#111827"/>
					</svg>
					<span class="text-danger">DELETE</span>
				</a-button>
				<a-button type="link" size="small" @click="edited">
					<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path class="fill-muted" d="M13.5858 3.58579C14.3668 2.80474 15.6332 2.80474 16.4142 3.58579C17.1953 4.36683 17.1953 5.63316 16.4142 6.41421L15.6213 7.20711L12.7929 4.37868L13.5858 3.58579Z" fill="#111827"/>
						<path class="fill-muted" d="M11.3787 5.79289L3 14.1716V17H5.82842L14.2071 8.62132L11.3787 5.79289Z" fill="#111827"/>
					</svg>
					<span class="text-dark">EDIT</span>
				</a-button>
				<a-button type="link" size="small" @click="downloadPdf">
					<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10 2C10.5523 2 11 2.44772 11 3V11.5858L12.2929 10.2929C12.6834 9.90237 13.3166 9.90237 13.7071 10.2929C14.0976 10.6834 14.0976 11.3166 13.7071 11.7071L10.7071 14.7071C10.3166 15.0976 9.68342 15.0976 9.29289 14.7071L6.29289 11.7071C5.90237 11.3166 5.90237 10.6834 6.29289 10.2929C6.68342 9.90237 7.31658 9.90237 7.70711 10.2929L9 11.5858V3C9 2.44772 9.44772 2 10 2ZM4 16C4 15.4477 4.44772 15 5 15H15C15.5523 15 16 15.4477 16 16C16 16.5523 15.5523 17 15 17H5C4.44772 17 4 16.5523 4 16Z" fill="#111827"/>
					</svg>
					<span class="text-dark">DOWNLOAD PDF</span>
				</a-button>

			</div> <br>
			<a-col :span="24">
			<a-card :bordered="false" class="card-billing-info">
				<div class="col-info">
					<Row :gutter="16">
						<Col :xs="24" :sm="24" :md="12" :lg="12">
							<a-descriptions title="Key Information" :column="1">
								<a-descriptions-item label="Company Name">
									{{ info.denominationOpa }}
								</a-descriptions-item>
								<a-descriptions-item label="Legal status">
									{{ info.juridique }}
								</a-descriptions-item>
								<a-descriptions-item label="Creation date">
									{{ info.dateCreaction }}
								</a-descriptions-item>
								<a-descriptions-item label="Contact person">
									{{ info.personneContact }}
								</a-descriptions-item>
								<a-descriptions-item label="Contact">
									{{ info.contact }}
								</a-descriptions-item>
								<a-descriptions-item label="E-mail">
									{{ info.courriel }}
								</a-descriptions-item>
								<a-descriptions-item label="Maillons">
									{{ info.maillon }}
								</a-descriptions-item>
								
							</a-descriptions>
						</Col>
						<Col :xs="24" :sm="24" :md="12" :lg="12">
							<a-descriptions title="More Information" :column="1">
								
								<a-descriptions-item label="Total cooperative members">
									{{ info.totalMembre }}
								</a-descriptions-item>
								<a-descriptions-item label="Number of men in the cooperative">
									{{ info.nbrHomme }}
								</a-descriptions-item>
								<a-descriptions-item label="Number of women in the cooperative">
									{{ info.nbrFemme }}
								</a-descriptions-item>
								<a-descriptions-item label="Number of young men in the cooperative">
									{{ info.nbrJHomme }}
								</a-descriptions-item>
								<a-descriptions-item label="Number of young women in the cooperative">
									{{ info.nbrJFemme }}
								</a-descriptions-item>
								<a-descriptions-item label="What services do you provide to your members?">
									{{ info.services }}
								</a-descriptions-item>
								
							</a-descriptions>
						</Col>
					</Row>
				</div>
				
			</a-card>
			</a-col>
			<a-col :span="24">
			<a-card :bordered="false" class="card-billing-info">
				<div class="col-info">
					<a-descriptions title="OPA Information" :column="1">
					
						<a-descriptions-item label="Year of collection">
							{{ info.year }}
						</a-descriptions-item>
						<a-descriptions-item label="New OPA?">
							{{ info.newOpa }}
						</a-descriptions-item>
						<a-descriptions-item label="Department">
							{{ info.departement }}
						</a-descriptions-item>
						<a-descriptions-item label="Arrondissement">
							{{ info.arrondissement }}
						</a-descriptions-item>
						<a-descriptions-item label="Village">
							{{ info.village }}
						</a-descriptions-item>
						<a-descriptions-item label="Address/House">
							{{ info.adresse }}
						</a-descriptions-item>
						<a-descriptions-item label="Type of OPA">
							{{ info.typeOpa }}
						</a-descriptions-item>
						<a-descriptions-item label="What are the sectors on which the OPA is positioned?">
							{{ info.position }}
						</a-descriptions-item>
						<a-descriptions-item label="Does the OPA have a management committee?">
							{{ info.gestionOpa }}
						</a-descriptions-item>
						<a-descriptions-item label="Does the OPA have a board of directors?">
							{{ info.administrationOpa }}
						</a-descriptions-item>
						<a-descriptions-item label="Does the OPA have a supervisory board or commission?">
							{{ info.surveillanceOpa }}
						</a-descriptions-item>
						<a-descriptions-item label="Does the OPA have an Executive Board?">
							{{ info.bureauOpa }}
						</a-descriptions-item>
						
					</a-descriptions>
				</div>
				<!--div class="col-action">
					<a-button type="link" size="small">
						<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path class="fill-danger" fill-rule="evenodd" clip-rule="evenodd" d="M9 2C8.62123 2 8.27497 2.214 8.10557 2.55279L7.38197 4H4C3.44772 4 3 4.44772 3 5C3 5.55228 3.44772 6 4 6L4 16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V6C16.5523 6 17 5.55228 17 5C17 4.44772 16.5523 4 16 4H12.618L11.8944 2.55279C11.725 2.214 11.3788 2 11 2H9ZM7 8C7 7.44772 7.44772 7 8 7C8.55228 7 9 7.44772 9 8V14C9 14.5523 8.55228 15 8 15C7.44772 15 7 14.5523 7 14V8ZM12 7C11.4477 7 11 7.44772 11 8V14C11 14.5523 11.4477 15 12 15C12.5523 15 13 14.5523 13 14V8C13 7.44772 12.5523 7 12 7Z" fill="#111827"/>
						</svg>
						<span class="text-danger">DELETE</span>
					</a-button>
					<a-button type="link" size="small">
						<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path class="fill-muted" d="M13.5858 3.58579C14.3668 2.80474 15.6332 2.80474 16.4142 3.58579C17.1953 4.36683 17.1953 5.63316 16.4142 6.41421L15.6213 7.20711L12.7929 4.37868L13.5858 3.58579Z" fill="#111827"/>
							<path class="fill-muted" d="M11.3787 5.79289L3 14.1716V17H5.82842L14.2071 8.62132L11.3787 5.79289Z" fill="#111827"/>
						</svg>
						<span class="text-dark">EDIT</span>
					</a-button>
				</div-->
			</a-card>
			</a-col>

			<a-col :span="24">
				<a-card :bordered="false" class="card-billing-info">
					<div class="col-info">
								<a-table
								:loading="anim"
								:columns="table2Columns"
								:data-source="info.actors"
								:pagination="true"
								style="margin-top: 25px"
								>
								<template slot="name" slot-scope="name">
									<a>{{ name }}</a>
								</template>

								

								<template slot="code" slot-scope="code">
									<h6 class="m-0">
									{{ code }}
									</h6>
								</template>


								<template slot="genre" slot-scope="genre">
									<div class="text-right text-sm font-semibold text-muted pr-15">
										{{ genre }}
									</div>
								</template>

								<template slot="age" slot-scope="age">
									<div class="progress-right">
									<div class="text-right text-sm font-semibold text-muted pr-15">
										{{ age }}
									</div>
									</div>
								</template>

								<template slot="langue" slot-scope="langue">
									
									<div class="text-right text-sm font-semibold text-muted pr-15">
										{{ langue }}
									</div>
								</template>
								<template slot="niveau" slot-scope="niveau">
									<div class="text-right text-sm font-semibold text-muted pr-15">
										{{ niveau }}
									</div>
								</template>

								<!--template slot="user" slot-scope="user">
									<div class="progress-right">
									<div class="text-right text-sm font-semibold text-muted pr-15">
										{{ user.email }}
									</div>
									</div>
								</templat-->

								
								</a-table>
					</div>
					<!--div class="col-action">
						<a-button type="link" size="small">
							<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="fill-danger" fill-rule="evenodd" clip-rule="evenodd" d="M9 2C8.62123 2 8.27497 2.214 8.10557 2.55279L7.38197 4H4C3.44772 4 3 4.44772 3 5C3 5.55228 3.44772 6 4 6L4 16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V6C16.5523 6 17 5.55228 17 5C17 4.44772 16.5523 4 16 4H12.618L11.8944 2.55279C11.725 2.214 11.3788 2 11 2H9ZM7 8C7 7.44772 7.44772 7 8 7C8.55228 7 9 7.44772 9 8V14C9 14.5523 8.55228 15 8 15C7.44772 15 7 14.5523 7 14V8ZM12 7C11.4477 7 11 7.44772 11 8V14C11 14.5523 11.4477 15 12 15C12.5523 15 13 14.5523 13 14V8C13 7.44772 12.5523 7 12 7Z" fill="#111827"/>
							</svg>
							<span class="text-danger">DELETE</span>
						</a-button>
						<a-button type="link" size="small">
							<svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path class="fill-muted" d="M13.5858 3.58579C14.3668 2.80474 15.6332 2.80474 16.4142 3.58579C17.1953 4.36683 17.1953 5.63316 16.4142 6.41421L15.6213 7.20711L12.7929 4.37868L13.5858 3.58579Z" fill="#111827"/>
								<path class="fill-muted" d="M11.3787 5.79289L3 14.1716V17H5.82842L14.2071 8.62132L11.3787 5.79289Z" fill="#111827"/>
							</svg>
							<span class="text-dark">EDIT</span>
						</a-button>
					</div-->
				</a-card>
			</a-col>

		</a-row>
	</a-card>
	<!-- / Billing Information Card -->

</template>

<script>

	export default ({
		props: {
          info: [],
		
		},
		data() {
			return {
				table2Columns : [
  {
    title: "Code",
    dataIndex: "code",
    scopedSlots: { customRender: "code" },
    width: 300,
  },
  {
    title: "Full Name",
    dataIndex: "name",
    class: "font-semibold text-muted",
  },
  {
    title: "Gender",
    dataIndex: "genre",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Age",
    dataIndex: "age",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Language",
    dataIndex: "langue",
    class: "font-semibold text-muted text-sm",
  },
  {
    title: "Level",
    dataIndex: "niveau",
    class: "font-semibold text-muted text-sm",
  },
 /* {
    title: "Add by",
    dataIndex: "user",
    scopedSlots: { customRender: "user" },
    class: "font-semibold text-muted text-sm",
  },*/
  
],
			}
		},
		methods: {
			deleted(){
				this.$emit('handleDeleteInfo', this.info);
			},
			edited(){
				this.$emit('handleEditInfo', this.info);
			}
		}
	})

</script>