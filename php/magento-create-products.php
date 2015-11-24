<?php 
	error_reporting(E_ALL | E_STRICT);
	$mageFilename = 'app/Mage.php';
	require_once $mageFilename;
	Mage::setIsDeveloperMode(true);
	umask(0);
	Mage::app();
	Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));


//create csv array





//$product = Mage::getModel('catalog/product'); 
/*	$product = new Mage_Catalog_Model_Product(); 

// Build the product 
	$product->setSku('configTest2'); 
	$product->setAttributeSetId('4');# 9 is for default 
	$product->setTypeId('configurable'); 
	$product->setName('Magic The Gatheringi1'); 
	$product->setCategoryIds(array(25)); # some cat id's, 
	$product->setWebsiteIDs(array(1)); # Website id, 1 is default 
	$product->setDescription('Full description here'); 
	$product->setShortDescription('Short description here'); 
	$product->setPrice(39.99); # Set some price

//Default Magento attribute 
	$product->setWeight(4.0000); 

	$product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH); 
	$product->setStatus(1); 
	$product->setTaxClassId(0); # default tax class 
	$product->setStockData(array( 
	'is_in_stock' => 1, 
	'qty' => 99999 
	)); 

	$product->setCreatedAt(strtotime('now')); */

	//$optionId = '92';
	$row = 1;
	if (($handle = fopen("product_import_category3.csv", "r")) !== FALSE)
	//if (($handle = fopen("product_import_category1.csv", "r")) !== FALSE)
	//if (($handle = fopen("product_import_category.csv", "r")) !== FALSE)
	//if (($handle = fopen("product_import_category_test.csv", "r")) !== FALSE) 
	{
		$resource = Mage::getSingleton('core/resource');
		$readCon = $resource->getConnection('core_read');
		while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) 
		{
			$num = count($data);
			//if($row != 1)
			//echo "<p> $num fields in line $row: <br /></p>\n";
			$row++;
			if($row != 2)
			{
				for ($c=0; $c < $num; $c++) 
				{
					if($c == 0)
					{
						//echo 'name is: ';
						$configName = $data[$c];
						$simpleName1 = $data[$c].' (not wrapped)';
						$simpleName2 = $data[$c].' (wrapped)';
					}
					if($c == 1)
						$price = $data[$c];
					if($c == 2)
					{
						$brandName = $data[$c];					
						$query = 'select option_id from eav_attribute_option_value where value="'.$brandName.'"';
						$brandId = $readCon->fetchOne($query);
					}
					if($c == 3)
						$shortDesc = $data[$c];
					if($c == 4)
					{
						$desc = $data[$c];
					}
					if($c == 5)
					{
						if($data[$c] != '')
						{
							//$categoryName = $data[$c];
							$category = Mage::getModel('catalog/category')->loadByAttribute('name', $data[$c]);
							$categoryId = $category->getId();
						}
						else
							$categoryId = '2';
					}
					if($c == 6)
					{
						$ageGroupName = $data[$c];					
						$query = 'select option_id from eav_attribute_option_value where value="'.$ageGroupName.'"';
						$ageGroupId = $readCon->fetchOne($query);
					}
					if($c == 7)
						$numPieces = $data[$c];
					if($c == 8)
					{
						//var_dump($data);die();
						//$weight = (float)$data[$c];
						$weight = $data[$c];
						//var_dump($weight);die();
					}
				
					if($c == 9)
					$dimensions = $data[$c];					
					if($c == 10)
					{
						$numPlayersName = $data[$c];					
						$query = 'select option_id from eav_attribute_option_value where value="'.$numPlayersName.'"';
						$numPlayersId = $readCon->fetchOne($query);
					}
					if($c == 11)
						$gameTime = $data[$c];					
					//if($c == 1)
					//	$subCategory = $data[$c];					
					if($c == 13)
					{
						echo $data[$c].'<br>';
						$subCategory = Mage::getModel('catalog/category')->loadByAttribute('name', $data[$c]);
						$subCategoryId = $subCategory->getId();
						//echo $subCategoryId;die();
					}
					if($c == 14)
					{
						//echo 'sku is: ';
						$configSku = $data[$c];
						$simpleSku1 = $data[$c].'_not_wrapped';
						$simpleSku2 = $data[$c].'_wrapped';
					}
					if($c == 27)
						$minNumPlayers = $data[$c];					
					if($c == 51)
						$metaKeywords = $data[$c];
					if($c == 15)
					{
						$image1 = $data[$c];
						$image1 = str_replace('/', '', $image1);
					}
					if($c == 16)
					{
						$image2 = $data[$c];
						$image2 = str_replace('/', '', $image2);
					}
					if($c == 17)
					{
						$image3 = $data[$c];
						$image3 = str_replace('/', '', $image3);
					}
					//if($c == 19)
					//{
					//	$crossSellSkus = array();
					//	$crossSellSkus = explode(',',$data[$c]);
						//var_dump($crossSell);die();
					//}
				}
				$simpleProductsSet = array();
				//$simpleProductsSet[] = createSimple($simpleSku1, $simpleName1, '92', $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $categoryId, $subCategoryId);
				$simpleProductsSet[] = createSimple($simpleSku1, $simpleName1, '92', $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $weight);
				//$simpleProductsSet[] = createSimple($simpleSku2, $simpleName2, '91', $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $categoryId, $subCategoryId);
				$simpleProductsSet[] = createSimple($simpleSku2, $simpleName2, '91', $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $weight);
				createConfigurable($configSku, $configName, '92', $simpleProductsSet, $price, $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $categoryId, $subCategoryId, $weight, $numPieces);
			}
		}
		fclose($handle);
	}


	//$sku = 'chess_not_wrapped';
	//$name = 'Chess (not wrapped)';
	//$sku = 'chess_wrapped';
	//$name = 'Chess (wrapped)';

	//function createSimple($sku, $name, $optionId, $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $categoryId, $subcategoryId)
	function createSimple($sku, $name, $optionId, $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $weight)
	{
		try
		{
			$product = new Mage_Catalog_Model_Product(); 
// Build the product 
			$product->setSku($sku); 
			$product->setAttributeSetId('13');# 9 is for default 
			$product->setTypeId('simple'); 
			$product->setName($name); 
			$product->setCategoryIds(array(25)); # some cat id's, 
			$product->setWebsiteIDs(array(1)); # Website id, 1 is default 
			$product->setDescription($desc); 
			$product->setShortDescription($shortDesc); 
			$product->setPrice(0); # Set some price
//Default Magento attribute 
			//$product->setWeight(5.0000); 
			$product->setWeight($weight); 
			$product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE); 
			$product->setStatus(1); 
			$product->setTaxClassId(0); # default tax class
			$product->setStockData(array( 
			'is_in_stock' => 1, 
			'qty' => 99999 
			)); 
			$product->setCreatedAt(strtotime('now'));
			//$product->setCategoryIds(array($categoryId, $subcategoryId));



			
			//$product->addImageToMediaGallery('./media/import/'.$image1,null,false,false); 
			//$product->addImageToMediaGallery('./media/import/'.$image2,null,false,false); 
			//$product->addImageToMediaGallery('./media/import/'.$image3,null,false,false); 
//custom attribute for gift wrapping
		}
		catch(Exception $exMain)
		{
			echo 'simple main exception:<br><br>'.$exMain.'<br><br>';
		}

		try 
		{ 
			$product->save();
			$_product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
			$_product->setData('gift_wrap', $optionId);
			$_product->setData('brand', $brandId);
			$_product->setData('age_group', $ageGroupId);
			$_product->setData('dimensions', $dimensions);
			$_product->setData('num_players', $numPlayersId);
			$_product->setData('game_time', $gameTime);
			$_product->setData('min_num_players', $minNumPlayers);
			$debugProduct = $_product;
			$_product->save();
//$attr = $_product->getResource()->getAttribute('gift_wrap');
//$attrVal1 = $attr->getSource()->getOptionId('Not Gift Wrapped');
//'Not Gift Wrapped' -> 92
//'Gift Wrapped' -> 91
//$attrVal1 = $attr->getSource()->getOptionId('Gift Wrapped');
//var_dump($product);
//die();
		} 
		catch(Exception $ex) 
		{ 
			echo 'simple save exception:<br><br>'.$ex; 
		}
		return $debugProduct; 
	}
	//echo 'here we go.';
	function createConfigurable($sku, $name, $optionId, $simpleProducts, $price, $brandId, $ageGroupId, $dimensions, $numPlayersId, $gameTime, $minNumPlayers, $shortDesc, $desc, $image1, $image2, $image3, $categoryId, $subCategoryId, $weight, $numPieces)
	{
		try
		{
			$product = new Mage_Catalog_Model_Product(); 
// Build the product 
			$product->setSku($sku); 
			$product->setAttributeSetId('13');# 9 is for default 
			$product->setTypeId('configurable'); 
			$product->setName($name); 
			$product->setCategoryIds(array(25)); # some cat id's, 
			$product->setWebsiteIDs(array(1)); # Website id, 1 is default 
			$product->setDescription($desc); 
			$product->setShortDescription($shortDesc); 
			$product->setPrice($price); # Set some price
//Default Magento attribute 
			//$product->setWeight($weight);
			echo '<br>'.$weight.'<br>';
			//$product->setWeight(0.2000); 
			$product->setWeight(4.0000); 
			$product->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH); 
			$product->setStatus(1); 
			$product->setTaxClassId(0); # default tax class 
			$product->setStockData(array( 
			'is_in_stock' => 1, 
			'qty' => 99999 
			)); 
			$product->setCreatedAt(strtotime('now')); 
			$product->setCategoryIds(array($categoryId, $subCategoryId));
			$product->setMetaDescription($shortDesc);
			$mediaAttribute = array(
							'thumbnail',
							'small_image',
							'image',
						);
			$imagePath1 = './media/import/'.$image1;
			$imagePath2 = './media/import/'.$image2;
			$imagePath3 = './media/import/'.$image3;
			//echo $imagePath1.'<br>'.$imagePath2.'<br>'.$imagePath3;die();
			if( !file_exists($imagePath1) && $imagePath1 != '')
			{
				if(file_exists('./media/import.bak/'.$image1))
				{
					exec('cp media/import.bak/'.$image1.' media/import');
					$product->addImageToMediaGallery('./media/import/'.$image1,$mediaAttribute,true,false); 
				}
				else
				{
					echo 'ERROR: file '.$imagePath1.' does not exist.  SKU is: '.$sku;
				}
			}
			elseif($imagePath1 != '')
				$product->addImageToMediaGallery($imagePath1,$mediaAttribute,true,false); 

			if( !file_exists($imagePath2) && $imagePath2 != '')
			{
				if ( file_exists('./media/import.bak/'.$image2))
				{
					exec('cp media/import.bak/'.$image2.' media/import');
					$product->addImageToMediaGallery('./media/import/'.$image2,null,true,false); 
				}
				else
				{
					echo 'ERROR: file '.$imagePath2.' does not exist.  SKU is: '.$sku;
				}
			}
			elseif($imagePath2 != '')
				$product->addImageToMediaGallery($imagePath2,null,true,false); 

			if( !file_exists($imagePath3) && $imagePath3 != '')
			{
				if ( file_exists('./media/import.bak/'.$image3))
				{
					exec('cp media/import.bak/'.$image3.' media/import');
					$product->addImageToMediaGallery('./media/import/'.$image3,null,true,false); 
				}
				else
				{
					echo 'ERROR: file '.$imagePath3.' does not exist.  SKU is: '.$sku;
				}
			}
			elseif($imagePath3 != '')
				$product->addImageToMediaGallery($imagePath3,null,true,false); 
//custom attribute for gift wrapping
		}
		catch(Exception $exMain)
		{
			echo 'configurable main exception:<br><br>'.$exMain.'<br><br>';
		}

		try 
		{ 
			$product->save();
			$_product = Mage::getModel('catalog/product')->loadByAttribute('sku', $sku);
			$configId=$_product->getId();
			$resource = Mage::getSingleton('core/resource');
			$readCon = $resource->getConnection('core_read');
			$writeCon = $resource->getConnection('core_write');
			$table = 'catalog_product_super_attribute';
			if (!$writeCon)
			{
				die('Could not connect: ' . mysql_error());
			}
//set gift wrap attribute:  super attribute id, configurable product id (auto-increment), normal attribute id, position (always 0 for one configurable option)
			$query = 'insert into catalog_product_super_attribute (product_id, attribute_id) values ('.$configId.', 142 )';
			$writeCon->query($query);
//i think this has to be set to create the associated products: configurable product id, associated simple product id  ...repeat as necessary (twice in this case)
			$simpleId1 = $simpleProducts[0]->getId();
			$simpleId2 = $simpleProducts[1]->getId();
			$query = 'insert into catalog_product_relation values ('.$configId.', '.$simpleId1.' )';
			$writeCon->query($query);
			$query = 'insert into catalog_product_relation values ('.$configId.', '.$simpleId2.' )';
			$writeCon->query($query);
//set the link id between the configurable product and the associated simple product: link id, simple product, configurable product
			$query = 'insert into catalog_product_super_link (product_id, parent_id) values ('.$simpleId1.', '.$configId.')';
			$writeCon->query($query);
			$query = 'insert into catalog_product_super_link (product_id, parent_id) values ('.$simpleId2.', '.$configId.')';
			$writeCon->query($query);
//get the superattribute id for the next write query
			$query = 'select product_super_attribute_id from catalog_product_super_attribute where product_id='.$configId;
			$superAttrId = $readCon->fetchOne($query);
			$query = 'insert into catalog_product_super_attribute_pricing (product_super_attribute_id, value_index, is_percent, pricing_value, website_id) values ('.$superAttrId.', 91, 0, 5.000, 0)';
			$writeCon->query($query);
			$_product->setData('brand', $brandId);
			$_product->setData('age_group', $ageGroupId);
			$_product->setData('dimensions', $dimensions);
			$_product->setData('num_players', $numPlayersId);
			$_product->setData('game_time', $gameTime);
			$_product->setData('min_num_players', $minNumPlayers);
			$_product->setData('num_pieces', $numPieces);
//set cross sell products
			//$crossProduct = Mage::getModel('catalog/product')->load
			//$_product->setCrossSellLinkData(
			$_product->save();
		} 
		catch(Exception $ex) 
		{ 
			echo 'configurable save exception:<br><br>'.$ex; 
		}
		/*$row1 = 1;
		$handle1 = fopen("product_import_category_test.csv", "r");
		while (($data1 = fgetcsv($handle1, 2000, ",")) !== FALSE)
		{
			$num1 = count($data1);
			$row1++;
			if($row1 != 2)
			{
				$sku = $data1[14];
				echo $data1[19].'<br>';
				$baseProduct = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
				$crossSellSkus = array();
				$crossSellSkus = explode(',',$data1[19]);
				var_dump($baseProduct);echo '<br>';var_dump($crossSellSkus);die();

			}



		}*/
	}

?>
