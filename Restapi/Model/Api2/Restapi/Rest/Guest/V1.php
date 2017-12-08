<?php
class Custom_Restapi_Model_Api2_Restapi_Rest_Guest_V1 extends Custom_Restapi_Model_Api2_Restapi
{

    /**
     * Create a customer
     * @return array
     */

    public function _create(array $data) {

        $firstName = $data['firstname'];
        $lastName = $data['lastname'];
        $email = $data['email'];
        $password = $data['password'];

        $customer = Mage::getModel("customer/customer");

        $customer->setFirstname($firstName);
        $customer->setLastname($lastName);
        $customer->setEmail($email);
        $customer->setPasswordHash(md5($password));
        $customer->save();

        return $this->_getLocation($customer);
    }


	protected function _retrieve() 
	{
		$product = $this->_getProduct (); 
                return $product->getData();
	}

        protected function _retrieveCollection()
	{
	$category = Mage::getModel('catalog/category');
	$catTree = $category->getTreeModel()->load();
	$catIds = $catTree->getCollection()->getAllIds();
	$cats = array();
	    if ($catIds){
		foreach ($catIds as $id){
		$cat = Mage::getModel('catalog/category');
		$cat->load($id);
		$cats[$cat->getId()]['firstname'] = $cat->getName();
$cats[$cat->getId()]['lastname'] = $cat->getName();
$cats[$cat->getId()]['email'] = $cat->getName();
$cats[$cat->getId()]['password'] = $cat->getName();
		//echo $cat->getName()."<br>";
	    	} 
	    } 
		//die(print_r($cats->toArray()));
              return $cats;
        }
}
