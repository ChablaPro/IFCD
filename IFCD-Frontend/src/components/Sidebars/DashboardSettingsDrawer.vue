<template>

	<!-- Settings Drawer -->
	<a-drawer class="settings-drawer" :class="[rtl ? 'settings-drawer-rtl' : '']" :placement="rtl ? 'left' : 'right'"
		:closable="false" :visible="showSettingsDrawer"  :getContainer="() => wrapper" width="100%"
		@close="$emit('toggleSettingsDrawer', false)">

		<!-- Settings Drawer Close Button -->
		<a-button type="link" class="btn-close" @click="$emit('toggleSettingsDrawer', false)">
			<svg xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9">
				<g id="close" transform="translate(0.75 0.75)">
					
					<path id="Path" d="M7.5,0,0,7.5" fill="none" stroke="#000" stroke-linecap="round"
						stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" />
					<path id="Path-2" data-name="Path" d="M0,0,7.5,7.5" fill="none" stroke="#000" stroke-linecap="round"
						stroke-linejoin="round" stroke-miterlimit="10" stroke-width="1.5" />
				</g>
			</svg>
		</a-button>
		<!-- / Settings Drawer Close Button -->

		<!-- Settings Drawer Content -->
		<div class="drawer-content">
			<h6>Configurator</h6>
			<p>See our dashboard options.</p>
			<hr>
			<div class="sidebar-color">
				<h6>Sidebar Color</h6>
				<a-radio-group v-model="sidebarColorModel" @change="$emit('updateSidebarColor', $event.target.value)"
					defaultValue="primary">
					<a-radio-button value="primary" class="bg-primary"></a-radio-button>
					<a-radio-button value="secondary" class="bg-secondary"></a-radio-button>
					<a-radio-button value="success" class="bg-success"></a-radio-button>
					<a-radio-button value="danger" class="bg-danger"></a-radio-button>
					<a-radio-button value="warning" class="bg-warning"></a-radio-button>
					<a-radio-button value="black" class="bg-dark"></a-radio-button>
				</a-radio-group>
			</div>
			<div class="sidenav-type">
				<h6>Sidenav Type</h6>
				<p>Choose between 2 different sidenav types.</p>
				<a-radio-group button-style="solid" v-model="sidebarThemeModel"
					@change="$emit('updateSidebarTheme', $event.target.value)" defaultValue="primary">
					<a-radio-button value="light">TRANSPARENT</a-radio-button>
					<a-radio-button value="white">WHITE</a-radio-button>
				</a-radio-group>
			</div>
			<div class="navbar-fixed">
				<h6>Navbar Fixed</h6>
				<a-switch default-checked v-model="navbarFixedModel"
					@change="$emit('toggleNavbarPosition', navbarFixedModel)" />
			</div>
			<!--div class="download">
				<a-button type="dark" href="https://www.creative-tim.com/product/muse-vue-ant-design-dashboard" block target="_blank">FREE DOWNLOAD</a-button>
				<a-button type="primary" href="https://www.creative-tim.com/product/muse-vue-ant-design-dashboard-pro" block target="_blank">UPGRADE TO PRO</a-button>
				<a-button type="secondary" href="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/documentation" block target="_blank">VIEW DOCUMENTATION</a-button>
			</div>
			<div class="github-stars">
				<gh-btns-star slug="creativetimofficial/muse-vue-ant-design-dashboard" show-count></gh-btns-star>
			</div>
			<div class="sharing">
				<h6>Thank you for sharing!</h6>
				<div class="share-links">
					<a-button type="dark" target="_blank" href="https://twitter.com/intent/tweet?url=https://www.creative-tim.com/product/muse-vue-ant-design-dashboard&text=Check%20Muse%20Vue%20Ant%20Design%20made%20by%20@CreativeTim%20#webdesign%20#dashboard%20#antdesign%20#vue%20https://www.creative-tim.com/product/muse-vue-ant-design-dashboard" size="small">
						<svg width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
						TWEET
					</a-button>
					<a-button type="dark" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/muse-vue-ant-design-dashboard"  size="small">
						<svg width="15px" height="15px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M503.691 189.836L327.687 37.851C312.281 24.546 288 35.347 288 56.015v80.053C127.371 137.907 0 170.1 0 322.326c0 61.441 39.581 122.309 83.333 154.132 13.653 9.931 33.111-2.533 28.077-18.631C66.066 312.814 132.917 274.316 288 272.085V360c0 20.7 24.3 31.453 39.687 18.164l176.004-152c11.071-9.562 11.086-26.753 0-36.328z"/></svg>
						SHARE
					</a-button>
				</div>
			</div-->
			<div class="download">
				<h6>Roles</h6>
				<a-collapse v-model:activeKey="activeKey" :bordered="false" style="background: rgb(255, 255, 255)">
					<template #expandIcon="{ isActive }">
						<caret-right-outlined :rotate="isActive ? 90 : 0" />
					</template>
					<a-collapse-panel key="1" header="Role Settings"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden">
						<p>
							<div>
								<a-modal v-model="openRole" width="1000px" title="Add Role">
									
									<p>
										<label>Role Name</label>
										<a-input v-model="data.name" />
									</p>
									<template #footer>
										<a-button key="back" @click="openRole = false" 
										>Cancel</a-button
										>
										<a-button
										key="submit"
										type="primary"
										:loading="loadingAdd"
										@click="handleOkOrg"
										>Submit</a-button
										>
									</template>
								</a-modal>

								<a-modal v-model="openEditRole" width="1000px" title="Edit Role">
									<p>
										<label>Role Name</label>
										<a-input v-model="editData.name" />
									</p>

								<template #footer>
									<a-button key="back" @click="openEditRole=false"
									>Cancel</a-button
									>
									<a-button
									key="submit"
									type="primary"
									:loading="loadingEdit"
									@click="handleEditOrg"
									>Submit</a-button
									>
								</template>
								</a-modal>

								<a-modal v-model="openInfoRole" width="1000px" title="View Organisation">
								<CardBillingInfoOrg
									:info="viewData"
									@handleDeleteInfo="handleDeleteInfo"
									@handleEditInfo="handleEditInfo"
								>
								</CardBillingInfoOrg>

								<template #footer>
									<a-button key="back" @click="handleCancelInfo">Cancel</a-button>
								</template>
								</a-modal>

								<!-- Projects Table -->
								<a-row :gutter="24" type="flex">
								<!-- Projects Table Column -->
								<a-col :span="24" class="mb-24">
									<!-- Projects Table Column -->
									<CardProjectTable2
									:anim="anim"
									:data="table2Data"
									:columns="table2Columns"
									@openFunc="handleOpenFunc"
									@handleValidate="handleValidate"
									@handleDelete="handleDelete"
									@handleEdit="handleEdit"
									@handleView="handleView"
									@handleNotValidate="handleNotValidate"
									@handleAll="handleAll"
									@search="handleSearch"
									>
									</CardProjectTable2>
									<!-- / Projects Table Column -->
								</a-col>
								<!-- / Projects Table Column -->
								</a-row>
								<!-- / Projects Table -->
							</div>
						</p>
					</a-collapse-panel>
				</a-collapse>
			</div>

			<div class="download">
				<h6>Roles Permissions</h6>
				<a-collapse v-model:activeKey="activeKey" :bordered="false" style="background: rgb(255, 255, 255)">
					<template #expandIcon="{ isActive }">
						<caret-right-outlined :rotate="isActive ? 90 : 0" />
					</template>
					<a-collapse-panel key="1" :header="role.name"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden" v-for="(role , i) in dataR.roles" :key="i">
						<p>
							
								<Row :gutter="16" >
									<Col span="4">Page Name</Col>
									<Col span="4">View</Col>
									<Col span="4">Add</Col>
									<Col span="4">Edit</Col>
									<Col span="4">Delete</Col>
									<Col span="4">Setting</Col>
									<Divider />
								</Row>
								<Row :gutter="16" v-for="(permission, id) in role.permissions" :key="id">
									<Col span="4">{{permission.name}}</Col>
									<Col span="4"><Checkbox v-model="permission.view" ></Checkbox></Col>
									<Col span="4"><Checkbox v-model="permission.add" ></Checkbox></Col>
									<Col span="4"><Checkbox v-model="permission.edit" ></Checkbox></Col>
									<Col span="4"><Checkbox v-model="permission.delete" ></Checkbox></Col>
									<Col span="4"><Checkbox v-model="permission.setting" ></Checkbox></Col>
									<Divider />
								</Row>
								
						</p>
					</a-collapse-panel>
				</a-collapse>
			</div>

			<div class="download">
				<h6>Users</h6>
				<a-collapse v-model:activeKey="activeKey" :bordered="false" style="background: rgb(255, 255, 255)">
					<template #expandIcon="{ isActive }">
						<caret-right-outlined :rotate="isActive ? 90 : 0" />
					</template>
					<a-collapse-panel key="1" header="User Settings"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden">
						<p>

                            <div >
								<Row>
									<Col span="12" ><Button type="primary"  @click="modalAdd = true" ><Icon type="ios-add" /> Add</Button></Col>
									<Col span="12" ><Input search placeholder="Enter something..." v-model="searchUser" @keyup="searchRoleUser" @search="searchRoleUser"
          @input="searchRoleUser" autocomplete="cc-exp"/></Col>
								</Row>
							
							 <br>

							<!--Tableau de données-->

								<div style="text-align: center;">
									
									<Table border :row-class-name="rowClassName" :columns="columns" :data="dataUsers" v-if="dataUsers.length > 0">
										<template #name="{ row }">
											<strong>{{ row.name }}</strong>
										</template>
										<template #email="{ row }">
											<strong>{{ row.email }}</strong>
										</template>
										<template #pays="{ row }">
											<strong>{{ row.pays }}</strong>
										</template>
										<template #role="{ row }">
											<strong>{{ row.role }}</strong>
										</template>
										<template #action="{ row, index }">
											<div>
												<Button type="primary" size="small" style="margin-right: 5px" @click="showEditModal(row, index)" >Edit</Button>
												<Button type="error" size="small" @click="showDeletingModal(row, index)" >Delete</Button>
											</div>
										</template>
										
									</Table>
									<span class="loader" v-if="dataUsers.length <=0 "></span>

									<!--Modal d'ajout'-->
									<Modal
										v-model="modalAdd">
										<template #header>
											<p style="text-align:center">
												<Icon type="md-add" />
												<span>Add User</span>
											</p>
										</template>
										<div >

											<p >

												<a-upload-dragger
												v-if="!dataUser.photo"
												:file-list="fileList"
												name="photo"
												:multiple="false"
												:action="'http://127.0.0.1:8000/api/actor/upload'"
												:headers="uploadHeaders"
												:before-upload="beforeUpload"
												@change="handleChange"
												@drop="handleDrop"
												>
													<p class="ant-upload-drag-icon">
														<inbox-outlined></inbox-outlined>
													</p>
													<p class="ant-upload-text">
														Click or drag an image to this area to upload
													</p>
													<p class="ant-upload-hint">
														Support for a single image upload. Strictly upload only image files
														(jpeg, png, jpg, gif) with a maximum size of 2MB.
													</p>
												</a-upload-dragger>
												<a-row type="flex">
												<a-col class="col-img" :span="24" :xl="12">
													<div class="card-img-bg">
														<img
															:src="'http://127.0.0.1:8000' + dataUser.photo"
															 v-if="dataUser.photo"
															  style="max-width: 150px; border-radius: 5px"
														/>
													</div>
												</a-col>
												<a-col
													class="col-content"
													:span="24"
													:xl="12"
													style="justify-content: center"
												>
													<a-button
													type="danger"
													danger
													style="width: 100%"
													v-if="dataUser.photo"
													@click="handleRemove"
													>Remove Image</a-button
													>
												</a-col>
												</a-row>
												
											</p>

										</div> <br>
										<div >
											<p>User Name <span style="color: red;">*</span></p>
											<p ><Input v-model="dataUser.name" placeholder="Ex: John Doe"  /></p>
										</div> <br>
										<div >
											<p>User Email <span style="color: red;">*</span></p>
											<p ><Input v-model="dataUser.email" placeholder="Ex: john@gmail.com"  /></p>
										</div> <br>
										<div >
											<p>User Password <span style="color: red;">*</span></p>
											<p>
												<Input
												v-model="dataUser.password"
												placeholder="Enter password"
												type="password" password
												/>
											</p>
											<!--p v-if="!passwordValid">
												The password must contain at least 6 characters, one uppercase letter, and one special character.
											</p-->
											</div>
											<!--div >
												<Progress :percent="40" status="wrong" v-if="passwordStrength==40"/>
												<Progress :percent="60"  v-if="passwordStrength==60" :stroke-color="['#f5578b', '#34A1DC']" />
												<Progress :percent="100"  v-if="passwordStrength==100"/>
											</div--> <br>
										<div >
											<p>User confirm_password <span style="color: red;">*</span></p>
											<p ><Input v-model="dataUser.password_confirm" type="password" placeholder="Confirm your password" password  /></p>
											
											<!--p>
												<div v-if="passwordConfirmValid">
												Passwords must match.
												<Progress :percent="60"  :stroke-color="['#f5578b', '#34A1DC']" />
												</div>
												<div v-else>
													<Progress :percent="100"  />
												</div>
											</p-->
											
										</div> <br>

										<div >
											<p>User Country </p>
											<p >
												<a-select
												v-model="dataUser.pays"
												show-search
												placeholder="Select a country"
												option-filter-prop="children"
												style="width: 100%"
												:filter-option="
													(input, option) =>
													option.componentOptions.children[0].text
														.toLowerCase()
														.includes(input.toLowerCase())
												"
												>
													<a-select-option  value="Burkina Faso">
														Burkina Faso 
													</a-select-option>
													<a-select-option  value="Mali">
														Mali 
													</a-select-option>
													<a-select-option  value="Niger">
														Niger
													</a-select-option>
													<a-select-option  value="Nigéria">
														Nigéria 
													</a-select-option>
												</a-select>
											</p>
											
											
										</div> <br>
										<div >
											<p>User Role <span style="color: red;">*</span></p>
											<p >
												<Select v-model="dataUser.role_id" placeholder="Select a role" >
													<Option v-for="item in getRole" :value="item.id" :key="item.id">{{ item.name }}</Option>
												</Select>
											</p>
										</div>
										<template #footer>
											<Button type="default"  @click="modalAdd = false">Cancel</Button>
											<Button type="success" :loading="modal_loading" @click="saveUser">Save</Button>
										</template>

									</Modal>

									<Modal
										v-model="modalEdit"
										title="Modal Edit">
										
										<template #header>
											<p style="text-align:center">
												<Icon type="ios-brush-outline" />
												<span>Edit User</span>
											</p>
										</template>
										<div >
											<p >
												<a-upload-dragger
												v-if="!editDataUser.photo"
												:file-list="fileList"
												name="photo"
												:multiple="false"
												:action="'http://127.0.0.1:8000/api/upload'"
												:headers="uploadHeaders"
												:before-upload="beforeUpload"
												@change="handleChangeEdit"
												@drop="handleDrop"
												>
													<p class="ant-upload-drag-icon">
														<inbox-outlined></inbox-outlined>
													</p>
													<p class="ant-upload-text">
														Click or drag an image to this area to upload
													</p>
													<p class="ant-upload-hint">
														Support for a single image upload. Strictly upload only image files
														(jpeg, png, jpg, gif) with a maximum size of 2MB.
													</p>
												</a-upload-dragger>
												<a-row type="flex">
												<a-col class="col-img" :span="24" :xl="12">
													<div class="card-img-bg">
														<img
															:src="'http://127.0.0.1:8000' + editDataUser.photo"
															 v-if="editDataUser.photo"
															  style="max-width: 150px; border-radius: 5px"
														/>
													</div>
												</a-col>
												<a-col
													class="col-content"
													:span="24"
													:xl="12"
													style="justify-content: center"
												>
													<a-button
													type="danger"
													danger
													style="width: 100%"
													v-if="editDataUser.photo"
													@click="handleRemoveEdit"
													>Remove Image</a-button
													>
												</a-col>
												</a-row>
											</p>

										</div> <br>
										<div >
											<p>User Name <span style="color: red;">*</span></p>
											<p ><Input v-model="editDataUser.name" placeholder="Ex: John Doe"  /></p>
										</div> <br>
										<div >
											<p>User Email <span style="color: red;">*</span></p>
											<p ><Input v-model="editDataUser.email" placeholder="Ex: john@gmail.com"  /></p>
										</div> <br>
										<div >
											<p>User Password <span style="color: red;">*</span></p>
											<p>
												<Input
												v-model="editDataUser.password"
												placeholder="Enter a password"
												type="password" password
												@input="validateEditPassword"
												/>
											</p>
											<!--p v-if="!passwordEditValid">
												The password must contain at least 6 characters, one uppercase letter, and one special character.
											</p-->
											</div>
											<!--div >
												<Progress :percent="40" status="wrong" v-if="passwordEditStrength==40"/>
												<Progress :percent="60"  v-if="passwordEditStrength==60" :stroke-color="['#f5578b', '#34A1DC']" />
												<Progress :percent="100"  v-if="passwordEditStrength==100"/>
											</div--> <br>
										<div >
											<p>User confirm_password <span style="color: red;">*</span></p>
											<p ><Input v-model="editDataUser.password_confirm" type="password" password placeholder="Confirm a passwword"  @input="validateEditPasswordConfirm" /></p>
											
											<!--p>
												<div v-if="passwordConfirmEditValid">
												Passwords must match.
												<Progress :percent="60"  :stroke-color="['#f5578b', '#34A1DC']" />
												</div>
												<div v-else>
													<Progress :percent="100"  />
												</div>
											</p-->
											
										</div> <br>
										<div >
											<p>User Country </p>
											<p >
												<a-select
												v-model="editDataUser.pays"
												show-search
												placeholder="Select a country"
												option-filter-prop="children"
												style="width: 100%"
												:filter-option="
													(input, option) =>
													option.componentOptions.children[0].text
														.toLowerCase()
														.includes(input.toLowerCase())
												"
												>
													<a-select-option  value="Burkina Faso">
														Burkina Faso 
													</a-select-option>
													<a-select-option  value="Mali">
														Mali 
													</a-select-option>
													<a-select-option  value="Niger">
														Niger
													</a-select-option>
													<a-select-option  value="Nigéria">
														Nigéria 
													</a-select-option>
												</a-select>
											</p>
											
											
										</div> <br>
										<div >
											<p>User Role <span style="color: red;">*</span></p>
											<p >
												<Select v-model="editDataUser.role" placeholder="Select a role" >
													<Option v-for="item in getRole" :value="item.name" :key="item.id">{{ item.name }}</Option>
												</Select>
											</p>
										</div>
										<template #footer>
											<Button type="default"  @click="modalEdit = false">Cancel</Button>
											<Button type="success" :loading="modal_loading" @click="edit">Edit</Button>
										</template>
									</Modal>

									<!--Modal de suppression-->
									<Modal v-model="modalDelete" width="360" >
										<template #header>
											<p style="color:#f60;text-align:center">
												<Icon type="ios-information-circle"></Icon>
												<span>Delete confirmation</span>
											</p>
										</template>
										<div style="text-align:center">
											<p>After this user is deleted, you won't be able to use it.</p>
											<p>Will you delete it?</p>
										</div>
										<template #footer>
											<Button type="error" size="large" long :loading="modal_loading" @click="deletes">Delete</Button>
										</template>
									</Modal>

								</div>

								<!--Tableau de données-->

								
				            </div>

						</p>
					</a-collapse-panel>
				</a-collapse>
			</div>

			<div class="download">
				<h6>User Permissions</h6>
				<a-collapse v-model:activeKey="activeKey" :bordered="false" style="background: rgb(255, 255, 255)">
					<template #expandIcon="{ isActive }">
						<caret-right-outlined :rotate="isActive ? 90 : 0" />
					</template>
					<a-collapse-panel key="1" header="Super Admin"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden">
						<p>Super Admin Settings</p>
					</a-collapse-panel>
					<a-collapse-panel key="2" header="Admin"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden">
						<p>Admin Settings</p>
					</a-collapse-panel>
					<a-collapse-panel key="3" header="Visitor"
						style="background: #f7f7f7;border-radius: 4px;margin-bottom: 24px;border: 0;overflow: hidden">
						<p>Visitor Settings</p>
					</a-collapse-panel>
				</a-collapse>
			</div>

			<Row justify="end">

				<Col  >
					<Button type="error" @click="$emit('toggleSettingsDrawer', false)">Close</Button>
				    <Button type="success" @click="saveSetting" style="margin-left: 10px;">Save</Button>
				</Col>
				
			</Row>
		</div>
		<!-- / Settings Drawer Content -->

	</a-drawer>
	<!-- / Settings Drawer -->

