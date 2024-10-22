<!-- 
	This is the main page of the application, the layout component is used here,
	and the router-view is passed to it.
	Layout component is dynamically declared based on the layout for each route,
	specified in routes list router/index.js .
 -->

<template>
  <div id="app">
    <div class="gtranslate_wrapper"></div>
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
     // Vérifier si l'écran est large (1024px et plus)
  /*if (window.innerWidth > 768) {
    // Charger le script de configuration de GTranslate
    const scriptSettings = document.createElement("script");
    scriptSettings.innerHTML = `window.gtranslateSettings = {
      "default_language": "en",
      "native_language_names": true,
      "languages": ["en", "fr"],
      "wrapper_selector": ".gtranslate_wrapper",
      "horizontal_position": "left",
      "vertical_position": "bottom"
    };`;
    document.head.appendChild(scriptSettings);

    // Charger le script externe de GTranslate
    const scriptGTranslate = document.createElement("script");
    scriptGTranslate.src = "https://cdn.gtranslate.net/widgets/latest/dropdown.js";
    scriptGTranslate.defer = true;
    document.head.appendChild(scriptGTranslate);
  }*/
 /* if (window.innerWidth <768) {
    // Charger le script de configuration de GTranslate
    const scriptSettings = document.createElement("script");
    scriptSettings.innerHTML = `window.gtranslateSettings = {
      "default_language": "en",
      "native_language_names": true,
      "languages": ["en", "fr"],
      "wrapper_selector": ".gtranslate_wrapper",
      "horizontal_position": "right",
      "vertical_position": "top"
    };`;
    document.head.appendChild(scriptSettings);

    // Charger le script externe de GTranslate
    const scriptGTranslate = document.createElement("script");
    scriptGTranslate.src = "https://cdn.gtranslate.net/widgets/latest/dropdown.js";
    scriptGTranslate.defer = true;
    document.head.appendChild(scriptGTranslate);
  }*/
  }
};
</script>

<style>
.layout-dashboard .ant-layout-header{
  border-radius: 0px;
}
</style>