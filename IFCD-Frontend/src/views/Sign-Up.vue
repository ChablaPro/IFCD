
<template>
  <div>
    <a-modal
      v-model="open"
      title="Mention d'informations sur les cookies"
      @ok="handleOk"
      :closable="false"
    >
      <template #footer>
        <a-button key="back" @click="handleCancel">TOUT REFUSER</a-button>
        <a-button key="submit" type="primary" @click="handleOk"
          >TOUT ACCEPTER</a-button
        >
      </template>
      <p><img src="/images/logos/ifdc.png" alt="" width="150px" /></p>
      <div>
        <h3>
          Cette mention est une exigence de l'Autorité de Protection des Données
          Personnelles du Bénin
        </h3>
      </div>
      <p>
        Ce site utilise des cookies pour collecter des données auprès de nos
        utilisateurs. L’Utilisateur est informé que lors de ses visites sur
        l’Application, un cookie peut s’installer automatiquement sur son
        logiciel de navigation. Cette collecte a pour finalité l’accès aux
        services de création et d’analyse des données sur le prix du marché des
        produits agroalimentaires.
      </p>
      <p>
        Nous partageons les informations collectées avec notre partenaire
        <a href="https://ticagrobusiness.com/">TIC AGRO BUSINESS CENTER.</a>
        Les données collectées sont conservées pendant la durée nécessaire à la
        fourniture du service, et donc à votre utilisation du service, augmentée
        de la durée de conservation imposée par les règles applicables en
        matière de prescription légale.
      </p>
      <p>
        Visitez notre
        <router-link to="/politique"
          >politique de protection des données personnelles</router-link
        >
      </p>
    </a-modal>
    <!-- Sign In Image And Headings -->
    <div
      class="sign-up-header"
      style="background-image: url('images/bg-sign3.jpg')"
    >
      <div class="content">
        <h1 class="mb-5">Sign In</h1>
        <p class="text-lg">Use these awesome forms to login.</p>
      </div>
    </div>
    <!-- / Sign In Image And Headings -->

    <!-- Sign In Form -->
    <a-card
      :bordered="false"
      class="card-signup header-solid h-full"
      :bodyStyle="{ paddingTop: 0 }"
    >
      <template #title>
        <h5 class="font-semibold text-center">Log in</h5>
      </template>

      <!--p class="text-center my-25 font-semibold text-muted">Or</p-->
      <a-form
        id="components-form-demo-normal-login"
        :form="form"
        class="login-form"
        @submit="handleSubmit"
      >
        <!--a-form-item class="mb-10">
          <a-input
            v-decorator="[
              'name',
              {
                rules: [{ required: true, message: 'Please input your name!' }],
              },
            ]"
            placeholder="Name"
          >
          </a-input>
        </a-form-item-->
        <a-form-item class="mb-10">
          <a-input
            v-decorator="[
              'email',
              {
                rules: [
                  { required: true, message: 'Please input your email!' },
                ],
              },
            ]"
            placeholder="Email"
          >
          </a-input>
        </a-form-item>
        <a-form-item class="mb-5">
          <a-input
            v-decorator="[
              'password',
              {
                rules: [
                  { required: true, message: 'Please input your Password!' },
                ],
              },
            ]"
            type="password"
            placeholder="Password"
          >
          </a-input>
        </a-form-item>
        <a-form-item class="mb-10">
          <a-checkbox
            v-decorator="[
              'remember',
              {
                valuePropName: 'checked',
                initialValue: true,
              },
            ]"
          >
            I agree the
            <router-link to="/politique" class="font-bold text-dark"
              >Terms and Conditions</router-link
            >
          </a-checkbox>
        </a-form-item>
        <a-form-item>
          <a-button
            type="primary"
            block
            html-type="submit"
            class="login-form-button"
          >
            SIGN IN
          </a-button>
        </a-form-item>
      </a-form>
      <p class="font-semibold text-muted text-center">
        <router-link to="/sign-in" class="font-bold text-dark"
          >did you forget your password ?</router-link
        >
      </p>
      <div class="sign-up-gateways">
        <a-row>
          <a-col :span="8"
            ><img src="images/logos/care.png" width="100%" alt=""
          /></a-col>
          <a-col :span="8"
            ><img src="images/logos/pays_bas_tiny.png" width="100%" alt=""
          /></a-col>
          <a-col :span="8">
            <img src="images/logos/kit.png" width="100%" alt=""
          /></a-col>
        </a-row>
      </div>
    </a-card>
    <!-- / Sign In Form -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      open: true,
      form: null, // Ajout de l'initialisation de form
    };
  },
  beforeCreate() {
    // Creates the form and adds it to the component's "form" property.
    this.form = this.$form.createForm(this, { name: "normal_login" });
  },
  created() {
    // Correct the comparison by parsing the localStorage value
    const ifdcApprove = localStorage.getItem("ifdcApprove");
    this.open = ifdcApprove ? JSON.parse(ifdcApprove) : true;
  },
  methods: {
    // Handles input validation after submission.
    handleSubmit(e) {
      e.preventDefault();
      this.form.validateFields((err, values) => {
        if (!err) {
          console.log("Received values of form: ", values);
        }
      });
    },

    handleOk() {
      localStorage.setItem("ifdcApprove", JSON.stringify(false));
      this.open = false;
    },
    handleCancel() {
      window.location.href = "about:blank";
      this.open = false;
    },
  },
};
</script>
