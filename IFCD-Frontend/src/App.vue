<!-- 
	This is the main page of the application, the layout component is used here,
	and the router-view is passed to it.
	Layout component is dynamically declared based on the layout for each route,
	specified in routes list router/index.js .
 -->

<template>
  <div id="app">
    <component :is="layout">
      <router-view />
    </component>
  </div>
</template>

<script>
export default {
  computed: {
    // Sets components name based on current route's specified layout, defaults to
    // <layout-default></layout-default> component.
    layout() {
      return "layout-" + (this.$route.meta.layout || "default").toLowerCase();
    },
  },
  mounted() {
    // Ajout du premier script
    window.gtranslateSettings = {
      default_language: "en",
      native_language_names: true,
      languages: ["en", "fr"],
      wrapper_selector: ".gtranslate_wrapper"
    };

    // Ajout du deuxième script dynamiquement
    const script = document.createElement('script');
    script.src = "https://cdn.gtranslate.net/widgets/latest/dropdown.js";
    script.defer = true;
    document.body.appendChild(script);
  }
};
</script>

<style lang="scss">
</style>