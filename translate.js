

function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}

document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the previously selected language from localStorage
    var selectedLanguage = localStorage.getItem('selectedLanguage');
    if (selectedLanguage) {
        var translateDropdown = document.querySelector('.goog-te-combo');
        if (translateDropdown) {
            translateDropdown.value = selectedLanguage;
            translateDropdown.dispatchEvent(new Event('change'));
        }
    }

    // Listen for language changes and save the selected language to localStorage
    var dropdown = document.querySelector('.goog-te-combo');
    if (dropdown) {
        dropdown.addEventListener('change', function () {
            localStorage.setItem('selectedLanguage', this.value);
        });
    }
});
