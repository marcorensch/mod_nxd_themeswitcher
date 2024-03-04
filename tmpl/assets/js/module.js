jQuery(document).ready(async function ($) {

    // Run script only once
    if (typeof window.jDarkMode !== "undefined") return;

    // Initial settings
    let darkMode = window.jDarkMode = await getDarkModeCurrentSetup();
    setDarkModeState(darkMode, true);
    // Update the first visible "Dark Mode Switcher" button to avoid flickering
    updateButton(document.querySelector("button.theme-button"), darkMode);
    updateMode(darkMode);

    function updateButton(btn, darkMode) {
        const icon = btn.querySelector(".header-item-icon > span");
        const text = btn.querySelector(".header-item-text");

        if (darkMode) {
            icon.innerHTML = "🌙";
            icon.style.backgroundColor = "rgb(31, 48, 71)";
            text.innerHTML = "&nbsp;Dark Mode";
        } else {
            icon.innerHTML = "☀️";
            icon.style.backgroundColor = "transparent";
            text.innerHTML = "Light Mode";
        }
    }

    function updateMode(darkMode) {
        for (const sheet of document.styleSheets) {
            if (sheet.href && sheet.href.includes("atum/css/template")) {
                for (let i = sheet.cssRules.length - 1; i >= 0; i--) {
                    let rule = sheet.cssRules[i].media;
                    if (typeof rule !== "undefined" && rule.mediaText.includes("prefers-color-scheme")) {
                        if (darkMode) {
                            if (!rule.mediaText.includes("(prefers-color-scheme: light)")) rule.appendMedium("(prefers-color-scheme: light)");
                            if (!rule.mediaText.includes("(prefers-color-scheme: dark)")) rule.appendMedium("(prefers-color-scheme: dark)");
                            if (rule.mediaText.includes("original")) rule.deleteMedium("original-prefers-color-scheme");
                        } else {
                            rule.appendMedium("original-prefers-color-scheme");
                            if (rule.mediaText.includes("light")) rule.deleteMedium("(prefers-color-scheme: light)");
                            if (rule.mediaText.includes("dark")) rule.deleteMedium("(prefers-color-scheme: dark)");
                        }
                    }
                }
            }
        }
    }

    // Sets localStorage state
    function setDarkModeState(state, calledFromInit = false) {
        localStorage.setItem("jDarkMode", state);
        if (window.themeSwitcherDbStore && calledFromInit) setDarkModeStateInDatabase(state);
    }


    function setDarkModeStateInDatabase(state) {
        $.ajax({
            url: 'index.php?option=com_ajax&module=nxd_themeswitcher&method=handleChange&data=' + state + '&format=json',
            type: "post",
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    async function getDarkModeStateFromDatabase() {
        try {
            const response = await $.ajax({
                url: 'index.php?option=com_ajax&module=nxd_themeswitcher&method=getDarkModeState&format=json',
                type: "get"
            });
            return response.data.data;
        } catch (error) {
            console.error(error);
            throw error; // Rethrow the error for the caller to handle
        }
    }

    // Gets localStorage state
    async function getDarkModeCurrentSetup() {
        if (localStorage.getItem("jDarkMode") !== null) {
            return localStorage.getItem("jDarkMode") === "true";
        } else {
            try {
                const dbResponse = await getDarkModeStateFromDatabase();
                if (dbResponse === 0 || dbResponse === 1) {
                    return Boolean(dbResponse);
                } else {
                    return window.jDarkModeDefault === "true";
                }
            } catch (error) {
                // Handle error from getDarkModeStateFromDatabase
                console.error(error);
                return window.jDarkModeDefault === "true"; // Return default value
            }
        }
    }

    // Update all "Dark Mode Switcher" buttons after DOMContentLoaded
    const dmsBtns = document.querySelectorAll("button.theme-button");
    dmsBtns.forEach((dmsBtn) => {
        updateButton(dmsBtn, darkMode);
        // Set eventListeners for all "dark-mode"-toggle-buttons on click and set localStorage
        dmsBtn.addEventListener("click", async () => {
            let darkMode = window.jDarkMode = await getDarkModeCurrentSetup();

            const newState = !darkMode;
            setDarkModeState(newState);
            dmsBtns.forEach((dmsBtn) => updateButton(dmsBtn, newState));
            updateMode(newState);
        });
    });

});