</template>

<script>

import 'vue-github-buttons/dist/vue-github-buttons.css'; // Stylesheet
import VueGitHubButtons from 'vue-github-buttons';
import Vue from 'vue';

import { message } from "ant-design-vue";
import Steps from "../../views/Steps.vue";

// "Authors" table component.
import CardAuthorTable from "../../components/Cards/CardAuthorTable";

// "Projects" table component.
import CardProjectTable2 from "../../components/Cards/CardProjectTableRole";


import CardProjectTableUser from "../../components/Cards/CardProjectTableUser";

import CardBillingInfoOrg from "../../components/Cards/CardBillingInfoOrg";

// Table.vue
import axios from "axios";

// "Authors" table list of columns and their properties.
const table1Columns = [
  {
    title: "AUTHOR",
    dataIndex: "author",
    scopedSlots: { customRender: "author" },
  },
  {
    title: "FUNCTION",
    dataIndex: "func",
    scopedSlots: { customRender: "func" },
  },
  {
    title: "STATUS",
    dataIndex: "status",
    scopedSlots: { customRender: "status" },
  },
  {
    title: "EMPLOYED",
    dataIndex: "employed",
    class: "text-muted",
  },
  {
    title: "",
    scopedSlots: { customRender: "editBtn" },
    width: 50,
  },
];

