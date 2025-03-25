document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        if (confirm("Voulez-vous vraiment supprimer cette transaction ?")) {
          // Later: Send deletion request to the server
          alert("Transaction supprimée (simulation)");
        }
      });
    });
  });
  