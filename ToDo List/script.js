let todoName = document.getElementById('todo-name');
let btnSimpan = document.getElementById('btn-save');

btnSimpan.addEventListener('click', function () {
    if (todoName.value == '') {
        alert("The ToDo name cannot be empty!!");
    } else {
        let todoContainer = document.querySelector('.list-group')
        let todoHTML = todoContainer.innerHTML
        todoHTML += `
                <li class="list-group-item d-flex justify-content-between">
                    <div>
                    <input class="form-check-input me-1" type="checkbox">
                    <span>${todoName.value}</span>
                    </div>
                    <button class="badge border-0 bg-danger btn-delete">DELETE</button>
                </li>
                `;
        todoContainer.innerHTML = todoHTML;
        todoName.value = '';
        todoName.focus();


        let checkTodo = document.querySelectorAll('.form-check-input')
        for(let i = 0; i < checkTodo.length; i++){
            const input = checkTodo[i];
            input .addEventListener('change', function() {
                let todoSpan = input.nextElementSibling;
                todoSpan.classList.toggle('text-decoration-line-through');
            })
        }

        let btnDelete = document.querySelectorAll('.btn-delete');
        for(let x = 0; x < btnDelete.length; x++){
            const deletes = btnDelete[x];
            deletes.addEventListener('click', function() {
                this.parentElement.remove();
            })
        }

    }
})