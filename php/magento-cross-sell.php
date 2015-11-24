<?

error_reporting(E_ALL | E_STRICT);
$mageFilename = 'app/Mage.php';
require_once $mageFilename;
Mage::setIsDeveloperMode(true);
umask(0);
Mage::app();
Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));
$row1 = 1;
$handle1 = fopen("product_import_category.csv", "r");
while (($data1 = fgetcsv($handle1, 2000, ",")) !== FALSE)
{
	$num1 = count($data1);
	$row1++;
	if($row1 != 2 && $data1[19] != '')
	{
		$sku = $data1[14];
		//echo 'Base Product SKU: '.$sku.'<br>';
		//echo $data1[19].'<br>';
		$baseProduct = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);
		//$baseId = $baseProduct->getId();
		$crossSellSkus = array();
		//$crossSellSkus = explode(',',$data1[19]);
		//$crossSellSkus = explode(',','4D-001_wrapped,4D-001_not_wrapped');
		$crossSellSkus = explode(',',$data1[19]);
		//var_dump($crossSellSkus);die();
		//var_dump($baseProduct);echo '<br>';var_dump($crossSellSkus);die();
		$crossSellProducts = array();
		$linkData = $baseProduct->getCrossSellLinkData();
		//echo 'Cross Sell SKUs: ';
		foreach($crossSellSkus as $crossSellSku)
		{
			$crossSellSku = trim($crossSellSku);
			//echo $crossSellSku.', ';
			//var_dump($crossSellSku);
			$prodTmp = Mage::getModel('catalog/product')->loadByAttribute('sku',$crossSellSku);
			if(is_object($prodTmp))
				$crossSellProducts[] = $prodTmp;
			else
				echo 'Error: Cannot add related product with sku, '.$crossSellSku.' to base product with sku, '.$sku.'.<br>';
		}
		//echo '<br><br>';
		$pos = 0;
		foreach($crossSellProducts as $crossSellProduct)
		{
			$linkIndex = $crossSellProduct->getId();
			$linkData[$linkIndex] = array('position' => $pos);
			$pos++;
		}
		$baseProduct->setCrossSellLinkData($linkData);
		//echo "success";die();
		$baseProduct->save();
		//var_dump($crossSellProducts[0]);echo '<br><br>';var_dump($crossSellProducts[1]);
	}
}
?>
