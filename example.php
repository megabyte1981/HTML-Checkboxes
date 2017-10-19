<?php

    include "checkBoxLayout.class.php";

    //======================================================================
    // Available Options
    //======================================================================
    // NOTE: The "|"'s around the values are not required. It's to illustrate that the string value is
    //      looking for the same data array index name.
    // columns: [INT] The number of column to render {DEFAULT} 2
    // direction: [STRING] Vertical or Horizontal {DEFAULT} Vertical
    // data: [REQUIRED] [ARRAY] an array of items to be rendered
    // sortBy: [ARRAY] direction: ASC or DESC {DEFAULT} ASC
    // sortBy: [ARRAY] value: data array index name from to sort by.
    // label: [REQUIRED] [STRING] display name for checkbox.  data array index name.
    // value: [STRING] value for the checkbox.  data array index name. {DEFAULT} is the label data array index name.
    // isSelected: [STRING] 0 or 1 {DEFAULT} 0 Check this box is needed.  data array index name.
    // attributes: [ARRAY] an array of data that needs to be injected inlined on the checkboxes.
    // css: [STRING] list a of classes for styling the checkboxes.
    //======================================================================
    // Sample 1 - parameter array of all options
    //======================================================================
    /*
    $p = array(
        "columns" => 2,
        "direction" => "Vertical",
        "data" => $list,
        "sortBy" => array(
            "direction" => SORT_ASC,
            "value" => "|name|"
        ),
        "label" => "|name|",
        "isSelected" => "|active|",
        "attributes" => "|attr|",
        "css" => "checkbox input"
    );
    */
    //======================================================================
    // Sample 2 - parameter array minimal options
    //======================================================================
    /*
    $p = array(
        "data" => $list,
        "label" => "|name|"
    );
    */

    $list = array(
        array(
            "id" => "1",
            "active" => "1",
            "name" => "Option 1",
            "attr" => array(
                "data-item" => "1",
                "data-item-2" => "1",
                "data-item-3" => "1"
            )
        ),
        array(
            "id" => "2",
            "active" => "0",
            "name" => "Option 2",
            "attr" => array(
                "data-item" => "2",
                "data-item-2" => "2",
                "data-item-3" => "2"
            )
        ),
        array(
            "id" => "3",
            "active" => "1",
            "name" => "Option 3",
            "attr" => array(
                "data-item" => "3",
                "data-item-2" => "3",
                "data-item-3" => "3"
            )
        ),
        array(
            "id" => "4",
            "active" => "0",
            "name" => "Option 4",
            "attr" => array(
                "data-item" => "4",
                "data-item-2" => "4",
                "data-item-3" => "4"
            )
        ),

        array(
            "id" => "5",
            "active" => "1",
            "name" => "Option 5",
            "attr" => array(
                "data-item" => "5",
                "data-item-2" => "5",
                "data-item-3" => "5"
            )
        ),
    );

    $p = array(
        "data" => $list,
        "label" => "|name|",
    );

    $CBL = new checkBoxLayout($p);
    $CBL->debug();
    echo $CBL->render();

    echo "<BR><BR><BR>";

    $p = array(
        "columns" => 3,
        "direction" => "Horizontal",
        "data" => $list,
        "sortBy" => array(
            "direction" => "DESC",
            "value" => "|name|"
        ),
        "label" => "|name|",
        "isSelected" => "|active|",
        "attributes" => "|attr|",
        "css" => ""
    );

    $CBL = new checkBoxLayout($p);
    $CBL->debug();
    echo $CBL->render();

    echo "<BR><BR><BR>";

    $p = array(
        "columns" => 1,
        "direction" => "Horizontal",
        "data" => $list,
        "label" => "|name|"
    );

    $CBL = new checkBoxLayout($p);
    $CBL->debug();
    echo $CBL->render();


    echo "<BR><BR><BR>";

    $p = array(
        "columns" => 5,
        "direction" => "Horizontal",
        "data" => $list,
        "sortBy" => array(
            "direction" => "DESC",
            "value" => "|name|"
        ),
        "label" => "|name|",
        "attributes" => "|attr|",
        "css" => ""
    );

    $CBL = new checkBoxLayout($p);
    $CBL->debug();
    echo $CBL->render();


?>
