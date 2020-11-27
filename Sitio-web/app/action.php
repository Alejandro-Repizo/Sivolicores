<?php 


session_start();
$total_item = 0;

if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				$total_item = $total_item + 1;
				if($_SESSION["shopping_cart"][$keys]['PK_ID_Producto'] == $_POST["PK_ID_Producto"])
				{
					$is_available++;
					$_SESSION["shopping_cart"][$keys]['Pt_Cantidad'] += $_POST["Pt_Cantidad"];
					$total_item;
				}
			}
			if($is_available == 0)
			{
				$item_array = array(
					'PK_ID_Producto'         =>     $_POST["PK_ID_Producto"],  
					'Pt_Nombre'             =>     $_POST["Pt_Nombre"],  
					'Pt_Precio'            =>     $_POST["Pt_Precio"],  
					'Pt_Cantidad'         =>     $_POST["Pt_Cantidad"],
					'Pt_Imagen'          =>     $_POST["Pt_Imagen"]
				);
				$_SESSION["shopping_cart"][] = $item_array;
				$total_item = $total_item + 1;
			}
		}
		else
		{
			$item_array = array(
				'PK_ID_Producto'         =>     $_POST["PK_ID_Producto"],  
				'Pt_Nombre'             =>     $_POST["Pt_Nombre"],  
				'Pt_Precio'            =>     $_POST["Pt_Precio"],  
				'Pt_Cantidad'         =>     $_POST["Pt_Cantidad"],
				'Pt_Imagen'          =>     $_POST["Pt_Imagen"]
			);
			$_SESSION["shopping_cart"][] = $item_array;
			$total_item = $total_item + 1;
		}
	}

	if($_POST["action"] == 'update')
	{
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($_SESSION["shopping_cart"][$keys]['PK_ID_Producto'] == $_POST["PK_ID_Producto"])
				{
					$is_available++;
					$_SESSION["shopping_cart"][$keys]['Pt_Cantidad'] = 0;
					$contador = $_POST["Pt_Cantidad"];
					$_SESSION["shopping_cart"][$keys]['Pt_Cantidad'] = $contador;
				}
			}
		}
	}

	if($_POST["action"] == 'remove')
	{	
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{	
			if($values["PK_ID_Producto"] === $_POST["PK_ID_Producto"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				
			}
			$total_item++;
		}
		--$total_item;
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);
		$total_item = 0;
	}

	echo json_encode($total_item);
}



?>