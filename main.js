async function getComment() {

    let res = await fetch('/comment');
    
    let comments = await res.json();
    
    comments.forEach((comment) => {
      del_button = ''
        if (comment.id){
          del_button = `<button type="button" class="btn btn-danger" onclick="delComment(${comment.id})">Удалить</button>`
        }
        document.querySelector('.comment').innerHTML += `<div class="card mb-1">
        <div class="card-header">
          ${comment.email}
        </div>
        <div class="card-body">
          <p class="card-text">${comment.comment}</p>
          ${del_button}
        </div>
      </div>`
    })
}
    
    getComment();

async function addComment() {
    const email = document.getElementById('exampleFormControlInput1').value,
    comment = document.getElementById('exampleFormControlTextarea1').value;
    let fromData = new FormData();
    fromData.append('email', email);
    fromData.append('comment', comment);

    const res = await fetch('/comment', {
      method: 'POST',
      body: fromData
    });
    const data = await res.json();
    if (data.status===true){
      document.querySelector('.comment').innerHTML = '';
      document.querySelector('.alert').innerHTML = '';
      await getComment();
    }else{
      document.querySelector('.alert').innerHTML = `<div class="alert alert-danger" role="alert">
      ${data.err}
    </div>`;
    }
}

async function delComment(id) {
  const res = await fetch(`/comment/${id}`, {
    method: 'DELETE'
  });
  const data = await res.json();
  if (data.status===true){
    document.querySelector('.comment').innerHTML = '';
    document.querySelector('.alert').innerHTML = '';
    await getComment();
  }else{
    document.querySelector('.alert').innerHTML = `<div class="alert alert-danger" role="alert">
    ${data.err}
  </div>`;
  }
}