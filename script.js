// script.js

document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
  checkbox.addEventListener('change', async (e) => {
    const id = e.target.getAttribute('data-id');
    try {
      const response = await fetch(`toggle.php?id=${id}`);
      const updated = await response.json();
      const span = e.target.nextElementSibling;
      if (updated.is_done) {
        span.classList.add('done');
      } else {
        span.classList.remove('done');
      }
    } catch (error) {
      alert('Σφάλμα ενημέρωσης κατάστασης task');
    }
  });
});
