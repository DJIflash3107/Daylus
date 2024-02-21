<div id="notification" class="notification shadow hidden"></div>
<p class="hidden bg-green-500"></p>
<p class="hidden bg-red-500"></p>
<script>
    function Notification(message, bg) {
        const notification = document.getElementById('notification');
        notification.innerHTML = message;
        notification.classList.add("bg-" + bg + "-500");
        notification.classList.remove("hidden");
        setTimeout(() => {
            notification.style.opacity = '1';
        }, 10);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 500);
        }, 2000);
    }
</script>