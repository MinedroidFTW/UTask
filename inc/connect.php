<?php
/**
 * Created by Daniel Vidmar.
 * Date: 1/31/13
 * Time: 6:43 PM
 * Version: Beta 1
 * Last Modified: 3/17/2013 at 2:32 PM
 * Last Modified by Daniel Vidmar.
 */
class Connect
{
    public $sqlHost='MySQLHost';
    public $sqlUser='MySQLUser';
    public $sqlPass='MySQLPass';
    public $sqlDB='MySQLDB';
    public $tablePrefix='todo';

    public function connect(){
        return new mysqli($this->sqlHost, $this->sqlUser, $this->sqlPass, $this->sqlDB);
    }
}
?>
