<script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-M8S4MT3EYG");
</script>
<script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
        c[a] =
            c[a] ||
            function () {
                (c[a].q = c[a].q || []).push(arguments);
            };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "kuc8w5o9nt");
</script>
<script>
    function markAsUnread(notificationId) {
        fetch(`/notifications/${notificationId}/unread`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Ou mise à jour dynamique du DOM
                }
            });
    }
    function markAsRead(notificationId) {
        fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mise à jour visuelle sans rechargement
                    const notificationElement = document.querySelector(`[data-notification-id="${notificationId}"]`);

                    // Modifier les classes pour l'état "lu"
                    notificationElement.classList.remove('bg-light', 'bg-opacity-10', 'fw-bold', 'text-dark');
                    notificationElement.classList.add('text-muted', 'fw-normal');

                    // Mettre à jour le badge
                    const badge = notificationElement.querySelector('.badge');
                    if (badge) {
                        badge.classList.remove('bg-primary');
                        badge.classList.add('bg-secondary');
                    }

                    // Supprimer l'indicateur "non lu"
                    const unreadIndicator = notificationElement.querySelector('.unread-indicator');
                    if (unreadIndicator) {
                        unreadIndicator.remove();
                    }

                    // Optionnel: mettre à jour le compteur de notifications non lues
                    updateUnreadCount();

                    // Redirection seulement si nécessaire (pour les liens dans la notification)
                    if (data.notification?.data?.lien) {
                        window.location.href = data.notification.data.lien;
                    }
                }
            })
            .catch(error => console.error('Error:', error));
    }
    function updateUnreadCount() {
        fetch('/api/notifications/unread-count')
            .then(response => response.json())
            .then(data => {
                document.getElementById('unread-count').textContent = data.count;
            });
    }

    // Actualiser toutes les 30 secondes
    setInterval(updateUnreadCount, 30000);
    updateUnreadCount(); // Au chargement initial

</script>

<script>
    function toggleAllNotifications() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.notification-checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });

        updateSelectedCount();
    }

    function updateSelectedCount() {
        const checkboxes = document.querySelectorAll('.notification-checkbox:checked');
        const count = checkboxes.length;
        const deleteBtn = document.getElementById('deleteSelectedBtn');
        const countSpan = document.getElementById('selectedCount');

        countSpan.textContent = count;
        deleteBtn.disabled = count === 0;

        // Mettre à jour le checkbox "Tout sélectionner"
        const selectAll = document.getElementById('selectAll');
        const allCheckboxes = document.querySelectorAll('.notification-checkbox');
        selectAll.checked = count === allCheckboxes.length;
        selectAll.indeterminate = count > 0 && count < allCheckboxes.length;
    }

    function deleteSelected() {
        const checkboxes = document.querySelectorAll('.notification-checkbox:checked');

        if (checkboxes.length === 0) {
            return;
        }

        if (!confirm(`Supprimer ${checkboxes.length} notification(s) sélectionnée(s) ?`)) {
            return;
        }

        const form = document.getElementById('bulkDeleteForm');
        const container = document.getElementById('selectedNotifications');

        // Vider le container
        container.innerHTML = '';

        // Ajouter les IDs sélectionnés
        checkboxes.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'notifications[]';
            input.value = checkbox.value;
            container.appendChild(input);
        });

        // Soumettre le formulaire
        form.submit();
    }

    // Initialiser le compteur au chargement
    document.addEventListener('DOMContentLoaded', function () {
        updateSelectedCount();
    });
</script>

<!-- Javascript-->
<script src="{{ asset('../assets/libs/nouislider/dist/nouislider.min.js')}}"></script>
<script src="{{ asset('../assets/libs/wnumb/wNumb.min.js')}}"></script>
<!-- Libs JS -->
<!-- <script src="{{ asset('../assets/libs/jquery/dist/jquery.min.js')}}"></script> -->
<script src="{{ asset('../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('../assets/libs/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Theme JS -->
<script src="{{ asset('../assets/js/theme.min.js')}}"></script>

<script src="{{ asset('../assets/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
<script src="{{ asset('../assets/js/vendors/tns-slider.js')}}"></script>
<script src="{{ asset('../assets/js/vendors/zoom.js')}}"></script>