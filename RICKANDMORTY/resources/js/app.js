import 'bootstrap';
window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

document.addEventListener('click', function(e){
  if (e.target.matches('.favorite-btn')) {
    const btn = e.target;
    const id = btn.getAttribute('data-id');

    fetch('/favorite/toggle', {
      method: 'POST',
      headers: {
        'Content-Type':'application/json',
        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ character_id: id })
    })
    .then(r => r.json())
    .then(data => {
      if (data.status === 'added') {
        btn.classList.add('btn-danger');
        btn.classList.remove('btn-success');
        btn.innerText = '★ Favorited';
      } else if (data.status === 'removed') {
        btn.classList.add('btn-success');
        btn.classList.remove('btn-danger');
        btn.innerText = '★ Save / Remove Favorite';
      } else {
        alert('Error toggling favorite');
      }
    })
    .catch(err => {
      console.error(err);
      alert('Network error.');
    });
  }
});
