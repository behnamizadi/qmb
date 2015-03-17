<?php
$a = new Lookup;
$b = $a -> getAll('study_degree');
unset($b[1]);
$b['default'] ='انتخاب';
if (isset($_POST['error']) && $_POST['error'] == 1)
	$l = '';
return array(

'manage' => array('<table id="add_tbl" class="create" style="display: none;">
 <tr>
 <td>', 'error' => array('type' => 'hidden', 'value' => 0), 
 'study_degree' => array('type' => 'select', 'options' => $b, 'validation' => 'required'), '</td><td>', 
 'study_field' => array('type' => 'select',' options' => CView::getVar('sfs'), 'validation' => 'required'), '</td><td>', '<label>تاریخ اخذ مدرک<span class="error">*</span></label>', 'y_get' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1340_1393', 'validation' => 'required'), '</td><td>', 'place' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => 'required'), '</td></tr><tr><td>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="btn btn-primary"'), '</td></tr></table>'), 
 
 'edit' => array('<table id="add_tbl" class="create"><tr><td>', 'reference' => 'model', 'study_degree' => array('type' => 'select', 'options' => $b, 'validation' => 'required'), '</td>
<td>', 'study_field' => array('type' => 'select', 'validation' => 'required', 'options' => CView::getVar('sfs')), '</td>
<td>', '<label>تاریخ اخذ مدرک<span class="error">*</span></label>', 'y_get' => array('decoration' => FALSE, 'type' => 'select', 'options' => 'years_1340_1393', 'validation' => 'required', 'reference' => 'y', ), '</td><td>', 'place' => array('type' => 'text', 'in' => 'class="txt"', 'validation' => 'required'), '</td></tr></table>', 'submit' => array('type' => 'submit', 'value' => 'ثبت', 'in' => 'class="btn btn-primary"') ));
?>
