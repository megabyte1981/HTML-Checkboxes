<?php

class checkBoxLayout
{

    public $debug = false;
    public $rowCount = 0;
    public $columnWidth = 0;
    public $dataCount = 0;

    public $direction = "Vertical";
    public $columns = 2;
    public $data = array();
    public $css = "";
    public $sortByDirection = SORT_ASC;
    public $sortByValue = "";
    public $label = "";
    public $value = "";
    public $isSelected = "";
    public $attributes = "";

    public function __construct($p = array()) {

        if(isset($p['columns']) && !empty($p['columns'])) {
            $this->columns = $p['columns'];
        }

        if(isset($p['data']) && !empty($p['data'])) {
            $this->data = $p['data'];
        } else {
            throw new Exception("Data parameter array is empty");
        }

        if(isset($p['direction']) && !empty($p['direction'])) {
            $this->direction = $p['direction'];
        }

        if(isset($p['css']) && !empty($p['css'])) {
            $this->css = $p['css'];
        }

        if(isset($p['sortBy']) && !empty($p['sortBy'])) {

            if(!empty($p['sortBy']['direction'])) {
                $this->sortByDirection = (($p['sortBy']['direction'] == "ASC") ? SORT_ASC : SORT_DESC);
            }

            if(!empty($p['sortBy']['value'])) {
                $this->sortByValue = str_replace("|", "", $p['sortBy']['value']);
            }
        }

        if(isset($p['label']) && !empty($p['label'])) {
            $this->label = str_replace("|", "", $p['label']);
        } else {
            throw new Exception("Data parameter label is required");
        }

        if(isset($p['value']) && !empty($p['value'])) {
            $this->value = str_replace("|", "", $p['value']);
        } else {
            $this->value = str_replace("|", "", $p['label']);
        }

        if(isset($p['isSelected']) && !empty($p['isSelected'])) {
            $this->isSelected = str_replace("|", "", $p['isSelected']);
        }

        if(isset($p['attributes']) && !empty($p['attributes'])) {
            $this->attributes = str_replace("|", "", $p['attributes']);
        }

    }

    public function debug() {

        $this->dataCount();
        $this->calculateColumnWidth();
        $this->calculateRowCount();
        $this->sortBy();

        $output = array();

        $output[] = "DIRECTION: " . $this->direction;
        $output[] = "COLUMN COUNT: " . $this->columns;
        $output[] = "ROW COUNT: " . $this->rowCount;

        if($this->sortByValue != "") {
            $output[] = "SORT BY: array value |" . $this->sortByValue . "|";
            $output[] = "SORT DIRECTION: " . (($this->sortByDirection == SORT_ASC) ? "ASC" : "DESC");
        }

        $output[] = "LABEL: array value |" . $this->label . "|";
        $output[] = "VALUE: array value |" . $this->value . "|";
        $output[] = "TOTAL WIDTH: " . $this->columnWidth;

        if($this->isSelected != "") {
            $output[] = "IS SELECTED: array value |" . $this->isSelected . "|";
        }

        if($this->attributes != "") {
            $output[] = "ATTRIBUTES: array value |" . $this->attributes . "|";
        }

        if($this->css != "") {
            $output[] = "CSS CLASSES: " . $this->css;
        }

        echo "<small>";
        echo "DEBUG OUTPUT <BR>";
        echo "-------------------------------------------------<BR>";
        echo implode("<BR>", $output);
        echo "</small>";

    }

    public function dataCount() {
        return $this->dataCount = count( $this->data );
    }

    public function calculateColumnWidth() {
        return $this->columnWidth = ( 100 / $this->columns );
    }

    public function calculateRowCount() {
        return $this->rowCount = ceil($this->dataCount / $this->columns);
    }

    public function generateCheckBox($item) {

        $label = (($this->label != "" && isset($item[$this->label])) ? $item[$this->label] : '');
        $value = (($this->value != "" && isset($item[$this->value])) ? $item[$this->value] : '');
        $isSelected = (($this->isSelected != "" && isset($item[$this->isSelected]) && $item[$this->isSelected]) ? ' checked' : '');
        $attributes = (($this->attributes != "" && isset($item[$this->attributes]) && $item[$this->attributes]) ? $item[$this->attributes] : array());

        $attr = "";
        if(!empty($attributes)) {
            foreach($attributes as $key=>$val) {
                $attr .= $key . " = '" . $val . "'";
            }
        }

        $checkBoxHTML = "";
        if($label != "") {
            $checkBoxHTML = "<label class='{$this->css}'><input type='checkbox' value='{$value}' {$attr} {$isSelected}/>{$label}</label>";
        }

        return $html = "<td width='{$this->columnWidth}%'>{$checkBoxHTML}</td>";
    }

    public function sortBy() {

        if($this->sortByValue != "") {
        	$data = array();
        	$tmp = $this->data;
        	foreach ($tmp as $key => $row) {
        		$data[$key] = $row[$this->sortByValue];
        	}
        	$data = array_map('strtolower', $data);
        	array_multisort($data, $this->sortByDirection, $tmp);
        	$this->data = $tmp;
        }

    }

    public function render() {

        $this->dataCount();
        $this->calculateColumnWidth();
        $this->calculateRowCount();
        $this->sortBy();

        // Pad the array so that all columns are equal in size
        for($i = 0; $i < $this->dataCount % $this->columns; $i++) {
            $this->data[] = null;
        }

        if($this->direction == "Horizontal") {

            $html = "<table width='100%'><tr>";
            foreach($this->data as $key => $item){
            	if(($key) % $this->columns == 0) {
            		$html .= "</tr><tr>";
            	}

                $html .= $this->generateCheckBox($item);
            }
            $html .= "</tr></table>";

        } else if($this->direction == "Vertical") {

            $item = array();
            $c = 1;
            $r = 1;

            foreach($this->data as $key => $val){
                $item['col_'.$c][$r] = $val;
                if ($r == $this->rowCount) {
            		$c++;
            		$r = 1;
            	} else {
            		$r++;
            	}
            }

            $html = "<table width='100%'>";
            for ($r = 1; $r <= $this->rowCount; $r++) {
                $html .= "<tr>";
                for ($c = 1; $c <= $this->columns; $c++) {

                    $html .= $this->generateCheckBox($item['col_'.$c][$r]);

            	}
                $html .= "</tr>";
            }
            $html .= "</table>";

        }

        return $html;
    }

}

?>
