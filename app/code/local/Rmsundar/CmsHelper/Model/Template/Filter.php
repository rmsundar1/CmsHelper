<?php

class Rmsundar_CmsHelper_Model_Filter extends Mage_Widget_Model_Template_Filter
{
	public function helperDirective($construction)
	{
		$params = $this->_getIncludeParameters($construction[2]);
		$allowedParams = array('module', 'method', 'params');
		if(empty($params) || !count(array_intersect($allowedParams, array_keys($params)))){
            return $construction[0];
        }
		if((isset($params['module']) && !empty($params['module'])) && (isset($params['module']) && !empty($params['module']))){
			try{
				$helper = Mage::helper($params['module']);
				if(is_callable(array($helper, $params['method']), true, $params['method'])){
					$arg = array();
					$method = $params['method'];
					if(isset($params['params']) && !empty($params['params'])){
						$arg = explode(',',$params['params']);
					}
					return call_user_func_array(array($helper, $method), $arg);
				}
			} catch (Exception $e){
				return $construction[0];
			}
		}
		return $construction[0];
	}
}