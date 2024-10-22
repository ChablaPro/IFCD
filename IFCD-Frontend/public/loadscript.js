const loadScript = (src) => {
    if (!window.loadedScripts) {
        window.loadedScripts = [];
    }

    // Check if the script is already loaded
    if (!window.loadedScripts.includes(src)) {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        document.head.appendChild(script);
        window.loadedScripts.push(src);
    }
};

const unloadScript = (src) => {
    const index = window.loadedScripts ? window.loadedScripts.indexOf(src) : -1;
    if (index !== -1) {
        window.loadedScripts.splice(index, 1);

        const scripts = document.head.getElementsByTagName('script');
        for (let i = 0; i < scripts.length; i++) {
            if (scripts[i].src.indexOf(src) !== -1) {
                document.head.removeChild(scripts[i]);
                break;
            }
        }
    }
};

export { loadScript, unloadScript };
