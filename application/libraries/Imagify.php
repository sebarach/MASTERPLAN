<?php
/**
 * Codeigniter Imagify
 * @author David Ticona Saravia <david.ticona.saravia@gmail.com>
 * @version 1.0
 * @link http://codeignitertutoriales.com Blog del autor
 * 
 */
require APPPATH.'third_party/Imagify/class-imagify.php';
class Imagify extends Imagify\Optimizer
{
    private $api_key = 'be7829f79b7ec2d126e3fb176554a82dcd2fedb0';
    /**
     * Constructor
     * @param array $options Array de opciones
     */
    public function __construct(array $options = array())
    {
        $this->api_key = isset($options['api_key']) ? $options['api_key'] : $this->api_key;
        if ($this->api_key==='')
        {
            die("API KEY not found");
        }
        parent::__construct($this->api_key);
    }
}
