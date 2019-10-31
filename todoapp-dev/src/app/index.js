import '../style/app.scss';

const $modal = document.getElementById('myModal');
const $openModal = document.getElementById('openModal');
const $closeModal = document.getElementById('close');
let $openSettingButtons = document.querySelectorAll('button#openSettingList');
let $settingList = document.querySelectorAll('ul#settingList');
const $todoForm = document.todoForm;
const $searchByTitle = document.querySelector('#searchByTitle');
const $searchByStatus = document.querySelector('#searchByStatus');
const $searchByPriority = document.querySelector('#searchByPriority');
let todoList = [];

function createOrUpdateTodo() {
  if (document.todoForm.todoId.value) {
    // обновляем запись
    const id = document.todoForm.todoId.value;
    const idx = todoList.findIndex(e => e.id === id);
    const oldTodo = todoList[idx];
    const newTodo = {
      ...oldTodo,
      title: document.todoForm.title.value,
      description: document.todoForm.description.value,
      priority: document.todoForm.priority.value
    };
    todoList[idx] = newTodo;
    $todoForm.reset();
  } else {
    // создаем
    const id = `_${Math.random()
      .toString(16)
      .substring(2, 9)}`;
    const title = document.todoForm.title.value;
    const description = document.todoForm.description.value;
    const priority = document.todoForm.priority.value;
    const status = 'open';
    todoList.push({ id, title, description, priority, status });
    $todoForm.reset();
  }
  // Создавать или редактировать задачу внутри этого метода
  $closeModal.click();
}

function done(event) {
  const pathToParentId = event.composedPath();
  const parentIdElem = pathToParentId.find(e =>
    e.classList.contains('todo-item')
  );
  /* const parentIdElem = pathToParentId.find( e => e.className === 'todo-item')  */
  const parentId = parentIdElem.id;
  const todoIdx = todoList.findIndex(e => e.id === parentId);
  todoList[todoIdx].status = 'done';
  displayTodos(todoList);
}

function fillTodoForm({ id, title, description, priority }) {
  document.todoForm.todoId.value = id;
  document.todoForm.title.value = title;
  document.todoForm.description.value = description;
  document.todoForm.priority.value = priority;
}

function editTodo(event) {
  const pathToParentId = event.composedPath();
  const parentIdElem = pathToParentId.find(e =>
    e.classList.contains('todo-item')
  );
  const parentId = parentIdElem.id;
  const todo = todoList.find(e => e.id === parentId);
  fillTodoForm(todo);
  $openModal.click();
}

function removeTodo(event) {
  const pathToParentId = event.composedPath();
  const parentIdElem = pathToParentId.find(e =>
    e.classList.contains('todo-item')
  );
  const parentId = parentIdElem.id;
  todoList = todoList.filter(e => e.id !== parentId);
  displayTodos(todoList);
  /* todoItemEventHandlers() */
}

function todoItemEventHandlers() {
  $openSettingButtons = document.querySelectorAll('button#openSettingList');
  $settingList = document.querySelectorAll('ul#settingList');

  $openSettingButtons.forEach(button => {
    button.addEventListener('click', event => {
      const pathToElem = event.composedPath();
      /* use includes method  */
      /* const parentContainer = pathToElem.find( e => e.attributes.class.nodeValue === 'todo-item__settings') */
      const parentContainer = pathToElem.find(e =>
        e.attributes.class.nodeValue.includes('todo-item__settings')
      );
      parentContainer.children.settingList.classList.toggle('show');
    });
  });

  $settingList.forEach(list => {
    list.addEventListener('click', event => {
      if (event.target.id === 'done') {
        done(event);
      } else if (event.target.id === 'edit') {
        editTodo(event);
      } else if (event.target.id === 'delete') {
        removeTodo(event);
      }
    });
  });
}

function displayTodos(todos) {
  const $container = document.getElementById('todoListSection');
  $container.innerHTML = '';
  todos.forEach(element => {
    const newTodo = `
      <div class="todo-item${
        element.status === 'done' ? ' todo-item_done' : ''
      }" id="${element.id}">
        <span class="far fa-check-square todo-item__check-box"></span>
        <header>
          <h2>${element.title}</h2>
        </header>
        <main>
          <div class="todo-item__description">
            ${element.description ? element.description : ''}
          </div> 
        </main>
        <footer class="todo-item__footer">
          <div class="todo-item__priority">
            ${element.priority}
          </div>
          <div class="settings todo-item__settings">
            <button id="openSettingList" class="dropdwn button button_raised">...</button>
            <ul class="list settings__list settings__list-styled" id="settingList">
              <li class="list__item" id="done">Done</li>
              <li class="list__item" id="edit">Edit</li>
              <li class="list__item" id="delete">Delete</li>
            </ul>
          </div>
        </footer>
      </div>
    `;
    $container.insertAdjacentHTML('afterbegin', newTodo);
  });
  todoItemEventHandlers();
}

function filter() {
  const title = $searchByTitle.value.trim().toLowerCase();
  const status = $searchByStatus.value;
  const priority = $searchByPriority.value;
  const titleFilter = todoList.filter(a =>
    a.title.toLowerCase().includes(title)
  );
  if (status === 'all' && priority === 'all') {
    displayTodos(titleFilter);
  } else if (status !== 'all' && priority !== 'all') {
    const result = titleFilter
      .filter(a => a.priority === priority)
      .filter(a => a.status === status);
    displayTodos(result);
  } else if (status !== 'all') {
    const result = titleFilter.filter(a => a.status === status);
    displayTodos(result);
  } else if (priority !== 'all') {
    const result = titleFilter.filter(a => a.priority === priority);
    displayTodos(result);
  }
}

$openModal.addEventListener('click', () => {
  $modal.style.display = 'flex';
});

$closeModal.addEventListener('click', () => {
  $modal.style.display = 'none';
});

window.addEventListener('click', event => {
  if (event.target === $modal) {
    $modal.style.display = 'none';
  }
  if (!event.target.matches('.dropdwn')) {
    const $dropdowns = document.getElementsByClassName('settings__list');
    let i;
    for (i = 0; i < $dropdowns.length; i += 1) {
      const openDropdown = $dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
});

$todoForm.addEventListener('submit', event => {
  event.preventDefault();
  createOrUpdateTodo();
  displayTodos(todoList);
  /* todoItemEventHandlers() */
  return false;
});

$todoForm.addEventListener('reset', () => {
  $todoForm.todoId.value = '';
});

$searchByTitle.addEventListener('input', filter);
$searchByStatus.addEventListener('change', filter);
$searchByPriority.addEventListener('change', filter);