// "Authors" table list of rows and their properties.
const table1Data = [
  {
    key: "1",
    author: {
      avatar: "images/face-2.jpg",
      name: "Michael John",
      email: "michael@mail.com",
    },
    func: {
      job: "Manager",
      department: "Organization",
    },
    status: 1,
    employed: "23/04/18",
  },
  {
    key: "2",
    author: {
      avatar: "images/face-3.jpg",
      name: "Alexa Liras",
      email: "alexa@mail.com",
    },
    func: {
      job: "Programator",
      department: "Developer",
    },
    status: 0,
    employed: "23/12/20",
  },
  {
    key: "3",
    author: {
      avatar: "images/face-1.jpg",
      name: "Laure Perrier",
      email: "laure@mail.com",
    },
    func: {
      job: "Executive",
      department: "Projects",
    },
    status: 1,
    employed: "13/04/19",
  },
  {
    key: "4",
    author: {
      avatar: "images/face-4.jpg",
      name: "Miriam Eric",
      email: "miriam@mail.com",
    },
    func: {
      job: "Marketing",
      department: "Organization",
    },
    status: 1,
    employed: "03/04/21",
  },
  {
    key: "5",
    author: {
      avatar: "images/face-5.jpeg",
      name: "Richard Gran",
      email: "richard@mail.com",
    },
    func: {
      job: "Manager",
      department: "Organization",
    },
    status: 0,
    employed: "23/03/20",
  },
  {
    key: "6",
    author: {
      avatar: "images/face-6.jpeg",
      name: "John Levi",
      email: "john@mail.com",
    },
    func: {
      job: "Tester",
      department: "Developer",
    },
    status: 0,
    employed: "14/04/17",
  },
];

