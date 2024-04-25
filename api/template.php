<?php

class template
{
  protected $_template;
  protected $_temp_start = '<#';
  protected $_temp_end = '#>';

  public function load($s_path)
  {
    if(is_file($s_path)) {
      $this->_template = file::readFile($s_path);
    }
    else {
      getError('error path not found:'.$s_path);
    }
  }

  public function setStart($data)
  {
    $this->_temp_start = $data;
  }

  public function setEnd($data)
  {
    $this->_temp_end = $data;
  }

  public function loadTemplate($s_file)
  {
    $this->_template = file::readFile($s_file);
  }

  public function setValue($s_name, $s_value)
  {
    $this->_template = str_replace($this->_temp_start.$s_name.$this->_temp_end, $s_value, $this->_template);
  }

  public function setValueArray($a_data)
  {
    foreach ((array )$a_data as $_key => $_item)
    {
      $this->_template = str_replace($this->_temp_start.$_key.$this->_temp_end, $_item, $this->_template);
    }
  }

  public function setTemplate($s_template)
  {
    $this->_template = $s_template;
  }

  public function getTemplate()
  {
    return $this->_template;
  }

  public function save($s_file)
  {
    file::saveFile($s_file, $this->_template);
  }

  public function getParams($type=1)
  {
    preg_match_all("/".$this->_temp_start."(.+?)".$this->_temp_end."/is", $this->_template, $param, PREG_PATTERN_ORDER);
    return $param[$type];
  }

}

?>