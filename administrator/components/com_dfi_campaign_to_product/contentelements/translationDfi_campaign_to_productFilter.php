<?php


class translationDfi_campaign_to_productFilter extends translationFilter
{
	function translationDfi_campaign_to_productFilter ($contentElement)
	{
		$this->filterNullValue=-1;
		$this->filterType="dfi_campaign_to_product";
		$this->filterField = $contentElement->getFilter("dfi_campaign_to_product");
		parent::translationFilter($contentElement);
	}
	
	function _createFilter(){
		global $database;
		if (!$this->filterField ) return "";
		$filter="";
		if ($this->filter_value!=$this->filterNullValue){
			$filter="c.dfi_campaign_product_id=".$this->filter_value;
		}
		return $filter;
	}
	

	/**
 * Creates vm_category filter 
 *
 * @param unknown_type $filtertype
 * @param unknown_type $contentElement
 * @return unknown
 */
	function _createfilterHTML(){
		global $database;

		if (!$this->filterField) return "";
		$categoryOptions=array();
		$categoryOptions[] = mosHTML::makeOption( '-1',_JOOMFISH_ADMIN_CATEGORY_ALL );
		
		$categoryList=array();
		$categoryList["title"]=_JOOMFISH_ADMIN_CATEGORY;
		$categoryList["html"] = mosHTML::selectList( $categoryOptions, 'dfi_campaign_to_product_filter_value', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $this->filter_value );

		return $categoryList;

	}

}

?>