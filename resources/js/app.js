import '../sass/app.scss';
import './bootstrap.js';

import {TempusDominus, loadLocale, locale, DateTime} from "@eonasdan/tempus-dominus";
import {localization, name} from "@eonasdan/tempus-dominus/dist/locales/ru";
import {cloneDeep} from "lodash";

loadLocale({localization, name});
locale(name);

const minDate = new DateTime();
minDate.manipulate(1, 'hours');
const maxDate = new DateTime();
maxDate.manipulate(1, 'month').manipulate(24, 'hours');
const defDate = cloneDeep(minDate);
if (defDate.minutes <= 30) {
    defDate.minutes = 30;
} else {
    defDate.minutes = 0;
    defDate.hours += 1;
}

if (document.getElementById('datetimepicker')) {
    const datepicker = new TempusDominus(document.getElementById('datetimepicker'), {
        defaultDate: defDate,
        restrictions: {
            minDate: minDate,
            maxDate: maxDate,
        },
        display: {
            icons: {
                type: 'icons',
                time: 'fa-solid fa-clock',
                date: 'fa-solid fa-calendar',
                up: 'fa-solid fa-arrow-up',
                down: 'fa-solid fa-arrow-down',
                previous: 'fa-solid fa-chevron-left',
                next: 'fa-solid fa-chevron-right',
                today: 'fa-solid fa-calendar-check',
                clear: 'fa-solid fa-trash',
                close: 'fa-solid fa-xmark'
            },
            buttons: {
                today: true,
            },
            components: {
                useTwentyfourHour: true
            },
        },
        stepping: 30
    });
}

function fallbackCopyTextToClipboard(text) {
    const textArea = document.createElement("textarea");
    textArea.value = text;

    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        const successful = document.execCommand('copy');
        const msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
        alert('Успішно скопійовано!');
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function () {
        console.log('Async: Copying to clipboard was successful!');
        alert('Успішно скопійовано!');
    }, function (err) {
        console.error('Async: Could not copy text: ', err);
    });
}

const copyBtn = document.querySelector('.js-copy-btn');

if (copyBtn) {
    copyBtn.addEventListener('click', function (event) {
        const textId = event.target.dataset.text;
        const copiedText = document.querySelector('[data-copy-text="' + textId + '"]').value;
        copyTextToClipboard(copiedText);
    });
}