// "Projects" table list of columns and their properties.
//'id', 'denominationOpa', 'typeOpa', 'village', 'position', 'dateCreaction', 'email'
const table2Columns = [
 
  {
    title: "Name",
    dataIndex: "name",
    class: "font-semibold text-muted",
  },
  {
    title: "Date de créaction",
    dataIndex: "created_at",
    class: "font-semibold text-muted",
  },
  {
    title: "Actions",
    scopedSlots: { customRender: "editBtn" },
    fixed: 'right',
    width: 300,
  },
];

// "Projects" table list of rows and their properties.
const table2Data = [];

Vue.use(VueGitHubButtons, { useCache: true });

export default ({
	components: {
		CardAuthorTable,
		CardProjectTable2,
		CardBillingInfoOrg,
		CardProjectTableUser,
		Steps,
	},
	props: {
		// Settings drawer visiblility status.
		showSettingsDrawer: {
			type: Boolean,
			default: false,
		},

		// Main sidebar color.
		sidebarColor: {
			type: String,
			default: "primary",
		},

		// Main sidebar theme : light, white, dark.
		sidebarTheme: {
			type: String,
			default: "light",
		},

		// Header fixed status.
		navbarFixed: {
			type: Boolean,
			default: false,
		},

		// Drawer direction.
		rtl: {
			type: Boolean,
			default: false,
		},
	},
	data() {
		return {
			modal_loading: false,
			getRole:{},
			fileList: [],
			modalAdd: false,
			modalEdit: false,
            modalDelete: false,
			editDataUser: [],
			dataUsers: [             
                ],
				dataUsersFiltre: [],
				//Tableau à envoyer au controlleur
                dataUser: {
                    name: "",
                    email: "",
                    password: "",
                    role_id: "",
                    password_confirm: "",
                    photo: "",
                    tel: "",
					pays: ""
                },
			screenWidth: window.innerWidth,
			modalAddUser: false,
			searchUser: "",
			openUser: false,
            dataR: {},
			anim: true,
			loadingAdd: false,
			loadingEdit: false,
			current: 0,
			currentEdit: 0,
			openInfoRole: false,
			openEditRole: false,
			user: [],
			editData: {},
			viewData: [],
			data: {
				name: ""
			},

			departs: [],
			communes: [],
			arrondissements: [],
			villages: [],
			maillons: [],
			juridiques: [],
			positions: [],

			nameDepOrg: "",
			inputRef: null,
			index: 0,
			openRole: false,
			newOPA: "oui",
			// Associating "Authors" table data with its corresponding property.
			table1Data: table1Data,

			// Associating "Authors" table columns with its corresponding property.
			table1Columns: table1Columns,

			// Associating "Projects" table data with its corresponding property.
			table2Data: [],
			filteredData: [],

			// Associating "Projects" table columns with its corresponding property.
			table2Columns: table2Columns,


			// The wrapper element to attach dropdowns to.
			wrapper: document.body,

			// Main sidebar color.
			sidebarColorModel: this.sidebarColor,

			// Main sidebar theme : light, white, dark.
			sidebarThemeModel: this.sidebarTheme,

			// Header fixed status.
			navbarFixedModel: this.navbarFixed,
		}
	},
	mounted: function () {
		window.addEventListener('resize', this.handleResize);
		// Set the wrapper to the proper element, layout wrapper.
		this.wrapper = document.getElementById('layout-dashboard');
	},
	beforeDestroy() {
                window.removeEventListener('resize', this.handleResize);
            },
	methods: {
		async deletes() {
                try {

                    this.modal_loading = true;

                    const res = await axios.post('/delete_admin', this.editDataUser)

                    if (res.status === 200) {
						this.modal_loading = false;
                        this.modalDelete = false;

                        this.$Message.success({
                            content: "The User has been successfully deleted.",
                            duration: 10,
                            closable: true
                        });

                        const index = this.dataUsers.findIndex(role => role.id === this.editDataUser.id);

                        if(index !== -1){
                            this.dataUsers.splice(index,1);
                        }

                        

                    }else{
                        this.$Message.warning({
                                content: "Try again, please",
                                duration: 10,
                                closable: true
                            });
                                this.modal_loading= false;
                    }
                    
                } catch (error) {
                    
                        this.$Message.warning({
                                content: "Try again, please",
                                duration: 10,
                                closable: true
                            });
                                this.modal_loading= false;

                }
                
            },
		isvalidEmail: async function(email) {
                const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                if (!emailPattern.test(email)) {
                    return false;
                }

                try {
                    const emailCheck = await axios.post('/check_email', { email });
                    return !emailCheck.data.exists; // Si l'email existe, retourne false, sinon retourne true
                } catch (error) {
                    console.error("Error checking email:", error);
                    return false; // En cas d'erreur, retourne false
                }
            },
		async saveUser(){
                this.modal_loading = true;

                if (this.dataUser.name.trim()=="" || this.dataUser.email.trim() =="" || this.dataUser.role_id =="" || this.dataUser.pays =="" || this.dataUser.password.trim() == ""  || this.dataUser.password_confirm.trim() == "") {
                    this.$Message.error({
                        content: "The form inputs are required!",
                        duration: 10,
                        closable: true
                    });

                    this.modal_loading = false;
                }else{

                    

                        if (  this.dataUser.password != this.dataUser.password_confirm || !(await this.isvalidEmail(this.dataUser.email))) {

                            if (!(await this.isvalidEmail(this.dataUser.email))) {
                                this.$Message.error({
                                content: " Email is not correct or already exists!",
                                duration: 10,
                                closable: true
                            });
                            }

                            if (this.dataUser.password != this.dataUser.password_confirm) {
                                this.$Message.error({
                                content: "Passwords are not correct !",
                                duration: 10,
                                closable: true
                            });
                            }
                           

                        this.modal_loading= false;
                        } else{

                      

                        this.dataUser.photo = `${this.dataUser.photo}`;

                        const saves = await axios.post('/add_admin', this.dataUser);

                        if(saves.status === 200){


                            this.modalAdd = false;

                            this.dataUsers.unshift(saves.data.admin);

                            this.$Message.success({
                                    content: "the user was created successfully",
                                    duration: 10,
                                    closable: true
                                });


                            this.dataUser.name = '';
                            this.dataUser.email="";
                            this.dataUser.password="";
                            this.dataUser.role_id="";
                            this.dataUser.photo="";
                            this.dataUser.password_confirm="";
                            this.dataUser.pays = "";
                            
                            this.modal_loading= false;
                            

                       }else{

                                this.$Message.warning({
                                    content: "Try again, please",
                                    duration: 10,
                                    closable: true
                                });
                                
                                    this.modal_loading= false;
                        }

                    }
                }
            },
	async handleRemove() {
      const res = await axios.post("/actor/delete-img", {
        photo: this.dataUser.photo,
      });
      this.dataUser.photo = "";
    },
	async handleRemoveEdit() {
      const res = await axios.post("/actor/delete-img", {
        photo: this.editDataUser.photo,
      });
      this.editDataUser.photo = "";
    },

	async edit(){
                this.modal_loading = true;

                if (this.editDataUser.name=="" || this.editDataUser.email =="" || this.editDataUser.pays =="" || this.editDataUser.role_id =="" || this.editDataUser.password == ""  || this.editDataUser.password_confirm == "") {
                    this.$Message.error({
                        content: "The form inputs are required!",
                        duration: 10,
                        closable: true
                    });

                    this.modal_loading = false;
                }else{

                    

                    if (  this.editDataUser.password != this.editDataUser.password_confirm || !((/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/).test(this.editDataUser.email))) {

                        if (!((/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/).test(this.editDataUser.email))) {
                            this.$Message.error({
                            content: " Email is not correct",
                            duration: 10,
                            closable: true
                        });
                        }

                        if (this.editDataUser.password != this.editDataUser.password_confirm ) {
                            this.$Message.error({
                            content: "Passwords are not correct !",
                            duration: 10,
                            closable: true
                        });
                        }


                        this.modal_loading= false;
                    } else{

                   

                        this.editDataUser.photo = `${this.editDataUser.photo}`;

                        const saves = await axios.post('/edit_admin', this.editDataUser);

                        if(saves.status === 200){


                            this.modalEdit = false;

                            const index = this.data.findIndex(role => role.id === this.editDataUser.id)
                            if(index !== -1){
                            this.dataUsers[index] = this.editDataUser
                            }

                            this.$Message.success({
                                    content: "the user was updated successfully",
                                    duration: 10,
                                    closable: true
                                });


                            this.editDataUser = {}

                  
                            
                            this.modal_loading= false;
                            

                            }else{

                                this.$Message.warning({
                                    content: "Try again, please",
                                    duration: 10,
                                    closable: true
                                });
                                    this.modal_loading= false;
                        }

                    }
                }
            },
    // Handle upload change events
    handleChange(info) {
      const status = info.file.status;
      console.log(status);
      if (status === "done") {
        this.fileList = [info.file]; // Restrict to a single file in the list

        // Access the image URL returned from the backend
        this.dataUser.photo = info.file.response.image_url;
        message.success(
          `Image uploaded successfully. URL: ${this.dataUser.photo}`
        );
      } else if (status === "error") {
        message.error(`${info.file.name} image upload failed.`);
      }
    },

	handleChangeEdit(info) {
      const status = info.file.status;
      console.log(status);
      if (status === "done") {
        this.fileList = [info.file]; // Restrict to a single file in the list

        // Access the image URL returned from the backend
        this.editDataUser.photo = info.file.response.image_url;
        message.success(
          `Image uploaded successfully. URL: ${this.editDataUser.photo}`
        );
      } else if (status === "error") {
        message.error(`${info.file.name} image upload failed.`);
      }
    },

    // Handle file drop event
    handleDrop(e) {
      console.log(e);
    },

    // Before uploading, validate if the file is an image and restrict to only one image
    beforeUpload(file) {
      const isImage = file.type.startsWith("image/");
      const isLt2M = file.size / 1024 / 1024 < 2; // Check if the file is less than 2MB

      if (!isImage) {
        message.error("You can only upload image files!");
        return false;
      }
      if (!isLt2M) {
        message.error("Image must be smaller than 2MB!");
        return false;
      }

      this.fileList = [file]; // Ensure only one file is in the list
      return true; // Proceed with the upload
    },


		handleSuccess(res, file) {
						if (this.isEditingItem) {
							return (this.editDataUser.photo = res.image_url);
						}
						this.dataUser.photo = res.image_url;
					},

					handleError(res, file) {
						this.$Notice.warning({
							title: "Le format de ce fichier est incorrect",
							desc: `${
							file.errors.file.length
								? file.errors.file[0]
								: "Quelque chose se déroule mal!"
							}`,
						});
                },

                handleFormatError(file) {
					this.$Notice.warning({
						title: "Le format du fichier est incorrect",
						desc:
						"Le fichier " +
						file.name +
						" est incorrect, svp sélectionner jpg ou png.",
					});
                },

                handleMaxSize(file) {
					this.$Notice.warning({
						title: "Excès de la taille su fichier",
						desc: "Le fichier " + file.name + " est trop lourd, pas plus que 50M.",
					});
                },

		showEditModal(row, index) {
                this.editDataUser = row;
                this.modalEdit = true;
                this.index = index;
            },

            async showDeletingModal(row, deleteIndex) {
                this.modalDelete = true;
                this.editDataUser = row;
                //this.deleteItem = row;
                //this.deleteIndex = deleteIndex;
                //this.showDeleteModal = true;
            },
		handleResize() {
            this.screenWidth = window.innerWidth;
            },
		searchRoleUser(value){
			    // Ajoutez votre logique de recherche ici
				if (value) {
					this.dataUsers = this.dataUsersFiltre.filter((item) => {
					// Remplacez 'name' et 'description' par les propriétés que vous souhaitez filtrer
					return (
						item.name.toLowerCase().includes(value.toLowerCase()) 
					);
					});
				} else {
					// Si aucune valeur de recherche, on réinitialise les données filtrées
					this.dataUsers = this.dataUsersFiltre;
				}
            },
			rowClassName (row, index) {
                if (this.variableGlobale) {
                    return 'demo-table-info-row';
                } 
                return '';
            },
		async saveSetting(){

			const res = await axios.post('/settingUpdate', this.dataR);
			if (res.status === 200) {

				this.$Notice.success({

					title: "your settings are successful updated",

				});

				this.$emit('toggleSettingsDrawer', false)

				
			}


		},
    formatDate(dateString) {
      const inputDate = new Date(dateString);
      const year = inputDate.getFullYear();
      const month = String(inputDate.getMonth() + 1).padStart(2, "0"); // Mois en entier, ajoute un zéro initial si < 10
      const day = String(inputDate.getDate()).padStart(2, "0"); // Ajoute un zéro initial si le jour est < 10

      return `${year}-${month}-${day}`;
    },
    handleNext() {
      this.current = 1;
    },
    handlePrevious() {
      this.current = 0;
    },
    handleEditNext() {
      this.currentEdit = 1;
    },
    handleEditPrevious() {
      this.currentEdit = 0;
    },
    handleSearch(value) {
      // Ajoutez votre logique de recherche ici
      if (value) {
        this.table2Data = this.filteredData.filter((item) => {
          // Remplacez 'name' et 'description' par les propriétés que vous souhaitez filtrer
          return (
            item.name.toLowerCase().includes(value.toLowerCase()) 
          );
        });
      } else {
        // Si aucune valeur de recherche, on réinitialise les données filtrées
        this.table2Data = this.filteredData;
      }
    },
    async handleDeleteInfo(row) {
      this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
      const res = await axios.post("/compagny/delete", row);
      this.openInfoRole = false;
    },
    async handleEditInfo(row) {
      this.editData = row;
      this.openInfoRole = false;
      this.openEditRole = true;
    },
    handleCancelInfo() {
      this.openInfoRole = false;
    },
    handleView(row) {
      this.viewData = row;
      this.openInfoRole = true;
    },
    handleNotValidate() {
      this.table2Data = this.filteredData.filter((item) => item.state == "new");
    },
    async handleAll() {
      this.table2Data = this.filteredData;
    },
    handleOpenFunc() {
      this.openRole = true; // Met à jour opeOrg lorsque l'événement est reçu
    },

	handleOpenFuncUser() {
      this.openUser = true; // Met à jour opeOrg lorsque l'événement est reçu
    },
    async handleValidate(row) {
      row.state = "validated";
      const res = await axios.post("/compagny/validate", row);
      message.success("Organization successfully validated.", 5);
    },
    async handleDelete(row) {
      this.table2Data = this.table2Data.filter((item) => item.id !== row.id);
      const res = await axios.post("/delete_role", row);
      message.success("Role successfully deleted.", 5);
    },
    handleEdit(row) {
      this.editData = row;
      this.openEditRole = true;
    },
    async handleEditOrg() {
      this.loadingEdit = true;
      const res = await axios.post("/edit_role", this.editData);
      this.openEditRole = false;
      this.loadingEdit = false;
      message.success("Role successfully edited.", 5);
    },
    async handleOkOrg() {
      this.loadingAdd = true;
      try {
        const res = await axios.post("/create_role", this.data);
        if (res.status == 200) {
          this.table2Data = res.data.roles.data.map((company) => {
            return {
              ...company,
              created_at: this.formatDate(company.created_at), // Formate l'attribut date
            };
          });
          this.data = {
           name : ""
          };
          this.loadingAdd = false;
          this.openRole = false;
          message.success("Role successfully registered.", 5);
        }
        this.loadingAdd = false;
      } catch (error) {
        this.loadingAdd = false;
        message.error("Check your fields.", 5);
      }
    },
    filterOptionDep(input, option) {
      return (
        option.componentOptions.children[0].text
          .toLowerCase()
          .indexOf(input.toLowerCase()) >= 0
      );
    },
  },
  computed:{

	columns() {
		return [
		{
				title: 'Name',
				slot: 'name',
				width: this.screenWidth > 1024 ? undefined : 150,
			},
			{
				title: 'Email',
				slot: 'email',
				width: this.screenWidth > 1024 ? undefined : 150,
			},
			{
				title: 'Pays',
				slot: 'pays',
				width: this.screenWidth > 1024 ? undefined : 150,
			},
			{
				title: 'Role',
				slot: 'role',
				width: this.screenWidth > 1024 ? undefined : 150,
			},
			
			
			{
				title: 'Action',
				slot: 'action',
				align: 'center',
				fixed: 'right',
				width: 150,
				// Pas de largeur définie pour occuper l'espace restant
			}
		];
	},

	uploadHeaders() {

			return {
			Authorization: `Bearer ${localStorage.getItem("token")}`,
			};
			
		},

	user() {

		return this.$store.getters.getUser;

	},

	permissions() {
		return this.$store.getters.userPermissions;
	},

  },
  async created() {
	const role =await axios.get('/get_roles')
    const res = await axios.get('/settings');
     const allRole = await axios.get('/get_roles');
	 const all = await axios.get('/getAdmins')
    const resP = await axios.get("/role/paginate6");

	if(role.status === 200){

                this.getRole = role.data.roles
              
            }

    if (resP.status == 200) {
      this.table2Data = resP.data.roles.data.map((company) => {
        return {
          ...company,
          created_at: this.formatDate(company.created_at), // Formate l'attribut date
        };
      });
	  
      this.filteredData = resP.data.roles.data.map((company) => {
        return {
          ...company,
          created_at: this.formatDate(company.created_at), // Formate l'attribut date
        };
      });

      this.anim = false;
    }

	if (res.status === 200) {
        this.dataR = res.data.settings;

        if (allRole.status === 200) {
           
            const defaultPermissions = [
            { name: "Home", view: true, add: true, edit: true, delete: false, setting: false },
            { name: "Organisation", view: true, add: true, edit: true, delete: false, setting: false },
            { name: "Actor", view: true, add: true, edit: true, delete: false, setting: false },
            { name: "Activity", view: true, add: true, edit: true, delete: false, setting: false },
			{ name: "Approval", view: true, add: true, edit: true, delete: false, setting: false },
            { name: "Settings", view: true, add: true, edit: true, delete: true, setting: true },
           ];
            

         // Initialisation de this.dataR.roles si nécessaire
         if (!Array.isArray(this.dataR.roles)) {
            this.dataR.roles = [];
        }

        // Création d'un Set pour suivre les noms de rôles déjà présents dans this.dataR.roles
        const existingNames = new Set(this.dataR.roles.map(role => role.name));

        // Ajout des rôles s'ils n'existent pas et ajout des permissions par défaut si nécessaire
        allRole.data.roles.forEach(async(role) => {
            if (!existingNames.has(role.name)) {
                existingNames.add(role.name);

                const roleWithPermissions = {
                    id: role.id,
                    name: role.name,
                    permissions: role.permissions ? role.permissions : defaultPermissions
                };

                this.dataR.roles.push(roleWithPermissions);
                await axios.post('/settingUpdate', this.dataR);
            }
        });


        

                
            
        }

       
     }

	 if(all.status === 200){
                this.dataUsers = all.data.admins
				this.dataUsersFiltre = all.data.admins
            }
  },
})

</script>
