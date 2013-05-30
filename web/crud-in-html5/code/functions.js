$(function(){
    var operation = "A"; //"A"=Adding; "E"=Editing
    var selected_index = -1; //Index of the selected list item
    var tbClients = localStorage.getItem("tbClients");//Retrieve the stored data
    tbClients = JSON.parse(tbClients); //Converts string to object
    if(tbClients == null) //If there is no data, initialize an empty array
        tbClients = [];

	function Add(){
		var client = JSON.stringify({
			Name  : $("#txtName").val(),
			Phone : $("#txtPhone").val(),
			Note : $("#txtNote").val()
		});
		tbClients.push(client);
		localStorage.setItem("tbClients", JSON.stringify(tbClients));
		return true;
	}

	function Edit(){
		tbClients[selected_index] = JSON.stringify({
				Name  : $("#txtName").val(),
				Phone : $("#txtPhone").val(),
				Note : $("#txtNote").val()
			});//Alter the selected item on the table
		localStorage.setItem("tbClients", JSON.stringify(tbClients));
		operation = "A"; //Return to default value
		return true;
	}

	function Delete(){
		tbClients.splice(selected_index, 1);
		localStorage.setItem("tbClients", JSON.stringify(tbClients));
	}

	function List(){       
		$("#tblList").html("");
		$("#tblList").html(
			"<thead>"+
			"   <tr>"+
			"   <th></th>"+
			"   <th>姓名</th>"+
			"   <th>电话</th>"+
			"   <th>备注</th>"+
			"   </tr>"+
			"</thead>"+
			"<tbody>"+
			"</tbody>"
			);
		for(var i in tbClients){
			var cli = JSON.parse(tbClients[i]);
			$("#tblList tbody").append(
				"<tr>"+
				"  <td><img src='edit.png' alt='Edit"+i+"' class='btnEdit'/>" + 
				"<img src='delete.png' alt='Delete"+i+"' class='btnDelete'/></td>" +
				"  <td>"+cli.Name+"</td>" +
				"  <td>"+cli.Phone+"</td>" +
				"  <td>"+cli.Note+"</td>" +
				"</tr>");
		}

		$(".btnEdit").bind("click", function(){
			operation = "E";
			selected_index = parseInt($(this).attr("alt").replace("Edit", ""));
			var cli = JSON.parse(tbClients[selected_index]);
			$("#txtName").val(cli.Name);
			$("#txtPhone").val(cli.Phone);
			$("#txtNote").val(cli.Note);
			$("#txtName").focus();
		});

		$(".btnDelete").bind("click", function(){
			selected_index = parseInt($(this).attr("alt").replace("Delete", ""));
			Delete();
			List();
		});
	}

	List();

	$("#frmCadastre").bind("submit", function(){
		if(operation == "A")
			return Add();
		else
			return Edit();
	});
});