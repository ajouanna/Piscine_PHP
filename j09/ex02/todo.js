// http://localhost:8080/j09/ex02/index.html
document.getElementById("new_button").onclick =  add_todo; // ne pas mettre de parentheses sinon la fonction est executee

var ident = 0;
function add_todo()
{
	var todo = prompt("Please enter new todo item", 'todo' + ident.toString());
	if (todo != null) 
	{
	    var ft_list = document.getElementById("ft_list");
	    
	    var new_todo = document.createElement('div');
	    var text = document.createTextNode(todo);
	    new_todo.appendChild(text);
	    new_todo.setAttribute('id', ident);
	    new_todo.setAttribute("onclick", "delete_todo(this)");
	    ft_list.insertBefore(new_todo, ft_list.firstChild);
	    console.log(ft_list);
	    ident++;
	    console.log(ident);
	}
}

function delete_todo(i)
{
	 if (confirm("Delete todo item?")) 
	 { 
		ft_list.removeChild(i);
     }
}