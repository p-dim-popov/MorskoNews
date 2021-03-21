require('./bootstrap');

require('alpinejs');

(function () {
    const notificationArea = document.createElement('div');
    notificationArea.id = 'notification-area';
    document.body.prepend(notificationArea);

    function generateNotificationToggle(color) {
        const template = `
            <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-${color}-500">
                <div class="inline-block align-middle mr-8 notification-item"></div>
                <button
                    class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                    <span>×</span>
                </button>
            </div>
        `;
        return function (message, timeout = 3000) {
            if (!message) {
                return;
            }

            const notification = document.createElement('div');
            notification.remove = notification.remove.bind(notification);
            notification.innerHTML = template;
            const content = notification.querySelector('div.notification-item');
            content.textContent = message;
            const closeButton = notification.querySelector('button');
            closeButton.onclick = notification.remove;

            notificationArea.appendChild(notification);

            setTimeout(notification.remove, timeout);
        }
    }

    window.alert = generateNotificationToggle('yellow');
    window.alert.warning = generateNotificationToggle('yellow');
    window.alert.success = generateNotificationToggle('green');
    window.alert.error = generateNotificationToggle('red');
})();

[...document.getElementsByClassName("utc-to-local")]
    .forEach(x => {
        if (!!x.value) x.value = dayjs.utc(x.value.trim()).local().format('llll')
        else x.textContent = dayjs.utc(x.textContent.trim()).local().format('llll')
    });

(function () {
    const confirmModal = document.getElementById('__CONFIRM__MODAL__');
    const headlineDiv = document.getElementById('__CONFIRM__MODAL__HEADLINE__');
    const contentDiv = document.getElementById('__CONFIRM__MODAL__CONTENT__');
    const confirmButton = document.getElementById('__CONFIRM__MODAL__CONFIRM__');
    const cancelButton = document.getElementById('__CONFIRM__MODAL__CANCEL__');

    const hideConfirmModal = () => confirmModal.style.display = 'none';
    const showConfirmModal = () => confirmModal.style.display = 'initial';

    window.confirm = ({
                          onConfirm = () => {},
                          onCancel = () => {},
                          headline = 'Are you sure?',
                          content = '',
                          confirmText = 'Confirm',
                          cancelText = 'Cancel'
                      }) => {
        headlineDiv.textContent = headline;
        contentDiv.textContent = content;
        confirmButton.textContent = confirmText;
        cancelButton.textContent = cancelText;

        confirmButton.onclick = () => {
            onConfirm();
            hideConfirmModal();
        };

        cancelButton.onclick = () => {
            onCancel();
            hideConfirmModal();
        }

        showConfirmModal();
    }
})();
