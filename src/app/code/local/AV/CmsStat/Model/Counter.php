<?php

class AV_CmsStat_Model_Counter {

    public function getResource($query) {
        $resource = Mage::getSingleton('core/resource');
        $writeConn = $resource->getConnection('core_write');
        return $writeConn->query($query);
    }

    public function viewCounter($observer) {
        $controller = $observer->getEvent()->getControllerAction();
        $request = $controller->getRequest();
        $page_id = (int) $request->getParam('page_id');
        $page_title = Mage::getModel('cms/page')->load($page_id)->getTitle();
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        if (strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot")) {
            return false;
        }
        if ($page_id) {
            return $this->getResource("INSERT INTO av_cmsstat_views (page_id, views, last_view) VALUES (" . $page_id . ", 1, \"" . $date . "\") ON DUPLICATE KEY UPDATE views=views+1, last_view=\"" . $date . "\"; ");
        }
    }

    public function setAttribute() {
        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');
        $resource = Mage::getSingleton('core/resource');
        $write = $resource->getConnection('core_write');
        $table = $resource->getTableName('cms/page');
        $select = $connection->select()
                ->from($coreResource->getTableName('av_cmsstat_views'));
        $data = $connection->fetchAll($select);
        foreach ($data as $info) {
            $_page_id = (int) $info['page_id'];
            $_view = (int) $info['views'];
            $_date = $info['last_view'];
            $_cms = Mage::getModel('cms/page')->load($_page_id);
            $_cms_id = $_cms->getPageId();
            if ($_cms) {
                $write->update($table, array('stat_view' => $_view, 'stat_last' => $_date), array('page_id = ?' => $_cms_id));
            }
        }
    }

}
