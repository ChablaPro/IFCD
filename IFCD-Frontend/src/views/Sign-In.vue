

<template>
  <div class="sign-in">
    <a-row type="flex" :gutter="[24, 24]" justify="space-around" align="middle">
      <!-- Sign In Form Column -->
      <a-col
        :span="24"
        :md="12"
        :lg="{ span: 12, offset: 0 }"
        :xl="{ span: 6, offset: 2 }"
        class="col-form"
      >
        <h1 class="mb-15">Sign In</h1>
        <h5 class="font-regular text-muted">
          Enter your email and password to sign in
        </h5>

        <!-- Sign In Form -->
        <a-form
          id="components-form-demo-normal-login"
          :form="form"
          class="login-form"
          @submit="handleSubmit"
          :hideRequiredMark="true"
        >
          <a-form-item class="mb-10" label="Email" :colon="false">
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
            />
          </a-form-item>
          <a-form-item class="mb-5" label="Password" :colon="false">
            <a-input
              v-decorator="[
                'password',
                {
                  rules: [
                    { required: true, message: 'Please input your password!' },
                  ],
                },
              ]"
              type="password"
              placeholder="Password"
            />
          </a-form-item>
          <a-form-item class="mb-10">
            <a-switch v-model="rememberMe" /> Remember Me
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
        <!-- / Sign In Form -->

        <p class="font-semibold text-muted">
          Don't have an account?
          <router-link to="/sign-in" class="font-bold text-dark"
            >Sign Up</router-link
          >
        </p>
      </a-col>
      <!-- / Sign In Form Column -->

      <!-- Sign In Image Column -->
      <a-col :span="24" :md="12" :lg="12" :xl="12" class="col-img">
        <img src="images/img-signin.jpg" alt="" />
      </a-col>
      <!-- Sign In Image Column -->

      <a-modal
        v-model="open"
        title="Mention d'informations sur les cookies"
        @ok="handleOk"
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
            Cette mention est une exigence de l'Autorité de Protection des
            Données Personnelles du Bénin
          </h3>
        </div>
        <p>
          Ce site utilise des cookies pour collecter des données auprès de nos
          utilisateurs. L’Utilisateur est informé que lors de ses visites sur
          l’Application, un cookie peut s’installer automatiquement sur son
          logiciel de navigation. Cette collecte a pour finalité l’accès aux
          services de création et d’analyse des données sur le prix du marché
          des produits agroalimentaires.
        </p>
        <p>
          Nous partageons les informations collectées avec notre partenaire
          <a href="https://ticagrobusiness.com/">TIC AGRO BUSINESS CENTER.</a>
          Les données collectées sont conservées pendant la durée nécessaire à
          la fourniture du service, et donc à votre utilisation du service,
          augmentée de la durée de conservation imposée par les règles
          applicables en matière de prescription légale.
        </p>
        <p>
          Visitez notre
          <router-link to="/politique"
            >politique de protection des données personnelles</router-link
          >
        </p>
      </a-modal>
    </a-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      open: true,
      // Binded model property for "Sign In Form" switch button for "Remember Me" .
      rememberMe: true,

      email: '',
      password: '',
      
      errorMessage: ''
    };
  },
  beforeCreate() {
    // Creates the form and adds to it component's "form" property.
    this.form = this.$form.createForm(this, { name: "normal_login" });
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

    handleOk() {},
    handleCancel() {},
  },
};
</script>

<style lang="scss">
body {
  background-color: #ffffff;
}
</style>