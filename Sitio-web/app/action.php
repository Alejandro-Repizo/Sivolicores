<?php 


session_start();
if(isset($_POST["action"]))
{
	if($_POST["action"] == "add")
	{
		if(isset($_SESSION["shopping_cart"]))
		{
			$is_available = 0;
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				if($_SESSION["shopping_cart"][$keys]['PK_ID_Producto'] == $_POST["PK_ID_Producto"])
				{
					$is_available++;
					$_SESSION["shopping_cart"][$keys]['Pt_Cantidad'] = $_SESSION["shopping_cart"][$keys]['Pt_Cantidad'] + $_POST["Pt_Cantidad"];
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
		}
	}

	if($_POST["action"] == 'remove')
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["PK_ID_Producto"] == $_POST["PK_ID_Producto"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	}
	if($_POST["action"] == 'empty')
	{
		unset($_SESSION["shopping_cart"]);
	}
}



?>