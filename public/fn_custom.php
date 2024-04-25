
<?php

/*
4LmE4Lif4Lil4LmM4LmC4LiE4LmJ4LiU4LiZ4Li14LmJ4LiW4Li54LiB4LmA4LiC4Li14Lii4LiZ4LiC4Li24LmJ4LiZ4LmC4LiU4LiiIOC4meC4suC4ouC4m+C4kOC4p+C4tSDguKjguKPguLXguJvguKPguLDguKrguKE=
*/

if (isset($_GET['showError']) && $_GET['showError'] == 'Y') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

if (isset($_GET['showSession']) && $_GET['showSession'] == 'Y') {
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre><hr>";
}


class pm
{

    public static function genFilter($array)
    {
        $filter = '';

        if (is_array($array)) {
            foreach ($array as $field) {
                if (trim($field[1]) != '') {
                    $filter .= " AND {$field[0]} ";
                    if ($field[2] == '=') {
                        $filter .= " = {$field[1]} ";
                    } else {
                        $filter .= $field[2] . " '" . $field[1] . "' ";
                    }
                }
            }
        }

        return $filter;
    }

    public static function boxTxt($key, $val, $txt, $sizeMain, $sizeTxt, $sizeInput, $class = '')
    {

        return '<div class="col-md-' . $sizeMain . '">
                <div class="form-group">
                    <div class="form-group d-flex justify-content-start align-items-center">
                        <label for="' . $key . '" class="col-md-' . $sizeTxt . ' text-right control-label">' . $txt . '</label>
                        <div class="col-md-' . $sizeInput . '">
                            <input type="text" name="' . $key . '" id="' . $key . '" class="form-control ' . $class . ' " value="' . $val . '">
                        </div>
                    </div>
                </div>
            </div>';
    }

    public static function boxSelect2($id, $select, $array, $txt, $sizeTxt, $sizeInput, $class = '', $option = '')
    {
        $select2 = '';
        if (is_array($array)) {
            $select2 .= '
            <div class="col-md-' . $sizeTxt . ' text-right control-label">' . $txt . '</div>
            <div class="col-md-' . $sizeInput . '">
                <div class="form-group">
                    <div class="form-group d-flex justify-content-start align-items-center">
                        <div class="col-md-12">
                            <select class="form-control select2 ' . $class . '" id="' . $id . '" ' . $option . ' name="' . $id . '">
                                <option disabled selected>เลือก</option>';
            foreach ($array as $key => $val) {
                $selected = ($key == $select) ? 'selected' : '';
                $select2 .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
            }
            $select2 .= '</select>
                        </div>
                    </div>
                </div>
            </div>';
        }
        return $select2;
    }
}

/*
echo pm::boxTxt('COURT_CODE_LAW', $COURT_CODE_LAW, 'รหัสศาล', 6, 4, 8, '');
echo pm::boxSelect2('TEST', $_GET['TEST'], array('asv' => 456, 'qwe' => 789), 'ทดสอบ', 6, 6);
*/
