let ft_list;
let cookie = [];

window.onload = function () {
    document.querySelector("#new").addEventListener("click", newTodo);
    ft_list = document.querySelector("#ft_list");
    let tmp = document.cookie;
    if (tmp) {
        cookie = JSON.parse(tmp);
        cookie.forEach(function (e) {
            addTodo(e);
        });
    }
};

window.onunload = function () {
    let todo = ft_list.children;
    let newCookie = [];
    for (let i = 0; i < todo.length; i++)
        newCookie.unshift(todo[i].innerHTML);
    document.cookie = JSON.stringify(newCookie);
};

function newTodo(){
    let todo = prompt("Input new ToDo:", '');
    if (todo !== NULL) {
        addTodo(todo)
    }
}

function addTodo(todo){
    let div = document.createElement("div");
    div.innerHTML = todo;
    div.addEventListener("click", deleteTodo);
    ft_list.insertBefore(div, ft_list.firstChild);
}

function deleteTodo(){
    if (confirm("Are you sure you want to delete the note?")){
        this.parentElement.removeChild(this);
    }
}