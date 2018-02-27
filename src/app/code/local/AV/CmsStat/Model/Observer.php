<?php

class AV_CmsStat_Model_Observer {

    public function addNewCmsField($observer) {
        $model = Mage::registry('cms_page');
        $form = $observer->getForm();
        $fieldset = $form->addFieldset('av_cmsstat_fieldset', array('legend' => Mage::helper('cms')->__('Statistic'), 'class' => 'fieldset-wide'));
        $fieldset->addField('stat_view', 'text', array(
            'name' => 'stat_view',
            'label' => Mage::helper('cms')->__('View Counter'),
            'title' => Mage::helper('cms')->__('View Counter'),
            'disabled' => false,
            'value' => $model->getStatView(),
            'readonly' => true,
        ));
        $fieldset->addField('stat_last', 'text', array(
            'name' => 'stat_last',
            'label' => Mage::helper('cms')->__('Last View'),
            'title' => Mage::helper('cms')->__('Last View'),
            'disabled' => false,
            'value' => $model->getStatLast(),
            'readonly' => true,
        ));
    }

}
