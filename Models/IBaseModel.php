<?php

    // An interface is a class to declare fucntion prototypes or function signatures
    interface IBaseModel {

        function GetId();
        function SetId($id);
        function FromRow($row);
    }

?>