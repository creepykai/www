<?php
class OvniModel {
    final function get_element_years() : array {
        $ret = [];
        $idx = 0;
        $fp = fopen('data.csv', 'r');
        while((!feof($fp)) && (($csv = fgetcsv($fp, 0, ',')) !== FALSE)) {
            if(!$idx) {
                $idx++;
                continue;
            }
            $ret[$idx++] = $csv[2];
        }
        fclose($fp);
        return $ret;
    }

    final function get_info_header() : array {
        $ret = [];
        $fp = fopen('data.csv', 'r');
        $csv = fgetcsv($fp, 0, ',');
        fclose($fp);
        if($csv != null) $ret = $csv;
        return $ret;
    }

    final function get_element_info(int $id) : array {
        $ret = [];
        $idx = -1;
        $fp = fopen('data.csv', 'r');
        while((!feof($fp)) && (($csv = fgetcsv($fp, 0, ',')) !== FALSE)) {
            $idx++;
            if($idx == $id){
                $ret = $csv;
                break;
            }
        }
        fclose($fp);
        return $ret;
    }
    
    final function add_element(array $data) : ?int {
        $fp = fopen('data.txt', 'a+');
        $ret = fputcsv($fp, $data);
        fclose($fp);
        return $ret;
    }
}